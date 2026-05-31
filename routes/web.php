<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    // Get announcement from database
    $announcement = App\Models\Announcement::where('is_active', true)->first();

    // Get gallery settings and images
    $gallery = App\Models\Gallery::where('is_active', true)->first();
    $galleryImages = [];

    // Get images from public directory (CMS uploads them here)
    $publicPath = public_path();
    if (is_dir($publicPath)) {
        $files = scandir($publicPath);
        foreach ($files as $file) {
            // Only include image files
            if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                $galleryImages[] = $file;
            }
        }
    }

    // Get team members from database
    $teamMembers = App\Models\TeamMember::where('is_active', true)->orderBy('order')->get();

    // Get footer settings from database
    $footerSettings = App\Models\FooterSetting::first();
    $footerLinks = App\Models\FooterLink::where('is_active', true)->orderBy('order')->get();

    return view('home', compact('announcement', 'gallery', 'galleryImages', 'teamMembers', 'footerSettings', 'footerLinks'));
});

// Login route (outside admin group so auth middleware can find 'login' route)
Route::get('/login', function () {
    return view('admin.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->with('error', 'Invalid credentials');
})->name('login.submit');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {

    Route::match(['get', 'post'], '/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');
    
    // Protected routes
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::get('/announcement', function () {
            $announcement = App\Models\Announcement::first();
            if (!$announcement) {
                $announcement = App\Models\Announcement::create([
                    'title' => 'ANNOUNCEMENTS',
                    'content' => 'Welcome to NightLight Guild! Stay tuned for updates and news.',
                    'is_active' => true
                ]);
            }
            return view('admin.announcement', compact('announcement'));
        })->name('announcement');

        Route::post('/announcement', function (Illuminate\Http\Request $request) {
            $announcement = App\Models\Announcement::first();
            if ($announcement) {
                $announcement->fill([
                    'title' => $request->input('title'),
                    'content' => $request->input('content')
                ]);
                $announcement->save();
            } else {
                App\Models\Announcement::create([
                    'title' => $request->input('title'),
                    'content' => $request->input('content'),
                    'is_active' => true
                ]);
            }
            return back()->with('success', 'Announcement updated successfully');
        })->name('announcement.update');
        
        Route::get('/gallery', function () {
            $gallery = App\Models\Gallery::first();
            if (!$gallery) {
                $gallery = App\Models\Gallery::create([
                    'title' => 'GALLERY',
                    'description' => 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings.',
                    'is_active' => true
                ]);
            }

            // Get images from public directory
            $images = [];
            $publicPath = public_path();
            if (is_dir($publicPath)) {
                $files = scandir($publicPath);
                foreach ($files as $file) {
                    // Only include image files
                    if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                        $images[] = (object)[
                            'id' => $file,
                            'filename' => $file,
                            'path' => $file
                        ];
                    }
                }
            }

            return view('admin.gallery', compact('gallery', 'images'));
        })->name('gallery');

        Route::post('/gallery', function (Illuminate\Http\Request $request) {
            $gallery = App\Models\Gallery::first();
            if ($gallery) {
                $gallery->title = $request->title;
                $gallery->description = $request->description;
                $gallery->save();
            } else {
                App\Models\Gallery::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'is_active' => true
                ]);
            }
            return back()->with('success', 'Gallery updated successfully');
        })->name('gallery.update');
        
        Route::post('/gallery/image', function (Illuminate\Http\Request $request) {
            try {
                // Validate the uploaded files
                $request->validate([
                    'images' => 'required|array',
                    'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120'
                ]);

                // Handle file uploads
                if ($request->hasFile('images')) {
                    $uploadedCount = 0;
                    $images = $request->file('images');
                    foreach ($images as $image) {
                        $imageName = time() . '_' . $uploadedCount . '_' . $image->getClientOriginalName();
                        $image->move(public_path(), $imageName);
                        $uploadedCount++;
                    }

                    return back()->with('success', $uploadedCount . ' image(s) uploaded successfully');
                }

                return back()->with('error', 'No images uploaded');
            } catch (\Exception $e) {
                return back()->with('error', 'Upload failed: ' . $e->getMessage());
            }
        })->name('gallery.image.add');
        
        Route::delete('/gallery/image/{id}', function ($id) {
            // Delete file from public directory
            $filePath = public_path($id);
            if (file_exists($filePath)) {
                unlink($filePath);
                return back()->with('success', 'Image deleted successfully');
            }

            return back()->with('error', 'Image not found');
        })->name('gallery.image.delete');
        
        Route::get('/team', function (Illuminate\Http\Request $request) {
            $sortBy = $request->get('sort', 'order');
            $sortDir = $request->get('dir', 'asc');
            $allowedSorts = ['id', 'name', 'role', 'order', 'is_active', 'created_at'];
            if (!in_array($sortBy, $allowedSorts)) $sortBy = 'order';
            $sortDir = $sortDir === 'desc' ? 'desc' : 'asc';
            $teamMembers = App\Models\TeamMember::orderBy($sortBy, $sortDir)->get();
            return view('admin.team', compact('teamMembers', 'sortBy', 'sortDir'));
        })->name('team');

        Route::post('/team', function (Illuminate\Http\Request $request) {
            $maxOrder = App\Models\TeamMember::max('order') ?? 0;
            $saved = 0;
            $names = $request->input('name', []);
            $roles = $request->input('role', []);
            $quotes = $request->input('quote', []);
            $avatars = $request->files->get('avatar', []);

            foreach ($names as $i => $name) {
                if (trim($name) === '') continue;
                $avatarPath = null;
                if (isset($avatars[$i]) && $avatars[$i]->isValid()) {
                    $image = $avatars[$i];
                    $imageName = time() . '_' . $i . '_' . $image->getClientOriginalName();
                    $image->move(public_path('images/avatars'), $imageName);
                    $avatarPath = 'images/avatars/' . $imageName;
                }
                App\Models\TeamMember::create([
                    'name' => trim($name),
                    'role' => trim($roles[$i] ?? ''),
                    'quote' => trim($quotes[$i] ?? ''),
                    'avatar' => $avatarPath,
                    'order' => $maxOrder + $saved + 1,
                    'is_active' => true
                ]);
                $saved++;
            }

            if ($saved > 0) {
                return back()->with('success', "$saved team member(s) added successfully");
            }
            return back()->with('error', 'No valid team member data provided');
        })->name('team.store');

        Route::get('/team/{id}/edit', function ($id) {
            return redirect()->route('admin.team', ['edit' => $id]);
        })->name('team.edit');

        Route::put('/team/{id}', function (Illuminate\Http\Request $request, $id) {
            $member = App\Models\TeamMember::find($id);
            if (!$member) {
                return back()->with('error', 'Team member not found');
            }
            
            // Handle avatar upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar if exists
                if ($member->avatar && file_exists(public_path($member->avatar))) {
                    unlink(public_path($member->avatar));
                }
                
                $image = $request->file('avatar');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/avatars'), $imageName);
                $member->avatar = 'images/avatars/' . $imageName;
            }
            
            $member->name = $request->name;
            $member->role = $request->role;
            $member->quote = $request->quote;
            $member->order = $request->order ?? $member->order;
            $member->is_active = $request->has('is_active');
            $member->save();
            
            return redirect()->route('admin.team')->with('success', 'Team member updated successfully');
        })->name('team.update');

        Route::delete('/team/{id}', function ($id) {
            $member = App\Models\TeamMember::find($id);
            if ($member) {
                $member->delete();
                return back()->with('success', 'Team member deleted successfully');
            }
            return back()->with('error', 'Team member not found');
        })->name('team.delete');
        
        Route::get('/footer', function () {
            $footer = App\Models\FooterSetting::first();
            if (!$footer) {
                $footer = App\Models\FooterSetting::create([
                    'description' => 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures.',
                    'copyright_text' => 'All Rights Reserved NightLight Guild.'
                ]);
            }
            $footerLinks = App\Models\FooterLink::orderBy('order')->get();
            return view('admin.footer', compact('footer', 'footerLinks'));
        })->name('footer');

        Route::post('/footer', function (Illuminate\Http\Request $request) {
            $footer = App\Models\FooterSetting::first();
            if ($footer) {
                $footer->description = $request->description;
                $footer->copyright_text = $request->copyright_text ?? 'All Rights Reserved NightLight Guild.';
                $footer->save();
            } else {
                App\Models\FooterSetting::create([
                    'description' => $request->description,
                    'copyright_text' => $request->copyright_text ?? 'All Rights Reserved NightLight Guild.'
                ]);
            }
            return back()->with('success', 'Footer updated successfully');
        })->name('footer.update');

        Route::post('/footer/link', function (Illuminate\Http\Request $request) {
            App\Models\FooterLink::create([
                'name' => $request->link_name,
                'url' => $request->link_url,
                'order' => App\Models\FooterLink::max('order') + 1,
                'is_active' => true
            ]);
            return back()->with('success', 'Link added successfully');
        })->name('footer.link.add');

        Route::delete('/footer/link/{id}', function ($id) {
            $link = App\Models\FooterLink::find($id);
            if ($link) {
                $link->delete();
                return back()->with('success', 'Link deleted successfully');
            }
            return back()->with('error', 'Link not found');
        })->name('footer.link.delete');
    });
});
