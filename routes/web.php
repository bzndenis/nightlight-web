<?php

use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('home');
});

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Login
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');
    
    Route::post('/login', function () {
        // Simple authentication - in production, use Laravel Auth
        $email = request('email');
        $password = request('password');
        
        // For demo purposes, accept admin@nightlight.com / admin123
        if ($email === 'admin@nightlight.com' && $password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }
        
        return back()->with('error', 'Invalid credentials');
    })->name('login.submit');
    
    Route::post('/logout', function () {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    })->name('logout');
    
    // Protected routes
    Route::group(['middleware' => function ($request, $next) {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }
        return $next($request);
    }], function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        
        Route::get('/announcement', function () {
            // In production, fetch from database
            $announcement = (object)[
                'title' => 'ANNOUNCEMENTS',
                'content' => 'Welcome to NightLight Guild! Stay tuned for updates and news.'
            ];
            return view('admin.announcement', compact('announcement'));
        })->name('announcement');
        
        Route::post('/announcement', function () {
            // In production, save to database
            return back()->with('success', 'Announcement updated successfully');
        })->name('announcement.update');
        
        Route::get('/gallery', function () {
            // In production, fetch from database
            $gallery = (object)[
                'title' => 'GALLERY',
                'description' => 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings.'
            ];
            $images = [];
            return view('admin.gallery', compact('gallery', 'images'));
        })->name('gallery');
        
        Route::post('/gallery', function () {
            // In production, save to database
            return back()->with('success', 'Gallery updated successfully');
        })->name('gallery.update');
        
        Route::post('/gallery/image', function () {
            // In production, handle image upload and save to database
            return back()->with('success', 'Image added successfully');
        })->name('gallery.image.add');
        
        Route::delete('/gallery/image/{id}', function ($id) {
            // In production, delete from database
            return back()->with('success', 'Image deleted successfully');
        })->name('gallery.image.delete');
        
        Route::get('/team', function () {
            // In production, fetch from database
            $teamMembers = [];
            return view('admin.team', compact('teamMembers'));
        })->name('team');
        
        Route::post('/team', function () {
            // In production, save to database
            return back()->with('success', 'Team member added successfully');
        })->name('team.store');
        
        Route::get('/team/{id}/edit', function ($id) {
            // In production, fetch from database
            return back()->with('error', 'Edit functionality coming soon');
        })->name('team.edit');
        
        Route::delete('/team/{id}', function ($id) {
            // In production, delete from database
            return back()->with('success', 'Team member deleted successfully');
        })->name('team.delete');
        
        Route::get('/footer', function () {
            // In production, fetch from database
            $footer = (object)[
                'description' => 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures.'
            ];
            $footerLinks = [];
            return view('admin.footer', compact('footer', 'footerLinks'));
        })->name('footer');
        
        Route::post('/footer', function () {
            // In production, save to database
            return back()->with('success', 'Footer updated successfully');
        })->name('footer.update');
        
        Route::post('/footer/link', function () {
            // In production, save to database
            return back()->with('success', 'Link added successfully');
        })->name('footer.link.add');
        
        Route::delete('/footer/link/{id}', function ($id) {
            // In production, delete from database
            return back()->with('success', 'Link deleted successfully');
        })->name('footer.link.delete');
    });
});
