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
    <meta property="og:description" content="NightLight Guild - A passionate community of gamers united by friendship and teamwork.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="NightLight - Guild Community">
    <meta name="twitter:description" content="NightLight Guild - A passionate community of gamers united by friendship and teamwork.">

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

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.3"></script>

    <!-- header 
   ================================================== -->
   <header id="header" class="row">   

   		<div class="header-logo">
	        <a href="{{ url('/') }}">NightLight</a>
	    </div>

	   	<nav id="header-nav-wrap">
			<ul class="header-main-nav">
				<li class="current"><a class="smoothscroll"  href="#home" title="home">Home</a></li>
                <li><a class="smoothscroll"  href="#about" title="about">Information</a></li>
				<li><a class="smoothscroll"  href="#pricing" title="pricing">Support</a></li>
				<li><a class="smoothscroll"  href="#testimonials" title="testimonials">Team</a></li>
				<li><a class="smoothscroll"  href="#download" title="download">Resources</a></li>	
			</ul>

            <a href="#" title="sign-up" class="button button-primary cta">Join Guild</a>
		</nav>

		<a class="header-menu-toggle" href="#"><span>Menu</span></a>    	
   	
   </header> <!-- /header -->


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
                        <a href="#download" class="smoothscroll button stroke">
                            <span class="icon-circle-down" aria-hidden="true"></span>
                            Resources
                        </a>
                        <a href="https://www.youtube.com/watch?v=Yeoxq3v73Qw" data-lity class="button stroke">
                            <span class="icon-play" aria-hidden="true"></span>
                            Learn More
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

            <div class="features-list block-1-3 block-m-1-2 block-mob-full group">

                <div class="bgrid feature" data-aos="fade-up">	

                    <center><span class="icon"> <img src="{{ asset('images/icons/rok.png') }}" /> </span></center>            

                    <div class="service-content">	

                        <center><h3>GUILD VALUES :</h3></center>
                        <h5>- <font color="46305e">Friendship</font> : Building lasting bonds with fellow members
						<h5>- <font color="46305e">Respect</font> : Treating everyone with dignity and kindness
						<h5>- <font color="46305e">Teamwork</font> : Working together to achieve common goals
						<h5>- <font color="46305e">Loyalty</font> : Standing by our guild and members
						<h5>- <font color="46305e">Growth</font> : Helping each other improve and succeed
						<h5>- <font color="46305e">Fun</font> : Enjoying the game together
                        </h5>
                        
                    </div> 	         	 

                    </div> <!-- /bgrid -->

                    <div class="bgrid feature" data-aos="fade-up">	

                        <center><span class="icon"> <img src="{{ asset('images/icons/nid.png') }}" /> </span></center>                        

                        <div class="service-content">	
                        <center><h3>GUILD ACTIVITIES :</h3></center>  

						<h5>- <font color="46305e">Guild Events</font> : Regular events and activities for all members
						<h5>- <font color="46305e">Raids & Dungeons</font> : Team up for challenging content together
						<h5>- <font color="46305e">PvP & Battlegrounds</font> : Competitive play as a united team
						<h5>- <font color="46305e">Social Gatherings</font> : Casual hangouts and community building
                        </h5>

                        
                    </div>	                          

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <center><span class="icon"> <img src="{{ asset('images/icons/fad.png') }}" /> </span></center>		            

                    <div class="service-content">
                        <center><h3>COMMUNITY SUPPORT :</h3></center>

                        <h5>- <font color="46305e">Discord Server</font> : Active Discord community for chatting and coordination
						<h5>- <font color="46305e">Mentorship</font> : Experienced members helping new players learn and grow
						<h5>- <font color="46305e">Resource Sharing</font> : Tips, guides, and resources shared among members
						</h5>
                            
                    </div> 	            	               

                </div> <!-- /bgrid -->

                    <div class="bgrid feature" data-aos="fade-up">

                        <center><span class="icon"> <img src="{{ asset('images/icons/emp.png') }}" /> </span></center>	

                    <div class="service-content">
                        <center><h3>GUILD ACHIEVEMENTS :</h3></center>

                        <h5>- <font color="46305e">Tournament Wins</font> : Multiple victories in guild competitions
						<h5>- <font color="46305e">Community Growth</font> : Continuously expanding our family of gamers
						<h5>- <font color="46305e">Member Recognition</font> : Celebrating individual and team accomplishments
						</h5>
                        
                    </div>                

                    </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <center><span class="icon"> <img src="{{ asset('images/icons/shu.png') }}" /> </span></center>		            

                    <div class="service-content">	
                        <center><h3>MEMBERSHIP BENEFITS :</h3></center>

                        <h5>- <font color="46305e">Exclusive Events</font> : Members-only activities and giveaways
						<h5>- <font color="46305e">Guild Bank</font> : Shared resources to help members progress
						<h5>- <font color="46305e">Priority Support</font> : Quick assistance from guild leadership
						</h5>
                    </div>	               

                </div> <!-- /bgrid -->

                <div class="bgrid feature" data-aos="fade-up">

                    <center><span class="icon"> <img src="{{ asset('images/icons/vot.png') }}" /> </span></center>	   	           

                    <div class="service-content">
                        <center><h3>JOIN US :</h3></center>

                        <h5>- <font color="46305e">Apply Now</font> : Fill out our application form to join
						<h5>- <font color="46305e">Discord</font> : Join our Discord server to meet the community
						<h5>- <font color="46305e">Contact Us</font> : Reach out to our leadership team for questions
						</h5>
                            
                    </div>	               

                </div> <!-- /bgrid -->

            </div> <!-- end features-list -->

        </div> <!-- end about-features -->
        
    </section> <!-- end about -->  
   

    <!-- pricing
    ================================================== -->
    <section id="pricing">
        <div class="row pricing-content">

            <div class="col-four pricing-intro">
                <h1 class="intro-header" data-aos="fade-up">SUPPORT THE GUILD :</h1>

                <h5 data-aos="fade-up">NightLight is a community-driven guild. While we don't require any payments, voluntary contributions help us maintain our Discord server, host events, and provide better resources for our members. Your support is greatly appreciated!
                </h5>
            </div>

            <div class="col-eight pricing-table">
                <div class="row">

                    <div class="col-six plan-wrap">
                        <div class="plan-block" data-aos="fade-up"> 

                            <div class="plan-top-part">
                                <h3 class="plan-block-title">Bank Transfer</h3>
								<p class="plan-block-per">Minimum Amount:</p>
                                <p class="plan-block-price"><sup>R$</sup>10</p>
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li><span>Bank</span> Your Bank Name</li>
                                    <li><span>Account Name</span> Account Holder Name</li>	
								    <li><span>Account Number</span> Account Number</li>
                                    <li><span>Bank Code</span> Bank Code</li>	
                                </ul>

                                <a class="button button-primary large" href="">Send Receipt</a>
                            </div>  
                     
                        </div>
                    </div> <!-- end plan-wrap -->

                    <div class="col-six plan-wrap">
                        <div class="plan-block primary" data-aos="fade-up">

                            <div class="plan-top-part">
                                <h3 class="plan-block-title">Digital Payment</h3>
                                <img src="{{ asset('images/qr-code.jpeg') }}">
                            </div>

                            <div class="plan-bottom-part">
                                <ul class="plan-block-features">
                                    <li><span>Convenience</span> Quick and easy payment</li>
                                    <li><span>Secure</span> Safe transaction process</li>
                                    <li><span>Flexible</span> Multiple payment options</li>										
                                </ul>

                                <a class="button button-primary large" href="">Send Receipt</a>
                            </div>

                        </div>
                    </div> <!-- end plan-wrap -->

                </div>               
            </div> <!-- end pricing-table -->

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

                    <div>
                        <p>
                        Life is a play that does not allow rehearsals.
                        </p> 

                        <div class="testimonial-author">
                                <img src="{{ asset('images/avatars/user-01.jpg') }}" alt="Author image">
                                <div class="author-info">
                                    [Admin] NightLight
                                    <span class="position">General Administrator.</span>
                                </div>
                        </div>                 
                    </div> 

                    <div>
                        <p>
                        If you get irritated by critics, you can be sure that almost always they are right.
                        </p>

                        <div class="testimonial-author">
                                <img src="{{ asset('images/avatars/user-02.jpg') }}" alt="Author image">
                                <div class="author-info">
                                    [GM] NightLight
                                    <span>Game Master, Event Maker, Support</span>
                                </div>
                        </div>                                         
                    </div> 

                </div> <!-- end slides -->

            </div> <!-- end testimonial-slider -->         
            
        </div> <!-- end flex-container -->

    </section></center> <!-- end testimonials -->

    <!-- download
    ================================================== -->
    <section id="download">

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

    </section> <!-- end download -->    

    <!-- footer
    ================================================== -->
    <footer>

        <div class="footer-main">
            <div class="row">  

                <div class="col-three md-1-3 tab-full footer-info">            

                    <div class="footer-logo"></div>

                    <p>
                    NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.
                    </p>

                    <ul class="footer-social-list">
                        <li>
                            <a href="#"><i class="fa fa-facebook-square"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dribbble"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                    
                    
                </div> <!-- end footer-info -->

                <div class="col-three md-1-3 tab-1-2 mob-full footer-contact">

                  <img src="{{ asset('images/sedora.png') }}" />                  

                </div> <!-- end footer-contact -->  

                <div class="col-two md-1-3 tab-1-2 mob-full footer-site-links">

                    <h4>Quick Links</h4>

                    <ul class="list-links">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#about">Information</a></li>
                        <li><a href="#pricing">Support</a></li>
                        <li><a href="#testimonials">Team</a></li>
                        <li><a href="#download">Resources</a></li>
                        <li><a href="#">Join Guild</a></li>
                    </ul>	      		
                            
                </div> <!-- end footer-site-links --> 

                <div class="col-four md-1-2 tab-full footer-subscribe">

                    <div class="fb-page" data-href="https://www.facebook.com/CronusEmulator/" data-tabs="timeline" data-width="400" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CronusEmulator/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CronusEmulator/">Cronus-Emulator</a></blockquote></div>	      		
                            
                </div> <!-- end footer-subscribe -->         

            </div> <!-- /row -->
        </div> <!-- end footer-main -->


      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span> All Rights Reserved NightLight Guild.</span> 
		         	<span>Designed by <a href="https://forum.cronus-emulator.com/profile/78797-mihael/">Mihael</a></span>		         	
		         </div>

		         <div id="go-top">
		            <a class="smoothscroll" title="Back to Top" href="#top"><i class="icon-arrow-up"></i></a>
		         </div>         
	      	</div>

      	</div> <!-- end footer-bottom -->     	

      </div>

    </footer>

    <div id="preloader"> 
    	<div id="loader"></div>
    </div>  

    <!-- Java Script
    ================================================== -->
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
