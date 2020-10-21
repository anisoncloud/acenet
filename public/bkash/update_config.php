<?php
require_once 'include.php';

$strJsonFileContents = file_get_contents("config.json");
$array = json_decode($strJsonFileContents, true);

if(isset($array['encrypted']) && $array['encrypted']=='yes'){
    //echo '<pre>Encrypted';print_r($array);
    echo 'no changes';
}
else{
   $array['encrypted']='yes';
   $array['app_key']= encDec('encrypt', $array['app_key']);
   $array['app_secret']= encDec('encrypt', $array['app_secret']);
   $array['username']= encDec('encrypt', $array['username']);
   $array['password']= encDec('encrypt', $array['password']);
   //echo '<pre>';print_r($array);
   file_put_contents("config.json", json_encode($array));
   
   echo 'updated';
}

?>
