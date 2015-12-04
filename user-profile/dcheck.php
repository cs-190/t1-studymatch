<?php
session_start();
if(isset($_SESSION["doub"])){
	if($_SESSION["doub"] == true){
  $thing = array();
  $thing["idtwo"] = $_SESSION["lastid"];
  $thing["d"] = "yes";
  if($_SESSION["id"]<$_SESSION["lastid"]){
     $thing["hasher"] = hash('ripemd160', $_SESSION["id"]."hi".$_SESSION["lastid"]);
  }
  else{
    $thing["hasher"] = hash('ripemd160', $_SESSION["lastid"]."hi".$_SESSION["id"]);
  }
  echo json_encode($thing); 
	}
else{
  $thing = array();
  $thing["d"] = "no";
  echo json_encode($thing);
	}
}
else{
  $thing = array();
  $thing["d"] = "no";
  echo json_encode($thing);
}
?>
