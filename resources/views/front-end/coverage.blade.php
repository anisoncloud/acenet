@extends('front-end.layouts.master')
@section('content')
<section class="page_title cover-background padding-mobile cs s-py-60 s-py-md-80 s-pt-xl-100 s-pb-xl-115" style="background-image: url('images/inner-banner-about.jpg');">
    <div class="container">
        <div class="row">


            <div class="col-md-4">
                <h5 class="bold">Coverage Map & Locations</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Coverage Map & Locations
                    </li>
                </ul>
            </div>


        </div>
    </div>
</section>


<!--eof topline-->





<section class="s-pt-50 s-pt-md-70 s-pt-xl-80 s-pb-60 s-pb-md-80 s-pb-xl-90">
    <div class="container-fluid" style="padding:0;">
        <div class="row c-gutter-30 vertical-center">

            <!--<div class="col-12 col-md-6">-->
            <!--	<img src="images/about-img.png" alt="">-->
            <!--</div>-->
            <!--<div class="divider-30 d-md-none"></div>-->
            <div class="col-12 col-md-12">
                <!--<div id="map" style="width: 100%; height: 400px;"></div>-->
                <div style=" width:100%; display:inline-block; overflow:hidden;">
                  <iframe class="custom-google-map" style="position:relative; top:-55px; border:none;" src="https://www.google.com/maps/d/u/0/embed?mid=1VoxHY41f9K_SJDmt1doz30LP47sfR4zi" width="100%" height="700"></iframe>
                <!---iframe class="custom-google-map" style="position:relative; top:-55px; border:none;" src="https://www.google.com/maps/d/u/0/embed?mid=1CxsTrOZgRVSx_7Zi6tXUMgHSum0moz-K" width="100%" height="700"></iframe --->
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
