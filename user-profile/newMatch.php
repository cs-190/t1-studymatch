<?php
session_start();
error_reporting(E_ALL);

getNewMatch();


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

function getFirstMatch(){
  $datab = getDB();
  $sqlGetUser = "SELECT User,Biography,GradeLevel,Major,Image,Email,id FROM Users";
  $prepGetUser = $datab->prepare($sqlGetUser);
  $prepGetUser->execute();
  $users = $prepGetUser -> fetchAll();
  return $users;
}


function getNewMatch(){
  if(!isset($_SESSION["mcount"])){
    $_SESSION["mcount"] = 0;
  }
  if(!isset($_SESSION["counter"])){
    $_SESSION["counter"] = 0;
  }
  $thing = true;
  while($thing){
    $person = getFirstMatch()[$_SESSION["counter"]];
    if($_SESSION["mcount"]>= count(getFirstMatch())){
      $_SESSION["out"] = true;
    }
    else{
      $_SESSION["out"] = false;
    }
    if($_SESSION["out"] == true){
      $person["User"] = "blank";
      output($person);
      $thing = false;
    }
    else{
      $_SESSION["mcount"] = $_SESSION["mcount"]+ 1;
      if($_SESSION["counter"] >= count(getFirstMatch())-1){
        $_SESSION["counter"] = 0;
      }
      else{
        $_SESSION["counter"] = $_SESSION["counter"] + 1 ;
      }
      if(prevMatchCheck($_SESSION["id"],$person["id"])){
          output($person);
          $thing = false;
      }
    }
  }
}

  function output($person){
    echo json_encode($person);
  }


function prevMatchCheck($u1,$u2){
    $db = getDB();
    $check = "SELECT userIDOne,userIDTwo FROM UserMatch WHERE userIDOne = :uone AND userIDTwo = :utwo";
    $prepC = $db->prepare($check);
    $prepC->execute(array(':uone' => $u1,':utwo' => $u2));
    if(($prepC->rowCount() == 0) && ($u1!=$u2) ){
      return true;
    }
    else{
      return false;
    }
}
