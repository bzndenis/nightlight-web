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
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

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
        <div class="home-content">        

            <div class="row contents">                     
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
                background: #f8f9fa;
                position: relative;
            }
            .gallery-intro {
                text-align: center;
                margin-bottom: 2rem;
            }
            .gallery-intro h1 {
                font-size: 2.8rem;
                font-weight: 800;
                color: #2b2b2b;
                text-transform: uppercase;
                letter-spacing: 2px;
                margin-bottom: 1rem;
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
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                background: #fff;
                transform: translateZ(0); /* Hardware acceleration */
            }
            
            .gallery-item:hover {
                transform: translateY(-12px) scale(1.02);
                box-shadow: 0 25px 50px rgba(233, 69, 96, 0.2);
                z-index: 10;
            }

            .gallery-image-wrapper {
                position: relative;
                width: 100%;
                padding-top: 100%; /* 1:1 Aspect Ratio / Square */
                overflow: hidden;
                background: #eaeaea;
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
                background: linear-gradient(to bottom, rgba(233,69,96,0.1), rgba(233,69,96,0.85));
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
                color: #ffffff;
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
                background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
                animation: placeholderPulse 2.5s infinite ease-in-out;
            }

            .placeholder-text {
                font-weight: 700;
                color: rgba(0,0,0,0.3);
                font-size: 1.2rem;
                text-transform: uppercase;
                letter-spacing: 2px;
            }

            @keyframes placeholderPulse {
                0% { opacity: 0.7; }
                50% { opacity: 1; }
                100% { opacity: 0.7; }
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
            }

            .team-guild-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 1.5rem;
                align-items: start;
            }

            .team-role-card {
                background: #ffffff;
                border-radius: 16px;
                padding: 1.5rem 1rem;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
                border: 2px solid #f0f0f0;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }
            
            .team-role-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border-color: #e94560;
            }

            .role-header {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
                gap: 0.8rem;
                padding-bottom: 1rem;
                border-bottom: 2px solid #f0f0f0;
            }

            .role-header h2 {
                color: #2b2b2b;
                font-size: 1.1rem;
                margin: 0;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-weight: 800;
                line-height: 1.3;
            }

            .role-count {
                background: rgba(233, 69, 96, 0.1);
                color: #e94560;
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
                background: linear-gradient(135deg, #FFD700 0%, #FF8C00 50%, #FF4500 100%);
                box-shadow: 0 0 10px rgba(255, 140, 0, 0.4);
                z-index: 0;
            }
            
            .avatar-frame.empty {
                background: #e0e0e0;
                box-shadow: none;
            }

            .member-avatar {
                position: relative;
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
                border: 4px solid #ffffff;
                z-index: 1;
                background: #f8f9fa;
            }

            .member-name {
                color: #333333;
                font-size: 1rem;
                font-weight: 700;
                text-align: center;
                margin: 0;
                word-break: break-word;
            }
            
            .empty-text {
                color: #aaaaaa;
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
    /* Modern Lightbox Styles */
    #lightbox {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 15, 20, 0.95);
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
        box-shadow: 0 25px 60px rgba(0,0,0,0.6);
        transform: scale(0.95);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    #lightbox.active #lightbox-img {
        transform: scale(1);
    }
    .lightbox-btn {
        position: absolute;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
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
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }
    .lightbox-btn:hover {
        background: #e94560;
        border-color: #e94560;
        transform: scale(1.1) translateY(-2px);
        box-shadow: 0 12px 25px rgba(233, 69, 96, 0.4);
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
    const galleryImages = @json(array_map(function($img) { return asset($img); }, $galleryImages ?? []));
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
