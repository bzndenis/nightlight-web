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
            background: linear-gradient(135deg, rgba(70, 48, 94, 0.95) 0%, rgba(136, 21, 216, 0.9) 100%), url('{{ asset('images/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
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
        }
        .admin-sidebar h2 {
            color: #ffffff;
            margin-bottom: 2.5rem;
            font-size: 2rem;
            font-family: "montserrat-bold", sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .admin-sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .admin-sidebar li {
            margin-bottom: 0.8rem;
        }
        .admin-sidebar a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.5rem;
            border: 1px solid transparent;
        }
        .admin-sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            color: #ffffff;
            transform: translateX(5px);
            border-color: rgba(255,255,255,0.2);
            box-shadow: 0 4px 15px rgba(136, 21, 216, 0.3);
        }
        .admin-sidebar a.active {
            background: linear-gradient(135deg, #8815d8 0%, #a855f7 100%);
            color: #ffffff;
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 4px 20px rgba(136, 21, 216, 0.5);
        }
        .admin-content {
            flex: 1;
            margin-left: 280px;
            padding: 3rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            min-height: 100vh;
        }
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            padding-bottom: 1.5rem;
            border-bottom: 3px solid linear-gradient(135deg, #46305e 0%, #8815d8 100%);
            border-bottom: 3px solid #46305e;
            position: relative;
        }
        .admin-header h1 {
            margin: 0;
            color: #46305e;
            font-family: "montserrat-bold", sans-serif;
            font-size: 3rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
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
        @media only screen and (max-width: 768px) {
            .admin-sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            .admin-content {
                margin-left: 0;
                padding: 2rem;
            }
            .admin-header h1 {
                font-size: 2rem;
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

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>

</body>

</html>
