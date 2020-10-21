@extends('front-end.layouts.master')
@section('content')
<section class="page_title cover-background padding-mobile cs s-py-60 s-py-md-80 s-pt-xl-100 s-pb-xl-115" style="background-image: url('{{ asset('/') }}images/inner-banner-about.jpg');">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <h5 class="bold">Contact Us</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Contact Us
                    </li>
                </ul>
            </div>


        </div>
    </div>
</section>


<!--eof topline-->
<section class="ls ">
    <div class="container">

        <div class="row vertical-center c-gutter-100">


            <div class="col-lg-5 cs p-80 z-index-2 border-radius-5">

                <h4 class="special-heading fw-300">
                    <span>Come By Our<br> Office!</span>
                </h4>

                <div class="divider-35"></div>


                <div class="divider-20 divider-md-30"></div>
                <div class="row c-gutter-15">
                    <div class="col-sm-12">
                        <div class="media">
                            <div class="icon-styled color-main">
                                <i class="fa fa-map" aria-hidden="true"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="">
                                    Address:
                                </h6>
                                <p>
                                    Safura Tower (12th Floor), 20 Kemal Ataturk Avenue, Banani C/A


                                </p>
                            </div>
                        </div>
                        <div class="divider-10"></div>
                        <div class="media">
                            <div class="icon-styled color-main">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="">
                                    E-mail:
                                </h6>
                                <p>
                                    salesinfo@ace.net.bd

                                </p>
                            </div>
                        </div>
                        <div class="divider-10"></div>
                        <div class="media">
                            <div class="icon-styled color-main">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>

                            <div class="media-body">
                                <h6 class="">
                                    Phone:
                                </h6>
                                <p>
                                    09666716716
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="divider-40 d-lg-none d-md-block"></div>
            <div class="col-lg-7 ls ms before-bg z-index-1 border-radius-5">
                <div class="divider-20 divider-lg-80 divider-md-20"></div>
                <h6 class="special-heading">
                    <span class="above">Don't Hesitate Any More </span>
                </h6>
                <h4 class="special-heading fw-300">
                    <span>Get In Touch With Us </span>
                </h4>

                <div class="divider-35"></div>

                <form class="c-mb-20 c-gutter-20" method="POST" action="{{route('contact.store')}}">
                    @csrf

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-placeholder">
                                <label for="subject">Name<span class="required">*</span></label>
                                <input type="text" aria-required="true" size="30" value="{{ old('name')}}" name="name" id="name" class="form-control" placeholder="Name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group has-placeholder">
                                <label for="name">Mobile<span class="required">*</span></label>
                                <input type="text" aria-required="true" size="30" value="{{ old('mobile')}}" name="mobile" id="mobile" class="form-control" placeholder="Mobile" required>
                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group has-placeholder">
                                <label for="email">Email address<span class="required">*</span></label>
                            <input type="email" aria-required="true" size="30" value="{{ old('email')}}" name="email" id="email" class="form-control" placeholder="E-mail" required>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group has-placeholder">
                                <label for="zone">Zone<span class="required">*</span></label>
                                <select class="form-control" placeholder="Zone" id="zone" name="zone" required>

                                    <option value="">Zone</option>
                                    <option value="Banani">Banani</option>
                                    <option value="Gulshan 1">Gulshan 1</option>
                                    <option value="Gulshan 2">Gulshan 2</option>
                                    <option value="Baridhara DOHS">Baridhara DOHS</option>
                                    <option value="Baridhara Society">Baridhara Society</option>
                                    <option value="Bashundhara">Bashundhara</option>
                                    <option value="Mohakhli DOHS">Mohakhli DOHS</option>
                                    <option value="Mirpur DOHS">Mirpur DOHS</option>
                                    <option value="Banani DOHS">Banani DOHS</option>
                                    <option value="Concord City">Concord City</option>
                                    <option value="Uttara">Uttara</option>
                                    <option value="Nikunjo">Nikunjo</option>
                                    <option value="Niketon">Niketon</option>
                                    <option value="Dhanmondi 32">Dhanmondi 32 ( Near PM Residence including Panthopath)</option>
                                    <option value="Dhanmondi R/A">Dhanmondi R/A</option>
                                    <option value="Mohammadpur Housing Society">Mohammadpur Housing Society and Housing Area</option>
                                  </select>
                                @error('zone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group has-placeholder">
                                <label for="package">Package<span class="required">*</span></label>
                                <select class="form-control" placeholder="package" id="package" name="package" required>
                                    <option value="">Package</option>
                                    @if (Request()->slug)
                                    <option value="{{Request()->slug}}" selected>{{Request()->slug}}</option>
                                    @endif
                                    <option value="PICO">PICO</option>
                                    <option value="NANO">NANO</option>
                                    <option value="MEGA">MEGA</option>
                                    <option value="DIAMOND">DIAMOND</option>
                                    <option value="RUBY">RUBY</option>
                                    <option value="SAPPHIRE">SAPPHIRE</option>
                                  </select>
                                @error('package')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-placeholder">
                                <label for="address"> Address<span class="required">*</span></label>
                                <input type="text" aria-required="true" size="30" value="{{ old('address')}}" name="address" id="address" class="form-control" placeholder=" Address" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-placeholder">
                                <label for="message">Message</label>
                            <textarea aria-required="true" rows="6" cols="45" name="message" id="message" class="form-control" placeholder="Your Message">{{old('message')}}</textarea>
                            @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group has-placeholder mt-25">
                                <button type="submit" id="contactSubmit" name="contactSubmit" class="btn btn-outline-maincolor">Submit Now</button>
                            </div>
                        </div>
                    </div>

                </form>
                <div class="divider-40 divider-lg-80 divider-md-20"></div>

            </div>
            <!--.col-* -->


        </div>
    </div>
</section>
@endsection
