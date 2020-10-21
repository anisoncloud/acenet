@extends('front-end.layouts.master')
@section('content')
<section class="page_title cover-background padding-mobile cs s-py-60 s-py-md-80 s-pt-xl-100 s-pb-xl-115" style="background-image: url('images/inner-banner-about.jpg');">
    <div class="container">
        <div class="row">


            <div class="col-md-4">
                <h5 class="bold">New or Existing Customer</h5>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="index.php">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        New or Existing Customer
                    </li>
                </ul>
            </div>


        </div>
    </div>
</section>


<!--eof topline-->
<section class="s-pt-30 s-pt-md-30 s-pt-xl-30 s-pb-30 s-pb-md-30 s-pb-xl-90">
    <div class="container">
        <div class="row  vertical-center">
            {{-- <div class="col-12 col-md-6">
                <img src="images/about-img.png" alt="">
            </div> --}}
            <div class="divider-30 d-md-none"></div>
            <div class="col-12 col-md-6">

                <div class="divider-30"></div>
                <a class="btn btn-primary" href="http://cportal.ace.net.bd/login" role="button">Existing Customer</a>
            <form class="cutcategory" action="{{ url('/cart')}}" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="productName" value="{{ $productName}}">
                    <input type="hidden" name="productPrice" value="{{ $productPrice}}">
                    <input type="hidden" name="productOtc" value="{{ $delivery}}">
                    <button type="submit" class="btn btn-primary">New Customer</button>
                    {{-- <a class="btn btn-primary" href="{{ route('cart.index')}}" role="button">New Customer</a> --}}
                </form>

                {{-- <a class="btn btn-primary" href="{{ route('cart.index')}}" role="button">New Customer</a> --}}

                <div class="divider-25"></div>

                <div class="divider-40"></div>
                <!-- <a class="btn btn-maincolor" href="/contact">Request A Quote</a> -->
            </div>

        </div>

    </div>
</section>
@endsection
