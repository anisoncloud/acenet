<?php
require_once 'include.php';
_client();

$invoice_data = json_decode(encDec('decrypt', $_SESSION['invoice_data']));

$idtoken = $_SESSION['token'];
$token = encDec('decrypt', $idtoken);

$log_filename = "logs/" . $_SESSION['customer_id'] . "/" . $_SESSION['log_file'] . ".txt";
$bkash_response = file_get_contents($log_filename);
$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);
$proxy = $array["proxy"];

$amount = $_GET['amount'];
$invoice = $_GET['invoice']; //"46f647h7"; // must be unique
$intent = $_GET['intent'];


//
if($invoice_data->total!=$amount){
    $output=[];
    $output['errorMessage'] = "Invalid Amount.";
    echo json_encode($output);
    exit;
}
if($invoice_data->invoice!=$invoice){
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
?>
