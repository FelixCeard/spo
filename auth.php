<?php
include 'functions.php';

if(isset($_POST["type"])){ // check if type exists

  if($_POST["type"] == "signup"){ // if type => Signup

    //check if all other data exists
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["mail"])){

    //check valid username
      //remove not valid characters
      $checked = delBad($_POST["username"]);
      //if cleaned username is different than the original username
      if($checked != $_POST["username"]){
        exit("bad username, use only lettery from A to z and numbers<br>check if you have a space included");
        //if the username is nothing
      }elseif($checked == ""){
        exit("please enter a username");
      }

      if (filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {

        signup( $db , $_POST["username"] , $_POST["password"], $_POST["password"] );
        echo "<br>signup<br>";
        if(isset($_SESSION["logged_in"])){
          if($_SESSION["logged_in"]){
            header("Location: app.php");
          }
        }
      }




    }

  }
}


 ?>
