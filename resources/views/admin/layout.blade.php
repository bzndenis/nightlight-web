<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <meta charset="utf-8">
    <title>@yield('page-title', 'Dashboard') — NightLight Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    @stack('styles')

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <script>
        (function () {
            var state = localStorage.getItem('admin-sidebar-state');
            var collapsed = state === 'collapsed' && window.innerWidth > 768;
            document.documentElement.style.setProperty(
                '--sidebar-current',
                collapsed ? '76px' : '264px'
            );
        })();
    </script>
</head>

<body class="admin-body">

    <div class="admin-shell">

        @include('admin.partials.sidebar')

        <div class="admin-shell__main" id="adminMain">

            <header class="admin-topbar">
                <div class="admin-topbar__left">
                    <button type="button" class="admin-topbar__menu" id="mobileMenuBtn" aria-label="Open menu">
                        <i data-lucide="menu"></i>
                    </button>
                    <div class="admin-topbar__titles">
                        <h1 class="admin-topbar__title">@yield('page-title', 'Dashboard')</h1>
                        @hasSection('page-subtitle')
                            <p class="admin-topbar__subtitle">@yield('page-subtitle')</p>
                        @endif
                    </div>
                </div>
                <div class="admin-topbar__right">
                    <button type="button" class="admin-topbar__theme" id="themeToggle" title="Toggle theme" aria-label="Toggle dark/light mode">
                        <i data-lucide="moon" class="theme-icon theme-icon--dark"></i>
                        <i data-lucide="sun" class="theme-icon theme-icon--light"></i>
                    </button>
                    <div class="admin-topbar__user" title="Admin">
                        <span>A</span>
                    </div>
                </div>
            </header>

            <div class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        <span>{{ session('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">
                        <span>{{ session('error') }}</span>
                        <button type="button" onclick="this.parentElement.remove()" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        AOS.init({ duration: 500, easing: 'ease-out-cubic', once: true, offset: 40 });

        (function () {
            const sidebar = document.getElementById('adminSidebar');
            const adminMain = document.getElementById('adminMain');
            const collapseBtn = document.getElementById('sidebarCollapse');
            const mobileBtn = document.getElementById('mobileMenuBtn');
            const backdrop = document.getElementById('sidebarBackdrop');
            const mqMobile = window.matchMedia('(max-width: 768px)');
            const STORAGE_KEY = 'admin-sidebar-state';

            function isMobile() { return mqMobile.matches; }

            function applySidebarState(state) {
                if (!sidebar) return;
                sidebar.dataset.state = state;
                document.documentElement.style.setProperty(
                    '--sidebar-current',
                    state === 'expanded' ? '264px' : '76px'
                );
            }

            function getDesktopState() {
                return localStorage.getItem(STORAGE_KEY) === 'collapsed' ? 'collapsed' : 'expanded';
            }

            function initSidebar() {
                if (!sidebar) return;
                if (isMobile()) {
                    sidebar.dataset.state = 'mobile-closed';
                } else {
                    applySidebarState(getDesktopState());
                }
            }

            function toggleDesktopSidebar() {
                const next = sidebar.dataset.state === 'expanded' ? 'collapsed' : 'expanded';
                applySidebarState(next);
                localStorage.setItem(STORAGE_KEY, next);
            }

            function openMobileSidebar() {
                sidebar.dataset.state = 'mobile-open';
                backdrop?.classList.add('is-visible');
                document.body.classList.add('sidebar-open');
            }

            function closeMobileSidebar() {
                sidebar.dataset.state = 'mobile-closed';
                backdrop?.classList.remove('is-visible');
                document.body.classList.remove('sidebar-open');
            }

            collapseBtn?.addEventListener('click', () => {
                if (!isMobile()) toggleDesktopSidebar();
            });

            mobileBtn?.addEventListener('click', () => {
                if (sidebar.dataset.state === 'mobile-open') {
                    closeMobileSidebar();
                } else {
                    openMobileSidebar();
                }
            });

            backdrop?.addEventListener('click', closeMobileSidebar);

            sidebar?.querySelectorAll('.sidebar__link').forEach(link => {
                link.addEventListener('click', () => {
                    if (isMobile()) closeMobileSidebar();
                });
            });

            mqMobile.addEventListener('change', () => {
                closeMobileSidebar();
                initSidebar();
            });

            initSidebar();

            // Theme
            const themeBtn = document.getElementById('themeToggle');
            const savedTheme = localStorage.getItem('admin-theme');
            if (savedTheme === 'light') document.documentElement.classList.add('light-mode');

            themeBtn?.addEventListener('click', () => {
                const isLight = document.documentElement.classList.toggle('light-mode');
                localStorage.setItem('admin-theme', isLight ? 'light' : 'dark');
            });

            // Toast
            window.showToast = function (message, type = 'success') {
                const container = document.getElementById('toastContainer');
                const toast = document.createElement('div');
                toast.className = 'toast toast-' + type;
                toast.textContent = message;
                container.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            };

            if (window.lucide) lucide.createIcons();
        })();
    </script>

    @stack('scripts')

</body>
</html>
