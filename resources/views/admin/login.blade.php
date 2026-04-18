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
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(70, 48, 94, 0.95) 0%, rgba(136, 21, 216, 0.9) 100%), url('{{ asset('images/hero-bg.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 2rem;
        }
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 3.5rem;
            border-radius: 20px;
            max-width: 420px;
            width: 100%;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.2);
            animation: fadeInUp 0.6s ease;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .login-box h1 {
            text-align: center;
            color: #46305e;
            margin-bottom: 2.5rem;
            font-family: "montserrat-bold", sans-serif;
            font-size: 2.5rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            background: linear-gradient(135deg, #46305e 0%, #8815d8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .login-box .form-group {
            margin-bottom: 2rem;
        }
        .login-box label {
            display: block;
            margin-bottom: 0.8rem;
            font-family: "montserrat-semibold", sans-serif;
            font-size: 1.5rem;
            color: #46305e;
            font-weight: 600;
        }
        .login-box input {
            width: 100%;
            height: 5rem;
            padding: 1rem 1.5rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1.5rem;
            font-family: "muli-regular", sans-serif;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        .login-box input:focus {
            outline: none;
            border-color: #8815d8;
            box-shadow: 0 0 0 4px rgba(136, 21, 216, 0.1);
            background: #ffffff;
        }
        .login-box button {
            width: 100%;
            height: 5.4rem;
            background: linear-gradient(135deg, #46305e 0%, #8815d8 100%);
            color: #ffffff;
            border: none;
            border-radius: 12px;
            font-size: 1.6rem;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: "montserrat-semibold", sans-serif;
            font-weight: 600;
            box-shadow: 0 4px 20px rgba(136, 21, 216, 0.3);
        }
        .login-box button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(136, 21, 216, 0.4);
        }
        .login-error {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            padding: 1rem;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(231, 76, 60, 0.2);
            animation: shake 0.5s ease;
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }
    </style>

</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <h1>Admin Login</h1>
            
            @if($errors->any())
                <div class="login-error">
                    @foreach($errors->all() as $error)
                        {{ $error }}
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
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>

</html>
