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

$gname = $_POST['groupname'];
$class = $_POST['classstudy'];
$loc = $_POST['location'];
$desc = $_POST['description'];



//$passwordHash = password_hash($password, PASSWORD_DEFAULT);

$sqlq = "INSERT INTO Groups (GroupName,Description,Class,Location) VALUES (:gname,:desc,:class,:loc)";

$getready = $db->prepare($sqlq);
$getready->execute(array(':gname' => $gname,':descr'=> $desc, ':loc'=>$loc, ':class' => $class ));
echo "Entered data successfully\n";
header('Refresh: 2; URL=index.php');



