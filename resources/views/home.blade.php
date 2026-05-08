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
    <title>NightLight - Guild Community</title>
    <meta name="description" content="NightLight Guild - A passionate community of gamers united by friendship and teamwork. Join our guild and experience the best gaming adventure together.">
    <meta name="keywords" content="NightLight, Guild, Gaming Community, Ragnarok Online, MMORPG, Guild, Community, Team, Friends">
    <meta name="author" content="NightLight">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/') }}">
    <meta property="og:title" content="NightLight - Guild Community">
    <meta property="og:description" content="NightLight Guild - A passionate community of gamers united by friendship and teamwork. Join our guild and experience the best gaming adventure together.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/hero-bg.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="NightLight Guild Community">
    <meta property="og:site_name" content="NightLight Guild">
    <meta property="og:locale" content="en_US">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="NightLight - Guild Community">
    <meta name="twitter:description" content="NightLight Guild - A passionate community of gamers united by friendship and teamwork. Join our guild and experience the best gaming adventure together.">
    <meta name="twitter:image" content="{{ asset('images/hero-bg.jpg') }}">

    <!-- mobile specific metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
   ================================================== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;500;600;700&family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <style>
    /* Ember Particles Container */
    .ember-particles {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 3;
        overflow: hidden;
    }

    .ember {
        position: absolute;
        width: 6px;
        height: 6px;
        background: radial-gradient(circle, var(--accent-secondary) 0%, var(--accent-primary) 50%, transparent 70%);
        border-radius: 50%;
        opacity: 0;
        animation: emberFloat linear infinite;
    }

    @keyframes emberFloat {
        0% {
            opacity: 0;
            transform: translateY(100vh) translateX(0) scale(0.3);
        }
        10% {
            opacity: 0.6;
        }
        90% {
            opacity: 0.4;
        }
        100% {
            opacity: 0;
            transform: translateY(-20vh) translateX(50px) scale(1);
        }
    }

    /* Scroll Progress Bar */
    .scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-primary), var(--accent-secondary));
        z-index: 9999;
        transition: width 0.1s ease;
        box-shadow: 0 0 10px var(--glow-white);
    }

    /* Back to Top Button */
    #go-top a {
        background: var(--bg-tertiary);
        border: 2px solid var(--accent-primary);
        box-shadow: 0 0 15px var(--glow-white);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #go-top a:hover {
        background: var(--accent-primary);
        box-shadow: 0 0 25px var(--glow-white);
    }

    #go-top a i,
    #go-top a .icon-arrow-up {
        color: var(--accent-primary) !important;
        font-size: 18px !important;
    }

    #go-top a:hover i,
    #go-top a:hover .icon-arrow-up {
        color: var(--bg-primary) !important;
    }

    /* Page Load Transition - Premium Loader */
    .page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: var(--bg-primary);
        z-index: 99999;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: opacity 1s ease, visibility 1s ease;
    }

    .page-loader.hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    /* Logo Container */
    .loader-logo {
        position: relative;
        margin-bottom: 3rem;
    }

    .loader-logo-text {
        font-family: var(--font-display);
        font-size: clamp(3rem, 8vw, 5rem);
        font-weight: 700;
        color: var(--accent-primary);
        letter-spacing: 0.5rem;
        text-transform: uppercase;
        animation: logoReveal 1.5s ease forwards;
        opacity: 0;
        transform: translateY(20px);
    }

    @keyframes logoReveal {
        0% {
            opacity: 0;
            transform: translateY(20px);
            letter-spacing: 1rem;
        }
        100% {
            opacity: 1;
            transform: translateY(0);
            letter-spacing: 0.5rem;
        }
    }

    /* Animated Border */
    .loader-border {
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, var(--accent-primary), transparent);
        animation: borderExpand 1.5s ease 0.5s forwards;
    }

    @keyframes borderExpand {
        0% { width: 0; }
        100% { width: 80%; }
    }

    /* Loading Ring */
    .loader-ring {
        position: relative;
        width: 80px;
        height: 80px;
        margin-bottom: 2rem;
    }

    .loader-ring::before,
    .loader-ring::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border: 2px solid transparent;
        border-radius: 50%;
    }

    .loader-ring::before {
        width: 100%;
        height: 100%;
        border-top: 2px solid var(--accent-primary);
        border-right: 2px solid var(--accent-secondary);
        animation: spinRing 1.5s linear infinite;
    }

    .loader-ring::after {
        width: 60%;
        height: 60%;
        border-bottom: 2px solid var(--accent-secondary);
        border-left: 2px solid var(--accent-primary);
        animation: spinRing 1s linear infinite reverse;
    }

    @keyframes spinRing {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    /* Dot Progress */
    .loader-dots {
        display: flex;
        gap: 8px;
        margin-top: 2rem;
    }

    .loader-dots span {
        width: 8px;
        height: 8px;
        background: var(--accent-primary);
        border-radius: 50%;
        animation: dotPulse 1.4s ease-in-out infinite;
    }

    .loader-dots span:nth-child(1) { animation-delay: 0s; }
    .loader-dots span:nth-child(2) { animation-delay: 0.2s; }
    .loader-dots span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes dotPulse {
        0%, 80%, 100% {
            transform: scale(0.6);
            opacity: 0.4;
        }
        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Percentage Counter */
    .loader-percent {
        position: absolute;
        bottom: 30%;
        font-family: var(--font-body);
        font-size: 1.2rem;
        color: var(--text-secondary);
        letter-spacing: 0.2rem;
    }

    .loader-percent span {
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent-primary);
    }

    /* Fade out animation for whole loader */
    .page-loader.fade-out {
        animation: loaderFadeOut 1s ease forwards;
    }

    @keyframes loaderFadeOut {
        0% { opacity: 1; }
        100% { opacity: 0; visibility: hidden; }
    }

    /* Scroll Reveal Animations */
    .reveal {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease, transform 0.8s ease;
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Hero Breathing Animation */
    .hero-content-wrapper {
        animation: heroBreathing 4s ease-in-out infinite;
    }

    @keyframes heroBreathing {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.01); }
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        .ember,
        .scroll-progress,
        .reveal,
        .hero-content-wrapper {
            animation: none;
        }
        .ember {
            display: none;
        }
    }
</style>

<!-- Page Loader -->
<div class="page-loader" id="pageLoader">
    <div class="loader-logo">
        <div class="loader-ring"></div>
        <div class="loader-logo-text">NightLight</div>
        <div class="loader-border"></div>
    </div>
    <div class="loader-percent"><span id="loaderPercent">0</span>%</div>
    <div class="loader-dots">
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<!-- Scroll Progress -->
<div class="scroll-progress" id="scrollProgress"></div>

    <!-- script
   ================================================== -->
    <script src="{{ asset('js/modernizr.js') }}"></script>
    <script src="{{ asset('js/pace.min.js') }}"></script>

    <!-- favicons
	================================================== -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

</head>

<body id="top">

@include('partials.header')


   <!-- home
   ================================================== -->
   <section id="home" data-parallax="scroll" data-image-src="{{ asset('images/hero-bg.jpg') }}" data-natural-width=3000 data-natural-height=2000>

        <div class="overlay"></div>
        <div class="ember-particles" id="emberParticles"></div>
        <div class="home-content">

            <div class="row contents hero-content-wrapper">                     
                <div class="home-content-left">

                    <h3 data-aos="fade-up">Welcome to NightLight Guild</h3>

                    <h1 data-aos="fade-up">
                        United by <br>
                        Friendship and <br>
                        Teamwork.
                    </h1>

                    <div class="discord-button-wrapper" data-aos="fade-up">
                        <a href="https://dsc.gg/nightlightt" target="_blank" class="button button-primary discord-btn">
                            <i class="fa fa-discord" aria-hidden="true"></i>
                            Join Discord
                        </a>
                    </div>

                    <div class="buttons" data-aos="fade-up">
                        <a href="#about" class="smoothscroll button stroke">
                            <span class="icon-circle-down" aria-hidden="true"></span>
                            Information
                        </a>
                        <a href="#pricing" class="smoothscroll button stroke">
                            <span class="icon-play" aria-hidden="true"></span>
                            Gallery
                        </a>
                    </div>                                         

                </div>

                <div class="home-image-right">
                    <img src="{{ asset('images/iphone-app-470.png') }}" 
                        srcset="{{ asset('images/iphone-app-470.png') }} 1x, {{ asset('images/iphone-app-940.png') }} 2x"  
                        data-aos="fade-up">
                </div>
            </div>

        </div> <!-- end home-content -->

        <ul class="home-social-list">
            <!-- <li>
                <a href="#"><i class="fa fa-facebook-square"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-twitter"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-instagram"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-youtube-play"></i></a>
            </li> -->
        </ul>
        <!-- end home-social-list -->

        <div class="home-scrolldown">
            <a href="#about" class="scroll-icon smoothscroll">
                <span>See More</span>
                <i class="icon-arrow-right" aria-hidden="true"></i>
            </a>
        </div>

    </section> <!-- end home -->  


    <!-- about
    ================================================== -->
    <section id="about">

        <div class="row about-intro">

            <div class="col-four">
                <h1 class="intro-header" data-aos="fade-up"><img src="{{ asset('images/girl-bg.png') }}" /></h1>
            </div>
            <div class="col-eight">
				<h1>A LITTLE ABOUT NIGHTLIGHT GUILD :</h1>
                <p class="lead" data-aos="fade-up">
                    NightLight is more than just a guild - we're a family of passionate gamers united by our love for adventure and camaraderie. We believe in supporting each other, growing together, and creating unforgettable memories in the gaming world.
					</p>
				<p class="lead" data-aos="fade-up">	
					Whether you're a hardcore gamer who spends hours perfecting your skills, or a casual player who enjoys gaming as a hobby, there's a place for you in NightLight. We welcome all players who value friendship, respect, and teamwork.
                </p>
            </div>                       
            
        </div>

        <div class="row about-features">

            <div class="announcement-section" data-aos="fade-up">

                <div class="announcement-content">
                    <h3>{{ $announcement->title ?? 'ANNOUNCEMENTS' }}</h3>
                    <p>{{ $announcement->content ?? 'Welcome to NightLight Guild! Stay tuned for updates and news.' }}</p>
                </div>

            </div> <!-- end announcement-section -->

        </div> <!-- end about-features -->
        
    </section> <!-- end about -->  
   

    <!-- pricing
    ================================================== -->
    <section id="pricing" class="modern-gallery-section">
        <style>
            .modern-gallery-section {
                padding: 6rem 0;
                background: var(--bg-secondary);
                position: relative;
            }
            .gallery-intro {
                text-align: center;
                margin-bottom: 2rem;
            }
            .gallery-intro h1 {
                font-size: clamp(2.5rem, 4vw, 3rem);
                font-family: var(--font-display);
                font-weight: 700;
                color: var(--text-primary);
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 1rem;
            }
            .gallery-intro p.lead {
                color: var(--text-secondary);
                font-size: 1.6rem;
            }
            .gallery-slider-wrapper {
                position: relative;
                width: 100%;
                padding: 2rem;
                max-width: 1400px;
                margin: 0 auto;
            }
            .gallery-slider-container {
                overflow-x: auto;
                overflow-y: hidden;
                cursor: grab;
                scroll-behavior: smooth;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
                padding: 1.5rem 0;
            }
            .gallery-slider-container::-webkit-scrollbar {
                display: none;
            }
            .gallery-slider {
                display: flex;
                gap: 2rem;
            }
            .gallery-item {
                flex: 0 0 calc(33.333% - 1.34rem);
                min-width: 280px;
                position: relative;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                background: var(--bg-tertiary);
                transform: translateZ(0);
            }

            .gallery-item:hover {
                transform: translateY(-12px) scale(1.03);
                box-shadow: 0 25px 50px var(--glow-white);
                z-index: 10;
            }

            .gallery-image-wrapper {
                position: relative;
                width: 100%;
                padding-top: 100%;
                overflow: hidden;
                background: var(--bg-secondary);
            }

            .gallery-image {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.6s ease;
            }

            .gallery-item:hover .gallery-image {
                transform: scale(1.1);
            }

            .gallery-overlay {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(to bottom, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.6));
                opacity: 0;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                transition: opacity 0.4s ease;
                pointer-events: none;
            }

            .gallery-item:hover .gallery-overlay {
                opacity: 1;
            }

            .gallery-icon {
                color: var(--text-primary);
                font-size: 3rem;
                transform: translateY(30px) scale(0.5);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                text-shadow: 0 5px 15px rgba(0,0,0,0.3);
            }

            .gallery-item:hover .gallery-icon {
                transform: translateY(0) scale(1);
            }

            .gallery-placeholder {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--bg-tertiary) 100%);
            }

            .placeholder-text {
                font-family: var(--font-body);
                font-weight: 700;
                color: var(--text-secondary);
                font-size: 1.2rem;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            @media (max-width: 1024px) {
                .gallery-item {
                    flex: 0 0 calc(50% - 1rem);
                }
            }
            @media (max-width: 768px) {
                .gallery-item {
                    flex: 0 0 calc(80% - 1rem);
                }
            }
        </style>

        <div class="row">
            <div class="col-twelve gallery-intro" data-aos="fade-up">
                <h1 class="intro-header">{{ $gallery->title ?? 'OUR GALLERY' }}</h1>
                <p class="lead">{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}</p>
            </div>
        </div>

        <div class="gallery-slider-wrapper">
            <div class="gallery-slider-container" id="galleryContainer">
                <div class="gallery-slider" id="gallerySlider">

                @if(isset($galleryImages) && count($galleryImages) > 0)
                    @foreach($galleryImages as $index => $image)
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                            <div class="gallery-image-wrapper" onclick="openLightbox('{{ asset($image) }}', {{ $index }})" style="cursor: pointer;">
                                <img data-src="{{ asset($image) }}" alt="Gallery Photo {{ $index + 1 }}" class="gallery-image lazy-load">
                                <div class="gallery-overlay">
                                    <i class="icon-search gallery-icon"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @for($i = 1; $i <= 6; $i++)
                        <div class="gallery-item" data-aos="fade-up" data-aos-delay="{{ $i * 50 }}">
                            <div class="gallery-image-wrapper">
                                <div class="gallery-placeholder">
                                    <span class="placeholder-text">Photo {{ $i }}</span>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif

                </div>
            </div>
        </div>
    </section> <!-- end pricing -->

    <!-- Testimonials Section
    ================================================== -->
    <section id="testimonials">

        <div class="row">
            <div class="col-twelve" style="text-align: center;">
                <h1 class="intro-header" data-aos="fade-up">Meet the NightLight Team</h1>
            </div>   		
        </div>   	

        <div class="row team-section" data-aos="fade-up">
            @php
                $roleOrder = ['Guild Master', 'Vice Guild Master', 'Charisma Baby', 'Officer', 'Commander'];
                
                $orderedGroupedMembers = [];
                foreach($roleOrder as $role) {
                    $orderedGroupedMembers[$role] = [];
                }
                
                if(isset($teamMembers) && count($teamMembers) > 0) {
                    foreach($teamMembers as $member) {
                        if (in_array($member->role, $roleOrder)) {
                            $orderedGroupedMembers[$member->role][] = $member;
                        }
                    }
                }
            @endphp

            <div class="team-guild-grid">
                @foreach($roleOrder as $role)
                @php 
                    $members = $orderedGroupedMembers[$role] ?? []; 
                    
                    $maxCount = 1;
                    if ($role == 'Vice Guild Master') $maxCount = 2;
                    if ($role == 'Officer') $maxCount = 4;
                @endphp
                <div class="team-role-card">
                    <div class="role-header">
                        <h2>{{ $role }}</h2>
                        <span class="role-count">{{ count($members) }}/{{ $maxCount }}</span>
                    </div>
                    <div class="role-members-list">
                        @if(count($members) > 0)
                            @foreach($members as $member)
                            <div class="team-member-item">
                                <div class="avatar-wrapper">
                                    <div class="avatar-frame"></div>
                                    <img src="{{ $member->avatar ? asset($member->avatar) : asset('images/avatars/user-01.jpg') }}" alt="{{ $member->name }}" class="member-avatar">
                                </div>
                                <div class="member-name">{{ $member->name }}</div>
                            </div>
                            @endforeach
                        @else
                            <div class="team-member-item empty-member">
                                <div class="avatar-wrapper">
                                    <div class="avatar-frame empty"></div>
                                    <div class="member-avatar" style="border: 3px solid #ffffff; background: #f0f0f0;"></div>
                                </div>
                                <div class="member-name empty-text">-</div>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <style>
            .team-section {
                padding: 2rem 1rem;
                max-width: 1200px;
                margin: 0 auto;
                background: linear-gradient(180deg, var(--bg-secondary) 0%, var(--bg-primary) 100%);
            }

            .team-guild-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 1.5rem;
                align-items: start;
            }

            .team-role-card {
                background: rgba(45, 35, 25, 0.7);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border-radius: 16px;
                padding: 1.5rem 1rem;
                border: 2px solid var(--bg-tertiary);
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            }

            .team-role-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 0 30px var(--glow-white);
                border-color: var(--accent-primary);
            }

            .role-header {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 0.8rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid var(--bg-tertiary);
            }

            .role-header h2 {
                font-family: var(--font-display);
                color: var(--text-primary);
                font-size: 1.1rem;
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-weight: 700;
                line-height: 1.3;
            }

            .role-count {
                background: rgba(245, 166, 35, 0.15);
                color: var(--accent-primary);
                padding: 4px 14px;
                border-radius: 20px;
                font-size: 0.9rem;
                font-weight: 700;
            }

            .role-members-list {
                display: flex;
                flex-direction: column;
                gap: 1.8rem;
                align-items: center;
            }

            .team-member-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 0.8rem;
                width: 100%;
            }

            .avatar-wrapper {
                position: relative;
                width: 90px;
                height: 90px;
            }

            .avatar-frame {
                position: absolute;
                top: -4px;
                left: -4px;
                right: -4px;
                bottom: -4px;
                border-radius: 50%;
                background: linear-gradient(135deg, var(--accent-secondary) 0%, var(--accent-primary) 50%, var(--accent-tertiary) 100%);
                box-shadow: 0 0 15px var(--glow-white);
                z-index: 0;
                animation: borderGradient 3s linear infinite;
            }

            @keyframes borderGradient {
                0% { filter: hue-rotate(0deg); }
                100% { filter: hue-rotate(360deg); }
            }

            .avatar-frame.empty {
                background: var(--bg-tertiary);
                box-shadow: none;
                border: 2px dashed var(--text-secondary);
            }

            .member-avatar {
                position: relative;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 4px solid var(--text-primary);
                z-index: 1;
                background: var(--bg-secondary);
            }

            .member-name {
                font-family: var(--font-body);
                color: var(--text-primary);
                font-size: 1rem;
                font-weight: 700;
                text-align: center;
                margin: 0;
                word-break: break-word;
            }

            .empty-text {
                color: var(--text-secondary);
            }

            @media (max-width: 1024px) {
                .team-guild-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            @media (max-width: 768px) {
                .team-guild-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
                .team-role-card {
                    padding: 1.2rem 0.5rem;
                }
                .avatar-wrapper {
                    width: 70px;
                    height: 70px;
                }
                .role-header h2 {
                    font-size: 0.95rem;
                }
            }

            @media (max-width: 480px) {
                .team-guild-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

    </section> <!-- end testimonials -->

    <!-- download
    ================================================== -->
    <!-- <section id="download">

        <div class="row">
            <div class="col-full">
                <h1 class="intro-header"  data-aos="fade-up">GUILD RESOURCES :</h1>
				
                <h5 class="lead" data-aos="fade-up">
                   Access our guild resources and tools to enhance your gaming experience.
                </h5>
				
				<p>
				</p>

                <ul class="download-badges" data-os="fade-up">
                    <div class="plan-bottom-part">
                        <a href="{{ asset('downloads/guild-guide.pdf') }}"><img src="{{ asset('images/button1s.png') }}" alt="Guild Guide" /></a>
						<a href="{{ asset('downloads/resource-pack.zip') }}"><img src="{{ asset('images/button2s.png') }}" alt="Resource Pack" /></a>
                    </div>
					 <h5 class="lead" data-aos="fade-up">
                   For any questions or issues, please contact our guild leadership.
                </h5>
                </ul>

            </div>
        </div>

    </section> end download     -->

<!-- Lightbox Modal -->
<style>
    /* Modern Lightbox Styles - Warm Theme */
    #lightbox {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(26, 20, 16, 0.95);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        z-index: 9999;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    #lightbox.active {
        opacity: 1;
    }
    #lightbox-img {
        max-width: 90%;
        max-height: 85vh;
        object-fit: contain;
        border-radius: 12px;
        box-shadow: 0 25px 60px var(--glow-white);
        transform: scale(0.95);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        border: 3px solid var(--accent-primary);
    }
    #lightbox.active #lightbox-img {
        transform: scale(1);
    }
    .lightbox-btn {
        position: absolute;
        background: rgba(45, 35, 25, 0.8);
        border: 2px solid var(--accent-primary);
        color: var(--accent-primary);
        border-radius: 50%;
        width: 65px;
        height: 65px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10000;
        font-size: 24px;
        box-shadow: 0 0 15px var(--glow-white);
    }
    .lightbox-btn:hover {
        background: var(--accent-primary);
        border-color: var(--accent-primary);
        color: var(--bg-primary);
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 0 30px var(--glow-white);
    }
    .lightbox-btn i {
        line-height: 1;
    }
    #lightbox-close { top: 30px; right: 30px; }
    #lightbox-prev { left: 40px; }
    #lightbox-next { right: 40px; }

    @media (max-width: 768px) {
        .lightbox-btn { width: 50px; height: 50px; font-size: 20px; }
        #lightbox-prev { left: 15px; }
        #lightbox-next { right: 15px; }
        #lightbox-close { top: 20px; right: 20px; }
    }
</style>

<div id="lightbox">
    <button id="lightbox-close" class="lightbox-btn" onclick="closeLightbox()">
        <i class="icon-times"></i>
    </button>
    <button id="lightbox-prev" class="lightbox-btn" onclick="prevImage(event)">
        <i class="icon-arrow-left"></i>
    </button>
    <button id="lightbox-next" class="lightbox-btn" onclick="nextImage(event)">
        <i class="icon-arrow-right"></i>
    </button>
    <img id="lightbox-img" src="" alt="Gallery Preview">
</div>

<script>
    // Page Loader - Premium loading animation
    (function() {
        const loader = document.getElementById('pageLoader');
        const percentEl = document.getElementById('loaderPercent');
        let progress = 0;
        const duration = 2000; // 2 seconds total loading time
        const interval = 20; // Update every 20ms
        const steps = duration / interval;
        const increment = 100 / steps;

        const loadInterval = setInterval(() => {
            progress += increment;
            if (progress >= 100) {
                progress = 100;
                clearInterval(loadInterval);

                // Wait for full page load
                window.addEventListener('load', function() {
                    setTimeout(() => {
                        loader.classList.add('fade-out');
                        setTimeout(() => {
                            loader.classList.add('hidden');
                        }, 1000);
                    }, 300);
                });

                // Fallback if load already fired
                if (document.readyState === 'complete') {
                    setTimeout(() => {
                        loader.classList.add('fade-out');
                        setTimeout(() => {
                            loader.classList.add('hidden');
                        }, 1000);
                    }, 300);
                }
            }
            percentEl.textContent = Math.floor(progress);
        }, interval);

        // Ensure loader hides even if window.load already fired
        window.addEventListener('load', function() {
            clearInterval(loadInterval);
            progress = 100;
            percentEl.textContent = '100';
            setTimeout(() => {
                loader.classList.add('fade-out');
                setTimeout(() => {
                    loader.classList.add('hidden');
                }, 1000);
            }, 500);
        });
    })();

    // Header scroll state (transparent to solid)
    const header = document.getElementById('header');
    let lastScroll = 0;

    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScroll = currentScroll;
    });

    // Scroll Progress Bar
    const scrollProgress = document.getElementById('scrollProgress');

    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        scrollProgress.style.width = scrolled + '%';
    });

    // Create Ember Particles
    function createEmbers() {
        const container = document.getElementById('emberParticles');
        const emberCount = 25;

        for (let i = 0; i < emberCount; i++) {
            const ember = document.createElement('div');
            ember.className = 'ember';

            // Random properties
            const size = Math.random() * 5 + 3; // 3-8px
            const left = Math.random() * 100;
            const animationDuration = Math.random() * 7 + 8; // 8-15s
            const animationDelay = Math.random() * 10;
            const opacity = Math.random() * 0.4 + 0.3; // 0.3-0.7

            ember.style.width = size + 'px';
            ember.style.height = size + 'px';
            ember.style.left = left + '%';
            ember.style.animationDuration = animationDuration + 's';
            ember.style.animationDelay = animationDelay + 's';
            ember.style.opacity = opacity;

            container.appendChild(ember);
        }
    }

    createEmbers();

    // Scroll Reveal Animation with IntersectionObserver
    const revealElements = document.querySelectorAll('.team-role-card, .gallery-item, .announcement-content');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => {
        el.classList.add('reveal');
        revealObserver.observe(el);
    });

    // Reduced motion check
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.querySelectorAll('.ember').forEach(e => e.style.display = 'none');
    }
</script>
<script>
    let currentImageIndex = 0;

    function openLightbox(imageSrc, index) {
        currentImageIndex = index;
        const lightboxImg = document.getElementById('lightbox-img');
        const lightbox = document.getElementById('lightbox');
        
        lightboxImg.src = imageSrc;
        lightbox.style.display = 'flex';
        
        // Force reflow to enable transition
        void lightbox.offsetWidth;
        lightbox.classList.add('active');

        // Hide navigation arrows if there's only 1 image
        const prevBtn = document.getElementById('lightbox-prev');
        const nextBtn = document.getElementById('lightbox-next');
        if (galleryImages.length <= 1) {
            prevBtn.style.display = 'none';
            nextBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'flex';
            nextBtn.style.display = 'flex';
        }
    }

    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('active');
        setTimeout(() => {
            lightbox.style.display = 'none';
            document.getElementById('lightbox-img').src = '';
        }, 400); // Matches transition duration
    }

    function changeImageWithAnimation(newIndex) {
        const img = document.getElementById('lightbox-img');
        img.style.opacity = '0';
        img.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            currentImageIndex = newIndex;
            img.src = galleryImages[currentImageIndex];
            
            img.onload = () => {
                img.style.opacity = '1';
                img.style.transform = 'scale(1)';
            };
        }, 200);
    }

    function nextImage(event) {
        if (galleryImages.length <= 1) return;
        if(event) event.stopPropagation();
        const newIndex = (currentImageIndex + 1) % galleryImages.length;
        changeImageWithAnimation(newIndex);
    }

    function prevImage(event) {
        if (galleryImages.length <= 1) return;
        if(event) event.stopPropagation();
        const newIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        changeImageWithAnimation(newIndex);
    }

    // Draggable slider functionality with smooth momentum
    const slider = document.getElementById('gallerySlider');
    let sliderContainer;
    let isDown = false;
    let startX;
    let scrollLeft;
    let isDragging = false;
    let velocity = 0;
    let animationFrame;
    let lastX;
    let autoScrollInterval;
    let scrollDirection = 1; // 1 for right, -1 for left

    // Only initialize slider if it exists
    if (slider) {
        sliderContainer = slider.parentElement;

        // Auto-scroll functionality
        function startAutoScroll() {
            // Only auto-scroll if there's content to scroll
            if (sliderContainer.scrollWidth <= sliderContainer.clientWidth) {
                return;
            }
            if (autoScrollInterval) clearInterval(autoScrollInterval);
            autoScrollInterval = setInterval(() => {
                if (!isDown && !isDragging) {
                    sliderContainer.scrollLeft += 1.5 * scrollDirection;

                    // Reverse direction when reaching end
                    if (sliderContainer.scrollLeft >= sliderContainer.scrollWidth - sliderContainer.clientWidth - 1) {
                        scrollDirection = -1;
                    }

                    // Reverse direction when reaching beginning
                    if (sliderContainer.scrollLeft <= 0) {
                        scrollDirection = 1;
                    }
                }
            }, 20);
        }

        function stopAutoScroll() {
            if (autoScrollInterval) {
                clearInterval(autoScrollInterval);
                autoScrollInterval = null;
            }
        }

        // Start auto-scroll on load
        startAutoScroll();

        // Pause auto-scroll on hover
        sliderContainer.addEventListener('mouseenter', stopAutoScroll);
        sliderContainer.addEventListener('mouseleave', () => {
            if (!isDown) startAutoScroll();
        });

        // Mouse events
        sliderContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            isDragging = false;
            sliderContainer.style.cursor = 'grabbing';
            startX = e.pageX - sliderContainer.offsetLeft;
            scrollLeft = sliderContainer.scrollLeft;
            lastX = startX;
            velocity = 0;
            stopAutoScroll();
            cancelAnimationFrame(animationFrame);
        });

        sliderContainer.addEventListener('mouseleave', () => {
            if (isDown) {
                isDown = false;
                sliderContainer.style.cursor = 'grab';
                applyMomentum();
            }
        });

        sliderContainer.addEventListener('mouseup', () => {
            isDown = false;
            sliderContainer.style.cursor = 'grab';
            if (isDragging) {
                applyMomentum();
            }
        });

        sliderContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            isDragging = true;
            const x = e.pageX - sliderContainer.offsetLeft;
            const walk = (x - startX) * 2;
            velocity = x - lastX;
            lastX = x;
            sliderContainer.scrollLeft = scrollLeft - walk;
        });

        // Touch events for mobile
        sliderContainer.addEventListener('touchstart', (e) => {
            isDown = true;
            isDragging = false;
            startX = e.touches[0].pageX - sliderContainer.offsetLeft;
            scrollLeft = sliderContainer.scrollLeft;
            lastX = startX;
            velocity = 0;
            stopAutoScroll();
            cancelAnimationFrame(animationFrame);
        });

        sliderContainer.addEventListener('touchend', () => {
            isDown = false;
            if (isDragging) {
                applyMomentum();
            }
        });

        sliderContainer.addEventListener('touchmove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            isDragging = true;
            const x = e.touches[0].pageX - sliderContainer.offsetLeft;
            const walk = (x - startX) * 2;
            velocity = x - lastX;
            lastX = x;
            sliderContainer.scrollLeft = scrollLeft - walk;
        });

        // Momentum effect for smooth scrolling
        function applyMomentum() {
            if (Math.abs(velocity) > 0.5) {
                sliderContainer.scrollLeft -= velocity * 2;
                velocity *= 0.95;
                animationFrame = requestAnimationFrame(applyMomentum);
            } else {
                // Resume auto-scroll after momentum stops
                startAutoScroll();
            }
        }
    }

    // Lazy loading with Intersection Observer
    const lazyImages = document.querySelectorAll('.lazy-load');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.6s ease';
                img.src = img.dataset.src;
                img.onload = function() {
                    img.style.opacity = '1';
                };
                img.classList.remove('lazy-load');
                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px 0px',
        threshold: 0.1
    });

    lazyImages.forEach(img => imageObserver.observe(img));

    // Close lightbox on escape key
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (lightbox.classList.contains('active')) {
            if (e.key === 'Escape') {
                closeLightbox();
            } else if (e.key === 'ArrowRight') {
                nextImage();
            } else if (e.key === 'ArrowLeft') {
                prevImage();
            }
        }
    });

    // Close lightbox when clicking outside the image
    document.getElementById('lightbox').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLightbox();
        }
    });
</script>

@include('partials.footer')
