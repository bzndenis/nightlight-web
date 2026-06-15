<!DOCTYPE html>
<html lang="en" class="no-js">

<head>

    <!--- basic page needs
   ================================================== -->
    <meta charset="utf-8">
    <title>@yield('page-title', 'Dashboard') — NightLight Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    @stack('styles')

    <!-- favicons
	================================================== -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    </head>

<body>

    <div class="admin-container">

        {{-- Sidebar --}}
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="logo-area">
                <span class="logo-glyph">NL</span>
                <span class="logo-text">NightLight</span>
            </div>

            <nav>
                <ul>
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                           class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}"
                           data-tooltip="Dashboard">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            </i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcement') }}"
                           class="{{ request()->is('admin/announcement*') ? 'active' : '' }}"
                           data-tooltip="Announcement">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                            </i>
                            <span class="nav-label">Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery') }}"
                           class="{{ request()->is('admin/gallery*') ? 'active' : '' }}"
                           data-tooltip="Gallery">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </i>
                            <span class="nav-label">Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.team') }}"
                           class="{{ request()->is('admin/team*') ? 'active' : '' }}"
                           data-tooltip="Team">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </i>
                            <span class="nav-label">Team</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.footer') }}"
                           class="{{ request()->is('admin/footer*') ? 'active' : '' }}"
                           data-tooltip="Footer">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                            </i>
                            <span class="nav-label">Footer</span>
                        </a>
                    </li>
                    <li class="nav-divider"></li>
                    <li>
                        <a href="{{ route('admin.logout') }}" class="logout-link" data-tooltip="Logout">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                            </i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- Main Content --}}
        <main class="admin-main">
            <header class="admin-header">
                <div class="page-title">@yield('page-title', 'Dashboard')</div>
                <div class="header-right">
                    <div class="theme-toggle" id="themeToggle" title="Toggle dark/light mode">
                        <span class="toggle-label">Dark</span>
                        <div class="toggle-track">
                            <div class="toggle-thumb"></div>
                        </div>
                        <span class="toggle-label">Light</span>
                    </div>
                    <div class="admin-avatar" title="Admin">A</div>
                </div>
            </header>

            <div class="admin-page">
                @if(session('success'))
                    <div class="alert alert-success">
                        <span>{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="alert-close">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">
                        <span>{{ session('error') }}</span>
                        <button onclick="this.parentElement.remove()" class="alert-close">&times;</button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <!-- JavaScript -->
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        // AOS init
        AOS.init({ duration: 600, easing: 'ease-in-out', once: true, offset: 60 });

        // Sidebar expand on hover
        const sidebar = document.getElementById('adminSidebar');
        if (sidebar) {
            sidebar.addEventListener('mouseenter', () => sidebar.classList.add('expanded'));
            sidebar.addEventListener('mouseleave', () => sidebar.classList.remove('expanded'));
        }

        // Theme toggle
        function applyTheme(isLight) {
            if (isLight) {
                document.documentElement.classList.add('light-mode');
            } else {
                document.documentElement.classList.remove('light-mode');
            }
        }

        const savedTheme = localStorage.getItem('admin-theme');
        applyTheme(savedTheme === 'light');

        const themeToggle = document.getElementById('themeToggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const isLight = document.documentElement.classList.toggle('light-mode');
                localStorage.setItem('admin-theme', isLight ? 'light' : 'dark');
            });
        }

        // Toast helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }

        // Lucide icons
        function refreshIcons() {
            if (window.lucide) window.lucide.createIcons();
        }
        refreshIcons();
    </script>

    @stack('scripts')

</body>
</html>