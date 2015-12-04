<?php
session_start();

$chatid = $_POST["chatid"];
$chat = $_POST["chatname"];
addid($chatid,$chat);

function addid($c1,$c2){
  $db = getDB();
  //$sqlIns2 = "INSERT INTO UserConnects (chat,chatid) VALUES (:userIDOne,:userIDTwo)";
  $sqlIns = "UPDATE UserConnects SET chatid=:chatid WHERE chat=:chat";
  $prepIns = $db->prepare($sqlIns);
  $prepIns->execute(array(':chatid' => $c1,':chat' => $c2));
  //$prepIns->execute(array(':userIDOne' => $c1,':userIDTwo' => $c2));
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

?>
