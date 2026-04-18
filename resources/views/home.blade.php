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
                <div class="row">

                    @if(isset($galleryImages) && count($galleryImages) > 0)
                        @foreach($galleryImages as $index => $image)
                            <div class="col-four gallery-item" data-aos="fade-up">
                                <div class="gallery-placeholder" style="background: none; border: none; height: auto;">
                                    <img src="{{ asset($image) }}" alt="Gallery Photo {{ $index + 1 }}" class="gallery-image">
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 1</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 2</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 3</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 4</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 5</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-four gallery-item" data-aos="fade-up">
                            <div class="gallery-placeholder">
                                <div class="placeholder-box">
                                    <span class="placeholder-text">Photo 6</span>
                                </div>
                            </div>
                        </div>
                    @endif

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

@include('partials.footer')
