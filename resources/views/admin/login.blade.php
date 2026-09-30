<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Masuk Portal Admin — NightLight Guild</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Google Fonts (Outfit & Plus Jakarta Sans & JetBrains Mono) - Pure Static CDN (Zero Vite) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <style>
        /* ===== CSS Reset & Design Tokens ===== */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        :root {
            --bg-base: #06060f;
            --bg-surface: #0c0c1c;
            --bg-card: rgba(15, 15, 32, 0.78);
            --bg-card-hover: rgba(22, 22, 46, 0.9);
            --bg-input: rgba(9, 9, 20, 0.85);

            --accent-purple: #8b5cf6;
            --accent-purple-glow: #a78bfa;
            --accent-purple-dark: #6d28d9;
            --accent-cyan: #06b6d4;
            --accent-cyan-glow: #22d3ee;
            --accent-emerald: #10b981;
            --accent-rose: #f43f5e;

            --accent-gradient: linear-gradient(135deg, #7c3aed 0%, #06b6d4 100%);
            --accent-gradient-hover: linear-gradient(135deg, #6d28d9 0%, #0891b2 100%);
            --accent-gradient-emerald: linear-gradient(135deg, #059669 0%, #10b981 100%);

            --border: rgba(255, 255, 255, 0.1);
            --border-subtle: rgba(255, 255, 255, 0.05);
            --border-hover: rgba(139, 92, 246, 0.45);
            --border-active: rgba(6, 182, 212, 0.6);

            --glass-blur: blur(20px);
            --radius-sm: 10px;
            --radius-md: 14px;
            --radius-lg: 20px;
            --radius-xl: 26px;
            --radius-full: 9999px;

            --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --font-heading: 'Outfit', var(--font-main);
            --font-mono: 'JetBrains Mono', monospace;
        }

        html, body {
            min-height: 100%;
            font-family: var(--font-main);
            background-color: var(--bg-base);
            color: #f8fafc;
            overflow-x: hidden;
            position: relative;
        }

        /* ===== Canvas Animated Background ===== */
        #bgCanvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 1;
            pointer-events: none;
        }

        /* Ambient Glowing Atmosphere Orbs */
        .ambient-glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            z-index: 2;
            opacity: 0.45;
        }

        .ambient-glow--1 {
            width: 550px;
            height: 550px;
            top: -120px;
            left: -100px;
            background: radial-gradient(circle, #7c3aed 0%, transparent 70%);
            animation: floatAmbient 22s infinite alternate ease-in-out;
        }

        .ambient-glow--2 {
            width: 600px;
            height: 600px;
            bottom: -150px;
            right: -100px;
            background: radial-gradient(circle, #0891b2 0%, transparent 70%);
            animation: floatAmbient 26s infinite alternate-reverse ease-in-out;
        }

        .ambient-glow--3 {
            width: 450px;
            height: 450px;
            top: 40%;
            left: 35%;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.25) 0%, transparent 70%);
            animation: floatAmbient 18s infinite alternate ease-in-out;
        }

        @keyframes floatAmbient {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(40px, 30px) scale(1.1); }
            100% { transform: translate(-30px, -20px) scale(0.95); }
        }

        /* ===== Main Split Layout ===== */
        .login-page {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 32px 48px;
            max-width: 1440px;
            margin: 0 auto;
        }

        .login-grid {
            display: grid;
            grid-template-columns: 1.15fr 0.95fr;
            gap: 60px;
            align-items: center;
            margin: auto 0;
            padding: 24px 0;
        }

        /* ===== Left Side: Showcase & Feature Cards ===== */
        .showcase {
            display: flex;
            flex-direction: column;
            gap: 28px;
            padding-right: 20px;
        }

        .showcase-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 16px;
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            border-radius: var(--radius-full);
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #34d399;
            width: fit-content;
            backdrop-filter: blur(8px);
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #34d399;
            box-shadow: 0 0 10px #10b981;
            animation: pulseDot 2s infinite ease-in-out;
        }

        @keyframes pulseDot {
            0%, 100% { transform: scale(0.9); opacity: 0.7; }
            50% { transform: scale(1.25); opacity: 1; box-shadow: 0 0 16px #34d399; }
        }

        .showcase-header {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .showcase-eyebrow {
            font-family: var(--font-mono);
            font-size: 0.82rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent-cyan);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .showcase-eyebrow::after {
            content: '';
            height: 1px;
            width: 48px;
            background: linear-gradient(90deg, var(--accent-cyan), transparent);
        }

        .showcase-title {
            font-family: var(--font-heading);
            font-size: clamp(2.4rem, 4vw, 3.4rem);
            font-weight: 900;
            line-height: 1.12;
            letter-spacing: -0.03em;
            color: #ffffff;
        }

        .showcase-title span {
            background: linear-gradient(135deg, #a78bfa 0%, #22d3ee 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .showcase-desc {
            font-size: 1.02rem;
            line-height: 1.65;
            color: #94a3b8;
            max-width: 580px;
        }

        /* Feature Cards Stack */
        .feature-stack {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 6px;
        }

        .feature-card {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 20px;
            background: rgba(18, 18, 38, 0.65);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            backdrop-filter: blur(12px);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: transparent;
            transition: background 0.25s ease;
        }

        .feature-card:hover {
            transform: translateX(6px);
            background: rgba(26, 26, 52, 0.85);
            border-color: rgba(139, 92, 246, 0.4);
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.6), 0 0 20px rgba(124, 58, 237, 0.15);
        }

        .feature-card:hover::before {
            background: var(--accent-gradient);
        }

        .feature-icon-box {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-sm);
            background: rgba(124, 58, 237, 0.14);
            border: 1px solid rgba(124, 58, 237, 0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-purple-glow);
            flex-shrink: 0;
            transition: all 0.25s ease;
        }

        .feature-card:nth-child(2) .feature-icon-box {
            background: rgba(6, 182, 212, 0.14);
            border-color: rgba(6, 182, 212, 0.35);
            color: var(--accent-cyan-glow);
        }

        .feature-card:nth-child(3) .feature-icon-box {
            background: rgba(16, 185, 129, 0.14);
            border-color: rgba(16, 185, 129, 0.35);
            color: #34d399;
        }

        .feature-card:hover .feature-icon-box {
            transform: scale(1.08);
            box-shadow: 0 0 16px rgba(124, 58, 237, 0.4);
        }

        .feature-content h4 {
            font-family: var(--font-heading);
            font-size: 0.98rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 3px;
        }

        .feature-content p {
            font-size: 0.84rem;
            line-height: 1.5;
            color: #94a3b8;
        }

        /* Showcase Meta Bar */
        .showcase-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 18px;
            border-top: 1px solid var(--border-subtle);
            font-size: 0.82rem;
            color: #64748b;
        }

        .server-status {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #cbd5e1;
        }

        .server-pulse {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #10b981;
            box-shadow: 0 0 8px #10b981;
        }

        .keywords-tag {
            color: #94a3b8;
            font-weight: 500;
        }

        /* ===== Right Side: Floating Glassmorphism Login Card ===== */
        .login-card-wrap {
            display: flex;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 480px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-xl);
            padding: 36px 36px 32px;
            box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.8), 0 0 40px rgba(124, 58, 237, 0.12);
            backdrop-filter: var(--glass-blur);
            -webkit-backdrop-filter: var(--glass-blur);
            position: relative;
            animation: cardAppear 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes cardAppear {
            from { opacity: 0; transform: translateY(24px) scale(0.97); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Top Navigation Header inside Card */
        .card-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
            padding-bottom: 14px;
            border-bottom: 1px solid var(--border-subtle);
        }

        .card-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.82rem;
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .card-breadcrumb:hover {
            color: var(--accent-cyan);
        }

        .card-help-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.82rem;
            color: #94a3b8;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .card-help-link:hover {
            color: var(--accent-purple-glow);
        }

        /* Portal Tab Switcher */
        .portal-tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: rgba(9, 9, 20, 0.7);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 4px;
            margin-bottom: 20px;
            gap: 4px;
        }

        .portal-tab {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.82rem;
            font-weight: 600;
            color: #94a3b8;
            text-decoration: none;
            background: transparent;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .portal-tab.is-active {
            background: rgba(124, 58, 237, 0.22);
            border: 1px solid rgba(124, 58, 237, 0.4);
            color: #ffffff;
            box-shadow: 0 2px 10px rgba(124, 58, 237, 0.2);
        }

        .portal-tab:not(.is-active):hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.04);
        }

        /* Security Pill Badge */
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 12px;
            border-radius: var(--radius-full);
            background: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.25);
            color: #34d399;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            margin-bottom: 14px;
        }

        /* Head Titles */
        .card-heading h1 {
            font-family: var(--font-heading);
            font-size: 1.45rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .card-heading h1 span {
            background: linear-gradient(135deg, #ffffff 40%, var(--accent-cyan-glow) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-heading p {
            font-size: 0.85rem;
            color: #94a3b8;
            line-height: 1.5;
            margin-bottom: 22px;
        }

        /* Error Notification Alert */
        .alert-error {
            background: rgba(244, 63, 94, 0.14);
            border: 1px solid rgba(244, 63, 94, 0.35);
            border-radius: var(--radius-sm);
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

        /* Form Inputs */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 7px;
        }

        .form-label {
            font-size: 0.83rem;
            font-weight: 600;
            color: #cbd5e1;
        }

        .form-link {
            font-size: 0.78rem;
            color: var(--accent-cyan);
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .form-link:hover {
            color: var(--accent-cyan-glow);
            text-decoration: underline;
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
            padding: 0 44px 0 44px;
            background: var(--bg-input);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: inherit;
            font-size: 0.92rem;
            color: #ffffff;
            outline: none;
            transition: all 0.2s ease;
        }

        .form-input::placeholder {
            color: #64748b;
        }

        .form-input:focus {
            border-color: var(--accent-purple);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.22), 0 0 16px rgba(124, 58, 237, 0.25);
            background: rgba(14, 14, 28, 0.95);
        }

        .form-input:focus ~ .input-icon {
            color: var(--accent-cyan);
        }

        .toggle-pw-btn {
            position: absolute;
            right: 12px;
            background: transparent;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s ease;
            outline: none;
        }

        .toggle-pw-btn:hover {
            color: #ffffff;
        }

        /* Checkbox & Remember */
        .form-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 0.83rem;
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

        /* Cloudflare-style SSL Badge */
        .security-stamp {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 12px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid var(--border-subtle);
            font-size: 0.74rem;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .security-stamp-left {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .security-stamp-left i[data-lucide] {
            width: 14px;
            height: 14px;
            color: #10b981;
        }

        .security-stamp-badge {
            font-family: var(--font-mono);
            font-size: 0.7rem;
            color: var(--accent-cyan);
            background: rgba(6, 182, 212, 0.1);
            padding: 2px 6px;
            border-radius: 4px;
        }

        /* Submit Button */
        .btn-submit {
            width: 100%;
            height: 52px;
            border-radius: var(--radius-sm);
            background: var(--accent-gradient);
            border: none;
            color: #ffffff;
            font-family: var(--font-heading);
            font-size: 1.02rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 24px rgba(124, 58, 237, 0.45);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-submit::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transform: translateX(-100%);
            transition: transform 0.5s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(124, 58, 237, 0.6);
            background: var(--accent-gradient-hover);
        }

        .btn-submit:hover::after {
            transform: translateX(100%);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Collapsible Quick Credentials Preview (Screenshot 2 Feature!) */
        .demo-accordion {
            margin-top: 22px;
            border-top: 1px solid var(--border-subtle);
            padding-top: 16px;
        }

        .demo-toggle {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: transparent;
            border: none;
            color: #94a3b8;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            padding: 4px 0;
            transition: color 0.2s ease;
        }

        .demo-toggle:hover {
            color: var(--accent-cyan);
        }

        .demo-toggle-left {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .demo-toggle-chevron {
            transition: transform 0.25s ease;
        }

        .demo-accordion.is-open .demo-toggle-chevron {
            transform: rotate(180deg);
        }

        .demo-body {
            display: none;
            margin-top: 12px;
            padding: 14px;
            background: rgba(9, 9, 20, 0.8);
            border: 1px dashed rgba(139, 92, 246, 0.3);
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            color: #cbd5e1;
        }

        .demo-accordion.is-open .demo-body {
            display: block;
        }

        .demo-info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
        }

        .demo-label {
            color: #64748b;
        }

        .demo-value {
            font-family: var(--font-mono);
            color: var(--accent-cyan);
        }

        .btn-autofill {
            width: 100%;
            margin-top: 10px;
            padding: 8px 12px;
            border-radius: 6px;
            background: rgba(124, 58, 237, 0.16);
            border: 1px solid rgba(124, 58, 237, 0.35);
            color: var(--accent-purple-glow);
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s ease;
        }

        .btn-autofill:hover {
            background: rgba(124, 58, 237, 0.3);
            color: #ffffff;
        }

        /* Card Sub-Footer */
        .card-foot {
            text-align: center;
            margin-top: 20px;
            font-size: 0.75rem;
            color: #64748b;
        }

        /* ===== Page Overall Footer ===== */
        .login-page-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid var(--border-subtle);
            font-size: 0.8rem;
            color: #64748b;
            flex-wrap: wrap;
            gap: 12px;
        }

        .footer-links {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .footer-links a {
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer-links a:hover {
            color: var(--accent-cyan);
        }

        /* ===== Responsive Media Queries ===== */
        @media (max-width: 1120px) {
            .login-grid {
                grid-template-columns: 1fr;
                gap: 40px;
                max-width: 600px;
                margin: 0 auto;
            }

            .showcase {
                padding-right: 0;
                text-align: center;
                align-items: center;
            }

            .showcase-eyebrow::after {
                display: none;
            }

            .feature-stack {
                width: 100%;
                text-align: left;
            }

            .showcase-footer {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .login-page {
                padding: 20px 16px;
            }

            .login-card {
                padding: 26px 20px;
            }

            .feature-card {
                padding: 12px 14px;
            }

            .showcase-title {
                font-size: 2rem;
            }

            .showcase-desc {
                font-size: 0.9rem;
            }

            .login-page-footer {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
    </style>
</head>

<body>

    {{-- Interactive Animated 3D Wave Wireframe Canvas --}}
    <canvas id="bgCanvas"></canvas>

    {{-- Ambient Pulsing Glow Orbs --}}
    <div class="ambient-glow ambient-glow--1"></div>
    <div class="ambient-glow ambient-glow--2"></div>
    <div class="ambient-glow ambient-glow--3"></div>

    <div class="login-page">

        {{-- Split Grid Layout (Inspired by Reference Screenshot 2 in Dark Mode) --}}
        <div class="login-grid">

            {{-- Left Side: Brand Showcase, Mission & Interactive Feature Cards --}}
            <div class="showcase">
                {{-- Government/Guild Verified Badge --}}
                <div class="showcase-badge">
                    <span class="badge-dot"></span>
                    <span>NightLight Guild &bull; Official Management Matrix</span>
                </div>

                <div class="showcase-header">
                    <div class="showcase-eyebrow">
                        <i data-lucide="shield" style="width:14px;height:14px;"></i>
                        <span>Core Command & Operations</span>
                    </div>
                    <h1 class="showcase-title">
                        NightLight <span>Console</span>
                    </h1>
                    <p class="showcase-desc">
                        Sistem manajemen dan tata kelola terpadu Guild NightLight. Ekosistem cerdas pengelolaan roster member, publikasi pengumuman beranda, dan kurasi dokumentasi petualangan secara terintegrasi.
                    </p>
                </div>

                {{-- 3 Value/Feature Cards (Exact structure from Screenshot 2) --}}
                <div class="feature-stack">
                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="shield-check"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Tata Kelola Roster & Otoritas Anggota</h4>
                            <p>Konfigurasi hierarki kepemimpinan, role raid leader, quote profil, serta urutan tampil member di situs publik secara real-time.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="megaphone"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Siaran Pengumuman & Berita Utama</h4>
                            <p>Publikasikan pengumuman mendesak, jadwal raid, dan event guild langsung ke banner beranda dengan simulator live preview.</p>
                        </div>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon-box">
                            <i data-lucide="image"></i>
                        </div>
                        <div class="feature-content">
                            <h4>Dokumentasi Media & Keamanan Akses</h4>
                            <p>Manajemen arsip screenshot petualangan dengan drag-and-drop multi upload serta otentikasi sesi berbasis enkripsi terproteksi.</p>
                        </div>
                    </div>
                </div>

                {{-- Showcase Status Footer --}}
                <div class="showcase-footer">
                    <div class="server-status">
                        <span class="server-pulse"></span>
                        <span>Server Operasional &bull; Koneksi Terenkripsi</span>
                    </div>
                    <div class="keywords-tag">
                        Solidaritas &bull; Eksplorasi &bull; Berkelanjutan
                    </div>
                </div>
            </div>

            {{-- Right Side: Modern Floating Glassmorphism Login Card --}}
            <div class="login-card-wrap">
                <div class="login-card">

                    {{-- Topbar inside Card --}}
                    <div class="card-topbar">
                        <a href="{{ url('/') }}" class="card-breadcrumb" title="Kembali ke Halaman Beranda">
                            <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
                            <span>Beranda / Login Portal</span>
                        </a>
                        <a href="{{ url('/') }}#footer" target="_blank" rel="noopener" class="card-help-link" title="Bantuan Pusat Pengguna">
                            <i data-lucide="help-circle" style="width:14px;height:14px;"></i>
                            <span>Bantuan</span>
                        </a>
                    </div>

                    {{-- Portal Tab Switcher --}}
                    <div class="portal-tabs">
                        <button type="button" class="portal-tab is-active">
                            <i data-lucide="shield" style="width:14px;height:14px;"></i>
                            <span>Admin Portal</span>
                        </button>
                        <a href="{{ url('/') }}" class="portal-tab">
                            <i data-lucide="globe" style="width:14px;height:14px;"></i>
                            <span>Website Publik</span>
                        </a>
                    </div>

                    {{-- Single Identity Badge --}}
                    <div class="security-badge">
                        <i data-lucide="lock" style="width:12px;height:12px;"></i>
                        <span>Single Identity Sign-On NightLight Admin</span>
                    </div>

                    {{-- Card Heading --}}
                    <div class="card-heading">
                        <h1>Masuk ke <span>Portal</span></h1>
                        <p>Kredensial tunggal digital bagi Guild Master dan administrator pengelola NightLight.</p>
                    </div>

                    {{-- Error Notification --}}
                    @if(session('error') || (isset($errors) && $errors->any()))
                        <div class="alert-error">
                            <i data-lucide="alert-triangle" style="width:18px;height:18px;flex-shrink:0;"></i>
                            <span>{{ session('error') ?? ($errors->first() ?? 'Kredensial tidak valid. Silakan periksa email dan kata sandi Anda.') }}</span>
                        </div>
                    @endif

                    {{-- Login Form --}}
                    <form method="POST" action="{{ route('login.submit') }}" id="loginForm">
                        @csrf

                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label class="form-label" for="email">Username / Email Kedinasan</label>
                            </div>
                            <div class="input-wrap">
                                <i data-lucide="mail" class="input-icon"></i>
                                <input type="email" id="email" name="email" class="form-input" 
                                       value="{{ old('email', 'admin@nightlight.com') }}" required autofocus placeholder="admin@nightlight.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-label-wrap">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <a href="javascript:void(0)" onclick="alert('Silakan hubungi Guild Master utama atau cek kredensial pengujian cepat di bawah.');" class="form-link">Lupa kata sandi?</a>
                            </div>
                            <div class="input-wrap">
                                <i data-lucide="lock" class="input-icon"></i>
                                <input type="password" id="password" name="password" class="form-input" 
                                       required placeholder="Masukkan kata sandi akun">
                                <button type="button" class="toggle-pw-btn" id="togglePasswordBtn" title="Tampilkan / Sembunyikan kata sandi" aria-label="Toggle password">
                                    <i data-lucide="eye" id="pwIcon"></i>
                                </button>
                            </div>
                        </div>

                        <div class="form-meta">
                            <label class="remember-label">
                                <input type="checkbox" name="remember" id="remember" checked>
                                <span>Ingat perangkat ini</span>
                            </label>
                        </div>

                        {{-- Cloudflare-style SSL Protection Bar --}}
                        <div class="security-stamp">
                            <div class="security-stamp-left">
                                <i data-lucide="check-circle-2"></i>
                                <span>Protected by NightLight Vault</span>
                            </div>
                            <span class="security-stamp-badge">SSL 256-bit</span>
                        </div>

                        <button type="submit" class="btn-submit" id="submitBtn">
                            <span>Masuk ke Sistem</span>
                            <i data-lucide="arrow-right" style="width:18px;height:18px;"></i>
                        </button>
                    </form>

                    {{-- Collapsible Quick Credentials Preview (Just like in Reference Screenshot 2!) --}}
                    <div class="demo-accordion" id="demoAccordion">
                        <button type="button" class="demo-toggle" id="demoToggle">
                            <span class="demo-toggle-left">
                                <i data-lucide="key" style="width:14px;height:14px;color:var(--accent-cyan);"></i>
                                <span>Kredensial Pengujian Cepat [Role Preview]</span>
                            </span>
                            <i data-lucide="chevron-down" class="demo-toggle-chevron" style="width:14px;height:14px;"></i>
                        </button>

                        <div class="demo-body">
                            <div class="demo-info-row">
                                <span class="demo-label">Hak Akses:</span>
                                <span class="demo-value" style="color:var(--accent-purple-glow); font-weight:700;">Guild Master / Superadmin</span>
                            </div>
                            <div class="demo-info-row">
                                <span class="demo-label">Email:</span>
                                <span class="demo-value">admin@nightlight.com</span>
                            </div>
                            <div class="demo-info-row">
                                <span class="demo-label">Kata Sandi:</span>
                                <span class="demo-value">admin123</span>
                            </div>
                            <button type="button" class="btn-autofill" id="autofillBtn">
                                <i data-lucide="zap" style="width:13px;height:13px;"></i>
                                <span>Gunakan Kredensial Ini</span>
                            </button>
                        </div>
                    </div>

                    <div class="card-foot">
                        NightLight Guild Administration &bull; Kawasan Terproteksi
                    </div>
                </div>
            </div>

        </div>

        {{-- Overall Page Footer (Bottom Bar) --}}
        <footer class="login-page-footer">
            <div>
                &copy; {{ date('Y') }} NightLight Guild &bull; Sistem Terpadu Manajemen Komunitas
            </div>
            <div class="footer-links">
                <a href="{{ url('/') }}">Beranda</a>
                <a href="{{ url('/') }}#team">Roster</a>
                <a href="{{ url('/') }}#gallery">Galeri</a>
                <a href="{{ url('/') }}#footer">Kontak</a>
            </div>
        </footer>

    </div>

    {{-- Interactive 3D Wave Wireframe Mesh & Particle Canvas Script --}}
    <script>
        (function() {
            // 1. Password Visibility Toggle
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
                submitBtn.innerHTML = '<span>Mengautentikasi...</span>';
            });

            // 2. Demo Accordion Toggle & 1-Click Autofill
            const demoToggle = document.getElementById('demoToggle');
            const demoAccordion = document.getElementById('demoAccordion');
            const autofillBtn = document.getElementById('autofillBtn');
            const emailInput = document.getElementById('email');

            demoToggle?.addEventListener('click', () => {
                demoAccordion.classList.toggle('is-open');
            });

            autofillBtn?.addEventListener('click', () => {
                emailInput.value = 'admin@nightlight.com';
                pwInput.value = 'admin123';
                pwInput.focus();
                
                // Flash feedback
                autofillBtn.innerHTML = '<i data-lucide="check" style="width:13px;height:13px;"></i><span>Kredensial Diisi!</span>';
                if (window.lucide) lucide.createIcons();
                setTimeout(() => {
                    autofillBtn.innerHTML = '<i data-lucide="zap" style="width:13px;height:13px;"></i><span>Gunakan Kredensial Ini</span>';
                    if (window.lucide) lucide.createIcons();
                }, 1800);
            });

            // 3. Animated 3D Wave Wireframe Mesh with Particles on Canvas
            const canvas = document.getElementById('bgCanvas');
            const ctx = canvas.getContext('2d');

            let width = canvas.width = window.innerWidth;
            let height = canvas.height = window.innerHeight;

            window.addEventListener('resize', () => {
                width = canvas.width = window.innerWidth;
                height = canvas.height = window.innerHeight;
            });

            // Mouse interaction for 3D tilt
            let mouseX = width / 2;
            let mouseY = height / 2;
            let targetMouseX = mouseX;
            let targetMouseY = mouseY;

            window.addEventListener('mousemove', (e) => {
                targetMouseX = e.clientX;
                targetMouseY = e.clientY;
            });

            // Particles Array
            const particles = [];
            const particleCount = Math.min(Math.floor(width / 30), 45);

            for (let i = 0; i < particleCount; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    vx: (Math.random() - 0.5) * 0.45,
                    vy: (Math.random() - 0.5) * 0.45,
                    size: Math.random() * 2.2 + 0.8,
                    baseAlpha: Math.random() * 0.5 + 0.25,
                    pulseSpeed: Math.random() * 0.02 + 0.01,
                    pulse: Math.random() * Math.PI,
                    color: Math.random() > 0.45 ? '139, 92, 246' : '6, 182, 212'
                });
            }

            // Grid Wave Parameters
            const cols = 28;
            const rows = 18;
            let stepX = width / (cols - 1);
            let stepY = height / (rows - 1);
            let time = 0;

            function render() {
                ctx.clearRect(0, 0, width, height);

                // Smooth mouse interpolation
                mouseX += (targetMouseX - mouseX) * 0.04;
                mouseY += (targetMouseY - mouseY) * 0.04;

                const offsetX = (mouseX - width / 2) * 0.06;
                const offsetY = (mouseY - height / 2) * 0.06;

                time += 0.014;

                stepX = (width * 1.2) / (cols - 1);
                stepY = (height * 0.85) / (rows - 1);

                // Generate 3D grid points
                const points = [];
                for (let r = 0; r < rows; r++) {
                    points[r] = [];
                    for (let c = 0; c < cols; c++) {
                        const rawX = (c * stepX) - (width * 0.1) + offsetX;
                        const rawY = (r * stepY) + (height * 0.25) + offsetY;

                        // Undulating wave equation
                        const wave1 = Math.sin((c * 0.35) + time) * 22;
                        const wave2 = Math.cos((r * 0.4) + (time * 0.8)) * 18;
                        const wave3 = Math.sin(((c + r) * 0.2) + (time * 1.2)) * 14;

                        // Perspective warping towards bottom-left like in screenshot 2
                        const perspectiveFactor = 0.5 + ((r / rows) * 0.7);
                        const finalY = rawY + ((wave1 + wave2 + wave3) * perspectiveFactor);

                        points[r][c] = {
                            x: rawX,
                            y: finalY,
                            alpha: Math.min(0.35, Math.max(0.04, (r / rows) * 0.3))
                        };
                    }
                }

                // Draw horizontal mesh lines
                for (let r = 0; r < rows; r++) {
                    ctx.beginPath();
                    for (let c = 0; c < cols; c++) {
                        const p = points[r][c];
                        if (c === 0) {
                            ctx.moveTo(p.x, p.y);
                        } else {
                            ctx.lineTo(p.x, p.y);
                        }
                    }
                    const rowAlpha = (r / rows) * 0.22;
                    ctx.strokeStyle = `rgba(124, 58, 237, ${rowAlpha})`;
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }

                // Draw vertical mesh lines
                for (let c = 0; c < cols; c++) {
                    ctx.beginPath();
                    for (let r = 0; r < rows; r++) {
                        const p = points[r][c];
                        if (r === 0) {
                            ctx.moveTo(p.x, p.y);
                        } else {
                            ctx.lineTo(p.x, p.y);
                        }
                    }
                    const colAlpha = 0.12;
                    ctx.strokeStyle = `rgba(6, 182, 212, ${colAlpha})`;
                    ctx.lineWidth = 0.8;
                    ctx.stroke();
                }

                // Draw glowing vertex nodes on selective intersections
                for (let r = 2; r < rows; r += 2) {
                    for (let c = 1; c < cols; c += 2) {
                        const p = points[r][c];
                        const nodeAlpha = (r / rows) * 0.45;
                        ctx.fillStyle = `rgba(34, 211, 238, ${nodeAlpha})`;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, 1.8, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }

                // Draw & Update Floating Particles
                for (let i = 0; i < particles.length; i++) {
                    const pt = particles[i];
                    pt.x += pt.vx;
                    pt.y += pt.vy;

                    // Wrap edges
                    if (pt.x < 0) pt.x = width;
                    if (pt.x > width) pt.x = 0;
                    if (pt.y < 0) pt.y = height;
                    if (pt.y > height) pt.y = 0;

                    pt.pulse += pt.pulseSpeed;
                    const alpha = pt.baseAlpha + Math.sin(pt.pulse) * 0.2;

                    // Draw Particle Glow
                    ctx.fillStyle = `rgba(${pt.color}, ${Math.max(0.05, alpha)})`;
                    ctx.beginPath();
                    ctx.arc(pt.x, pt.y, pt.size, 0, Math.PI * 2);
                    ctx.fill();

                    // Connect nearby particles
                    for (let j = i + 1; j < particles.length; j++) {
                        const pt2 = particles[j];
                        const dx = pt.x - pt2.x;
                        const dy = pt.y - pt2.y;
                        const dist = Math.sqrt(dx * dx + dy * dy);

                        if (dist < 110) {
                            const lineAlpha = (1 - dist / 110) * 0.18;
                            ctx.strokeStyle = `rgba(139, 92, 246, ${lineAlpha})`;
                            ctx.lineWidth = 0.7;
                            ctx.beginPath();
                            ctx.moveTo(pt.x, pt.y);
                            ctx.lineTo(pt2.x, pt2.y);
                            ctx.stroke();
                        }
                    }
                }

                requestAnimationFrame(render);
            }

            render();

            if (window.lucide) lucide.createIcons();
        })();
    </script>
</body>

</html>
