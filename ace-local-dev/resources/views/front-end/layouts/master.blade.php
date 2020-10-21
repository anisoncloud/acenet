<head>
	<title>ACE IT Networks Limited</title>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<![endif]-->
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="{{ asset('/') }}css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/animations.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/regular.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/brands.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/solid.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/fontawesome.min.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/font-awesome.css">
	<link rel="stylesheet" href="{{ asset('/') }}css/main.css" class="color-switcher-link">
    <link rel="stylesheet" href="{{ asset('/') }}css/shop.css" class="color-switcher-link">
    <link rel="stylesheet" href="{{ asset('/') }}css/custom.css">
	<script src="{{ asset('/') }}js/vendor/modernizr-custom.js"></script>

	<!--[if lt IE 9]>
		<script src="{{ asset('/') }}js/vendor/html5shiv.min.js"></script>
		<script src="{{ asset('/') }}js/vendor/respond.min.js"></script>
		<script src="{{ asset('/') }}js/vendor/jquery-1.12.4.min.js"></script>
	<![endif]-->

</head>

<body>
	<!--[if lt IE 9]>
		<div class="bg-danger text-center">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/" class="color-main">upgrade your browser</a> to improve your experience.</div>
	<![endif]-->

	<div class="preloader">
		<div class="preloader_image"></div>
	</div>

	<!-- wrappers for visual page editor and boxed version of template -->
	<div id="canvas">
		<div id="box_wrapper">

			<!-- template sections -->

			<!--topline section visible only on small screens|-->

			<!--eof topline-->

			<section class="page_topline s-border ls s-borderbottom s-overlay">
				<div class="container-fluid">
					<div class="row justify-content-end txt-right">

						<!--<div class="col-lg-12 col-xl-3 text-center text-xl-left">-->
						<!--	<ul>-->
						<!--		<li>-->
						<!--			<p>Internet. Simplified.</p>-->
						<!--		</li>-->

						<!--	</ul>-->
						<!--</div>-->

						<div class="col-lg-12 col-xl-6">
							<ul class="top-line-includes-first top-includes">
								<!--<li>-->
								<!--	<p class="address_top"> <i class="ico icon-placeholder"></i>Safura Tower (12th Floor), 20 Kemal Ataturk Avenue, Banani C/A</p>-->
								<!--</li>-->
								<li>
								    <p class="phone_number"> <i class="ico icon-icon"></i><a href="tel:09666716716">09666716716</a></p>

								</li>
								<li>

								      <p class="phone_number"> <i class="fa fa-globe"></i><a href="http://cportal.ace.net.bd/login">Customer Portal</a></p>




								</li>
							</ul>
						</div>
					</div>
				</div>
			</section>

			<!-- header with two Bootstrap columns - left for logo and right for navigation and includes (search, social icons, additional links and buttons etc -->
			<header class="page_header ls justify-nav-end">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-xl-2 col-lg-3 col-md-4 col-11">
							<a href="{{route('index')}}" class="logo">
								<img src="{{ asset('/') }}images/logo_light.png" alt="">
							</a>
						</div>
						<div class="col-xl-10 col-lg-9 col-md-8 col-1">
							<div class="nav-wrap">

								<!-- main nav start -->
								<nav class="top-nav">
									<ul class="nav sf-menu">


										<li class="active">
                                        <a href="{{route('index')}}">Home</a></li>

										<li>
											<a href="{{ route('about')}}">About us</a>
										</li>
										<!-- eof pages -->



										<!-- blog -->
										<li>
											<a href="{{route('index')}}#service">Services</a>

										</li>
										<!-- eof blog -->

										<!-- shop -->
										<li>
											<a href="{{route('index')}}#Package">Offer</a>
										</li>
										<!-- eof shop -->


										<!-- blog -->
										<!--<li>-->
										<!--	<a href="#">Payment</a>-->

										<!--</li>-->
										<!-- eof blog -->


										<!-- contacts -->
										<li>
                                        <a href="{{ route('contacts')}}">Contact</a>
										</li>


										<!-- eof contacts -->
									</ul>


								</nav>
								<!-- eof main nav -->

								<!--hidding includes on small devices. They are duplicated in topline-->


							</div>
						</div>
					</div>
				</div>
				<!-- header toggler -->
				<span class="toggle_menu"><span></span></span>
			</header>
@yield('content')

<div class="footer_before">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 animate" data-animation="fadeInUp">
                <ul class="bottom-includes">
                    <li>
                        <img src="{{ asset('/') }}images/logo_footer.png" alt="">
                    </li>
                    <!--<li>-->
                    <!--	<a href="#" class="fa fa-twitter" title="facebook">Find us on Twitter</a>-->
                    <!--</li>-->
                    <!--<li>-->
                    <!--	<a href="#" class="fa fa-youtube-play" title="youtube-play">Find tutorials and demos</a>-->
                    <!--</li>-->
                    <li>
                        <a href="https://web.facebook.com/ace.business.networks/" class="fa fa-facebook" title="Facebook">Connect on Facebook</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<footer class="page_footer ds s-pt-35 s-pb-45">
    <div class="container">
        <div class="row">
            <div class="divider-20 d-none d-xl-block"></div>

            <div class="col-12 col-sm-6 col-md-3 animate" data-animation="fadeInUp">
                <div class="widget widget_service">
                    <h5 class="widget-title">Contact Us</h5>
                    <p>09666716716 </p>
                </div>
                <div class="divider-30 divider-md-0"></div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 animate" data-animation="fadeInUp">
                <div class="widget widget_archive">
                    <h5 class="widget-title">Address </h5>
                    <p>Safura Tower (12th Floor), 20 Kemal Ataturk Avenue, Banani C/A, Dhaka-1213, Bangladesh</p>
                </div>
                <div class="divider-30 divider-sm-0"></div>
            </div>



            <div class="col-12 col-sm-6 col-md-3 animate" data-animation="fadeInUp">
                <div class="widget widget_mailchimp">

                    <h5 class="widget-title">Subscribe for Newsletter</h5>

                    <form class="signup" action="#">
                        <input id="mailchimp_email" name="email" type="email" class="form-control mailchimp_email" placeholder="Your email">
                        <button type="submit" class="search-submit">
                            <i class="fa fa-envelope"></i>
                        </button>
                        <div class="response"></div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</footer>
<section class="page_copyright ds s-py-35">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12">
                <p><span class="copyright_year">&copy;</span> Copyright 2020 All Rights</p>
            </div>
        </div>
    </div>
</section>


</div><!-- eof #box_wrapper -->
</div><!-- eof #canvas -->


<script src="{{ asset('/') }}js/compressed.js"></script>
<script src="{{ asset('/') }}js/main.js"></script>
<!-- <script src="js/switcher.js"></script> -->
@yield('javascripts')
</body>


</html>
