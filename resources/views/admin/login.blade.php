<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NightLight — Admin Portal Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Fonts & Icons --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-base: #080812;
            --accent-purple: #8b5cf6;
            --accent-purple-glow: #a78bfa;
            --accent-cyan: #06b6d4;
            --accent-cyan-glow: #22d3ee;
            --accent-gradient: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%);
            --border: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(139, 92, 246, 0.45);
        }

        html, body {
            height: 100%;
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: var(--bg-base);
            color: #f8fafc;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-wrapper {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            overflow: hidden;
        }

        /* Ambient Glowing Background Mesh */
        .ambient-mesh {
            position: absolute;
            inset: 0;
            background: 
                radial-gradient(circle 500px at 15% 20%, rgba(124, 58, 237, 0.25), transparent 70%),
                radial-gradient(circle 600px at 85% 80%, rgba(6, 182, 212, 0.2), transparent 70%),
                radial-gradient(circle 400px at 50% 50%, rgba(15, 15, 30, 0.9), transparent 80%);
            animation: pulseMesh 14s infinite alternate ease-in-out;
            pointer-events: none;
            z-index: 1;
        }

        @keyframes pulseMesh {
            0% { transform: scale(1) translate(0, 0); }
            50% { transform: scale(1.08) translate(-1%, 2%); }
            100% { transform: scale(1) translate(1%, -1%); }
        }

        /* Ambient Orbs */
        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.55;
            pointer-events: none;
            z-index: 1;
        }
        .orb-1 {
            width: 380px;
            height: 380px;
            background: #7c3aed;
            top: -80px;
            left: -80px;
            animation: floatOrb 18s infinite alternate ease-in-out;
        }
        .orb-2 {
            width: 440px;
            height: 440px;
            background: #0891b2;
            bottom: -120px;
            right: -100px;
            animation: floatOrb 22s infinite alternate-reverse ease-in-out;
        }

        @keyframes floatOrb {
            0% { transform: translateY(0) translateX(0); }
            100% { transform: translateY(40px) translateX(30px); }
        }

        /* Login Card */
        .login-card {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 440px;
            background: rgba(18, 18, 36, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px 36px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 0 30px rgba(124, 58, 237, 0.15);
            animation: cardAppear 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(24px) scale(0.96); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Brand Head */
        .login-head {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo {
            width: 58px;
            height: 58px;
            border-radius: 16px;
            background: var(--accent-gradient);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(124, 58, 237, 0.45);
            margin-bottom: 16px;
            position: relative;
            overflow: hidden;
        }

        .login-logo::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, transparent 60%);
        }

        .login-title {
            font-family: 'Outfit', sans-serif;
            font-size: 1.65rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .login-subtitle {
            font-size: 0.88rem;
            color: #94a3b8;
        }

        /* Form Controls */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 0.84rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            width: 18px;
            height: 18px;
            pointer-events: none;
            transition: color 0.2s ease;
        }

        .form-input {
            width: 100%;
            height: 48px;
            padding: 0 44px 0 42px;
            background: rgba(10, 10, 22, 0.85);
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: inherit;
            font-size: 0.92rem;
            color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input:focus {
            border-color: var(--accent-purple);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.25), 0 0 16px rgba(124, 58, 237, 0.3);
            background: rgba(16, 16, 32, 0.95);
        }

        .form-input:focus ~ .input-icon {
            color: var(--accent-cyan);
        }

        /* Show/Hide Password Toggle */
        .toggle-pw-btn {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
        }

        .toggle-pw-btn:hover {
            color: #ffffff;
        }

        .toggle-pw-btn i[data-lucide] {
            width: 18px;
            height: 18px;
        }

        /* Checkbox & Links */
        .form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.84rem;
        }

        .remember-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
            cursor: pointer;
            user-select: none;
        }

        .remember-label input[type="checkbox"] {
            accent-color: var(--accent-purple);
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .back-link {
            color: var(--accent-cyan);
            text-decoration: none;
            transition: color 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .back-link:hover {
            color: var(--accent-cyan-glow);
            text-decoration: underline;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 50px;
            border-radius: 12px;
            background: var(--accent-gradient);
            border: none;
            color: #ffffff;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 0.98rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 20px rgba(124, 58, 237, 0.45);
            transition: all 0.25s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(124, 58, 237, 0.6);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .btn-submit i[data-lucide] {
            width: 18px;
            height: 18px;
        }

        /* Error Box */
        .login-error {
            background: rgba(244, 63, 94, 0.15);
            border: 1px solid rgba(244, 63, 94, 0.35);
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 0.85rem;
            color: #fb7185;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-6px); }
            40%, 80% { transform: translateX(6px); }
        }

        .login-error i[data-lucide] {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Footer Tag */
        .login-foot {
            text-align: center;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid var(--border);
            font-size: 0.78rem;
            color: #64748b;
        }
    </style>
</head>

<body>

    <div class="login-wrapper">
        <div class="ambient-mesh"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>

        <div class="login-card">
            <div class="login-head">
                <div class="login-logo">NL</div>
                <h1 class="login-title">Admin Portal</h1>
                <p class="login-subtitle">NightLight Guild Management Console</p>
            </div>

            @if(session('error') || (isset($errors) && $errors->any()))
                <div class="login-error">
                    <i data-lucide="alert-triangle"></i>
                    <span>{{ session('error') ?? ($errors->first() ?? 'Invalid credentials. Please verify your email and password.') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">Admin Email</label>
                    <div class="input-wrap">
                        <i data-lucide="mail" class="input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email', 'admin@nightlight.com') }}" required autofocus placeholder="name@guild.com">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-wrap">
                        <i data-lucide="lock" class="input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input" 
                               required placeholder="••••••••">
                        <button type="button" class="toggle-pw-btn" id="togglePasswordBtn" title="Toggle password visibility" aria-label="Toggle password visibility">
                            <i data-lucide="eye" id="pwIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-meta">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" id="remember" checked>
                        <span>Remember session</span>
                    </label>

                    <a href="{{ url('/') }}" class="back-link">
                        <span>Guild Site</span>
                        <i data-lucide="arrow-up-right" style="width:14px;height:14px;"></i>
                    </a>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Authenticate & Enter</span>
                    <i data-lucide="arrow-right"></i>
                </button>
            </form>

            <div class="login-foot">
                NightLight Guild Console &bull; Protected Zone
            </div>
        </div>
    </div>

    <script>
        (function() {
            const pwInput = document.getElementById('password');
            const togglePwBtn = document.getElementById('togglePasswordBtn');
            const pwIcon = document.getElementById('pwIcon');
            const loginForm = document.getElementById('loginForm');
            const submitBtn = document.getElementById('submitBtn');

            togglePwBtn?.addEventListener('click', () => {
                const isPassword = pwInput.type === 'password';
                pwInput.type = isPassword ? 'text' : 'password';
                pwIcon.setAttribute('data-lucide', isPassword ? 'eye-off' : 'eye');
                if (window.lucide) lucide.createIcons();
            });

            loginForm?.addEventListener('submit', () => {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.85';
                submitBtn.innerHTML = '<span>Verifying...</span>';
            });

            if (window.lucide) lucide.createIcons();
        })();
    </script>
</body>

</html>
