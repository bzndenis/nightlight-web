<!DOCTYPE html>
<!--[if lt IE 9 ]><html class="no-js oldie" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="no-js oldie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

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

    @stack('styles')

    <!-- favicons
	================================================== -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        .admin-sidebar {
            width: 280px;
            background: rgba(70, 48, 94, 0.95);
            backdrop-filter: blur(10px);
            color: #ffffff;
            padding: 2.5rem 2rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 20px rgba(0,0,0,0.3);
            border-right: 1px solid rgba(255,255,255,0.1);
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            gap: 0;
        }
        .admin-sidebar.expanded {
            width: 320px;
        }
        .logo-area {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 3rem;
            padding: 0 0.5rem;
        }
        .logo-glyph {
            font-family: "montserrat-bold", sans-serif;
            font-size: 2rem;
            background: linear-gradient(135deg, #a855f7 0%, #ec4899 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            flex-shrink: 0;
        }
        .logo-text {
            font-family: "montserrat-bold", sans-serif;
            font-size: 1.6rem;
            color: #ffffff;
            opacity: 0;
            white-space: nowrap;
            transition: opacity 0.3s ease;
        }
        .admin-sidebar.expanded .logo-text {
            opacity: 1;
        }
        .admin-sidebar nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .admin-sidebar nav li {
            margin-bottom: 0.4rem;
        }
        .admin-sidebar nav li.nav-divider {
            margin: 1.5rem 0;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .admin-sidebar nav a {
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.2rem;
            padding: 1rem 1rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.5rem;
            border: 1px solid transparent;
            white-space: nowrap;
            overflow: hidden;
        }
        .admin-sidebar nav a i {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }
        .admin-sidebar nav a i svg {
            width: 20px;
            height: 20px;
        }
        .nav-label {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .admin-sidebar.expanded .nav-label {
            opacity: 1;
        }
        .admin-sidebar nav a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            border-color: rgba(255,255,255,0.2);
            box-shadow: 0 4px 15px rgba(136, 21, 216, 0.3);
        }
        .admin-sidebar nav a.active {
            background: linear-gradient(135deg, #8815d8 0%, #a855f7 100%);
            color: #ffffff;
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 4px 20px rgba(136, 21, 216, 0.5);
        }
        .admin-sidebar nav a.logout-link:hover {
            background: rgba(239, 68, 68, 0.2);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        .admin-main {
            flex: 1;
            margin-left: 280px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.8rem 3rem;
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(70,48,94,0.1);
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 15px rgba(70,48,94,0.05);
        }
        .page-title {
            font-family: "montserrat-bold", sans-serif;
            font-size: 2.2rem;
            color: #46305e;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
        }
        .header-right {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        .theme-toggle {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            cursor: pointer;
            user-select: none;
        }
        .toggle-label {
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.2rem;
            color: #46305e;
            opacity: 0.6;
            transition: opacity 0.3s ease;
        }
        .theme-toggle:hover .toggle-label {
            opacity: 1;
        }
        .toggle-track {
            width: 48px;
            height: 26px;
            background: #46305e;
            border-radius: 13px;
            position: relative;
            transition: background 0.3s ease;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.3);
        }
        .toggle-thumb {
            width: 20px;
            height: 20px;
            background: #ffffff;
            border-radius: 50%;
            position: absolute;
            top: 3px;
            left: 3px;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 6px rgba(0,0,0,0.25);
        }
        :root:not(.light-mode) .toggle-thumb {
            transform: translateX(22px);
        }
        .admin-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #8815d8 0%, #a855f7 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            font-family: "montserrat-bold", sans-serif;
            font-size: 1.4rem;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(136,21,216,0.4);
        }
        .admin-page {
            padding: 3rem;
            flex: 1;
        }
        /* Light mode overrides */
        :root.light-mode .admin-sidebar {
            background: rgba(255, 255, 255, 0.98);
            border-right: 1px solid rgba(70,48,94,0.1);
        }
        :root.light-mode .logo-text,
        :root.light-mode .admin-sidebar nav a {
            color: #46305e;
        }
        :root.light-mode .admin-sidebar nav a:hover {
            background: rgba(136, 21, 216, 0.08);
            color: #8815d8;
        }
        :root.light-mode .admin-sidebar nav a.logout-link:hover {
            background: rgba(239, 68, 68, 0.08);
            color: #ef4444;
        }
        :root.light-mode .admin-header {
            background: rgba(255, 255, 255, 1);
        }
        :root.light-mode .page-title,
        :root.light-mode .toggle-label {
            color: #46305e;
        }
        .admin-content .card {
            background: #ffffff;
            padding: 2.5rem;
            border-radius: 16px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 40px rgba(70, 48, 94, 0.1);
            border: 1px solid rgba(70, 48, 94, 0.1);
            transition: all 0.3s ease;
        }
        .admin-content .card:hover {
            box-shadow: 0 15px 50px rgba(70, 48, 94, 0.15);
            transform: translateY(-2px);
        }
        .admin-content .card h2 {
            color: #46305e;
            margin-bottom: 2rem;
            font-family: "montserrat-bold", sans-serif;
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            position: relative;
            padding-bottom: 1rem;
        }
        .admin-content .card h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, #46305e 0%, #8815d8 100%);
        }
        .admin-content .form-group {
            margin-bottom: 2rem;
        }
        .admin-content label {
            display: block;
            margin-bottom: 0.8rem;
            font-family: "montserrat-semibold", sans-serif;
            font-size: 1.5rem;
            color: #46305e;
            font-weight: 600;
        }
        .admin-content input,
        .admin-content textarea {
            width: 100%;
            padding: 1.2rem 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 1.5rem;
            font-family: "muli-regular", sans-serif;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        .admin-content input:focus,
        .admin-content textarea:focus {
            outline: none;
            border-color: #8815d8;
            box-shadow: 0 0 0 3px rgba(136, 21, 216, 0.1);
            background: #ffffff;
        }
        .admin-content textarea {
            min-height: 150px;
            resize: vertical;
        }
        .admin-content button {
            padding: 1.2rem 2.5rem;
            background: linear-gradient(135deg, #46305e 0%, #8815d8 100%);
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "montserrat-semibold", sans-serif;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(136, 21, 216, 0.3);
        }
        .admin-content button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(136, 21, 216, 0.4);
        }
        .admin-content .btn-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
        }
        .admin-content .btn-danger:hover {
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.4);
        }
        .admin-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .admin-content th {
            padding: 1.5rem;
            text-align: left;
            background: linear-gradient(135deg, #46305e 0%, #8815d8 100%);
            color: #ffffff;
            font-family: "montserrat-semibold", sans-serif;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
        }
        .admin-content td {
            padding: 1.5rem;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            color: #46305e;
        }
        .admin-content tr:hover td {
            background: rgba(136, 21, 216, 0.05);
        }
        .alert {
            padding: 1.5rem 2rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-family: "muli-regular", sans-serif;
            font-size: 1.5rem;
            animation: slideIn 0.5s ease;
        }
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
            border: 1px solid #c3e6cb;
            box-shadow: 0 4px 15px rgba(21, 87, 36, 0.2);
        }
        .alert-error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
            border: 1px solid #f5c6cb;
            box-shadow: 0 4px 15px rgba(114, 28, 36, 0.2);
        }
        .toast-container {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            display: flex;
            flex-direction: column;
            gap: 0.8rem;
            z-index: 9999;
        }
        .toast {
            padding: 1.2rem 2rem;
            border-radius: 10px;
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.4rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.2);
            animation: toastIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .toast-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }
        .toast-error {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }
        @keyframes toastIn {
            from { opacity: 0; transform: translateX(100%); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @media only screen and (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            .admin-main {
                margin-left: 0;
            }
            .page-title {
                font-size: 1.6rem;
            }
        }
    </style>

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
                           class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"
                           data-tooltip="Dashboard">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                            </i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.announcement') }}"
                           class="{{ request()->is('admin/announcement') ? 'active' : '' }}"
                           data-tooltip="Announcement">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 11 18-5v12L3 13v-2z"/><path d="M11.6 16.8a3 3 0 1 1-5.8-1.6"/></svg>
                            </i>
                            <span class="nav-label">Announcement</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.gallery') }}"
                           class="{{ request()->is('admin/gallery') ? 'active' : '' }}"
                           data-tooltip="Gallery">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </i>
                            <span class="nav-label">Gallery</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.team') }}"
                           class="{{ request()->is('admin/team') ? 'active' : '' }}"
                           data-tooltip="Team">
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            </i>
                            <span class="nav-label">Team</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.footer') }}"
                           class="{{ request()->is('admin.footer') ? 'active' : '' }}"
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
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
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
        sidebar.addEventListener('mouseenter', () => sidebar.classList.add('expanded'));
        sidebar.addEventListener('mouseleave', () => sidebar.classList.remove('expanded'));

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

        document.getElementById('themeToggle').addEventListener('click', () => {
            const isLight = document.documentElement.classList.toggle('light-mode');
            localStorage.setItem('admin-theme', isLight ? 'light' : 'dark');
        });

        // Toast helper
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;
            toast.textContent = message;
            container.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
    </script>

    @stack('scripts')

</body>
</html>