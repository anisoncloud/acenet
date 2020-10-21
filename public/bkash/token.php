<?php
require_once 'include.php';
_client();

//To update config.json file from Payment Gateway setting run {URL}bkash/update_config.php 

$invoice_data = json_decode(encDec('decrypt', $_SESSION['invoice_data']));

$invoiceno = $invoice_data->invoice;//$_GET['i'];
if(isset($invoiceno)){
    $_SESSION['log_file'] =$invoiceno;
}
else{
    $_SESSION['log_file'] =session_id();
}

$bkash_path = "";
$customer_id = $_SESSION['customer_id'];
$log_file = $_SESSION['log_file'];

if(!is_dir($bkash_path . "logs/" . $customer_id)){
    mkdir($bkash_path . "logs/" . $customer_id, 0777);
}
$log_filename = $bkash_path . "logs/" . $customer_id . "/" . $log_file . ".txt";
if(!is_file($log_filename)){
    file_put_contents($log_filename, "");
}

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
//echo '<pre>';print_r($array);

$_SESSION['token'] = $array['token'];

if(isset($array['token_generated_on'])){ 
    $token_expires_in = 3600;
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

?>
