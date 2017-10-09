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


            $token = getToken();
            $newu = $db->prepare("INSERT INTO token (token,used) VALUES(:token,false)");// insert into the database the data

            $array = array("token" => $token);// insert into the database the data

            $executed = $newu->execute($array);
            if($executed){
              $_SESSION["token"] = $token;
              header("Location: app.php");
            }else {
              exit("internal error");
            }
          }
        }
      }else {
        echo "unvalid e-mail, <a href=\"index.php\">take another please</a>";
      }




    }

  }elseif($_POST["type"] == "login") {
    if(isset($_POST["username"]) && isset($_POST["password"])){
      if(isset($_POST["mail"])){
        header("Location: error.php?error=unvalid_post");
      }else {


        $login = login($db,$_POST["username"],$_POST["password"]);



        $newi = $db->prepare("INSERT INTO token VALUES (:token,:used)");// insert into the database the data
        $token = getToken();
        $array = array("token" => $token,"used" => false);// insert into the database the data

          if (!$newi->execute($array)) {
            exit("internal error");
          }else {
            $_SESSION["token"] = $token;
          }

          if($login){
            header("Location: app.php");
          }else {
            exit("wrong username or password, <a href=\"index.php\">try again please </a>");
          }



      }
    }

  }
}


 ?>
