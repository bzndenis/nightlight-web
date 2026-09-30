<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
    // 1. Validasi ketat input untuk menangkal malformed input / type juggling
    $validated = $request->validate([
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'max:255'],
    ], [
        'email.required' => 'Email kedinasan wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'password.required' => 'Kata sandi wajib diisi.',
    ]);

    // 2. Anti Brute-Force Rate Limiting (Maksimal 5 percobaan per menit per email + IP)
    $throttleKey = Str::transliterate(Str::lower($validated['email']) . '|' . $request->ip());

    if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = RateLimiter::availableIn($throttleKey);
        return back()
            ->with('error', "Terlalu banyak percobaan masuk. Akses dibatasi sementara demi keamanan. Silakan coba kembali dalam {$seconds} detik.")
            ->withInput($request->only('email'));
    }

    // 3. Autentikasi PDO Prepared Statement (Kebal dari SQL Injection)
    $remember = $request->boolean('remember');
    if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']], $remember)) {
        RateLimiter::clear($throttleKey);
        // Regenerasi session ID untuk menangkal Session Fixation
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard'));
    }

    RateLimiter::hit($throttleKey, 60);

    return back()
        ->with('error', 'Kombinasi email atau kata sandi tidak cocok.')
        ->withInput($request->only('email'));
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
            $totalMembers = \App\Models\TeamMember::where('is_active', true)->count();
            $totalMembersAll = \App\Models\TeamMember::count();
            $publicPath = public_path();
            $totalImages = 0;
            if (is_dir($publicPath)) {
                $files = scandir($publicPath);
                foreach ($files as $file) {
                    if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
                        $totalImages++;
                    }
                }
            }
            $activeAnnouncements = \App\Models\Announcement::where('is_active', true)->count();
            $totalFooterLinks = \App\Models\FooterLink::where('is_active', true)->count();
            $totalFooterLinksAll = \App\Models\FooterLink::count();
            $announcement = \App\Models\Announcement::first();
            $recentMembers = \App\Models\TeamMember::orderByDesc('updated_at')->limit(3)->get();
            $gallery = \App\Models\Gallery::first();
            return view('admin.dashboard', compact(
                'totalMembers',
                'totalMembersAll',
                'totalImages',
                'activeAnnouncements',
                'totalFooterLinks',
                'totalFooterLinksAll',
                'announcement',
                'recentMembers',
                'gallery'
            ));
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
            $data = [
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'is_active' => $request->has('is_active'),
            ];
            if ($announcement) {
                $announcement->fill($data);
                $announcement->save();
            } else {
                App\Models\Announcement::create($data);
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
                    if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                        $fullPath = $publicPath . DIRECTORY_SEPARATOR . $file;
                        $sizeBytes = file_exists($fullPath) ? filesize($fullPath) : 0;
                        $sizeFormatted = $sizeBytes > 1048576 
                            ? round($sizeBytes / 1048576, 2) . ' MB' 
                            : round($sizeBytes / 1024, 1) . ' KB';
                        $modifiedAt = file_exists($fullPath) ? date('M d, Y', filemtime($fullPath)) : 'Recent';

                        $images[] = (object)[
                            'id' => $file,
                            'filename' => $file,
                            'path' => $file,
                            'size' => $sizeFormatted,
                            'date' => $modifiedAt,
                        ];
                    }
                }
            }

            return view('admin.gallery', compact('gallery', 'images'));
        })->name('gallery');

        Route::post('/gallery', function (Illuminate\Http\Request $request) {
            $gallery = App\Models\Gallery::first();
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->has('is_active'),
            ];
            if ($gallery) {
                $gallery->fill($data);
                $gallery->save();
            } else {
                App\Models\Gallery::create($data);
            }
            return back()->with('success', 'Gallery settings updated successfully');
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

        Route::post('/team/reorder', function (Illuminate\Http\Request $request) {
            $ids = $request->input('ids', []);
            foreach ($ids as $index => $id) {
                App\Models\TeamMember::where('id', $id)->update(['order' => $index + 1]);
            }
            return response()->json(['success' => true]);
        })->name('team.reorder');

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
            $request->validate([
                'link_name' => 'required|string|max:100',
                'link_url' => 'required|string|max:255',
            ]);
            $maxOrder = App\Models\FooterLink::max('order') ?? 0;
            App\Models\FooterLink::create([
                'name' => trim($request->link_name),
                'url' => trim($request->link_url),
                'order' => $maxOrder + 1,
                'is_active' => true
            ]);
            return back()->with('success', 'Footer link added successfully');
        })->name('footer.link.add');

        Route::put('/footer/link/{id}', function (Illuminate\Http\Request $request, $id) {
            $link = App\Models\FooterLink::find($id);
            if (!$link) {
                return back()->with('error', 'Link not found');
            }
            $link->name = trim($request->name ?? $link->name);
            $link->url = trim($request->url ?? $link->url);
            $link->is_active = $request->has('is_active');
            $link->save();
            return back()->with('success', 'Footer link updated successfully');
        })->name('footer.link.update');

        Route::post('/footer/link/reorder', function (Illuminate\Http\Request $request) {
            $ids = $request->input('ids', []);
            foreach ($ids as $index => $id) {
                App\Models\FooterLink::where('id', $id)->update(['order' => $index + 1]);
            }
            return response()->json(['success' => true]);
        })->name('footer.link.reorder');

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

