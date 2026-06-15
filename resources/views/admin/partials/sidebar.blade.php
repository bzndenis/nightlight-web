@php
    $navItems = [
        ['route' => 'admin.dashboard', 'match' => 'admin/dashboard*', 'label' => 'Dashboard', 'icon' => 'layout-grid'],
        ['route' => 'admin.announcement', 'match' => 'admin/announcement*', 'label' => 'Announcement', 'icon' => 'megaphone'],
        ['route' => 'admin.gallery', 'match' => 'admin/gallery*', 'label' => 'Gallery', 'icon' => 'image'],
        ['route' => 'admin.team', 'match' => 'admin/team*', 'label' => 'Team', 'icon' => 'users'],
        ['route' => 'admin.footer', 'match' => 'admin/footer*', 'label' => 'Footer', 'icon' => 'link-2'],
    ];
@endphp

<aside class="sidebar" id="adminSidebar" data-state="expanded" aria-label="Admin navigation">
    <div class="sidebar__inner">

        {{-- Brand --}}
        <div class="sidebar__head">
            <a href="{{ route('admin.dashboard') }}" class="sidebar__brand" title="NightLight Admin">
                <span class="sidebar__logo">NL</span>
                <span class="sidebar__brand-text">
                    <span class="sidebar__name">NightLight</span>
                    <span class="sidebar__tag">Admin Panel</span>
                </span>
            </a>
            <button type="button" class="sidebar__collapse" id="sidebarCollapse" aria-label="Toggle sidebar">
                <i data-lucide="panel-left-close" class="sidebar__collapse-icon sidebar__collapse-icon--open"></i>
                <i data-lucide="panel-left" class="sidebar__collapse-icon sidebar__collapse-icon--closed"></i>
            </button>
        </div>

        {{-- Navigation --}}
        <nav class="sidebar__nav">
            <p class="sidebar__section">Main Menu</p>
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
                            @if(request()->is($item['match']))
                                <span class="sidebar__link-indicator" aria-hidden="true"></span>
                            @endif
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        {{-- Footer --}}
        <div class="sidebar__foot">
            <p class="sidebar__section">System</p>
            <ul class="sidebar__menu">
                <li>
                    <a href="{{ url('/') }}" target="_blank" rel="noopener"
                       class="sidebar__link sidebar__link--muted" data-tooltip="View Site">
                        <span class="sidebar__link-icon">
                            <i data-lucide="external-link"></i>
                        </span>
                        <span class="sidebar__link-label">View Site</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.logout') }}"
                       class="sidebar__link sidebar__link--danger" data-tooltip="Logout">
                        <span class="sidebar__link-icon">
                            <i data-lucide="log-out"></i>
                        </span>
                        <span class="sidebar__link-label">Logout</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar__profile">
                <div class="sidebar__avatar">A</div>
                <div class="sidebar__profile-info">
                    <span class="sidebar__profile-name">Administrator</span>
                    <span class="sidebar__profile-role">Guild Manager</span>
                </div>
            </div>
        </div>

    </div>
</aside>

<div class="sidebar__backdrop" id="sidebarBackdrop" aria-hidden="true"></div>
