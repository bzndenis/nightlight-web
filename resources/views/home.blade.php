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
    <section id="pricing">
        <div class="row pricing-content">

            <div class="col-four pricing-intro">
                <h1 class="intro-header" data-aos="fade-up">{{ $gallery->title ?? 'GALLERY' }} :</h1>

                <h5 data-aos="fade-up">{{ $gallery->description ?? 'Explore our gallery featuring memorable moments from guild events, raids, and community gatherings. See our adventures and achievements captured in screenshots.' }}
                </h5>
            </div>

            <div class="col-eight gallery-grid">
                <div class="gallery-slider-container" style="overflow-x: auto; overflow-y: hidden; cursor: grab; scroll-behavior: smooth; -webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                    <style>
                        .gallery-slider-container::-webkit-scrollbar {
                            display: none;
                        }
                    </style>
                    <div class="gallery-slider" id="gallerySlider" style="display: flex; gap: 1rem;">

                    @if(isset($galleryImages) && count($galleryImages) > 0)

                        @foreach($galleryImages as $index => $image)
                            <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                                <div class="gallery-placeholder" style="background: none; border: none; height: auto;">
                                    <img data-src="{{ asset($image) }}" alt="Gallery Photo {{ $index + 1 }}" class="gallery-image lazy-load" onclick="openLightbox('{{ asset($image) }}', {{ $index }})" style="cursor: pointer; width: 100%; height: auto; border-radius: 8px; object-fit: cover; background: #f0f0f0; min-height: 200px;">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 1</span>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 2</span>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 3</span>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 4</span>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 5</span>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" style="flex: 0 0 calc(25% - 0.75rem); min-width: 200px;" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 6</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    </div>
                </div>
            </div> <!-- end gallery-grid -->

        </div> <!-- end pricing-content -->
    </section> <!-- end pricing -->

    <!-- Testimonials Section
    ================================================== -->
    <center><section id="testimonials">

        <div class="row">
            <div class="col-twelve">
                <h1 class="intro-header" data-aos="fade-up">Meet the NightLight Team</h1>
            </div>   		
        </div>   	

        <div class="row owl-wrap">

            <div id="testimonial-slider"  data-aos="fade-up">

                <div class="slides owl-carousel">

                    @if(isset($teamMembers) && count($teamMembers) > 0)
                        @foreach($teamMembers as $member)
                        <div>
                            <p>
                            {{ $member->quote }}
                            </p>

                            <div class="testimonial-author">
                                <img src="{{ $member->avatar ? asset($member->avatar) : asset('images/avatars/user-01.jpg') }}" alt="Author image">
                                <div class="author-info">
                                    {{ $member->name }}
                                    <span class="position">{{ $member->role }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div>
                            <p>
                            Leading NightLight Guild to greatness together.
                            </p>

                            <div class="testimonial-author">
                                <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Author image">
                                <div class="author-info">
                                    xOrc
                                    <span class="position">Guild Master</span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div> <!-- end slides -->

            </div> <!-- end testimonial-slider -->         
            
        </div> <!-- end flex-container -->

    </section></center> <!-- end testimonials -->

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
<div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.9); z-index: 9999; justify-content: center; align-items: center;">
    <button onclick="closeLightbox()" style="position: absolute; top: 20px; right: 30px; font-size: 40px; color: white; background: none; border: none; cursor: pointer; z-index: 10000;">&times;</button>
    <button onclick="prevImage()" style="position: absolute; left: 30px; font-size: 40px; color: white; background: none; border: none; cursor: pointer; z-index: 10000;">&#10094;</button>
    <button onclick="nextImage()" style="position: absolute; right: 30px; font-size: 40px; color: white; background: none; border: none; cursor: pointer; z-index: 10000;">&#10095;</button>
    <img id="lightbox-img" src="" alt="Gallery Preview" style="max-width: 90%; max-height: 90%; object-fit: contain;">
</div>

<script>
    const galleryImages = @json(array_map(function($img) { return asset($img); }, $galleryImages ?? []));
    let currentImageIndex = 0;

    function openLightbox(imageSrc, index) {
        currentImageIndex = index;
        document.getElementById('lightbox-img').src = imageSrc;
        document.getElementById('lightbox').style.display = 'flex';
    }

    function closeLightbox() {
        document.getElementById('lightbox').style.display = 'none';
    }

    function nextImage() {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        document.getElementById('lightbox-img').src = galleryImages[currentImageIndex];
    }

    function prevImage() {
        currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
        document.getElementById('lightbox-img').src = galleryImages[currentImageIndex];
    }

    // Draggable slider functionality with smooth momentum
    const slider = document.getElementById('gallerySlider');
    const sliderContainer = slider.parentElement;
    let isDown = false;
    let startX;
    let scrollLeft;
    let isDragging = false;
    let velocity = 0;
    let animationFrame;
    let lastX;
    let autoScrollInterval;
    let scrollDirection = 1; // 1 for right, -1 for left

    // Auto-scroll functionality
    function startAutoScroll() {
        if (autoScrollInterval) clearInterval(autoScrollInterval);
        autoScrollInterval = setInterval(() => {
            if (!isDown && !isDragging) {
                sliderContainer.scrollLeft += 2 * scrollDirection;

                // Reverse direction when reaching end
                if (sliderContainer.scrollLeft >= sliderContainer.scrollWidth - sliderContainer.clientWidth) {
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
        if (!isDragging) {
            // It was a click, not a drag
        } else {
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

    // Lazy loading with Intersection Observer
    const lazyImages = document.querySelectorAll('.lazy-load');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.3s ease';
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
        if (e.key === 'Escape') {
            closeLightbox();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        } else if (e.key === 'ArrowLeft') {
            prevImage();
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
