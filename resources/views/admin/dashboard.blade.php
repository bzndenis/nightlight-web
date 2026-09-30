@extends('admin.layout')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Overview and management of your guild community')

@section('content')
    {{-- Welcome Hero Banner --}}
    <div class="dash-hero" data-aos="fade-up">
        <div class="dash-hero__content">
            <p class="dash-hero__eyebrow">
                <i data-lucide="sparkles"></i>
                <span>{{ now()->format('l, F j, Y') }}</span>
                <span style="opacity:0.4;">•</span>
                <span style="color:var(--accent-emerald-glow);">Systems Operational</span>
            </p>
            <h1 class="dash-hero__title">Welcome back, Admin</h1>
            <p class="dash-hero__subtitle">
                Manage NightLight Guild announcements, media gallery, team members, and footer links from a single hub.
            </p>
        </div>
        <div class="dash-hero__actions">
            <a href="{{ route('admin.announcement') }}" class="btn btn-secondary">
                <i data-lucide="megaphone"></i>
                <span>Post Announcement</span>
            </a>
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="btn btn-primary">
                <i data-lucide="external-link"></i>
                <span>View Public Site</span>
            </a>
        </div>
    </div>

    {{-- Stats Row --}}
    <div class="stat-grid">
        {{-- Stat 1: Team Members --}}
        <div class="stat-card stat-card--purple" data-aos="fade-up" data-aos-delay="0">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="users"></i>
                </div>
                <span class="stat-badge stat-badge--live">
                    {{ $totalMembers ?? 0 }} Active
                </span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalMembersAll ?? $totalMembers ?? 0 }}</div>
                <div class="stat-label">Guild Roster Members</div>
                @if(($totalMembersAll ?? 0) > ($totalMembers ?? 0))
                    <div class="stat-meta">{{ ($totalMembersAll - $totalMembers) }} members currently inactive</div>
                @else
                    <div class="stat-meta">All registered members are active</div>
                @endif
            </div>
        </div>

        {{-- Stat 2: Gallery Images --}}
        <div class="stat-card stat-card--cyan" data-aos="fade-up" data-aos-delay="60">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="image"></i>
                </div>
                <span class="stat-badge {{ ($gallery->is_active ?? true) ? 'stat-badge--live' : '' }}">
                    {{ ($gallery->is_active ?? true) ? 'Section Live' : 'Hidden' }}
                </span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalImages ?? 0 }}</div>
                <div class="stat-label">Gallery Media Files</div>
                <div class="stat-meta">Showcasing moments on homepage</div>
            </div>
        </div>

        {{-- Stat 3: Announcements --}}
        <div class="stat-card stat-card--violet" data-aos="fade-up" data-aos-delay="120">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="megaphone"></i>
                </div>
                <span class="stat-badge {{ ($announcement->is_active ?? false) ? 'stat-badge--live' : '' }}">
                    {{ ($announcement->is_active ?? false) ? 'Live Banner' : 'Inactive' }}
                </span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $activeAnnouncements ?? 0 }}</div>
                <div class="stat-label">Active Announcements</div>
                <div class="stat-meta">Direct notice to guild visitors</div>
            </div>
        </div>

        {{-- Stat 4: Footer Links --}}
        <div class="stat-card stat-card--emerald" data-aos="fade-up" data-aos-delay="180">
            <div class="stat-card__top">
                <div class="stat-icon">
                    <i data-lucide="link-2"></i>
                </div>
                <span class="stat-badge stat-badge--live">
                    {{ $totalFooterLinks ?? 0 }} Active
                </span>
            </div>
            <div class="stat-info">
                <div class="stat-num">{{ $totalFooterLinksAll ?? $totalFooterLinks ?? 0 }}</div>
                <div class="stat-label">Navigation & Social Links</div>
                <div class="stat-meta">Connected to guild community channels</div>
            </div>
        </div>
    </div>

    {{-- Main Grid --}}
    <div class="dash-grid">
        {{-- Left Column: Quick Actions & Lists --}}
        <div class="dash-main">
            <div class="section-title" data-aos="fade-up">
                <i data-lucide="zap"></i>
                <span>Quick Actions</span>
                <span class="badge badge--purple">Instant access</span>
            </div>

            <div class="qa-grid">
                <a href="{{ route('admin.announcement') }}" class="qa-card qa-card--announce" data-aos="fade-up" data-aos-delay="0">
                    <div class="qa-icon">
                        <i data-lucide="megaphone"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Announcements</h3>
                        <p>Draft & broadcast banners to homepage</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.gallery') }}" class="qa-card qa-card--gallery" data-aos="fade-up" data-aos-delay="60">
                    <div class="qa-icon">
                        <i data-lucide="image"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Media Gallery</h3>
                        <p>Upload screenshots, raids, and event photos</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.team') }}" class="qa-card qa-card--team" data-aos="fade-up" data-aos-delay="120">
                    <div class="qa-icon">
                        <i data-lucide="users"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Team Roster</h3>
                        <p>Organize members, assign roles & quotes</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>

                <a href="{{ route('admin.footer') }}" class="qa-card qa-card--footer" data-aos="fade-up" data-aos-delay="180">
                    <div class="qa-icon">
                        <i data-lucide="link-2"></i>
                    </div>
                    <div class="qa-text">
                        <h3>Footer & Socials</h3>
                        <p>Configure links, description & copyright</p>
                    </div>
                    <span class="qa-arrow"><i data-lucide="arrow-right"></i></span>
                </a>
            </div>

            {{-- Recently Updated Team --}}
            @if(isset($recentMembers) && $recentMembers->isNotEmpty())
                <div class="glass-card" data-aos="fade-up">
                    <div class="card-header">
                        <div class="card-title">
                            <i data-lucide="users"></i>
                            <span>Recently Updated Members</span>
                        </div>
                        <a href="{{ route('admin.team') }}" class="btn btn-ghost btn-sm">
                            <span>View All</span>
                            <i data-lucide="arrow-right"></i>
                        </a>
                    </div>

                    <ul class="recent-list">
                        @foreach($recentMembers as $member)
                            <li class="recent-item">
                                <div class="recent-avatar">
                                    @if($member->avatar && file_exists(public_path($member->avatar)))
                                        <img src="{{ asset($member->avatar) }}" alt="{{ $member->name }}">
                                    @else
                                        <span>{{ strtoupper(substr($member->name, 0, 1)) }}</span>
                                    @endif
                                </div>
                                <div class="recent-info">
                                    <span class="recent-name">{{ $member->name }}</span>
                                    <span class="recent-role">{{ $member->role ?: 'Guild Member' }}</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:8px;">
                                    <span class="status-pill {{ $member->is_active ? 'status-pill--active' : 'status-pill--inactive' }}">
                                        {{ $member->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <a href="{{ route('admin.team', ['edit' => $member->id]) }}" class="btn-icon btn-icon--edit" title="Edit Member">
                                        <i data-lucide="pencil"></i>
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- System Health / Environment Card --}}
            <div class="glass-card" data-aos="fade-up">
                <div class="card-header">
                    <div class="card-title">
                        <i data-lucide="cpu"></i>
                        <span>System Environment & Status</span>
                    </div>
                    <span class="badge badge--emerald">Normal</span>
                </div>

                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap:16px;">
                    <div style="padding:14px; background:rgba(255,255,255,0.02); border:1px solid var(--border-subtle); border-radius:var(--radius-sm);">
                        <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em;">Framework</div>
                        <div style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-top:4px;">Laravel {{ app()->version() }}</div>
                    </div>
                    <div style="padding:14px; background:rgba(255,255,255,0.02); border:1px solid var(--border-subtle); border-radius:var(--radius-sm);">
                        <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em;">PHP Runtime</div>
                        <div style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-top:4px;">v{{ PHP_VERSION }}</div>
                    </div>
                    <div style="padding:14px; background:rgba(255,255,255,0.02); border:1px solid var(--border-subtle); border-radius:var(--radius-sm);">
                        <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em;">Environment</div>
                        <div style="font-size:1.05rem; font-weight:700; color:var(--accent-cyan); margin-top:4px;">{{ ucfirst(app()->environment()) }}</div>
                    </div>
                    <div style="padding:14px; background:rgba(255,255,255,0.02); border:1px solid var(--border-subtle); border-radius:var(--radius-sm);">
                        <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; letter-spacing:0.05em;">Server Time</div>
                        <div style="font-size:1.05rem; font-weight:700; color:var(--text-primary); margin-top:4px;">{{ now()->format('H:i') }} UTC</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Live Previews & Health --}}
        <aside class="dash-aside" data-aos="fade-left">
            {{-- Site Health Checklist --}}
            <div class="glass-card">
                <div class="card-header">
                    <div class="card-title">
                        <i data-lucide="activity"></i>
                        <span>Guild Site Health</span>
                    </div>
                </div>
                <ul class="health-list">
                    <li class="health-item {{ ($announcement->is_active ?? false) ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Announcement Banner</span>
                        <span class="health-value">{{ ($announcement->is_active ?? false) ? 'Broadcasting' : 'Hidden' }}</span>
                    </li>
                    <li class="health-item {{ ($totalMembers ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Guild Roster</span>
                        <span class="health-value">{{ $totalMembers ?? 0 }} Active</span>
                    </li>
                    <li class="health-item {{ ($totalImages ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Gallery Media</span>
                        <span class="health-value">{{ $totalImages ?? 0 }} Items</span>
                    </li>
                    <li class="health-item {{ ($totalFooterLinks ?? 0) > 0 ? 'health-item--ok' : 'health-item--warn' }}">
                        <span class="health-dot"></span>
                        <span class="health-label">Social & Footer Links</span>
                        <span class="health-value">{{ $totalFooterLinks ?? 0 }} Active</span>
                    </li>
                </ul>
            </div>

            {{-- Live Announcement Preview --}}
            @if(isset($announcement))
                <div class="glass-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i data-lucide="eye"></i>
                            <span>Live Announcement</span>
                        </div>
                        <a href="{{ route('admin.announcement') }}" class="btn-icon btn-icon--edit" title="Edit Announcement">
                            <i data-lucide="pencil"></i>
                        </a>
                    </div>
                    <div class="preview-banner-box">
                        <span class="preview-tag">Homepage Broadcast</span>
                        <h4 class="preview-title">{{ $announcement->title }}</h4>
                        <p class="preview-content">{{ Str::limit($announcement->content, 140) }}</p>
                    </div>
                </div>
            @endif

            {{-- Admin Pro Tips --}}
            <div class="glass-card">
                <div class="card-header">
                    <div class="card-title">
                        <i data-lucide="sparkles"></i>
                        <span>Pro Tips</span>
                    </div>
                </div>
                <div style="display:flex; flex-direction:column; gap:12px; font-size:0.85rem; color:var(--text-secondary); line-height:1.5;">
                    <div style="display:flex; gap:10px;">
                        <i data-lucide="check" style="color:var(--accent-cyan); width:16px; height:16px; flex-shrink:0; margin-top:2px;"></i>
                        <span>Drag & drop team members and footer links to instantly reorder them on the public page.</span>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <i data-lucide="check" style="color:var(--accent-purple-glow); width:16px; height:16px; flex-shrink:0; margin-top:2px;"></i>
                        <span>Use <kbd style="font-family:var(--font-mono); font-size:0.75rem; background:rgba(255,255,255,0.08); padding:2px 5px; border-radius:4px;">Ctrl+K</kbd> to jump across dashboard sections anytime.</span>
                    </div>
                    <div style="display:flex; gap:10px;">
                        <i data-lucide="check" style="color:var(--accent-emerald-glow); width:16px; height:16px; flex-shrink:0; margin-top:2px;"></i>
                        <span>Toggle dark and light themes smoothly from the header button.</span>
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
<script>
    if (window.lucide) lucide.createIcons();
</script>
@endpush
