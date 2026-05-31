@extends('admin.layout')

@push('styles')
<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem;
    margin-bottom: 2rem;
}
.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 640px) {
    .stats-grid, .quick-actions-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')
    <div class="page-header" data-aos="fade-up">
        <h1>Dashboard</h1>
        <p class="page-subtitle">Overview of your NightLight guild</p>
    </div>

    <div class="stats-grid" data-aos="fade-up" data-aos-delay="100">
        <div class="glass-card stats-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="stat-number">{{ $totalMembers }}</div>
            <div class="stat-label">Total Members</div>
        </div>

        <div class="glass-card stats-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </div>
            <div class="stat-number">{{ $totalImages }}</div>
            <div class="stat-label">Gallery Images</div>
        </div>

        <div class="glass-card stats-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/>
                </svg>
            </div>
            <div class="stat-number">{{ $activeAnnouncements }}</div>
            <div class="stat-label">Active Announcements</div>
        </div>

        <div class="glass-card stats-card">
            <div class="stat-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            </div>
            <div class="stat-number">{{ $totalFooterLinks }}</div>
            <div class="stat-label">Footer Links</div>
        </div>
    </div>

    <div class="page-header" data-aos="fade-up" data-aos-delay="200">
        <h2>Quick Actions</h2>
    </div>

    <div class="quick-actions-grid" data-aos="fade-up" data-aos-delay="300">
        <div class="glass-card quick-action-card" data-href="{{ route('admin.announcement') }}">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 17H2a3 3 0 0 0 3-3V9a7 7 0 0 1 14 0v5a3 3 0 0 0 3 3zm-8.27 4a2 2 0 0 1-3.46 0"/>
                </svg>
            </div>
            <div class="quick-action-title">Announcement</div>
            <div class="quick-action-desc">Create and manage guild announcements</div>
        </div>

        <div class="glass-card quick-action-card" data-href="{{ route('admin.gallery') }}">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                    <circle cx="8.5" cy="8.5" r="1.5"/>
                    <polyline points="21 15 16 10 5 21"/>
                </svg>
            </div>
            <div class="quick-action-title">Gallery</div>
            <div class="quick-action-desc">Upload and organize gallery images</div>
        </div>

        <div class="glass-card quick-action-card" data-href="{{ route('admin.team') }}">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>
            <div class="quick-action-title">Team</div>
            <div class="quick-action-desc">Manage team members and roles</div>
        </div>

        <div class="glass-card quick-action-card" data-href="{{ route('admin.footer') }}">
            <div class="quick-action-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                    <polyline points="14 2 14 8 20 8"/>
                    <line x1="16" y1="13" x2="8" y2="13"/>
                    <line x1="16" y1="17" x2="8" y2="17"/>
                    <polyline points="10 9 9 9 8 9"/>
                </svg>
            </div>
            <div class="quick-action-title">Footer</div>
            <div class="quick-action-desc">Manage footer links and content</div>
        </div>
    </div>

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quick-action-card').forEach(function (card) {
            card.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });
    });
    </script>
    @endpush
@endsection