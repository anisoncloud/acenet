<?php
$productName = $_POST['productName'];
$productPrice = $_POST['productPrice'];
$productOtc = $_POST['productOtc'];
$totalCost = $productPrice + $productOtc;

echo 'Package Name: '. $productName.'<br/>';
echo 'Package Price: '.$productPrice.'<br/>';
echo 'Package OTC: '.$productOtc.'<br/>';
echo 'Total Cost :' .$totalCost;
?>