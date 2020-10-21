<?php
//session_name('laravel_session');
//session_start();

function _client()
{
//    if( isset($_SESSION["apisess"]) && isset($_SESSION["apirole"]) && isset($_SESSION["username"]) && isset($_SESSION["password"]) ) 
//    {
//        return true;
//    }
//    $output=[];
//    $output['errorMessage'] = "Access Denied.";
//    echo json_encode($output);
//    exit;
//    exit;
}

function bkash_Store_Payment_Info($checkoutUrl, $data){
    $bkash_path = public_path() . "/bkash/";
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    $bkash_response = file_get_contents($log_filename);
    
    //Billing API START
    //$resultdata = '{"paymentID":"ZM4XHY71599734349356","createTime":"2020-09-10T10:39:09:397 GMT+0000","updateTime":"2020-09-10T10:39:24:878 GMT+0000","trxID":"7IA102QZCB","transactionStatus":"Completed","amount":"500.00","currency":"BDT","intent":"sale","merchantInvoiceNumber":"INV-692062873","refundAmount":"0"}';
    //$data_string = json_decode($resultdata);

    $bkash_response = '';
    
    $ch = curl_init($checkoutUrl);
    
    $bkash_response .= getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Server Billinng API' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $checkoutUrl . PHP_EOL;

    //curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "Content-Length: " . strlen($data_string) ));
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
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
    file_put_contents($log_filename, $bkash_response);

    curl_close($ch);
    return $resultdata_billingapi;
    //Billing API END
}

function bkash_Execute_Payment($paymentID){
    $bkash_path = public_path() . "/bkash/";
    
    $idtoken = Session::get('bkash_token');
    $token = encDec('decrypt', $idtoken);
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    $bkash_response = file_get_contents($log_filename);
    
    $strJsonFileContents = file_get_contents($bkash_path . "config.json");
    $array = json_decode($strJsonFileContents, true);
    $array['app_key']= encDec('decrypt', $array['app_key']);
    $proxy = $array["proxy"];
    
    $url = curl_init($array["executeURL"].$paymentID);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$token,
        'x-app-key:'.$array["app_key"]              
    );

    $bkash_response .= getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Execute Payment' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $array["executeURL"].$paymentID . PHP_EOL;
    if(isLocalhost()){
        $bkash_response .= 'Request Body : ' . json_encode($header) . PHP_EOL ;
    }  

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    if(isLocalhost()){
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    }

    $resultdata=curl_exec($url);

    $bkash_response .= 'API Response : ' . $resultdata . PHP_EOL. PHP_EOL;
    file_put_contents($log_filename, $bkash_response);

    curl_close($url);
    
    return $resultdata;
}

function bkash_Create_Payment($amount, $invoice, $intent){
    $bkash_path = public_path() . "/bkash/";
    
    $idtoken = Session::get('bkash_token');
    $token = encDec('decrypt', $idtoken);
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    $bkash_response = file_get_contents($log_filename);
    
    $strJsonFileContents = file_get_contents($bkash_path . "config.json");
    $array = json_decode($strJsonFileContents, true);
    $array['app_key']= encDec('decrypt', $array['app_key']);
    $proxy = $array["proxy"];

    $createpaybody=array('amount'=>$amount, 'currency'=>'BDT', 'merchantInvoiceNumber'=>$invoice,'intent'=>$intent);   
    $url = curl_init($array["createURL"]);

    $createpaybodyx = json_encode($createpaybody);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$token,
        'x-app-key:'.$array["app_key"]
    );

    $bkash_response .= getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Create Payment' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $array["createURL"] . PHP_EOL;
    if(isLocalhost()){
        $bkash_response .= 'Request Body : ' . json_encode($header) . PHP_EOL . json_encode($createpaybody) . PHP_EOL;
    }

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    if(isLocalhost()){
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    }

    $resultdata = curl_exec($url);

    $bkash_response .= 'API Response : ' . $resultdata . PHP_EOL. PHP_EOL;
    file_put_contents($log_filename, $bkash_response);

    curl_close($url);

    return $resultdata;
}

function bkash_Query_Payment($paymentID){
    $bkash_path = public_path() . "/bkash/";
    
    $idtoken = Session::get('bkash_token');
    $token = encDec('decrypt', $idtoken);
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    $bkash_response = file_get_contents($log_filename);
    
    $strJsonFileContents = file_get_contents($bkash_path . "config.json");
    $array = json_decode($strJsonFileContents, true);
    $array['app_key']= encDec('decrypt', $array['app_key']);
    $proxy = $array["proxy"];

    $url = curl_init($array["queryURL"].$paymentID);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$token,
        'x-app-key:'.$array["app_key"]              
    );	
    
    $bkash_response = getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Query Payment' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $array["queryURL"].$paymentID . PHP_EOL;
    if(isLocalhost()){
        $bkash_response .= 'Request Body : ' . json_encode($header) . PHP_EOL ;
    }
    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);
    if(isLocalhost()){
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    }
    $resultdatax=curl_exec($url);
    
    $bkash_response .= 'API Response : ' . $resultdatax . PHP_EOL. PHP_EOL;

    curl_close($url);
    
    file_put_contents($log_filename, $bkash_response);
    
    return $resultdatax;
}

function bkash_Save_Token($request_token){
    $bkash_path = public_path() . "/bkash/";
    
    if(isset($request_token['id_token'])){
        $idtoken=$request_token['id_token'];
        $idtoken= encDec('encrypt', $idtoken);
        $strJsonFileContents = file_get_contents($bkash_path . "config.json");
        $array = json_decode($strJsonFileContents, true);

        $array['token']=$idtoken;
        $array['expires_in']=$request_token['expires_in'];
        $array['refresh_token']= encDec('encrypt', $request_token['refresh_token']);
        $array['token_generated_on'] = date("Y-m-d H:i:s");
        
        $newJsonString = json_encode($array);
        file_put_contents($bkash_path . 'config.json',$newJsonString);

        //print_r(json_decode(encDec('decrypt', $_SESSION['invoice_data'])));

        //echo $idtoken;
        //$_SESSION['token'] = $idtoken;
        Session::put('bkash_token', $idtoken);
    }
    else{
        //http_response_code(500);
        //echo json_encode($request_token);
    }
}
function bkash_Refresh_Token(){
    $bkash_path = public_path() . "/bkash/";
    //$customer_id = $_SESSION['customer_id'];
    //$log_file = $_SESSION['log_file'];
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    if(!is_dir($bkash_path . "logs/" . $customer_id)){
        mkdir($bkash_path . "logs/" . $customer_id, 0777);
    }
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    if(!is_file($log_filename)){
        file_put_contents($log_filename, "");
    }
    $bkash_response = file_get_contents($log_filename);
    
    $strJsonFileContents = file_get_contents($bkash_path . "config.json");
    $array = json_decode($strJsonFileContents, true);
    
    $array['app_key']= encDec('decrypt', $array['app_key']);
    $array['app_secret']= encDec('decrypt', $array['app_secret']);
    $array['username']= encDec('decrypt', $array['username']);
    $array['password']= encDec('decrypt', $array['password']);
    
    $array["tokenURL"] = str_replace('/token/grant', '/token/refresh', $array["tokenURL"]);
    
    $post_token=array(
        'app_key'=>$array["app_key"],                                              
        'app_secret'=>$array["app_secret"],
        'refresh_token'=>encDec('decrypt', $array["refresh_token"])
    );	

    $url=curl_init($array["tokenURL"]);
    $proxy = $array["proxy"];
    $posttoken=json_encode($post_token);
    $header=array(
        'Content-Type:application/json',
        'password:'.$array["password"],                                                               
        'username:'.$array["username"]                                                           
    );				

    $bkash_response .= getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Refresh Token' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $array["tokenURL"] . PHP_EOL;
    if(isLocalhost()){
        $bkash_response .= 'Request Body : ' . json_encode($header) . PHP_EOL . json_encode($post_token) . PHP_EOL;
    }

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    if(isLocalhost()){
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    }

    $resultdata=curl_exec($url);
    if($resultdata === false)
    {
        $resultdata = json_encode(array("message"=> curl_error($url)));
    }
    curl_close($url);
    $bkash_response .= 'API Response : ' . $resultdata . PHP_EOL . PHP_EOL;

    file_put_contents($log_filename, $bkash_response);

    return json_decode($resultdata, true);    
}


function bkash_Get_Token(){
    $bkash_path = public_path() . "/bkash/";
    //$customer_id = $_SESSION['customer_id'];
    //$log_file = $_SESSION['log_file'];
    
    $customer_id = Session::get('customer_id');
    $log_file = Session::get('log_file');
    
    if(!is_dir($bkash_path . "logs/" . $customer_id)){
        mkdir($bkash_path . "logs/" . $customer_id, 0777);
    }
    $log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
    if(!is_file($log_filename)){
        file_put_contents($log_filename, "");
    }
    $bkash_response = file_get_contents($log_filename);

    $strJsonFileContents = file_get_contents($bkash_path . "config.json");
    $array = json_decode($strJsonFileContents, true);
    
    $array['app_key']= encDec('decrypt', $array['app_key']);
    $array['app_secret']= encDec('decrypt', $array['app_secret']);
    $array['username']= encDec('decrypt', $array['username']);
    $array['password']= encDec('decrypt', $array['password']);
    
    $post_token=array(
        'app_key'=>$array["app_key"],                                              
        'app_secret'=>$array["app_secret"]                  
    );	

    $url=curl_init($array["tokenURL"]);
    $proxy = $array["proxy"];
    $posttoken=json_encode($post_token);
    $header=array(
        'Content-Type:application/json',
        'password:'.$array["password"],                                                               
        'username:'.$array["username"]                                                           
    );				
     
    $bkash_response .= getCurrentDateTime() . PHP_EOL;
    $bkash_response .= 'API Title : ' . 'Grant Token' . PHP_EOL;
    $bkash_response .= 'API URL : ' . $array["tokenURL"] . PHP_EOL;
    if(isLocalhost()){
        $bkash_response .= 'Request Body : ' . json_encode($header) . PHP_EOL . json_encode($post_token) . PHP_EOL;
    }

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    if(isLocalhost()){
        curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
    }

    $resultdata=curl_exec($url);
    if($resultdata === false)
    {
        $resultdata = json_encode(array("message"=> curl_error($url)));
    }
    curl_close($url);
    $bkash_response .= 'API Response : ' . $resultdata . PHP_EOL . PHP_EOL;

    file_put_contents($log_filename, $bkash_response);

    return json_decode($resultdata, true);    
}

function encDec($action, $string)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = sha1("ZXExeXJmdG1HU0tGTTlXQW9GRUg0dz09");
    $secret_iv = sha1("ZXExeXJmdG1HU0tGTTlXQW9GRUg0dz09");
    $key = hash("sha256", $secret_key);
    $iv = substr(hash("sha256", $secret_iv), 0, 16);
    if( $action == "encrypt" ) 
    {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    }
    else
    {
        if( $action == "decrypt" ) 
        {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

    }

    return $output;
}

function getCurrentDateTime(){
    $date = new DateTime();
    $date->setTimezone(new DateTimeZone('GMT+6')); //Time Zone GMT +6
    $dt= $date->format('Y-m-d h:i:s A');
    return $dt;
}
function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}
?>
