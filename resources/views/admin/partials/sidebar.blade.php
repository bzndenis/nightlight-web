@php
    $counts = $sidebarCounts ?? ['members' => 0, 'images' => 0, 'announcement_active' => false, 'links' => 0];

    $navItems = [
        [
            'route' => 'admin.dashboard',
            'match' => 'admin/dashboard*',
            'label' => 'Dashboard',
            'icon' => 'layout-grid',
            'badge' => null
        ],
        [
            'route' => 'admin.announcement',
            'match' => 'admin/announcement*',
            'label' => 'Announcement',
            'icon' => 'megaphone',
            'badge' => !empty($counts['announcement_active']) ? 'Live' : 'Off',
            'badgeClass' => !empty($counts['announcement_active']) ? 'sidebar__link-badge--live' : ''
        ],
        [
            'route' => 'admin.gallery',
            'match' => 'admin/gallery*',
            'label' => 'Gallery',
            'icon' => 'image',
            'badge' => isset($counts['images']) ? $counts['images'] : null,
            'badgeClass' => ''
        ],
        [
            'route' => 'admin.team',
            'match' => 'admin/team*',
            'label' => 'Team',
            'icon' => 'users',
            'badge' => isset($counts['members']) ? $counts['members'] : null,
            'badgeClass' => ''
        ],
        [
            'route' => 'admin.footer',
            'match' => 'admin/footer*',
            'label' => 'Footer',
            'icon' => 'link-2',
            'badge' => isset($counts['links']) ? $counts['links'] : null,
            'badgeClass' => ''
        ],
    ];
@endphp

<aside class="sidebar" id="adminSidebar" data-state="expanded" aria-label="Admin navigation">
    <div class="sidebar__inner">

        {{-- Brand / Head --}}
        <div class="sidebar__head">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__brand" title="NightLight Guild Admin">
                <div class="sidebar__logo-wrap">
                    <span class="sidebar__logo">NL</span>
                </div>
                <div class="sidebar__brand-text">
                    <span class="sidebar__name">NightLight</span>
                    <span class="sidebar__tag">Admin Console</span>
                </div>
            </a>
            <button type="button" class="sidebar__collapse" id="sidebarCollapse" aria-label="Toggle sidebar collapse">
                <i data-lucide="panel-left-close" class="sidebar__collapse-icon sidebar__collapse-icon--open"></i>
                <i data-lucide="panel-left" class="sidebar__collapse-icon sidebar__collapse-icon--closed"></i>
            </button>
        </div>

        {{-- Navigation Menu --}}
        <nav class="sidebar__nav">
            <p class="sidebar__section">Core Navigation</p>
            <ul class="sidebar__menu">
                @foreach($navItems as $item)
                    <li>
                        <a href="{{ route($item['route']) }}"
                           class="sidebar__link {{ request()->is($item['match']) ? 'is-active' : '' }}"
                           data-tooltip="{{ $item['label'] }}">
                            <span class="sidebar__link-icon">
                                <i data-lucide="{{ $item['icon'] }}"></i>
                            </span>
                            <span class="sidebar__link-label">{{ $item['label'] }}</span>
                            
                            @if(!empty($item['badge']))
                                <span class="sidebar__link-badge {{ $item['badgeClass'] ?? '' }}">{{ $item['badge'] }}</span>
                            @endif

                            @if(request()->is($item['match']))
                                <span class="sidebar__link-indicator" aria-hidden="true"></span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Footer System Info --}}
        <div class="sidebar__foot">
            <p class="sidebar__section">External</p>
            <ul class="sidebar__menu">
                <li>
                    <a href="{{ url('/') }}" target="_blank" rel="noopener"
                       class="sidebar__link" data-tooltip="Public Website">
                        <span class="sidebar__link-icon">
                            <i data-lucide="globe"></i>
                        </span>
                        <span class="sidebar__link-label">Public Website</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}"
                       class="sidebar__link sidebar__link--danger" data-tooltip="Sign Out">
                        <span class="sidebar__link-icon">
                            <i data-lucide="log-out"></i>
                        </span>
                        <span class="sidebar__link-label">Sign Out</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar__profile">
                <div class="sidebar__avatar">A</div>
                <div class="sidebar__profile-info">
                    <span class="sidebar__profile-name">Administrator</span>
                    <span class="sidebar__profile-role">Guild Master</span>
                </div>
            </div>
        </div>

    </div>
</aside>

<div class="sidebar__backdrop" id="sidebarBackdrop" aria-hidden="true"></div>
