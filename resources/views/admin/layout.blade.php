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
    <title>NightLight - Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

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
            width: 250px;
            background: #46305e;
            color: #ffffff;
            padding: 2rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .admin-sidebar h2 {
            color: #ffffff;
            margin-bottom: 2rem;
            font-size: 1.8rem;
        }
        .admin-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .admin-sidebar li {
            margin-bottom: 1rem;
        }
        .admin-sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: block;
            padding: 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .admin-sidebar a:hover,
        .admin-sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #ffffff;
        }
        .admin-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            background: #f5f5f5;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #ddd;
        }
        .admin-header h1 {
            margin: 0;
            color: #46305e;
        }
        .admin-content .card {
            background: #ffffff;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .admin-content .card h2 {
            color: #46305e;
            margin-bottom: 1.5rem;
        }
        .admin-content .form-group {
            margin-bottom: 1.5rem;
        }
        .admin-content label {
            display: block;
            margin-bottom: 0.5rem;
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.4rem;
            color: #151515;
        }
        .admin-content input,
        .admin-content textarea {
            width: 100%;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.5rem;
            font-family: "muli-regular", sans-serif;
        }
        .admin-content textarea {
            min-height: 150px;
            resize: vertical;
        }
        .admin-content button {
            padding: 1rem 2rem;
            background: #46305e;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .admin-content button:hover {
            background: #8815d8;
        }
        .admin-content .btn-danger {
            background: #e74c3c;
        }
        .admin-content .btn-danger:hover {
            background: #c0392b;
        }
        .admin-content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        .admin-content th,
        .admin-content td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .admin-content th {
            background: #46305e;
            color: #ffffff;
        }
        .alert {
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        @media only screen and (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            .admin-content {
                margin-left: 0;
            }
        }
    </style>

</head>

<body>

    <div class="admin-container">
        <div class="admin-sidebar">
            <h2>NightLight Admin</h2>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">Dashboard</a></li>
                <li><a href="{{ route('admin.announcement') }}" class="{{ request()->is('admin/announcement') ? 'active' : '' }}">Announcement</a></li>
                <li><a href="{{ route('admin.gallery') }}" class="{{ request()->is('admin/gallery') ? 'active' : '' }}">Gallery</a></li>
                <li><a href="{{ route('admin.team') }}" class="{{ request()->is('admin/team') ? 'active' : '' }}">Team</a></li>
                <li><a href="{{ route('admin.footer') }}" class="{{ request()->is('admin/footer') ? 'active' : '' }}">Footer</a></li>
                <li><a href="{{ route('admin.logout') }}" style="margin-top: 2rem; color: #ff6b6b;">Logout</a></li>
            </ul>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
