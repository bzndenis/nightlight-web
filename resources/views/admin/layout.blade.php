<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('page-title', 'Dashboard') — NightLight Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Direct Static Assets (No Vite / No Build Step Required - Pure Vanilla CSS & Scripts) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ file_exists(public_path('css/admin.css')) ? filemtime(public_path('css/admin.css')) : time() }}">
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
                collapsed ? '78px' : '264px'
            );
            var theme = localStorage.getItem('admin-theme');
            if (theme === 'light') {
                document.documentElement.classList.add('light-mode');
            }
        })();
    </script>
</head>

<body class="admin-body">

    <div class="admin-shell">

        @include('admin.partials.sidebar')

        <div class="admin-shell__main" id="adminMain">

            {{-- Topbar Header --}}
            <header class="admin-topbar">
                <div class="admin-topbar__left">
                    <button type="button" class="admin-topbar__menu" id="mobileMenuBtn" aria-label="Open sidebar menu">
                        <i data-lucide="menu"></i>
                    </button>
                    
                    <nav class="admin-topbar__breadcrumbs" aria-label="Breadcrumb">
                        <a href="{{ route('admin.dashboard') }}" class="admin-topbar__breadcrumbs-brand">
                            <span class="admin-topbar__crumb-dot"></span>
                            <span>NightLight</span>
                        </a>
                        <span class="admin-topbar__breadcrumbs-separator">
                            <i data-lucide="chevron-right" style="width:13px;height:13px;"></i>
                        </span>
                        <span class="admin-topbar__breadcrumbs-current">@yield('page-title', 'Dashboard')</span>
                    </nav>
                </div>

                <div class="admin-topbar__right">
                    {{-- Quick Search Palette Trigger --}}
                    <button type="button" class="admin-topbar__search-trigger" id="searchTriggerBtn" title="Quick Navigation (Ctrl+K)">
                        <i data-lucide="search" style="width:16px;height:16px;"></i>
                        <span>Search actions...</span>
                        <span class="admin-topbar__search-shortcut">Ctrl K</span>
                    </button>

                    {{-- Public Site Link --}}
                    <a href="{{ url('/') }}" target="_blank" rel="noopener" class="admin-topbar__action-btn" title="View Public Website">
                        <i data-lucide="external-link"></i>
                    </a>

                    {{-- Theme Toggle --}}
                    <button type="button" class="admin-topbar__action-btn" id="themeToggle" title="Toggle Dark/Light Mode" aria-label="Toggle theme">
                        <i data-lucide="moon" class="theme-icon theme-icon--dark"></i>
                        <i data-lucide="sun" class="theme-icon theme-icon--light"></i>
                    </button>

                    {{-- User Profile Dropdown --}}
                    <div class="admin-user-menu" id="userMenu">
                        <div class="admin-user-trigger" id="userMenuTrigger">
                            <div class="admin-user-avatar">
                                <span>A</span>
                            </div>
                            <div class="admin-user-info">
                                <span class="admin-user-name">Administrator</span>
                                <span class="admin-user-role">Guild Master</span>
                            </div>
                            <i data-lucide="chevron-down" class="admin-user-chevron"></i>
                        </div>

                        <div class="admin-user-dropdown" id="userDropdown">
                            <div class="admin-user-dropdown-header">
                                <div class="admin-user-dropdown-title">Administrator</div>
                                <div class="admin-user-dropdown-email">admin@nightlight.com</div>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="admin-user-dropdown-item">
                                <i data-lucide="layout-grid"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('admin.team') }}" class="admin-user-dropdown-item">
                                <i data-lucide="users"></i>
                                <span>Team Management</span>
                            </a>
                            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="admin-user-dropdown-item">
                                <i data-lucide="globe"></i>
                                <span>Public Website</span>
                            </a>
                            <div style="border-top: 1px solid var(--border); margin: 6px 0;"></div>
                            <a href="{{ route('admin.logout') }}" class="admin-user-dropdown-item admin-user-dropdown-item--danger">
                                <i data-lucide="log-out"></i>
                                <span>Sign Out</span>
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Main Content Area --}}
            <main class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success" data-aos="fade-down">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <i data-lucide="check-circle-2" style="width:20px;height:20px;flex-shrink:0;"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error" data-aos="fade-down">
                        <div style="display:flex; align-items:center; gap:10px;">
                            <i data-lucide="alert-circle" style="width:20px;height:20px;flex-shrink:0;"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" onclick="this.parentElement.remove()" class="alert-close" aria-label="Close">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Toasts Container --}}
    <div class="toast-container" id="toastContainer"></div>

    {{-- Global Confirmation Modal Dialog --}}
    <div id="globalConfirmModal" class="modal-overlay" style="display: none;" role="dialog" aria-modal="true">
        <div class="modal-panel" style="max-width: 440px;">
            <div class="modal-header">
                <h2 id="globalConfirmTitle" style="display:flex;align-items:center;gap:10px;color:var(--accent-rose);">
                    <i data-lucide="alert-triangle"></i>
                    <span>Confirm Action</span>
                </h2>
                <button type="button" class="modal-close" onclick="closeConfirmModal()" aria-label="Close">
                    <i data-lucide="x"></i>
                </button>
            </div>
            <p id="globalConfirmMessage" style="font-size:0.95rem;color:var(--text-secondary);line-height:1.6;margin-bottom:20px;">
                Are you sure you want to proceed? This action cannot be undone.
            </p>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary" onclick="closeConfirmModal()">Cancel</button>
                <button type="button" class="btn btn-danger" id="globalConfirmSubmitBtn">Delete</button>
            </div>
        </div>
    </div>

    {{-- Command Palette / Quick Search Modal --}}
    <div id="quickSearchModal" class="modal-overlay" style="display: none;" role="dialog" aria-modal="true">
        <div class="modal-panel" style="max-width: 560px; padding: 20px;">
            <div style="display:flex; align-items:center; gap:12px; padding-bottom:14px; border-bottom:1px solid var(--border);">
                <i data-lucide="search" style="color:var(--accent-cyan); width:20px; height:20px;"></i>
                <input type="text" id="quickSearchInput" placeholder="Type a command or jump to page..." 
                       style="background:transparent; border:none; color:var(--text-primary); font-size:1rem; outline:none; width:100%;">
                <kbd style="font-family:var(--font-mono); font-size:0.75rem; color:var(--text-muted); padding:3px 6px; border:1px solid var(--border); border-radius:4px;">ESC</kbd>
            </div>
            <div id="quickSearchResults" style="margin-top:14px; display:flex; flex-direction:column; gap:6px; max-height:300px; overflow-y:auto;">
                <a href="{{ route('admin.dashboard') }}" class="admin-user-dropdown-item" style="padding:10px 14px;">
                    <i data-lucide="layout-grid" style="color:var(--accent-purple);"></i>
                    <span style="font-weight:600;">Dashboard Overview</span>
                    <span style="margin-left:auto; font-size:0.75rem; color:var(--text-muted);">Main metrics</span>
                </a>
                <a href="{{ route('admin.announcement') }}" class="admin-user-dropdown-item" style="padding:10px 14px;">
                    <i data-lucide="megaphone" style="color:var(--accent-cyan);"></i>
                    <span style="font-weight:600;">Announcement Banner</span>
                    <span style="margin-left:auto; font-size:0.75rem; color:var(--text-muted);">Edit headline</span>
                </a>
                <a href="{{ route('admin.gallery') }}" class="admin-user-dropdown-item" style="padding:10px 14px;">
                    <i data-lucide="image" style="color:var(--accent-emerald);"></i>
                    <span style="font-weight:600;">Gallery & Media</span>
                    <span style="margin-left:auto; font-size:0.75rem; color:var(--text-muted);">Upload images</span>
                </a>
                <a href="{{ route('admin.team') }}" class="admin-user-dropdown-item" style="padding:10px 14px;">
                    <i data-lucide="users" style="color:var(--accent-purple-glow);"></i>
                    <span style="font-weight:600;">Team Roster</span>
                    <span style="margin-left:auto; font-size:0.75rem; color:var(--text-muted);">Manage guild members</span>
                </a>
                <a href="{{ route('admin.footer') }}" class="admin-user-dropdown-item" style="padding:10px 14px;">
                    <i data-lucide="link-2" style="color:var(--accent-amber);"></i>
                    <span style="font-weight:600;">Footer & Links</span>
                    <span style="margin-left:auto; font-size:0.75rem; color:var(--text-muted);">Social & copyright</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Modern Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    <script>
        AOS.init({ duration: 400, easing: 'ease-out-cubic', once: true, offset: 20 });

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
                    state === 'expanded' ? '264px' : '78px'
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

            // Theme Toggle
            const themeBtn = document.getElementById('themeToggle');
            themeBtn?.addEventListener('click', () => {
                const isLight = document.documentElement.classList.toggle('light-mode');
                localStorage.setItem('admin-theme', isLight ? 'light' : 'dark');
            });

            // User Dropdown Menu
            const userMenu = document.getElementById('userMenu');
            const userMenuTrigger = document.getElementById('userMenuTrigger');
            userMenuTrigger?.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('is-active');
            });
            document.addEventListener('click', (e) => {
                if (!userMenu?.contains(e.target)) {
                    userMenu?.classList.remove('is-active');
                }
            });

            // Toast System
            window.showToast = function (message, type = 'success') {
                const container = document.getElementById('toastContainer');
                if (!container) return;
                const toast = document.createElement('div');
                toast.className = 'toast toast-' + type;

                let iconName = 'check-circle-2';
                if (type === 'error') iconName = 'alert-triangle';
                if (type === 'info') iconName = 'info';

                toast.innerHTML = `
                    <i data-lucide="${iconName}" class="toast-icon"></i>
                    <span style="flex:1;">${message}</span>
                `;
                container.appendChild(toast);
                if (window.lucide) lucide.createIcons();

                setTimeout(() => {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(40px)';
                    toast.style.transition = 'all 0.3s ease';
                    setTimeout(() => toast.remove(), 300);
                }, 3500);
            };

            // Global Confirmation Dialog
            let pendingConfirmCallback = null;
            window.confirmAction = function(options) {
                const modal = document.getElementById('globalConfirmModal');
                const title = document.getElementById('globalConfirmTitle');
                const msg = document.getElementById('globalConfirmMessage');
                const btn = document.getElementById('globalConfirmSubmitBtn');

                if (title && options.title) title.querySelector('span').textContent = options.title;
                if (msg && options.message) msg.textContent = options.message;
                if (btn && options.btnText) btn.textContent = options.btnText;

                pendingConfirmCallback = options.onConfirm || null;
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            };

            window.closeConfirmModal = function() {
                const modal = document.getElementById('globalConfirmModal');
                modal.style.display = 'none';
                document.body.style.overflow = '';
                pendingConfirmCallback = null;
            };

            document.getElementById('globalConfirmSubmitBtn')?.addEventListener('click', () => {
                if (typeof pendingConfirmCallback === 'function') {
                    pendingConfirmCallback();
                }
                closeConfirmModal();
            });

            // Quick Search Command Palette
            const searchModal = document.getElementById('quickSearchModal');
            const searchInput = document.getElementById('quickSearchInput');
            const searchTriggerBtn = document.getElementById('searchTriggerBtn');

            function openSearchModal() {
                searchModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                setTimeout(() => searchInput.focus(), 50);
            }

            function closeSearchModal() {
                searchModal.style.display = 'none';
                document.body.style.overflow = '';
                searchInput.value = '';
                filterSearchResults('');
            }

            searchTriggerBtn?.addEventListener('click', openSearchModal);

            document.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
                    e.preventDefault();
                    if (searchModal.style.display === 'flex') {
                        closeSearchModal();
                    } else {
                        openSearchModal();
                    }
                }
                if (e.key === 'Escape') {
                    if (searchModal.style.display === 'flex') closeSearchModal();
                    if (document.getElementById('globalConfirmModal').style.display === 'flex') closeConfirmModal();
                }
            });

            searchModal?.addEventListener('click', (e) => {
                if (e.target === searchModal) closeSearchModal();
            });

            function filterSearchResults(query) {
                const items = document.querySelectorAll('#quickSearchResults a');
                const q = query.toLowerCase().trim();
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(q) ? 'flex' : 'none';
                });
            }

            searchInput?.addEventListener('input', (e) => filterSearchResults(e.target.value));

            if (window.lucide) lucide.createIcons();
        })();
    </script>

    @stack('scripts')

</body>
</html>
