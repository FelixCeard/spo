<?php
include 'functions.php';
if(isset($_SESSION["token"])){
  $valid_token = validToken($db,$_SESSION["token"]);
  if($valid_token){
    echo "your token is valid";
  }else {
    echo "your token is <b>not</b> valid";
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>app spotify DING</title>
  </head>
  <body>
<h1>App</h1>
<a href="logout.php">logout</a>
  </body>
</html>
