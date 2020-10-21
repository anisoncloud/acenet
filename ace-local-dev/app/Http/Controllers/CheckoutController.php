<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpByMail;
use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        //$this->middleware('auth');
    }
    public function index()
    {
       // dd(Cart::content());
       if(Cart::count()==0){
           return redirect('/');
       }
        return view('front-end.checkout');
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    private $merchant_token = "e/ElHdFXTaKwmN6HKHUV0bNMI7HBQaxWRL3siBZZ1y5PvLCbMWDvjA==";

    public function saveShippingInfo(Request $request)
    {
        $this->validate($request, [
            'package_name'=>'required',
            'billing_email'=>'required|email',
            'billing_name'=>'required',
            'billing_address'=>'required',
            'billing_phone'=>'required',
            'billing_zone'=>'required'
        ]);

            $cart_final = array(
                'amount' => $request->orderTotal,
                'extra' => "",
                'notify_mobile' => $request->mobileNumber,
                'notify_email' => $request->emailAddress,
                'cancel_url' => route('/cancel-url'),
                'transactionid' => $request->customer_id,
                'fail_url' => route('/fail-url'),
                'token' => $this->merchant_token,
                'success_url' => route('/success-url')
            );
            $json = json_encode($cart_final);
            $url_encode_data = urlencode($json);
//            return $url_encode_data;
            $url = "http://ecom.aamrainfotainment.com/msp/PUBLIC_API/AccessToken.jsp?data={$url_encode_data}";
            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);
            curl_close($ch);
//            $get_access_token = file_get_contents($url);
//            return gettype($data);
//            $get_access_token = $data;
            $get_access_token = json_decode($data);
//            return response()->json($get_access_token);
//            return $get_access_token->data->amount;
            $access_token_url = "http://ecom.aamrainfotainment.com/msp/payment2.jsp?atoken=" . urlencode($get_access_token->access_token);
            return redirect($access_token_url);

    }

    public function cancelMessage()
    {
        return view('front.checkout.cancel-message');
    }

    public function failMessage()
    {
        return view('front.checkout.fail-message');
    }

    public function successMessage(Request $request)
    {

    }

    public function onlinePaymentResponse(Request $request)
    {
        $return_token = $request->return_token;
        $payment_final = array(
            'return_token' => "" . $return_token . "",
            'token' => "" . $this->merchant_token . ""
        );

        $json = json_encode($payment_final);

        $url_encode_data = urlencode($json);

        $url = "http://ecom.aamrainfotainment.com/msp/PUBLIC_API/TokenInfo.jsp?data={$url_encode_data}";
        //echo '<br><br><br>';

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

//        $get_data = file_get_contents($url);
//        return $get_data;
//        $get_data = $data;
        $get_data = json_decode($data);


        $get_data2 = '{
            "transaction_id" : "Sat Sep 12 13:30:11 BDT 201569341.50042373298",
            "amount" : "90",
            "bank_transaction_id" : "j6v1qpcb3l",
            "data" :
                {
                    "return_token" : "pPUCEktoCHI7uojmk7GaBRnfm6OXGyRVpvHk5gDagc2BD9VwCutcmq6BB6nrHJN8"
                },
            "ip" : "182.160.120.178",
            "access_token" : "Ytd4W55oQBja8iIsYCmjk7bKbw10GUt6wrj3F1PfzBKBD9VwCutcmtfnKswfmVrw",
            "success" : true,
            "domain" : "www.newdomain.com",
            "bank_transaction_details" : {
                "banktransactionid" : "j6v1qpcb3l",
                "transactionid" : "n\/nkjL\/tB1rZ8FDg3gcVtNuq7ess5FbXa7kb1jCWfz6BD9VwCutcmgbw23\/DLKNK"
            },
            "bank_name" : "TestBank",
            "time" : "2015-09-12 13:30:10.257",
            "hit_count" : "0",
            "status" : "SUCCESS"
        }';
//        $get_data = json_decode($get_data2);
//        $get_data = response()->json($get_data2);
//        return $get_data->status;


        if ($get_data->success == false) {
            return redirect('/customer/checkout/fail_url');
        } elseif ($get_data->status == 'SUCCESS') {
            $online_payment = new OnlinePayment();
            $online_payment->transaction_id = $get_data->transaction_id;
            $online_payment->amount = $get_data->amount;
            $online_payment->bank_transaction_id = $get_data->bank_transaction_id;
            $online_payment->ip = $get_data->ip;
            $online_payment->domain = $get_data->domain;
            $online_payment->banktransactionid = $get_data->bank_transaction_details->banktransactionid;
            $online_payment->transactionid = $get_data->bank_transaction_details->transactionid;
            $online_payment->bank_name = $get_data->bank_name;
            $time = strtotime($get_data->time);
            $online_payment->created_time = date("m-d-y H:i:s",$time);// $time->format('m-d-y H:i:s');;
            $online_payment->save();
            return redirect('/customer/checkout/success_notice');
        } else {
            return redirect('/customer/checkout/cancel_url');
        }
    }

    public function sendOTP(){
        $billing_email = $_GET['billing_email'];
        $digits = 6;
        $i = 0; //counter
        $pin_code = ""; //our default pin is blank.
        while ($i < $digits) {
            //generate a random number between 0 and 9.
            $pin_code .= mt_rand(0, 9);
            $i++;
        }
            Session::put('otp_pin', $pin_code);
            echo $billing_email;
            $data = [
                $billing_email,
                $pin_code
            ];
            Mail::to($billing_email)->send( new SendOtpByMail($data));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private function getGUIDnoHash(){
        mt_srand((double)microtime()*10000);
        $charid = md5(uniqid(rand(), true));
        $c = unpack("C*",$charid);
        $c = implode("",$c);
        return substr($c,0,10);
    }
    public function preview(Request $request){
        /* $validatedData = $request->validate([
            //'package_name'=>'required',
            'billing_email'=>'required|email',
            'billing_name'=>'required',
            'customer_nid'=>'required',
            'billing_apartment'=>'required',
            'billing_phone'=>'required',
            'billing_zone'=>'required',
            'gander'=>'required',
            'house'=>'required',
            'road'=>'required',
            'block'=>'required',
            'area'=>'required',
            'city'=>'required',
            'post_code'=>'required',
            'connectivity_date'=>'required',
            'note'=>'required',
        ]); */


        $customer =array(
            'billing_name'          =>      $request->billing_name,
            'billing_phone'            =>      $request->billing_phone,
            'billing_email'             =>      $request->billing_email,
            'billing_nid'               =>      $request->billing_nid,
            'billing_gender'             =>      $request->billing_gender,
            'billing_apartment'         =>      $request->billing_apartment,
            'billing_house'             =>      $request->billing_house,
            'billing_road'              =>      $request->billing_road,
            'billing_block'             =>      $request->billing_block,
            'billing_area'              =>      $request->billing_area,
            'billing_city'              =>      $request->billing_city,
            'billing_pcode'             =>      $request->billing_pcode,
            'billing_zone'              =>      $request->billing_zone,
            'billing_cdate'             =>      $request->billing_cdate,
            'billing_note'              =>      $request->billing_note,
            'billing_splan'             =>      $request->billing_splan,
        );
        //Session::push('customer', $customer);

        if (Session::has('otp_pin')){
            $otp = $request->get('otp_pin');
            $session_otp = Session::get('otp_pin');
            if ($otp == $session_otp) {
                Session::put('billing_email', $request->billing_email);
                return view('front-end.checkoutpre')->with('customer', $customer);
             } else {
                return view('front-end.checkout')->with('customer' , $customer);
                //return redirect()->back()->with('otp_message','OTP is not Match');
                //return redirect()->route('cart.index')->with('otp_message','OTP is not Match');
                //return redirect('cart')->with('customer', $customer);
                //return redirect()->url('cart')->with('otp_message','OTP is not Match');
            }
        }else{
            return redirect()->back()->with(['otp_message'=>'OTP is not Match', 'customer'=>$customer]);
            //return redirect()->url('cart.index')->with('otp_message','OTP is not Match');
            //return redirect('cart')->with('otp_message','OTP is not Match');
            //return redirect()->url('cart')->with('otp_message','OTP is not Match');
        }

    }
    public function store(Request $request)
    {

        //dd(request()->all());
        //Field validation check
        /* $validatedData = $request->validate([
            //'package_name'=>'required',
            'billing_email'=>'required|email',
            'billing_name'=>'required',
            'billing_address'=>'required',
            'billing_phone'=>'required',
            'billing_zone'=>'required'
        ]); */
        foreach (Cart::content() as $item) {
            $billing_subtotal = $item->subtotal;
            $billing_total=$item->total;
            $package_name=$item->name;
        }
                 $order = Order::create([
                    'user_id'                   =>auth()->user() ? auth()->user()->id : null,
                    'package_name'              =>      $package_name,
                    'billing_name'              =>      $request->billing_name,
                    'customer_nid'              =>      $request->billing_nid,
                    'billing_apartment'         =>      $request->billing_apartment,
                    'billing_phone'         =>      $request->billing_phone,
                    'billing_email'             =>      $request->billing_email,
                    'billing_zone'              =>      $request->billing_zone,
                    'payement_gateway'          =>      'COD',
                    'billing_subtotal'          =>      $billing_subtotal,
                    'billing_total'             =>      $billing_total,
                    'error'                     =>      null,
                    'house'             =>      $request->billing_house,
                    'gander'                     =>      $request->billing_gender,
                    'road'                      =>      $request->billing_road,
                    'block'                     =>      $request->billing_block,
                    'area'                      =>      $request->billing_area,
                    'city'                      =>      $request->billing_city,
                    'post_code'                  =>      $request->billing_pcode,
                    'connectivity_date'          =>      $request->billing_cdate,
                    'note'                      =>      $request->billing_note,
                    'service_plan'             =>      $request->billing_splan
                ]);

                Cart::instance('default')->destroy();
                return redirect()->route('confirmation.index')->with('success_message', 'Your order have successfully submitted');



    }




/*
    public function store(Request $request)
    {

        //dd(request()->all());
        //Field validation check
        $validatedData = $request->validate([
            //'package_name'=>'required',
            'billing_email'=>'required|email',
            'billing_name'=>'required',
            'billing_address'=>'required',
            'billing_phone'=>'required',
            'billing_zone'=>'required'
        ]);

        //OTP Check
        if (Session::has('otp_pin')){
            $otp = $request->get('otp_pin');
            $session_otp = Session::get('otp_pin');
            if ($otp == $session_otp) {
                Session::put('billing_phone', $request->billing_phone);
                foreach (Cart::content() as $item) {
                    $billing_subtotal = $item->subtotal;
                    $billing_total=$item->total;
                    $package_name=$item->name;
                }
// Payment Functionality

                $cart_final = array(
                    'amount' => $billing_total,
                    'extra' => "",
                    'notify_mobile' => $request->billing_phone,
                    'notify_email' => $request->billing_email,
                    'cancel_url' => route('/cancel-url'),
                    'transactionid' => $this->getGUIDnoHash(),
                    'fail_url' => route('/fail-url'),
                    'token' => $this->merchant_token,
                    'success_url' => route('/success-url')
                );
                //dd(request()->all());

                $json = json_encode($cart_final);
                //dd($json);
                $url_encode_data = urlencode($json);
                //dd($url_encode_data);
                //            return $url_encode_data;
                $url = "http://ecom.aamrainfotainment.com/msp/PUBLIC_API/AccessToken.jsp?data={$url_encode_data}";
                $ch = curl_init();
                $timeout = 5;
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                $data = curl_exec($ch);
                curl_close($ch);
                //            $get_access_token = file_get_contents($url);
                //            return gettype($data);
                //            $get_access_token = $data;
                $get_access_token = json_decode($data);
                dd($data);
                //            return response()->json($get_access_token);
                //            return $get_access_token->data->amount;
                //dd($get_access_token);
                $access_token_url = "http://ecom.aamrainfotainment.com/msp/payment2.jsp?atoken=" . urlencode($get_access_token->token);
                return redirect($access_token_url);
                // Payment functionality end
                /* $order = Order::create([
                    'user_id'=>auth()->user() ? auth()->user()->id : null,
                    'package_name'=>$package_name,
                    'billing_email'=>$request->billing_email,
                    'billing_name'=>$request->billing_name,
                    'billing_address'=>$request->billing_address,
                    'billing_phone'=>$request->billing_phone,
                    'billing_zone'=>$request->billing_zone,
                    'payement_gateway'=>'COD',
                    'billing_subtotal'=>$billing_subtotal,
                    'billing_total'=>$billing_total,
                    'error'=>null
                ]);

                Cart::instance('default')->destroy();
                return redirect()->route('confirmation.index')->with('success_message', 'Your order have successfully submitted');
            }else{
                return redirect()->route('checkout.index')->with('message','OTP is not Match');
            }
        }else{
            return redirect()->route('checkout.index')->with('message','First Set Your OTP');
        }

    } */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
