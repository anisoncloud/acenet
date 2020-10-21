<?php
require_once 'include.php';
_client();

$invoice_data = json_decode(encDec('decrypt', $_SESSION['invoice_data']));

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

//Billing API START
//$resultdata = '{"paymentID":"ZM4XHY71599734349356","createTime":"2020-09-10T10:39:09:397 GMT+0000","updateTime":"2020-09-10T10:39:24:878 GMT+0000","trxID":"7IA102QZCB","transactionStatus":"Completed","amount":"500.00","currency":"BDT","intent":"sale","merchantInvoiceNumber":"INV-692062873","refundAmount":"0"}';
$data_string = $resultdata;
$checkoutUrl = $_SESSION['srv_url'] . '/billing/bkash-checkout.php?s=' . encDec('encrypt',$invoice_data->invoice);       
$url = curl_init($checkoutUrl);

$bkash_response .= getCurrentDateTime() . PHP_EOL;
$bkash_response .= 'API Title : ' . 'Server Billinng API' . PHP_EOL;
$bkash_response .= 'API URL : ' . $checkoutUrl . PHP_EOL;

curl_setopt($url, CURLOPT_HTTPHEADER, array( "Content-Type: application/json", "Content-Length: " . strlen($data_string) ));
curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($url, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
//curl_setopt($url, CURLOPT_PROXY, $proxy);

if(isLocalhost()){
    curl_setopt($url, CURLOPT_SSL_VERIFYPEER, false);
}

$resultdata_billingapi=curl_exec($url);
if($resultdata_billingapi === false)
{
    $resultdata_billingapi = json_encode(array("message"=> curl_error($url)));
}
$bkash_response .= 'Billing API Response : ' . $resultdata_billingapi . PHP_EOL. PHP_EOL;
file_put_contents($log_filename, $bkash_response);

curl_close($url);
//Billing API END

echo $resultdata;
?>
