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
    <title>NightLight - Admin Login</title>
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
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body, html {
            height: 100%;
            font-family: "muli-regular", "Helvetica Neue", sans-serif;
            overflow: hidden;
            background: #1a1a2e;
        }

        .login-wrapper {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            overflow: hidden;
        }

        /* Animated Background Image */
        .bg-image {
            position: absolute;
            top: -5%;
            left: -5%;
            right: -5%;
            bottom: -5%;
            background: url('{{ asset('images/hero-bg.jpg') }}') no-repeat center center;
            background-size: cover;
            animation: panScaleBackground 25s infinite alternate ease-in-out;
            z-index: 1;
        }

        @keyframes panScaleBackground {
            0% {
                transform: scale(1) translate(0, 0);
            }
            50% {
                transform: scale(1.05) translate(-1%, 1%);
            }
            100% {
                transform: scale(1.1) translate(1%, -1%);
            }
        }

        /* Animated gradient overlay */
        .gradient-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(-45deg,
                rgba(233, 69, 96, 0.8),
                rgba(26, 26, 46, 0.9),
                rgba(15, 52, 96, 0.8),
                rgba(233, 69, 96, 0.8)
            );
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            z-index: 2;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Particles and Orbs */
        .particles-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 3;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.15);
            animation: float 15s infinite ease-in-out;
            pointer-events: none;
            backdrop-filter: blur(2px);
            -webkit-backdrop-filter: blur(2px);
        }

        .particle:nth-child(1) { width: 80px; height: 80px; top: 10%; left: 10%; animation-duration: 20s; }
        .particle:nth-child(2) { width: 120px; height: 120px; top: 20%; right: 10%; animation-duration: 25s; animation-delay: -2s; }
        .particle:nth-child(3) { width: 60px; height: 60px; bottom: 30%; left: 20%; animation-duration: 18s; animation-delay: -4s; }
        .particle:nth-child(4) { width: 150px; height: 150px; bottom: 10%; right: 20%; animation-duration: 22s; animation-delay: -6s; background: rgba(233, 69, 96, 0.1); }
        .particle:nth-child(5) { width: 50px; height: 50px; top: 50%; left: 5%; animation-duration: 15s; animation-delay: -8s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) scale(1); opacity: 0.3; }
            50% { transform: translateY(-40px) translateX(20px) scale(1.1); opacity: 0.6; }
        }

        /* Glowing orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: orbPulse 8s infinite ease-in-out;
            pointer-events: none;
            z-index: 2;
        }
        .orb-1 { width: 400px; height: 400px; background: #e94560; top: -100px; left: -100px; animation-delay: 0s; }
        .orb-2 { width: 500px; height: 500px; background: #0f3460; bottom: -150px; right: -150px; animation-delay: 4s; }

        @keyframes orbPulse {
            0%, 100% { transform: scale(1); opacity: 0.4; }
            50% { transform: scale(1.2); opacity: 0.7; }
        }

        /* Login Box Glassmorphism */
        .login-box {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            padding: 4.5rem 4rem;
            border-radius: 24px;
            max-width: 440px;
            width: 100%;
            box-shadow: 0 30px 60px rgba(0,0,0,0.4), inset 0 1px 0 rgba(255,255,255,0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: fadeInUp 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 10;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px) scale(0.95); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        .login-box h1 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 3.5rem;
            font-family: "montserrat-bold", sans-serif;
            font-size: 2.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
        }
        .login-box h1::after {
            content: '';
            position: absolute;
            bottom: -12px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: #e94560;
            border-radius: 2px;
        }

        /* Floating Label Inputs */
        .form-group {
            position: relative;
            margin-bottom: 2.5rem;
        }

        .form-group input {
            width: 100%;
            height: 5.5rem;
            padding: 1.5rem 1.5rem 0.5rem;
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            font-size: 1.6rem;
            font-family: "muli-regular", sans-serif;
            color: #ffffff;
            background: rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #e94560;
            background: rgba(0, 0, 0, 0.4);
            box-shadow: 0 0 15px rgba(233, 69, 96, 0.3);
        }

        .form-group label {
            position: absolute;
            top: 50%;
            left: 1.5rem;
            transform: translateY(-50%);
            font-family: "montserrat-semibold", sans-serif;
            font-size: 1.4rem;
            color: rgba(255, 255, 255, 0.6);
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .form-group input:focus ~ label,
        .form-group input:valid ~ label,
        .form-group input:not(:placeholder-shown) ~ label {
            top: 1.2rem;
            font-size: 1rem;
            color: #e94560;
            font-weight: 700;
        }

        /* Auto-fill styling fix for dark background */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active{
            -webkit-box-shadow: 0 0 0 30px #1a1a2e inset !important;
            -webkit-text-fill-color: white !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .login-box button {
            width: 100%;
            height: 5.5rem;
            background: linear-gradient(135deg, #e94560 0%, #ff6b6b 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 1.6rem;
            cursor: pointer;
            transition: all 0.4s ease;
            font-family: "montserrat-bold", sans-serif;
            letter-spacing: 1px;
            box-shadow: 0 8px 25px rgba(233, 69, 96, 0.4);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
            margin-top: 1rem;
        }

        .login-box button::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s ease;
        }

        .login-box button:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 30px rgba(233, 69, 96, 0.6);
        }

        .login-box button:hover::after {
            left: 100%;
        }

        .login-error {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.4rem;
            padding: 1.2rem;
            background: rgba(233, 69, 96, 0.15);
            border-radius: 10px;
            border: 1px solid rgba(233, 69, 96, 0.3);
            animation: shake 0.5s ease;
            backdrop-filter: blur(5px);
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px); }
            75% { transform: translateX(8px); }
        }
    </style>

</head>

<body>

    <div class="login-wrapper">
        <!-- Animated Background Image -->
        <div class="bg-image"></div>

        <!-- Animated gradient overlay -->
        <div class="gradient-overlay"></div>

        <!-- Glowing orbs -->
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <!-- Floating particles -->
        <div class="particles-container">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="login-box">
            <h1>Admin Login</h1>
            
            @if($errors->any())
                <div class="login-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @if(session('error'))
                <div class="login-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                
                <div class="form-group">
                    <!-- Note: input placeholder must be empty string '' for floating label to work -->
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder=" ">
                    <label for="email">Email Address</label>
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" required placeholder=" ">
                    <label for="password">Password</label>
                </div>

                <button type="submit">Log In</button>
            </form>
        </div>
    </div>

</body>

</html>
