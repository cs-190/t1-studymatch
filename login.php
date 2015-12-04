<?php
session_start();
error_reporting(E_ALL);


logintry($dsn,$username,$password);


function getDB(){
  $dsn = 'mysql:host=cgi.cs.duke.edu;port=3306;dbname=fml6;';
  $username = 'fml6';
  $password = 'qNT25+3qTRxZ';
  try {
      $db = new PDO($dsn, $username, $password);

  } catch(PDOException $e) {
      die('Could not connect to the database:<br/>' . $e);
  }
  return $db;
}


function logintry($dsn, $username, $password){

  $db = getDB();
  $email = $_POST['email'];
  $password = $_POST['pass'];

  $passwordHash = password_hash($password, PASSWORD_DEFAULT);

  $sqlGetUser = "SELECT Password FROM Users WHERE Email = :email LIMIT 1";
  $prepGetUser = $db->prepare($sqlGetUser);
  $prepGetUser->execute(array(':email' => $email));
  if ($prepGetUser->rowCount() == 1) {
      $check = $prepGetUser->fetchColumn(0);
  }

  if(password_verify($password, $check)){
    $sqlGetName = "SELECT User FROM Users WHERE Email = :email LIMIT 1";
    $prepGetName = $db->prepare($sqlGetName);
    $prepGetName->execute(array(':email' => $email));
    if ($prepGetName->rowCount() == 1) {
        $_SESSION["Name"] = $prepGetName->fetchColumn(0);
    }
    //echo "Login Success!";
    echo "hi";
    getProfile($email);
    echo "Profile Success";
    header('Refresh: 2; URL=index.php');
  }
  else{
    echo "Login Failure, Try Again!";
    header('Refresh: 2; URL=loginpage.html');
  }
}


function getProfile($userEmail){
  echo "hi";
}
?>
