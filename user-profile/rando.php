<?php
session_start();
error_reporting(E_ALL);
include_once "TokenException.php";
include_once "TokenGenerator.php";
//use firebase-token-generator-php-master\src\TokenException;
//use firebase-token-generator-php-master\src\TokenGenerator;

try {
    $generator = new TokenGenerator('afMJ42Yfa6kiOQhkCyVXaWYBaHkWx0LU2TL7e9pp');
    $generator->setData(array('uid' => "uniqueId1"))->create();
    echo "hi";
} catch (TokenException $e) {
    echo "Error: ".$e->getMessage();
}

//echo $token;
?>
