@extends('front-end.layouts.master')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-4 order-md-2 mb-4">

        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Your cart</span>

        </h4>


        <ul class="list-group mb-3">

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">{{ Session::get('productName')}}</h6>
            </div>
            <span class="text-muted">{{ Session::get('productPrice')}}</span>
          </li>

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">OTC</h6>
            </div>
            <span class="text-muted">{{ Session::get('productOtc')}}</span>
          </li>

          <li class="list-group-item d-flex justify-content-between">
            <span>Total (BDT)</span>
          <strong>{{ Session::get('totalCost')}}</strong>
          </li>

        </ul>


      </div>
      <div class="col-md-8 order-md-1 ls ms">
        @if (Session::has('message'))
            {{Session::get('message')}}
        @endif
        <!--{{Session::get('otp_pin')}}-->
        <h4 class="mb-3">Billing address</h4>
        <form method="POST" action="https://test.texeltech.com/login.php">
            @csrf
            <div class="mb-3">
              <label for="billing_name">Customer Name</label>
                <input type="text" class="form-control" id="billing_name" name="billing_name"  placeholder="Full Name (as in NID)" value="{{$customer['billing_name']}}" readonly required>
              @error('billing_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                @enderror
            </div>


          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="billing_phone">Mobile Number </label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="validationTooltipUsernamePrepend">+88</span>
                    </div>
                    <input type="number" class="form-control" id="billing_phone" name="billing_phone" placeholder="Mobile Number" value="{{$customer['billing_phone']}}" minlength="11" pattern = "[0-9]{1,11}" readonly required>
                    @error('billing_phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="billing_email">Email</label>
          <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Email" value="{{$customer['billing_email']}}" readonly required>
            @error('billing_email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
          </div>

          <div class="row">
            <div class="col-md-8 mb-3">
                <label for="billing_nid">National ID</label>
                <input type="text" class="form-control" id="billing_nid" name="billing_nid" placeholder="NID" value="{{$customer['billing_nid']}}" readonly required>
                @error('billing_nid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="billing_gender">Gender</label>
                <input type="text" class="form-control" id="billing_gender" name="billing_gender" placeholder="Gener" value="{{$customer['billing_gender']}}" readonly required>

                @error('billing_gender')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="billing_apartment">Apartment</label>
                <input type="text" class="form-control" id="billing_apartment" name="billing_apartment" placeholder="Apartment" value="{{$customer['billing_apartment']}}" readonly required>
                @error('billing_apartment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
			<div class="col-md-6 mb-3">
                <label for="billing_house">House</label>
                <input type="text" class="form-control" id="billing_house" name="billing_house" placeholder="House" value="{{$customer['billing_house']}}" readonly required>
                @error('billing_house')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
		  <div class="row">
            <div class="col-md-6 mb-3">
                <label for="billing_road">Road</label>
                <input type="text" class="form-control" id="billing_road" name="billing_road" placeholder="Road" value="{{$customer['billing_road']}}" readonly required>
                @error('billing_road')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_block">Block</label>
                <input type="text" class="form-control" id="billing_block" name="billing_block" placeholder="Block" value="{{$customer['billing_block']}}" readonly required>
                @error('billing_block')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>

          <div class="row">
		  <div class="col-md-6 mb-3">
              <label for="billing_area">Area</label>
              <input type="text" class="form-control" id="billing_area" name="billing_area" placeholder="Block" value="{{$customer['billing_area']}}" readonly required>
              @error('billing_area')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
			<div class="col-md-6 mb-3">
                <label for="billing_city">City</label>
                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City" value="{{$customer['billing_city']}}" readonly required>
                @error('billing_city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
		  <div class="row">
            <div class="col-md-6 mb-3">
                <label for="billing_pcode">Post Code</label>
                <input type="text" class="form-control" id="billing_pcode" name="billing_pcode" placeholder="Post Code" value="{{$customer['billing_pcode']}}" readonly required>
                @error('billing_pcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_splan">Service Plan</label>
                <input type="text" class="form-control" id="billing_splan" name="billing_splan" placeholder="Occupation" value="" readonly required>
                @error('billing_splan')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
		   <div class="row">
            <div class="col-md-6 mb-3">
              <label for="billing_zone">Zone</label>
              <input type="text" class="form-control" id="billing_zone" name="billing_zone" placeholder="Zone" value="{{$customer['billing_zone']}}" readonly required>
              @error('billing_zone')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_cdate">Connectivity Date</label>
                <input type='date' class="form-control" id='billing_cdate'  name="billing_cdate" placeholder="yyyy/mm/dd" value="{{$customer['billing_cdate']}}" readonly required />
                @error('billing_cdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
		  <div class="mb-3">
              <label for="billing_note">Note</label>
                <textarea  class="form-control" id="billing_note" name="billing_note"  placeholder="Note" readonly required>{{$customer['billing_note']}} </textarea>
              @error('billing_note')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                @enderror
            </div>

        {{-- Location Map --}}
          <style>
              #map {
              height: 300px;
            }
          </style>
        <div id="map" class="map"></div>

        <script>
            //var map, infoWindow;

            var geocoder = new google.maps.Geocoder();
          function initMap() {
              if (navigator.geolocation) {
                  navigator.geolocation.getCurrentPosition(function(position) {
                  var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                  console.log(`Lat: ${position.coords.latitude} Lng: ${position.coords.longitude}`) ;
                  var mapOptions = {
                      zoom: 18,
                      center: myLatlng,
                      mapTypeId: google.maps.MapTypeId.ROADMAP
                  };
                  var map = new google.maps.Map(document.getElementById('map'), mapOptions);
                  var marker = new google.maps.Marker();
                  marker.setPosition(myLatlng);
                  marker.setMap(map);

                  /*geocoder.geocode({'latLng': myLatlng}, function(results, status) {
                  if(status == google.maps.GeocoderStatus.OK) { if(results[0]) {
                      $('#address_current').text(results[0].formatted_address);
                  }
                  else {
                      alert('No results found');
                  }

              }
              else {
                  var error = { 'ZERO_RESULTS': 'We Could Not Find Your Address' }
                  $('#address_new').html('' + error[status] + ''); } }); */
          }, function() {
                  alert("Your Site is not Using https. So, browser does not support Geolocation.");
              });
          }
      }
      </script>
        <script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-RqC_GAn3jagvHwceAYEKkCK4u5mNKyA&callback=initMap"></script>
        {{-- eof location map --}}

          <hr class="mb-4">
          <a href="javascript:history.back()" class="btn btn-primary">Back</a>
          <button class="btn btn-primary btn-lg " type="submit">Continue to checkout</button>


        </form>
      </div>
    </div>
</div>
@section('javascripts')

@endsection
@endsection
