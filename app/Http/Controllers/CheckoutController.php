<?php

namespace App\Http\Controllers;

use App\Mail\SendOtpByMail;
use App\Order;
use App\AppConfig;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Routing\Route;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $url;

    public function __construct(UrlGenerator $url)
    {
        //$this->middleware('auth');

        $this->url = $url;
    }

    public function index()
    {
       // dd(Cart::content());
       if(Cart::count()==0){
           return redirect('/');
       }
        return view('front-end.checkout');
    }


    public function test()
    {
        $payment_gateway = AppConfig::where('setting', 'api_credential')->first();
        print_r($payment_gateway->value);
        //echo '<br>';
        exit;
        $order_id = 2;
        $response = $this->Invoke_Billing_Server($order_id);
        echo $response;
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

        if (Session::has('otp_pin')){
            $otp = $request->get('otp_pin');
            $session_otp = Session::get('otp_pin');
            if ($otp == $session_otp) {
                Session::put('billing_email', $request->billing_email);
                echo json_encode(array('success' => 1));
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

                //Session::put('totalCost', 2); //TODO

                $invoice_data = array('invoice'=> $this->getGUIDnoHash(), 'total'=> Session::get('totalCost'));
                $invoice_data = $invoice_data;
                Session::put('customer',$customer);
                Session::put('invoice_data',$invoice_data);
                Session::put('customer_id', '');
                $bkash_path = public_path() . "/bkash/";
                $bkash_config = file_get_contents($bkash_path . 'config.json');
                $bkash_config = trim($bkash_config);
                if($bkash_config!=''){
                    $bkash_config = (array)json_decode($bkash_config);
                    //echo '<pre>'; print_r($bkash_config);exit;
                }
                else{

                }
                return view('front-end.checkoutpre', ['customer'=>$customer, 'invoice_data' => $invoice_data, 'bkash_config'=>$bkash_config]);


            } else {
                //return redirect()->back()->with('otp_message','OTP is not Match');
                //return redirect('cart')->with('otp_message','OTP is not Match');
              echo json_encode(array('success' => 0));
            }
       }else{
            //return redirect()->back()->with('otp_message','OTP is not Match');
         echo json_encode(array('success' => 2));
       }

    }

    public function bkashsuccess(){
        return redirect()->route('confirmation.index')->with('success_message', 'Your order have successfully submitted');
    }

    public function bkashexecutepayment(){
        $invoice_data = Session::get('invoice_data');

        $paymentID = $_GET['paymentID'];
        $resultdata = bkash_Execute_Payment($paymentID);
        $resultdata = trim($resultdata);
        if($resultdata!=''){
            //echo $resultdata;
            //exit();
        }
        else{
            // delaying execution of the script for 30 seconds, then execute QueryPayment . this is the Business UAT from bKash
            sleep(30);

            //Query Payment
            $resultdata = bkash_Query_Payment($paymentID);
        }


         $data = [];
        $data = Session::get('customer');
        $data['bkash'] = $resultdata;

        //$url = $this->url->to('/');
        //$url = config('app.url')
        //$checkoutUrl = $url . '/checkout?s=' . encDec('encrypt',$invoice_data['invoice']);
        try{
            $response = $this->Store_Payment_Info( $data);
            //echo $response;
            $this->Invoke_Billing_Server($response);
        } catch (Exception $e) {
            //echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        //$request = Request::create('checkout', 'POST', $data);
        //return app()->handle($request);

        echo $resultdata;
    }

    private function Invoke_Billing_Server($order_id)
    {
        //$order = Order::orderby('id', 'desc')->first();
        $order = Order::find($order_id);
        //$order_id = $order->id;
        $bkash_response = '';

        if(isset($order)){
            $order = $order->toArray();
            $bkash_response = $order['bkash_response'];
            $order = json_encode($order);
            //print_r($order);
        }
        if(!empty($bkash_response)){
            $bkash_response = json_decode ($bkash_response);
        }
        $invoice = $bkash_response->merchantInvoiceNumber;
        //print_r($invoice); exit;
        $payment_gateway = AppConfig::where('setting', 'api_credential')->first();
        //print_r($payment_gateway->value);
        //echo '<br>';
        if( isset($payment_gateway->value) )
        {
            $getapi = explode(",", $payment_gateway->value);
            list(, $apikey, $apisecret) = $getapi;
            //var_dump($getapi);
            $get_srv_url = explode("//", $getapi[0]);
            //var_dump($get_srv_url);
            $get_srv_url = explode(":", $get_srv_url[1]);
            //var_dump($get_srv_url);

            $endpoint = $getapi[0] . "/billing/api.php";
            $srv_url = $getapi[0];

            //echo $endpoint, '<br>';
            //echo $srv_url, '<br>';
            $role = 'add_new_web_customer';
            $data = array( "role" => $role, "apikey" => $apikey, "apisecret" => $apisecret, "data" => $order );
            $data_string = json_encode($data);
            $ch = curl_init($endpoint);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "Content-Length: " . strlen($data_string) ));
            if(isLocalhost()){
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            }
            $result = curl_exec($ch);
            if($result === false)
            {
                $result = json_encode(array("message"=> curl_error($ch)));
            }
            $data = json_decode($result);
            //echo '<pre>'; print_r($result);
            if( isset($data->status) && $data->status == "s01" )
            {
                if(isset($data->response->customer_id)){

                    $order = Order::find($order_id);
                    $order->customer_id = $data->response->customer_id;
                    $order->save();

                    //Billing API START
                    $resultdata = json_encode($bkash_response);
                    //$resultdata = '{"paymentID":"ZM4XHY71599734349356","createTime":"2020-09-10T10:39:09:397 GMT+0000","updateTime":"2020-09-10T10:39:24:878 GMT+0000","trxID":"7IA102QZCB","transactionStatus":"Completed","amount":"500.00","currency":"BDT","intent":"sale","merchantInvoiceNumber":"INV-692062873","refundAmount":"0"}';
                    $bkash_response = '';
                    $data_string = $resultdata;
                    $checkoutUrl = $srv_url . '/billing/bkash-checkout.php?s=' . encDec('encrypt', $invoice);
                    $ch = curl_init($checkoutUrl);

                    $bkash_response .= getCurrentDateTime() . PHP_EOL;
                    $bkash_response .= 'API Title : ' . 'Server Billinng API' . PHP_EOL;
                    $bkash_response .= 'API URL : ' . $checkoutUrl . PHP_EOL;

                    curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "Content-Length: " . strlen($data_string) ));
                    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch,CURLOPT_FOLLOWLOCATION, 1);
                    //curl_setopt($ch, CURLOPT_PROXY, $proxy);

                    if(isLocalhost()){
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    }

                    $resultdata_billingapi=curl_exec($ch);
                    if($resultdata_billingapi === false)
                    {
                        $resultdata_billingapi = json_encode(array("message"=> curl_error($ch)));
                    }
                    $bkash_response .= 'Billing API Response : ' . $resultdata_billingapi . PHP_EOL. PHP_EOL;
                    //file_put_contents($log_filename, $bkash_response);

                    curl_close($ch);

                    echo $resultdata_billingapi;

                    //Billing API END
                }
            }
            else
            {
                //
            }
        }
    }

    private function Store_Payment_Info($request)
    {
         //$request = $data['customer'];
        //$post = file_get_contents("php://input");
        //echo '<pre>'; print_r($request); exit;

//        foreach (Cart::content() as $item) {
//            $billing_subtotal = $item->subtotal;
//            $billing_total=$item->total;
//            $package_name=$item->name;
//        }

        $billing_subtotal = Session::get('totalCost');
        $billing_total = Session::get('totalCost');
        $package_name = Session::get('productName');

        $order = Order::create([
           'user_id'                   =>auth()->user() ? auth()->user()->id : null,
           'package_name'              =>      $package_name,
           'billing_name'              =>      $request['billing_name'],
           'customer_nid'              =>      $request['billing_nid'],
           'billing_apartment'         =>      $request['billing_apartment'],
           'billing_phone'           =>      $request['billing_phone'],
           'billing_email'             =>      $request['billing_email'],
           'billing_zone'              =>      $request['billing_zone'],
           'payement_gateway'          =>      'BKASH',
           'billing_subtotal'          =>      $billing_subtotal,
           'billing_total'             =>      $billing_total,
           'error'                     =>      null,
           'house'                       =>      $request['billing_house'],
           'gander'                     =>      $request['billing_gender'],
           'road'                      =>      $request['billing_road'],
           'block'                     =>      $request['billing_block'],
           'area'                      =>      $request['billing_area'],
           'city'                      =>      $request['billing_city'],
           'post_code'                  =>      $request['billing_pcode'],
           'connectivity_date'          =>      $request['billing_cdate'],
           'note'                      =>      $request['billing_note'],
           'service_plan'             =>      $request['billing_splan'],
           'bkash_response'             =>      $request['bkash']
       ]);

       Cart::instance('default')->destroy();

       return $order->id;
    }

    public function bkashcreatepayment(){
        $amount = $_GET['amount'];
        $invoice = $_GET['invoice']; //"46f647h7"; // must be unique
        $intent = $_GET['intent'];

        $invoice_data = Session::get('invoice_data');
        //$invoiceno = $invoice_data['invoice'];

        //
        if($invoice_data['total']!=$amount){
            $output=[];
            $output['errorMessage'] = "Invalid Amount.";
            echo json_encode($output);
            exit;
        }
        if($invoice_data['invoice']!=$invoice){
            $output=[];
            $output['errorMessage'] = "Invalid Invoice.";
            echo json_encode($output);
            exit;
        }
        if('sale'!=$intent){
            $output=[];
            $output['errorMessage'] = "Invalid Intent.";
            echo json_encode($output);
            exit;
        }

        $response = bkash_Create_Payment($amount, $invoice, $intent);

        echo $response;


    }

    public function bkashtoken(Request $request){
        $bkash_path = public_path() . "/bkash/";

        $invoice_data = Session::get('invoice_data');
        $invoiceno = $invoice_data['invoice'];
        if(isset($invoiceno)){
            Session::put('log_file', $invoiceno);
        }
        else{
            Session::put('log_file', session_id());
        }

        $customer_id = Session::get('customer_id');
        $log_file = Session::get('log_file');

        if(!is_dir($bkash_path . "logs/" . $customer_id)){
            mkdir($bkash_path . "logs/" . $customer_id, 0777);
        }
        $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
        if(!is_file($log_filename)){
            file_put_contents($log_filename, "");
        }

        $strJsonFileContents = file_get_contents($bkash_path . "config.json");
        $array = json_decode($strJsonFileContents, true);
        //echo '<pre>';print_r($array);

        Session::put('bkash_token', $array['token']);

        if(isset($array['token_generated_on'])){
            $token_expires_in = 60*55; //(60*60)3600 60minitues // refresh before 5mins
            if(isset($array['expires_in'])) $token_expires_in = $array['expires_in'];
            $token_generated_on = $array['token_generated_on'];
            $token_now = date("Y-m-d H:i:s");
            $token_life = strtotime($token_now) - strtotime($token_generated_on);
            if($token_life >= $token_expires_in){
                //echo 'refresh';
                $request_token=bkash_Refresh_Token();
                bkash_Save_Token($request_token);
            }
        }
        else{
            $request_token=bkash_Get_Token();
            bkash_Save_Token($request_token);
        }
    }

    public function store(Request $request)
    {
        //$post = file_get_contents("php://input");
        echo '<pre>'; print_r($request->all()); exit;
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
           'billing_phone'           =>      $request->billing_phone,
           'billing_email'             =>      $request->billing_email,
           'billing_zone'              =>      $request->billing_zone,
           'payement_gateway'          =>      'COD',
           'billing_subtotal'          =>      $billing_subtotal,
           'billing_total'             =>      $billing_total,
           'error'                     =>      null,
           'house'                       =>      $request->billing_house,
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
