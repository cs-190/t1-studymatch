<?php
session_start();
error_reporting(E_ALL);

putData();

function imgUp(){
  if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
       $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 2097152){
       $errors[]='File size must be excately 2 MB';
	}

    if(empty($errors)==true){
       $val = move_uploaded_file($file_tmp,$file_name);
       return $file_name;
    }
    else{
       print_r($errors);
    }
 }
 }


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


 function putData(){
   $db = getDB();
   $img = imgUp();
   //$_SESSION["image"] = $image;
   $major = $_POST["major"];
   $grade = $_POST["grade"];
   $bio = $_POST["biography"];
   $sql= "UPDATE Users SET Major=:major, GradeLevel = :grade, Image = :img, Biography = :bio WHERE email= :email";
   $prepGetUser = $db->prepare($sql);
   $prepGetUser->execute(array(':major' => $major,':grade' => $grade,':img' =>$img, ':bio' => $bio, ':email' =>$_SESSION['email']));
   getProfile($_SESSION["email"]);
   header('Refresh: 0; URL=../index.php');

 }

 function getProfile($userEmail){
   $db = getDB();
   $sqlProfile = "SELECT Image,Biography,GradeLevel,Major FROM Users WHERE Email = :email LIMIT 1";
   $prepProfile = $db->prepare($sqlProfile);
   $prepProfile->execute(array(':email' => $userEmail));
   $user = ($prepProfile->fetch());
   $_SESSION['email'] = $userEmail;
   $_SESSION["image"] = $user["Image"];
   $_SESSION["biography"] = $user["Biography"];
   $_SESSION["year"] = $user["GradeLevel"];
   $_SESSION["major"] = $user["Major"];
 }
