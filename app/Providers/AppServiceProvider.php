<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('admin.*', function ($view) {
            try {
                $totalMembers = \App\Models\TeamMember::count();
                $totalLinks = \App\Models\FooterLink::count();
                $announcementActive = \App\Models\Announcement::where('is_active', true)->exists();
                
                $galleryCount = 0;
                $publicPath = public_path();
                if (is_dir($publicPath)) {
                    $files = scandir($publicPath);
                    foreach ($files as $file) {
                        if ($file !== '.' && $file !== '..' && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file)) {
                            $galleryCount++;
                        }
                    }
                }

                $view->with('sidebarCounts', [
                    'members' => $totalMembers,
                    'images' => $galleryCount,
                    'announcement_active' => $announcementActive,
                    'links' => $totalLinks,
                ]);
            } catch (\Throwable $e) {
                $view->with('sidebarCounts', [
                    'members' => 0,
                    'images' => 0,
                    'announcement_active' => false,
                    'links' => 0,
                ]);
            }
        });
    }
}

