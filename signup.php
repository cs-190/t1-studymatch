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
if ($name !== filter_var($name, FILTER_SANITIZE_STRING)) {
    echo "Login Failure, Not a valid name!";
    header('Refresh: 2; URL=signuppage.html');
    exit;
}
$email = $_POST['email'];
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo "Login Failure, Not a valid email!";
    header('Refresh: 2; URL=signuppage.html');
    exit;
}

if($_POST['pass'] !== $_POST['confirmpass']){
  echo "Password Mismatch";
  header('Refresh: 2; URL=signuppage.html');
}
else{
  $password = $_POST['pass'];

if (($password !== filter_var($password, FILTER_SANITIZE_STRING)) || ($password==NULL)) {
    echo "Login Failure, Not a valid password!";
    header('Refresh: 2; URL=signuppage.html');
    exit;
}



$passwordHash = password_hash($password, PASSWORD_DEFAULT);
$check = "SELECT Email FROM Users WHERE Email = :email";
  $prepC = $db->prepare($check);
  $prepC->execute(array(':email' => $email));
  if($prepC->rowCount() == 0){
    $sqlq = "INSERT INTO Users (User,Password,Email) VALUES (:user,:password,:email)";
	$getready = $db->prepare($sqlq);
	$getready->execute(array(':user' => $name,':password'=> $passwordHash, ':email'=>$email));
	$_SESSION["Name"] = $name;
	$_SESSION["email"] = $email;
	echo "Sign Up Successful";
	header('Refresh: 2; URL=user-profile/create-profile');
  }
  else{
  	echo "Emailed Already Signed Up.";
	header('Refresh: 2; URL=loginpage.html');
  }
}
