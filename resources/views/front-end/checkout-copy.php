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
              <h6 class="my-0">{{ Session::get('productName') }}</h6>
            </div>
            <span class="text-muted">{{ Session::get('productPrice') }}</span>
          </li>

          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">OTC</h6>
            </div>
            <span class="text-muted">{{ Session::get('productOtc') }}</span>
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
        {{Session::get('otp_pin')}}
        <h4 class="mb-3">Billing address</h4>
        <form method="POST" action="{{ route('checkout.preview')}}" name="form_order" id="form_order">
            @csrf

            <div class="mb-3">
              <label for="billing_name">Customer Name</label>
                <input type="text" class="form-control" id="billing_name" name="billing_name"  placeholder="Full Name (as in NID)" value="" required>
              @error('billing_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                @enderror
            </div>


          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="billing_email">Email</label>
              <input type="email" class="form-control" id="billing_email" name="billing_email" placeholder="Email" value="{{old('billing_email')}}" required>
                @error('billing_email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
              </div>
            <div class="col-md-3 mb-3">
                <button class="btn btn-outline-secondary" type="button" onclick="sendOTP()">Send OTP to Mail</button>
                {{-- <input type="button" class="btn btn-primary" value="Send OTP"> --}}
            </div>
            <div class="col-md-3 mb-3">
                <input type="number" class="form-control" name="otp_pin" id="otp_pin" placeholder="Input OTP" maxlength="6"  required="required" minlength="6" pattern = "[0-9]{1,6}">
                    @if (Session::has('otp_message'))
                        <span class="invalid-feedback" role="alert">
                            {{Session::get('otp_message')}}
                        </span>
                    @endif
            </div>
          </div>
          <div class="mb-3">
            <label for="billing_phone">Mobile Number </label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend">+88</span>
                </div>
                <input type="text" class="form-control" id="billing_phone" name="billing_phone" placeholder="Mobile Number" value="{{old('billing_phone')}}" maxlength="11" minlength="11" pattern = "[0-9]{1,11}" required>
                @error('billing_phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


          <div class="row">
            <div class="col-md-8 mb-3">
                <label for="billing_nid">National ID</label>
                <input type="text" class="form-control" id="billing_nid" name="billing_nid" placeholder="NID" value="{{old('billing_nid')}}" required>
                @error('billing_nid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="billing_gender">Gender</label>
                <select class="form-control" style="height: 50px" placeholder="Select Gender" id="billing_gender" name="billing_gender" required>
                    <option value="" disabled>Select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
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
                <input type="text" class="form-control" id="billing_apartment" name="billing_apartment" placeholder="Apartment" value="{{old('billing_apartment')}}" required>
                @error('billing_apartment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
			<div class="col-md-6 mb-3">
                <label for="billing_house">House</label>
                <input type="text" class="form-control" id="billing_house" name="billing_house" placeholder="House" value="{{old('billing_house')}}" required>
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
                <input type="text" class="form-control" id="billing_road" name="billing_road" placeholder="Road" value="{{old('billing_road')}}" required>
                @error('billing_road')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_block">Block</label>
                <input type="text" class="form-control" id="billing_block" name="billing_block" placeholder="Block" value="{{old('billing_block')}}" required>
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
              <select class="form-control" placeholder="Area" id="billing_area" name="billing_area" required>
                <option value="">Area</option>
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
              @error('billing_area')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
			<div class="col-md-6 mb-3">
                <label for="billing_city">City</label>
                <input type="text" class="form-control" id="billing_city" name="billing_city" placeholder="City" value="{{old('billing_city')}}" required>
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
                <input type="text" class="form-control" id="billing_pcode" name="billing_pcode" placeholder="Post Code" value="{{old('billing_pcode')}}" required>
                @error('billing_pcode')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_splan">Service Plan</label>
                <input type="text" class="form-control" id="billing_splan" name="billing_splan" placeholder="Occupation" value="" required>
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
              <select class="form-control" placeholder="Zone" id="billing_zone" name="billing_zone" required>
                <option value="">Zone</option>
                <option value="ACE-Bashundhara">ACE-Bashundhara</option>
              </select>
              @error('billing_zone')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="billing_cdate">Connectivity Date</label>
                <p><input type="text" id="datepicker" class="form-control" name="billing_cdate" placeholder="Date of Birth" required></p>
                @error('billing_cdate')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
          </div>
		  <div class="mb-3">
              <label for="billing_note">Note</label>
                <textarea  class="form-control" id="billing_note" name="billing_note"  placeholder="Note" value="{{old('billing_note')}}" required></textarea>
              @error('billing_note')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
                @enderror
            </div>


          <hr class="mb-4">
          <button class="btn btn-primary btn-lg " type="submit">Preview before Checkout</button>

        </form>
      </div>
    </div>
</div>
<div id="loaderDiv" style="display:none; opacity: 0.7; width: 100%; height: 100%; background:#cccccc; z-index: 999999999; position: absolute; top:0; left: 0;">
<span style="text-align: center; top:200px; position: relative;">
    <h1>Check your email, Please. </h1>
</span>
</div>
@section('javascripts')
<script !src="">
    function sendOTP() {
        let billing_email = $('#billing_email').val();
            $.ajax({
                url:"{{route('otp.otpsend')}}?billing_email="+billing_email,
                type:'GET',
                beforeSend: function() {
                    $("#loaderDiv").show();    },
                success:function (response) {
                    $("#loaderDiv").hide();
                    alert('Successfully Send OTP to '+response);
                    // $('#otp_notification').html(response);
                }
            })
    }

</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat:"yy-mm-dd"
    });
  } );
  </script>
  <script !src="">
      $(document).ready(function(){
        $("#form_order").submit(function(event){
            event.preventDefault();
      });

    //checkOTP();
  });
      function checkOTP() {
        let user_given_otp = $("#otp_pin").val();
            $.ajax({
                //url:"{{route('checkout.preview')}}?otp_pin="+user_given_otp,
                url:"{{route('checkout.preview')}}"
                type:'POST',
                data: {otp_pin: user_given_otp },
                /* beforeSend: function() {
                    $("#loaderDiv").show();    }, */
                success:function (response) {
                    //$("#loaderDiv").hide();
                    var jsonData = JSON.parse(response);
                    if (jsonData.success == "1")
                {
                    //"{{ route('checkout.preview')}}"
                    //$('#form_order').trigger('submit');
                }
                else
                {
                    alert('Invalid Credentials!');
                }
                    //alert(response);
                    //console.log(response);
                    // $('#otp_notification').html(response);
                    if (jsonData.success == "2"){
                        alert(response);
                    }
                }
            });
        }
    /* function checkOTP() {
        let original_otp = "{{Session::get('otp_pin')}}";
        let user_given_otp = $("#otp_pin").val();
        if(original_otp == user_given_otp){
            return true;
            submit();
        }else{
            alert('OTP not match');
            return false;
        }
    } */
</script>
@endsection
@endsection
