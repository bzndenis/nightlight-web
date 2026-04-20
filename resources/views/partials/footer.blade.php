    <!-- footer
    ================================================== -->
    <footer>

        <div class="footer-main">
            <div class="row" style="display: flex; justify-content: center; flex-wrap: wrap;">  

                <div class="col-three md-1-3 tab-full footer-info">

                    <div class="footer-logo">NightLight</div>

                    <p>
                    {{ $footerSettings->description ?? 'NightLight is a gaming guild community dedicated to bringing players together through friendship, teamwork, and shared adventures. We believe in creating a welcoming environment for all gamers.' }}
                    </p>

                    <!-- <ul class="footer-social-list">
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
                    </ul> -->


                </div> <!-- end footer-info -->

                <div class="col-three md-1-3 tab-1-2 mob-full footer-contact" style="text-align: center;">

                  <img src="{{ asset('images/sedora.png') }}" style="max-width: 100%; display: inline-block;" />

                </div> <!-- end footer-contact -->

                <div class="col-two md-1-3 tab-1-2 mob-full footer-site-links">

                    <h4>Quick Links</h4>

                    <ul class="list-links">
                        @if(isset($footerLinks) && count($footerLinks) > 0)
                            @foreach($footerLinks as $link)
                                <li><a href="{{ $link->url }}">{{ $link->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="#about">Information</a></li>
                            <li><a href="#pricing">Gallery</a></li>
                            <li><a href="#testimonials">Team</a></li>
                            <li><a href="#">Join Guild</a></li>
                        @endif
                    </ul>

                </div> <!-- end footer-site-links --> 

                <!-- <div class="col-four md-1-2 tab-full footer-subscribe">

                    <div class="fb-page" data-href="https://www.facebook.com/CronusEmulator/" data-tabs="timeline" data-width="400" data-height="250" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/CronusEmulator/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/CronusEmulator/">Cronus-Emulator</a></blockquote></div>	      		
                            
                </div>  -->
                
                <!-- end footer-subscribe -->         

            </div> <!-- /row -->
        </div> <!-- end footer-main -->


      <div class="footer-bottom">

      	<div class="row">

      		<div class="col-twelve">
	      		<div class="copyright">
		         	<span>{{ $footerSettings->copyright_text ?? 'All Rights Reserved NightLight Guild.' }}</span>
		         	<span>Designed by ❤︎</span>

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
