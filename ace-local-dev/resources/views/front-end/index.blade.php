@extends('front-end.layouts.master')
@section('content')
    <!--banner-->
			<section class="page_slider">
				<div class="flexslider">
					<ul class="slides">
						<li class="ds cover-image flex-slide">
                        <img src="{{asset('/')}}images/slider/banner.jpg" alt="">
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<div class="intro_layers_wrapper">
											<div class="intro_layers">
												<div class="intro_layer" data-animation="fadeInRight">
													<h6 class="special-heading">
														<span class="above">ACE IT Networks Limited</span>
													</h6>
												</div>
												<div class="intro_layer" data-animation="fadeInRight">
													<h4 class="special-heading">
														<span>Fast. Unlimited. Simplified </span>
													</h4>
												</div>
												<div class="intro_layer" data-animation="fadeInRight">
													<p>High speed broadband internet to surf, stream, chat and game</p>
												</div>
												<!--<div class="intro_layer" data-animation="fadeInRight">-->
												<!--	<div class="price-wrap ">-->
												<!--		<span class="plan-sign">Starting from BDT 1600</span>-->
												<!--		<span class="plan-price">39</span>-->
												<!--		<span class="plan-decimals">.99/mo</span>-->
												<!--	</div>-->
												<!--</div>-->
												<div class="intro_layer" data-animation="fadeInRight">
                                                <a class="btn btn-maincolor" href="{{ route('contacts')}}">Contact Us</a><span>or Call Now 09666716716</span>
												</div>
											</div> <!-- eof .intro_layers -->
										</div> <!-- eof .intro_layers_wrapper -->
									</div> <!-- eof .col-* -->
								</div><!-- eof .row -->
							</div><!-- eof .container-fluid -->
						</li>



					</ul>
				</div> <!-- eof flexslider -->
			</section>
			<a id="service"></a>
<!--banner-->

			<section class="s-pt-50 s-pt-md-50 s-pt-xl-50 s-pb-50 s-pb-md-50 s-pb-xl-50 ls">
				<div class="container">
					<div class="row justify-content-center c-gutter-30 vertical-center">
						<div class="col-md-12 text-center">
							<h6 class="special-heading" >
								<span class="above">ACE IT Networks Limited</span>
							</h6>
							<h4 class="special-heading">
								<span>Solutions from ACE Net</span>
							</h4>
							<div class="divider-30 divider-sm-50"></div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/BroadbandInternet.png" alt=""></i>
								</div>
								<h5>Broadband Internet</h5>
							</div>
						</div>
						<div class="divider-40 d-md-none"></div>
						<div class="col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/DomainRegistration.png" alt=""></i>
								</div>
								<h5>Domain Registration</h5>
							</div>
						</div>
						<div class="divider-40 d-lg-none"></div>
						<div class="col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/P2PConnectivity.png" alt=""></i>
								</div>
								<h5>P2P Connectivity</h5>
							</div>
						</div>
						<div class="divider-40 d-md-none"></div>
						<div class="col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/EmailHosting.png" alt=""></i>
								</div>
								<h5>Email Hosting</h5>
							</div>
						</div>

						<div class="divider-40 d-lg-none"></div>
						<div class="col-lg-offset-2  col-md-offset-2 col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/NetworkServerMaintenance.png" alt=""></i>
								</div>
								<h5>Network & Server Maintenance</h5>
							</div>
						</div>
						<div class="divider-40 d-md-none"></div>
						<div class="col-lg-3 col-md-6 col-sm-12 text-center">
							<div class="icon-box text-center home-style">
								<div class="icon-styled color-main">
									<i class="ico"><img src="images/WebHosting.png" alt=""></i>
								</div>
								<h5>Web Hosting</h5>
							</div>
						</div>





					</div>
				</div>
			</section>


			<section id="internet-service" class="s-pt-50 s-pt-md-50 s-pt-xl-50 s-pb-50 s-pb-md-50 s-pb-xl-50 ls">
				<div class="container">
					<div class="row c-gutter-30 vertical-center">
						<div class="divider-70 divider-sm-50 "></div>
						<div class="col-xl-12 text-center">
							<h6 class="special-heading">
								<span class="above color-white">ACE IT Networks Limited</span>
							</h6>
							<h4 class="special-heading">
								<span class="color-red">Why ACE Net is Right for You?</span>
							</h4>
							<div class="divider-30"></div>
							<!--<p style="color:#fff;">The speed of data, as it travels from the Internet to your computer, is measured in megabits per second (Mbps). Different activities require different speeds.</p>-->
							<!--<div class="divider-40"></div>-->
							<!--<a class="btn btn-maincolor" href="#">Contact Us</a>-->

							<div class="rightFor row justify-content-center">
							    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
							        <div class="icon-styled color-main">
    									<i class="ico"><img src="images/w1.png" alt=""></i>
    								</div>
    								<h5>Scalable Broadband Solutions</h5>
							    </div>
							    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
							        <div class="icon-styled color-main">
    									<i class="ico"><img src="images/w2.png" alt=""></i>
    								</div>
    								<h5>Enterprise-grade Fault Tolerance</h5>
							    </div>
							    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
							        <div class="icon-styled color-main">
    									<i class="ico"><img src="images/w3.png" alt=""></i>
    								</div>
    								<h5>Easier Hosting & Convenient Access</h5>
							    </div>
							    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
							        <div class="icon-styled color-main">
    									<i class="ico"><img src="images/w4.png" alt=""></i>
    								</div>
    								<h5>Reliable Speed for Voice and Video Communications </h5>
							    </div>
							    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
							        <div class="icon-styled color-main">
    									<i class="ico"><img src="images/w5.png" alt=""></i>
    								</div>
    								<h5>Multiple Upstream Connectivity (submarine cabling, ITC, etc.) with Failover Support </h5>
							    </div>
							</div>


						</div>
					</div>
				</div>
			</section>


			<section class="home-gallery ls">
				<div class="">
					<div class="row">
						<div class="col-lg-12">
							<div class="row isotope-wrapper masonry-layout c-gutter-0">
								<div class="col-md-4 col-sm-12">
									<div class="vertical-item item-gallery content-absolute text-center ds">
										<div class="item-media">
											<img src="images/FastInternet.png" alt="">
										</div>
										<div class="item-content">
											<h4>
												<a href="#">Fast Internet Speed</a>
											</h4>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-sm-12">
									<div class="vertical-item item-gallery content-absolute text-center ds">
										<div class="item-media">
											<img src="images/UploadDownload.png" alt="">
										</div>
										<div class="item-content">
											<h4>
											    <!--<a href="#">Equal Upload Download Speed</a>-->
												<a href="#">symmetrical download & upload ratio</a>
											</h4>
										</div>
									</div>
								</div>

								<div class="col-md-4 col-sm-12">
									<div class="vertical-item item-gallery content-absolute text-center ds">
										<div class="item-media">
											<img src="images/FiberOptic.png" alt="">
										</div>
										<div class="item-content">
											<h4>
												<a href="#">Fiber Optic Technology</a>
											</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section><a id="Package"></a>



			<section class="s-pt-50 s-pt-md-50 s-pt-xl-50 s-pb-50 s-pb-md-50 s-pb-xl-50 ls">
				<div class="container">
					<div class="row c-gutter-30">
						<div class="col-md-12 text-center">
							<h6 class="special-heading">
								<span class="above">Better-Than-Ever Offers</span>
							</h6>
							<h4 class="special-heading">
								<span>Individual Package</span>
							</h4>
							<div class="divider-30 divider-sm-50"></div>
						</div>


						<div class="col-lg-12 col-md-12 up-sells upsells products">
						    <ul class="products">
								<li class="product">
									<div class="pricing-plan box-shadow color_style1">
        								<div class="plan-name">
        									<h3>
        										Pico
        									</h3>
        								</div>
        								<div class="plan-header">
        									<ul>
        										<li>
        											<p class="plan-header-title">internet</p>
        											<p class="plan-header-aftertitle">25 Mbps</p>
        											<p class="plan-header-text">Download Speeds</p>
        										</li>
        										<li>
        											<p class="plan-header-title">YouTube</p>
        											<p class="plan-header-aftertitle">100</p>
        											<p class="plan-header-text">Mbps</p>
        										</li>
        											<li>
        											 <p class="plan-header-text"> </p>
        											<p class="plan-header-title">Router <br>BDT 2500</p>
        											<p class="plan-header-aftertitle"> </p>
        										   </li>
        										   	<li>
        											<p class="plan-header-title">Surveillance <br>BDT 2500</p>

        										   </li>
        									</ul>
        									<img alt="" src="images/25mbps.png">
        								</div>

        								<div class="plan-features">
        									<ul class="list-styled-circle">
        										<li>BDIX 100Mbps</li>
        										<!--<li>Lobby Wifi Camera</li>-->
        									</ul>
        								</div>
        								<div class="price-wrap ">
        									<span class="plan-sign">tk</span>
        									<span class="plan-price">1600</span>
        									<span class="plan-decimals">/month</span>
        								</div>

        								<form method="POST" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="plan-button">
                                                <input type="hidden" name="id" value="3">
                                                <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                                <a href="{{ route('contact', ['slug'=>'Pico']) }}" class="btn btn-maincolor">Contact Us</a>
                                            </div>
                                        </form>
        							</div>
								</li>
								<li class="product">
									<div class="pricing-plan box-shadow color_style1">
        								<div class="plan-name">
        									<h3>
        										Nano
        									</h3>
        								</div>
        								<div class="plan-header">
        									<ul>
        										<li>
        											<p class="plan-header-title">internet</p>
        											<p class="plan-header-aftertitle">35 Mbps</p>
        											<p class="plan-header-text">Download Speeds</p>
        										</li>
        										<li>
        											<p class="plan-header-title">YouTube</p>
        											<p class="plan-header-aftertitle">100</p>
        											<p class="plan-header-text">Mbps</p>
        										</li>
        											<li>
        											<p class="plan-header-text"></p>
        											<p class="plan-header-title">Router <br>BDT 2500</p>
        											<p class="plan-header-aftertitle"> </p>
        										   </li>
        										   	<li>
        											<p class="plan-header-title">Surveillance<br> BDT 2500</p>
        											<p class="plan-header-aftertitle"> </p>
        										   </li>
        									</ul>
        									<img alt="" src="images/35mbps.png">
        								</div>

        								<div class="plan-features">
        									<ul class="list-styled-circle">
        										<li>BDIX 100Mbps</li>
        										<!--<li>Lobby Wifi Camera</li>-->
        									</ul>
        								</div>
        								<div class="price-wrap ">
        									<span class="plan-sign">tk</span>
        									<span class="plan-price">2500</span>
        									<span class="plan-decimals">/month</span>
        								</div>

        								<form method="POST" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="plan-button">
                                                <input type="hidden" name="id" value="4">
                                                <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                                <a href="{{ route('contact', ['slug'=>'Nano']) }}" class="btn btn-maincolor">Contact Us</a>
                                            </div>
                                        </form>
        							</div>
								</li>

								<li class="product">
									<div class="pricing-plan box-shadow color_style1">
        								<div class="plan-name">
        									<h3>
        										Mega
        									</h3>
        								</div>
        								<div class="plan-header">
        									<ul>
        										<li>
        											<p class="plan-header-title">Internet</p>
        											<p class="plan-header-aftertitle">50 Mbps</p>
        											<p class="plan-header-text">Download Speeds</p>
        										</li>
        										<li>
        											<p class="plan-header-title">YouTube</p>
        											<p class="plan-header-aftertitle">100</p>
        											<p class="plan-header-text">Mbps</p>
        										</li>
        											<li>
        											<p class="plan-header-title">IPTV</p>
        											<p class="plan-header-title">Router <br>BDT 2500</p>

        										   </li>
        										   	<li>
        											<p class="plan-header-title">Surveillance <br>BDT 2500</p>

        										   </li>
        									</ul>
        									<img alt="" src="images/50mbps.png">
        								</div>

        								<div class="plan-features">
        									<ul class="list-styled-circle">
        										<li>BDIX 100Mbps</li>
        										<!--<li>Lobby Wifi Camera</li>-->
        									</ul>
        								</div>
        								<div class="price-wrap ">
        									<span class="plan-sign">tk</span>
        									<span class="plan-price">4000</span>
        									<span class="plan-decimals">/month</span>
        								</div>

        								<form method="POST" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="plan-button">
                                                <input type="hidden" name="id" value="1">
                                                <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                                <a href="{{ route('contact', ['slug'=>'Mega']) }}" class="btn btn-maincolor">Contact Us</a>
                                            </div>
                                        </form>
        							</div>
								</li>

								<li class="product">
									<div class="pricing-plan box-shadow color_style1">
        								<div class="plan-name">
        									<h3>
        										Giga
        									</h3>
        								</div>
        								<div class="plan-header">
        									<ul>
        										<li>
        											<p class="plan-header-title">internet</p>
        											<p class="plan-header-aftertitle">100 Mbps</p>
        											<p class="plan-header-text">Download Speeds</p>
        										</li>
        										<li>
        											<p class="plan-header-title">YouTube</p>
        											<p class="plan-header-aftertitle">100</p>
        											<p class="plan-header-text">Mbps</p>
        										</li>
        											<li>
        											 <p class="plan-header-title">IPTV</p>
        											<p class="plan-header-title">End-point <br>security(1 device) </p>

        											<!--<p class="plan-header-aftertitle">  </p>-->
        										   </li>
        										   	<li>
        										   	 <p class="plan-header-title">Router </p>
        										   	 <p class="plan-header-title">Surveillance<br> (complimentary)</p>

        											<!--<p class="plan-header-aftertitle"> </p>-->
        										   </li>
        									</ul>
        									<img alt="" src="images/100mbps.png">
        								</div>

        								<div class="plan-features">
        									<ul class="list-styled-circle">
        										<li>BDIX 100Mbps</li>
        										<!--<li>Lobby Wifi Camera</li>-->
        									</ul>
        								</div>
        								<div class="price-wrap ">
        									<span class="plan-sign">tk</span>
        									<span class="plan-price">7000</span>
        									<span class="plan-decimals">/month</span>
        								</div>
                                    <form method="POST" action="{{ route('cart.store') }}">
                                            @csrf
                                            <div class="plan-button">
                                                <input type="hidden" name="id" value="2">
                                                {{-- <input type="hidden" name="name" value="Giga">
                                                <input type="hidden" name="price" value="7000">
                                                <input type="hidden" name="qty" value="1"> --}}
                                                <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                                <a href="{{ route('contact', ['slug'=>'Giga']) }}" class="btn btn-maincolor">Contact Us</a>
                                                {{-- <a href="{{ route('contact', ['slug'=>'Giga']) }}" class="btn btn-maincolor">Buy Now</a> --}}

                                            </div>
                                        </form>

        							</div>
								</li>


							</ul>
						</div>

						<!--pac-->



						<div class="col-md-12 text-center" style="padding-top:50px;">
							<h4 class="special-heading">
								<span>Community Package</span>
							</h4>
							<div class="divider-30 divider-sm-50"></div>
						</div>

						<!--pac-->
						<div class="col-lg-4 col-md-4">
							<div class="pricing-plan box-shadow color_style1">
								<div class="plan-name">
									<h3>
										Diamond
									</h3>
								</div>
								<div class="plan-header">
									<ul>
										<li>
											<p class="plan-header-title">internet</p>
											<p class="plan-header-aftertitle">50 Mbps</p>
											<p class="plan-header-text">Download Speeds</p>
										</li>
										<li>
											<p class="plan-header-title">YouTube</p>
											<p class="plan-header-aftertitle">100</p>
											<p class="plan-header-text">Mbps</p>
										</li>
									</ul>
									<img alt="" src="images/50mbps.png">
								</div>

								<div class="plan-features">
									<ul class="list-styled-circle">
										<li>BDIX 100Mbps</li>
										<li>Lobby Wifi</li>
									</ul>
								</div>
								<div class="price-wrap ">
									<span class="plan-sign">tk</span>
									<span class="plan-price">5000</span>
									<span class="plan-decimals">/month</span>
								</div>

								<form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="plan-button">
                                        <input type="hidden" name="id" value="5">
                                        <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                        <a href="{{ route('contact', ['slug'=>'Diamond']) }}" class="btn btn-maincolor">Contact Us</a>
                                    </div>
                                </form>
							</div>
						</div>
						<div class="divider-30 d-md-none"></div>


						<!--pac-->
						<div class="col-lg-4 col-md-4">
							<div class="pricing-plan box-shadow color_style2">
								<div class="plan-name">
									<h3>
										Ruby
									</h3>
								</div>
								<div class="plan-header">
									<ul>
										<li>
											<p class="plan-header-title">internet</p>
											<p class="plan-header-aftertitle">100 Mbps</p>
											<p class="plan-header-text">Download Speeds</p>
										</li>
										<li>
											<p class="plan-header-title">YouTube</p>
											<p class="plan-header-aftertitle">100</p>
											<p class="plan-header-text">Mbps</p>
										</li>
									</ul>
									<img alt="" src="images/100mbps.png">
								</div>

								<div class="plan-features">
									<ul class="list-styled-circle">
										<li>BDIX 100Mbps</li>
										<li>Lobby Wifi</li>
									</ul>
								</div>
								<div class="price-wrap ">
									<span class="plan-sign">tk</span>
									<span class="plan-price">9000</span>
									<span class="plan-decimals">/month</span>
								</div>

								<form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="plan-button">
                                        <input type="hidden" name="id" value="6">
                                        <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                        <a href="{{ route('contact', ['slug'=>'Ruby']) }}" class="btn btn-maincolor">Contact Us</a>
                                    </div>
                                </form>
							</div>
						</div>
						<div class="divider-30 d-md-none"></div>


						<!--pac-->
						<div class="col-lg-4 col-md-4">
							<div class="pricing-plan box-shadow color_style1">
								<div class="plan-name">
									<h3>
										Sapphire
									</h3>
								</div>
								<div class="plan-header">
									<ul>
										<li>
											<p class="plan-header-title">internet</p>
											<p class="plan-header-aftertitle">200 Mbps</p>
											<p class="plan-header-text">Download Speeds</p>
										</li>
										<li>
											<p class="plan-header-title">YouTube</p>
											<p class="plan-header-aftertitle">100</p>
											<p class="plan-header-text">Mbps</p>
										</li>
									</ul>
									<img alt="" src="images/200mbps.png">
								</div>

								<div class="plan-features">
									<ul class="list-styled-circle">
										<li>BDIX 100Mbps</li>
										<li>Lobby Wifi</li>
									</ul>
								</div>
								<div class="price-wrap ">
									<span class="plan-sign">tk</span>
									<span class="plan-price">16000</span>
									<span class="plan-decimals">/month</span>
								</div>

								<form method="POST" action="{{ route('cart.store') }}">
                                    @csrf
                                    <div class="plan-button">
                                        <input type="hidden" name="id" value="7">
                                        <button type="submit" class="btn btn-maincolor">Buy Now</button>
                                        <a href="{{ route('contact', ['slug'=>'Sapphire']) }}" class="btn btn-maincolor">Contact Us</a>
                                    </div>
                                </form>
							</div>
						</div>
						<div class="divider-30 d-md-none"></div>


						<div class="col-md-12">
							<!--<div class="divider-30 divider-sm-50"></div>-->
							<!--<a class="btn btn-outline-secondary" href="#">View All Offers</a>-->
							<p class="marB0"><small>*Prices excluding One Time Installation charge </small></p>
							<p class="marB0"><small>**Separate charges applicable for back-up link </small></p>
						</div>


					</div>
				</div>
			</section>




			<section id="coverage-map" class="s-pt-50 s-pt-md-50 s-pt-xl-50 s-pb-50 s-pb-md-50 s-pb-xl-50 ls">
				<div class="container">
					<div class="row c-gutter-30 vertical-center">
						<div class="col-xl-8 offset-xl-2 text-center">
							<div class="icon-box text-center">
								<div class="icon-styled color-light fs-60">
									<i class="ico icon-wifi1"></i>
								</div>
							</div>
							<h6 class="special-heading">
								<span class="above colorWhite">ACE net network coverage</span>
							</h6>
							<h4 class="special-heading">
								<span class="colorWhite">Coverage Map & Locations</span>
							</h4>
							<div class="divider-30"></div>
							<p class="colorWhite">To check coverage in your location, click to find out! </p>
							<div class="divider-40"></div>
							<a class="btn btn-maincolor" href="{{route('coverage')}}">Check Coverage</a>
						</div>
					</div>
				</div>
			</section>

			<section id="icon-bg-gradient" class="ds">
				<div class="container">
					<div class="row">
						<div class="divider-50 divider-md-70 divider-xl-140"></div>
						<div class="col-sm-12">
							<!--<h6 class="special-heading text-center">-->
							<!--	<span class="above">have you any questions</span>-->
							<!--</h6>-->
							<h4 class="special-heading text-center">
								<span>To Know More </span>
							</h4>
						</div>
						<div class="divider-40"></div>
						<div class="col-md-4">
							<div class="icon-box text-center bordered p-30">
								<div class="icon-styled color-darkgrey icon-bordered">
									<i class="ico icon-headphones fs-36"></i>
								</div>
								<h5><a href="#">Talk to an Agent</a></h5>
								<p>
									Get a Call
								</p>
							</div>
						</div>
						<div class="divider-40 d-md-none"></div>
						<div class="col-md-4">
							<div class="icon-box text-center bordered p-30">
								<div class="icon-styled color-darkgrey icon-bordered">
									<i class="ico icon-chat fs-36"></i>
								</div>
								<h5><a href="#">Chat with an Agent</a></h5>
								<p>
									Chat Now
								</p>
							</div>
						</div>
						<div class="divider-40 d-md-none"></div>
						<div class="col-md-4">
							<div class="icon-box text-center bordered p-30">
								<div class="icon-styled color-main3 icon-bordered">
									<i class="ico icon-envelope fs-36" aria-hidden="true"></i>
								</div>
								<h5><a href="#">Email Us</a></h5>
								<p>
									 salesinfo@ace.net.bd
								</p>
							</div>
						</div>
						<div class="divider-60 divider-md-80 divider-xl-150"></div>
					</div>
				</div>
			</section>
@endsection
