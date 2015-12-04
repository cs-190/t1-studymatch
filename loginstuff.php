<?php
session_start();
error_reporting(E_ALL);
$dsn = 'mysql:host=cgi.cs.duke.edu;port=3306;dbname=fml6;';
$username = 'fml6';
$password = 'qNT25+3qTRxZ';


try {
    $db = new PDO($dsn, $username, $password);

} catch(PDOException $e) {
    die('Could not connect to the database:<br/>' . $e);
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];



$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sqlq = "INSERT INTO Users (User,Password,Email) VALUES (:user,:password,:email)";

$getready = $db->prepare($sqlq);
$getready->execute(array(':user' => $name,':password'=> $passwordHash, ':email'=>$email));
include("login.php");
getProfile($email);
$_SESSION["email"] = $email;
echo "Entered data successfully\n";
