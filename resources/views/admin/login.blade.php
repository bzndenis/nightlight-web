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
            background: #141515;
            padding: 2rem;
        }
        .login-box {
            background: #ffffff;
            padding: 3rem;
            border-radius: 8px;
            max-width: 400px;
            width: 100%;
        }
        .login-box h1 {
            text-align: center;
            color: #46305e;
            margin-bottom: 2rem;
        }
        .login-box .form-group {
            margin-bottom: 1.5rem;
        }
        .login-box label {
            display: block;
            margin-bottom: 0.5rem;
            font-family: "montserrat-regular", sans-serif;
            font-size: 1.4rem;
            color: #151515;
        }
        .login-box input {
            width: 100%;
            height: 5rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1.5rem;
        }
        .login-box button {
            width: 100%;
            height: 5.4rem;
            background: #46305e;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .login-box button:hover {
            background: #8815d8;
        }
        .login-error {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 1rem;
            font-size: 1.4rem;
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
