@extends('admin.layout')

@section('page-title', 'Dashboard')

@section('content')
    <div class="page-header" data-aos="fade-up">
        <h1>Dashboard</h1>
        <p class="page-subtitle">Overview of your NightLight guild</p>
    </div>

    {{-- Stats Row --}}
    <div class="stat-grid" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalMembers }}</div>
                <div class="stat-label">Total Team Members</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                    <circle cx="9" cy="9" r="2"/>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalImages }}</div>
                <div class="stat-label">Gallery Images</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 11 18-5v12L3 13v-2z"/>
                    <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $activeAnnouncements }}</div>
                <div class="stat-label">Active Announcements</div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalFooterLinks }}</div>
                <div class="stat-label">Footer Links</div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="page-header" data-aos="fade-up" data-aos-delay="200" style="margin-top:40px;">
        <h2>Quick Actions</h2>
    </div>

    <div class="qa-grid" data-aos="fade-up" data-aos-delay="300">
        <a href="{{ route('admin.announcement') }}" class="quick-action-card">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m3 11 18-5v12L3 13v-2z"/>
                    <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/>
                </svg>
            </div>
            <div class="quick-action-text">
                <h3>Announcement</h3>
                <p>Create and manage guild announcements</p>
            </div>
        </a>

        <a href="{{ route('admin.gallery') }}" class="quick-action-card">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2"/>
                    <circle cx="9" cy="9" r="2"/>
                    <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>
                </svg>
            </div>
            <div class="quick-action-text">
                <h3>Gallery</h3>
                <p>Upload and organize gallery images</p>
            </div>
        </a>

        <a href="{{ route('admin.team') }}" class="quick-action-card">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="quick-action-text">
                <h3>Team</h3>
                <p>Manage team members and roles</p>
            </div>
        </a>

        <a href="{{ route('admin.footer') }}" class="quick-action-card">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
            </div>
            <div class="quick-action-text">
                <h3>Footer</h3>
                <p>Manage footer links and content</p>
            </div>
        </a>
    </div>
@endsection