@extends('admin.layout')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview of your guild site')

@section('content')
    {{-- Welcome Hero --}}
    <div class="dash-hero">
        <div class="dash-hero__content">
            <p class="dash-hero__eyebrow">
                <i data-lucide="sparkles"></i>
                {{ now()->format('l, F j, Y') }}
            </p>
            <h1 class="dash-hero__title">Welcome back, Admin</h1>
            <p class="dash-hero__subtitle">Here's what's happening with NightLight today.</p>
        </div>
        <div class="dash-hero__actions">
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="btn btn-ghost dash-btn-site">
                <i data-lucide="external-link"></i>
                View Site
            </a>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="stat-grid">
        <div class="stat-card stat-card--purple" data-aos="fade-up" data-aos-delay="0">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="users"></i>
                </div>
                <span class="stat-badge stat-badge--live">Active</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalMembers ?? 0 }}</div>
                <div class="stat-label">Team Members</div>
                @if(($totalMembersAll ?? 0) > ($totalMembers ?? 0))
                    <div class="stat-meta">{{ $totalMembersAll - $totalMembers }} inactive</div>
                @endif
            </div>
        </div>

        <div class="stat-card stat-card--cyan" data-aos="fade-up" data-aos-delay="80">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="image"></i>
                </div>
                <span class="stat-badge">Gallery</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalImages ?? 0 }}</div>
                <div class="stat-label">Gallery Images</div>
                <div class="stat-meta">{{ ($gallery->is_active ?? true) ? 'Section live' : 'Section hidden' }}</div>
            </div>
        </div>

        <div class="stat-card stat-card--violet" data-aos="fade-up" data-aos-delay="160">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="megaphone"></i>
                </div>
                <span class="stat-badge {{ ($announcement->is_active ?? false) ? 'stat-badge--live' : 'stat-badge--muted' }}">
                    {{ ($announcement->is_active ?? false) ? 'Live' : 'Off' }}
                </span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $activeAnnouncements ?? 0 }}</div>
                <div class="stat-label">Active Announcements</div>
                <div class="stat-meta">Homepage banner</div>
            </div>
        </div>

        <div class="stat-card stat-card--indigo" data-aos="fade-up" data-aos-delay="240">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="link-2"></i>
                </div>
                <span class="stat-badge">Footer</span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalFooterLinks ?? 0 }}</div>
                <div class="stat-label">Footer Links</div>
                @if(($totalFooterLinksAll ?? 0) > ($totalFooterLinks ?? 0))
                    <div class="stat-meta">{{ $totalFooterLinksAll - $totalFooterLinks }} inactive</div>
                @else
                    <div class="stat-meta">All links active</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="dash-grid">
        {{-- Left Column --}}
        <div class="dash-main">
            <div class="section-header" data-aos="fade-up">
                <div class="section-header__text">
                    <h2 class="section-title">
                        <i data-lucide="zap"></i>
                        Quick Actions
                    </h2>
                    <p class="section-desc">Jump straight to the most common tasks</p>
                </div>
            </div>

            <div class="qa-grid">
                <a href="{{ route('admin.announcement') }}" class="qa-card qa-card--announce" data-aos="fade-up" data-aos-delay="0">
                    <div class="qa-icon">
                        <i data-lucide="megaphone"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Announcements</h3>
                        <p>Create and manage guild announcements</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.gallery') }}" class="qa-card qa-card--gallery" data-aos="fade-up" data-aos-delay="60">
                    <div class="qa-icon">
                        <i data-lucide="image"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Gallery</h3>
                        <p>Upload and organize gallery images</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.team') }}" class="qa-card qa-card--team" data-aos="fade-up" data-aos-delay="120">
                    <div class="qa-icon">
                        <i data-lucide="users"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Team</h3>
                        <p>Manage team members and roles</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.footer') }}" class="qa-card qa-card--footer" data-aos="fade-up" data-aos-delay="180">
                    <div class="qa-icon">
                        <i data-lucide="link-2"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Footer</h3>
                        <p>Manage footer links and content</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>
            </div>

            @if($recentMembers->isNotEmpty())
                <div class="glass-card dash-recent" data-aos="fade-up">
                    <div class="card-title">
                        <i data-lucide="clock"></i>
                        Recently Updated Team
                    </div>
                    <ul class="recent-list">
                        @foreach($recentMembers as $member)
                            <li class="recent-item">
                                <div class="recent-avatar">
                                    @if($member->avatar)
                                        <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}">
                                    @else
                                        <span>{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="recent-info">
                                    <span class="recent-name">{{ $member->name }}</span>
                                    <span class="recent-role">{{ $member->role ?: 'No role set' }}</span>
                                </div>
                                <span class="recent-status {{ $member->is_active ? 'is-active' : 'is-inactive' }}">
                                    {{ $member->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('admin.team') }}" class="recent-link">
                        View all members
                        <i data-lucide="arrow-right"></i>
                    </a>
                </div>
            @endif
        </div>

        {{-- Right Sidebar --}}
        <aside class="dash-aside" data-aos="fade-left">
            {{-- Site Health --}}
            <div class="glass-card dash-health">
                <div class="card-title">
                    <i data-lucide="activity"></i>
                    Site Health
                </div>
                <ul class="health-list">
                    <li class="health-item {{ ($announcement->is_active ?? false) ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Announcement banner</span>
                        <span class="health-value">{{ ($announcement->is_active ?? false) ? 'Live' : 'Hidden' }}</span>
                    </li>
                    <li class="health-item {{ ($totalMembers ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Team roster</span>
                        <span class="health-value">{{ $totalMembers ?? 0 }} active</span>
                    </li>
                    <li class="health-item {{ ($totalImages ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Gallery content</span>
                        <span class="health-value">{{ $totalImages ?? 0 }} images</span>
                    </li>
                    <li class="health-item {{ ($totalFooterLinks ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Footer links</span>
                        <span class="health-value">{{ $totalFooterLinks ?? 0 }} active</span>
                    </li>
                </ul>
            </div>

            {{-- Announcement Preview --}}
            @if($announcement)
                <div class="glass-card dash-preview">
                    <div class="card-title">
                        <i data-lucide="eye"></i>
                        Live Preview
                    </div>
                    <div class="preview-banner">
                        <span class="preview-tag">Homepage Banner</span>
                        <h3 class="preview-title">{{ $announcement->title }}</h3>
                        <p class="preview-content">{{ Str::limit($announcement->content, 120) }}</p>
                        <a href="{{ route('admin.announcement') }}" class="preview-edit">
                            <i data-lucide="pencil"></i>
                            Edit announcement
                        </a>
                    </div>
                </div>
            @endif

            {{-- Tips --}}
            <div class="glass-card dash-tips">
                <div class="card-title">
                    <i data-lucide="lightbulb"></i>
                    Quick Tips
                </div>
                <ul class="tips-list">
                    <li>Keep announcements short and updated for maximum impact.</li>
                    <li>Upload high-quality images to make your gallery stand out.</li>
                    <li>Drag team members to reorder them on the public site.</li>
                </ul>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
<script>
    if (window.lucide) lucide.createIcons();
</script>
@endpush
