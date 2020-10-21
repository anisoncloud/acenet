<?php
//session_start();

echo '<pre>';
echo 'dd'; exit;

$paymentID = 'PTL4LRT1598255236243';
$request_query_payment=bkash_Query_Payment($paymentID);
print_r($request_query_payment);

$response_query_payment = json_decode($request_query_payment['API Response'],true);
$trxID = '';
if(isset($response_query_payment['trxID'])){
    $trxID=$response_query_payment['trxID'];
}
$request_search_payment=bkash_Search_Payment($trxID);
print_r($request_search_payment);
echo $_SESSION['token']; exit;


$request_token=bkash_Get_Token();
print_r($request_token);

$response_token = json_decode($request_token['API Response'],true);
$idtoken=$response_token['id_token'];
$_SESSION['token']=$idtoken;

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);

//$array['token']=$idtoken;

$newJsonString = json_encode($array);
file_put_contents('config.json',$newJsonString);


$request_create_payment=bkash_Create_Payment();
print_r($request_create_payment);

$response_create_payment = json_decode($request_create_payment['API Response'],true);
$paymentID=$response_create_payment['paymentID'];

$request_execute_payment=bkash_Execute_Payment($paymentID);
print_r($request_execute_payment);

$request_query_payment=bkash_Query_Payment($paymentID);
print_r($request_query_payment);

$response_query_payment = json_decode($request_query_payment['API Response'],true);
$trxID = '';
if(isset($response_query_payment['trxID'])){
    $trxID=$response_query_payment['trxID'];
}
$request_search_payment=bkash_Search_Payment($trxID);
print_r($request_search_payment);

function bkash_Search_Payment($trxID){
    
    $output = [];
    $output['API Title'] = 'Search Payment';
    $output['API URL'] = '';
    $output['Request Body'] = '';
    $output['API Response'] = '';
    
    $strJsonFileContents = file_get_contents("config.json");
    $array = json_decode($strJsonFileContents, true);
    //$paymentID = $_GET['paymentID'];
    $proxy = $array["proxy"];

    $url = curl_init($array["searchURL"].$trxID);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$_SESSION["token"],
        'x-app-key:'.$array["app_key"]              
    );	
    
    $output['API URL'] = $array["searchURL"].$trxID; 
    $output['Request Body'] = json_encode($header);

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    $resultdatax=curl_exec($url);
    curl_close($url);
    $output['API Response'] = $resultdatax;
    
    return $output;
}

function bkash_Query_Payment($paymentID){
    
    $output = [];
    $output['API Title'] = 'Query Payment';
    $output['API URL'] = '';
    $output['Request Body'] = '';
    $output['API Response'] = '';
    
    $strJsonFileContents = file_get_contents("config.json");
    $array = json_decode($strJsonFileContents, true);
    //$paymentID = $_GET['paymentID'];
    $proxy = $array["proxy"];

    $url = curl_init($array["queryURL"].$paymentID);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$_SESSION["token"],
        'x-app-key:'.$array["app_key"]              
    );	
    
    $output['API URL'] = $array["queryURL"].$paymentID; 
    $output['Request Body'] = json_encode($header);

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    $resultdatax=curl_exec($url);
    curl_close($url);
    $output['API Response'] = $resultdatax;
    
    return $output;
}

function bkash_Execute_Payment($paymentID){
    
    $output = [];
    $output['API Title'] = 'Execute Payment';
    $output['API URL'] = '';
    $output['Request Body'] = '';
    $output['API Response'] = '';
    
    $strJsonFileContents = file_get_contents("config.json");
    $array = json_decode($strJsonFileContents, true);
    //$paymentID = $_GET['paymentID'];
    $proxy = $array["proxy"];

    $url = curl_init($array["executeURL"].$paymentID);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$_SESSION["token"],
        'x-app-key:'.$array["app_key"]              
    );	
    
    $output['API URL'] = $array["executeURL"].$paymentID; 
    $output['Request Body'] = json_encode($header);

    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);

    $resultdatax=curl_exec($url);
    curl_close($url);
    $output['API Response'] = $resultdatax;
    
    return $output;
}

function bkash_Create_Payment(){
    
    $output = [];
    $output['API Title'] = 'Create Payment';
    $output['API URL'] = '';
    $output['Request Body'] = '';
    $output['API Response'] = '';
    
    $strJsonFileContents = file_get_contents("config.json");
    $array = json_decode($strJsonFileContents, true);
    $amount = 100;
    $invoice = rand(); //"46f647h7"; // must be unique
    $intent = "sale";
    $proxy = $array["proxy"];
    $createpaybody=array('amount'=>$amount, 'currency'=>'BDT', 'merchantInvoiceNumber'=>$invoice,'intent'=>$intent);   
    $url = curl_init($array["createURL"]);

    $createpaybodyx = json_encode($createpaybody);

    $header=array(
        'Content-Type:application/json',
        'authorization:'.$_SESSION["token"],
        'x-app-key:'.$array["app_key"]
    );

    $output['API URL'] = $array["createURL"]; 
    $output['Request Body'] = json_encode($header);
    
     $output['Request Body'] .= $createpaybodyx;
    
    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
    curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
    curl_setopt($url,CURLOPT_POSTFIELDS, $createpaybodyx);
    curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
    //curl_setopt($url, CURLOPT_PROXY, $proxy);
    
    $resultdata = curl_exec($url);
    curl_close($url);
    
    $output['API Response'] = $resultdata;
    return $output;
}

function bkash_Get_Token(){
    
    $output = [];
    $output['API Title'] = 'Grant Token';
    $output['API URL'] = '';
    $output['Request Body'] = '';
    $output['API Response'] = '';
    
    $strJsonFileContents = file_get_contents("config.json");
    $array = json_decode($strJsonFileContents, true);
    $post_token=array(
    'app_key'=>$array["app_key"],                                              
            'app_secret'=>$array["app_secret"]                  
    );	
    
    $output['API URL'] = $array["tokenURL"]; 
    $output['Request Body'] = json_encode($post_token);
    
    $url=curl_init($array["tokenURL"]);
	$proxy = $array["proxy"];
	$posttoken=json_encode($post_token);
	$header=array(
		'Content-Type:application/json',
		'password:'.$array["password"],                                                               
        'username:'.$array["username"]                                                           
    );	
        
    $output['Request Body'] .= json_encode($header);
    
    curl_setopt($url,CURLOPT_HTTPHEADER, $header);
	curl_setopt($url,CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($url,CURLOPT_POSTFIELDS, $posttoken);
	curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
	//curl_setopt($url, CURLOPT_PROXY, $proxy);
	$resultdata=curl_exec($url);
        
	curl_close($url);
        
        $output['API Response'] = $resultdata;
        
	return $output;    
        //return json_decode($resultdata, true); 
}
?>
