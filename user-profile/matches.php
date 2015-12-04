<?php
session_start();
?>
<html>
    <head>
      <head>
        <meta charset="utf-8" />

        <!-- jQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <!-- Firebase -->
        <script src="https://cdn.firebase.com/js/client/2.0.2/firebase.js"></script>

        <!-- Firechat -->
        <link rel="stylesheet" href="https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.css" />
        <script src="https://cdn.firebase.com/libs/firechat/2.0.1/firechat.min.js"></script>

        <!-- Custom CSS -->
        <style>
          #firechat-wrapper {
            height: 475px;
            max-width: 325px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            margin: 50px auto;
            text-align: center;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: 0 5px 25px #666;
            -moz-box-shadow: 0 5px 25px #666;
            box-shadow: 0 5px 25px #666;
          }
          a#firechat-btn-rooms {
            visibility: hidden;
          }
          a.btn.full.firechat-dropdown-toggle{
            visibility: hidden;
          }

        </style>
      </head>
            <link href="assets/css/bootstrap.css" rel="stylesheet" />
    </head>
    <div id="firechat-wrapper"></div>
    <script type="text/javascript">
    var chatRef = new Firebase("https://davidschat.firebaseio.com/");
    var chat = new FirechatUI(chatRef, document.getElementById("firechat-wrapper"));
    $(function() {

    chatRef.onAuth(function(authData) {
      if (authData) {
        chat.setUser(authData.uid, <?php echo "'".$_SESSION['Name']."'";?>);
      } else {
        chatRef.authAnonymously(function(error, authData) {
          if (error) {
            console.log("hey");
          }
        });
      }
    });
    });

    </script>
<body>
<?php
$db = getDB();
$check = "SELECT userIDTwo FROM UserConnects WHERE userIDOne = :uone";
$prepC = $db->prepare($check);
$prepC->execute(array(':uone' => $_SESSION["id"]));
$allmatches = $prepC->fetchAll();


foreach($allmatches as $match){
  $usera = "SELECT User,Biography,Image,Email,id FROM Users WHERE id = :uone";
  $fusers = $db->prepare($usera);
  $fusers->execute(array(':uone' => $match["userIDTwo"]));
  $person = $fusers->fetch();
  $chat = $person["id"];
  if($_SESSION["id"]<$chat){
     $thing = hash('ripemd160', $_SESSION["id"]."hi".$chat);
  }
  else{
    $thing = hash('ripemd160', $chat."hi".$_SESSION["id"]);
  }
  $check = "SELECT * FROM UserConnects WHERE chat = :chat";
  $db = getDB();
  $prepC = $db->prepare($check);
  $prepC->execute(array(':chat' => $thing));
  $goodgood = $prepC ->fetch();
  $emailtouse = $person["Email"];
  echo $person["User"];
  echo ":   ";
  echo $person["Biography"];
  echo "<br>";
  echo "Chat with me at: ";
  echo "<a id='".$person['id']."'>Chat</a>";
  echo "<script type='text/javascript'>";
  echo "$(function() {";
  echo "$('#".$person['id']."').click(function(){
    chat._chat.enterRoom('".$goodgood["chatid"]."');})});";
    echo '</script>';

  echo "<br>";


  echo "<img class='img-responsive-test' src='create-profile/".$person["Image"]."'></img>";

  echo "<br><br><br><br><br>";
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

?>
