<?php
session_start();
$chat = $_GET["chatid"];
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
<!DOCTYPE html>
<html>
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
    </style>
  </head>

  <!--
    Example: Anonymous Authentication

    This example uses Firebase Simple Login to create "anonymous" user sessions in Firebase,
    meaning that user credentials are not required, though a user has a valid Firebase
    authentication token and security rules still apply.

    Requirements: in order to use this example with your own Firebase, you'll need to do the following:
      1. Apply the security rules at https://github.com/firebase/firechat/blob/master/rules.json
      2. Enable the "Anonymous" authentication provider in Forge
      3. Update the URL below to reference your Firebase
      4. Update the room id for auto-entry with a public room you have created
   -->
  <body>
    <p id="shit"> hi. </p>
    <div id="firechat-wrapper"></div>
    <script type="text/javascript">
    $(function() {
      var pe = "";
      pe = "<?php echo $path; ?>";
      $("#shit").click(function(){
-     chat._chat.enterRoom("<?php echo $goodgood["chatid"] ?>");});
    /*$.get( "rando.php", function( data ) {
        pe = data;
    },"json");*/

      var chatRef = new Firebase("https://davidschat.firebaseio.com/");
      var chat = new FirechatUI(chatRef, document.getElementById("firechat-wrapper"));
      /*chatRef.authWithCustomToken(pe, function(error, authData) {
        if (error) {
          console.log("Login Failed!", error);
        } else {
          console.log("Login Succeeded!", authData);
        }
      });*/
      chatRef.onAuth(function(authData) {
        if (authData) {
          chat.setUser(authData.uid, "Anon" + authData.uid.substr(10, 8));
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
  </body>
</html>
