<?php

session_start();
$usertwo = $_POST["email"];
$answer = $_POST["answer"];

$db = getDB();
$sqlG = "SELECT id FROM Users WHERE Email = :email LIMIT 1";
$prepG = $db->prepare($sqlG);
$prepG->execute(array(':email' => $usertwo));
if ($prepG->rowCount() == 1) {
    $idTwo = $prepG->fetchColumn(0);
}
if($answer == 'yes'){
  $check = "SELECT userIDOne,userIDTwo FROM UserMatch WHERE userIDOne = :uone AND userIDTwo = :utwo";
  $prepC = $db->prepare($check);
  $prepC->execute(array(':uone' => $_SESSION["id"],':utwo' => $idTwo));
  if($prepC->rowCount() == 0){
    $sqlIns = "INSERT INTO UserMatch (userIDOne,userIDTwo,yay_nay) VALUES (:userIDOne,:userIDTwo,:yay_nay)";
    $prepIns = $db->prepare($sqlIns);
    $prepIns->execute(array(':userIDOne' => $_SESSION["id"],':userIDTwo' => $idTwo,':yay_nay' => 1));
    if(checkifinmatch($_SESSION["id"],$idTwo)){
      insertDouble($_SESSION["id"],$idTwo);
      $_SESSION["doub"] = true;
      $_SESSION["lastid"] = $idTwo;
    }
    else{
      $_SESSION["doub"] = false;
    }
  }
}
else{
  $sqlIns = "INSERT INTO UserMatch (userIDOne,userIDTwo,yay_nay) VALUES (:userIDOne,:userIDTwo,:yay_nay)";
  $prepIns = $db->prepare($sqlIns);
  $prepIns->execute(array(':userIDOne' =>$_SESSION["id"],':userIDTwo' => $idTwo,':yay_nay' => 0));
}

function checkifinmatch($u1,$u2){
  $db = getDB();
  $check = "SELECT userIDOne,userIDTwo,yay_nay FROM UserMatch WHERE userIDOne = :uone AND userIDTwo = :utwo AND yay_nay = :yay_nay";
  $prepC = $db->prepare($check);
  $prepC->execute(array(':uone' => $u1,':utwo' => $u2, ':yay_nay' => 1));
  if($prepC->rowCount() == 1){
    $check = "SELECT userIDOne,userIDTwo,yay_nay FROM UserMatch WHERE userIDOne = :uone AND userIDTwo = :utwo AND yay_nay = :yay_nay";
    $prepC = $db->prepare($check);
    $prepC->execute(array(':uone' => $u2,':utwo' => $u1, ':yay_nay' => 1));
    if($prepC->rowCount() == 1){
      return true;
    }
  }
  return false;
}


function insertDouble($u1,$u2){
  $db = getDB();
  $sqlIns = "INSERT INTO UserConnects (userIDOne,userIDTwo,chat) VALUES (:userIDOne,:userIDTwo,:chat)";
  $prepIns = $db->prepare($sqlIns);
  $prepIns->execute(array(':userIDOne' => $u1,':userIDTwo' => $u2,'chat' =>hasher($u1,$u2)));
  $sqlIns = "INSERT INTO UserConnects (userIDOne,userIDTwo,chat) VALUES (:userIDOne,:userIDTwo,:chat)";
  $prepIns = $db->prepare($sqlIns);
  $prepIns->execute(array(':userIDOne' => $u2,':userIDTwo' => $u1, 'chat' => hasher($u1,$u2)));
}

function hasher($u1,$u2){
  if($u1<$u2){
    return hash('ripemd160', $u1."hi".$u2);
  }
  else{
    return hash('ripemd160', $u2."hi".$u1);
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
