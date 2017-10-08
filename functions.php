<?php

session_start();
//function for getting a protected value from an object
function getProtectedValue($obj,$name) {
  $array = (array)$obj;
  $prefix = chr(0).'*'.chr(0);
  return $array[$prefix.$name];
}

function ConnectToDatabase($table="spotifyJAJAJA",$username = "root",$password = "")
{
  try {//try to connect to the database
    $db = new PDO("mysql:host=localhost;dbname=$table;charset=utf8", $username, $password);
    return $db;
    // database existst
  } catch (Exception $e) { //dealing with errors
    // database missing
    $code = getProtectedValue($e,"code");
    $db = new PDO('mysql:host=localhost;charset=utf8', $username, $password);
    if($code == 1049){
      // create new database
      $sql = "CREATE DATABASE IF NOT EXISTS $table";
      $response = $db->exec($sql);
      if(!$response){
        return false;
      }
      $db = new PDO("mysql:host=localhost;dbname=$table;charset=utf8", $username, $password);


      // create new table
      $table= "user";
      $columns = "Username VARCHAR( 20 ) NOT NULL , Password VARCHAR( 255 ) NOT NULL , Mail VARCHAR( 250 ) NOT NULL" ;
      $createTable = $db->exec("CREATE TABLE spotifyJAJAJA.$table ($columns)");
      if(!$createTable){
        return false;
      }
    }
  }
  return $db;
}

$db = ConnectToDatabase();
if($db == false){
  exit(
    "false"
  );
}

//signup
function signup($db,$username,$password,$mail)
{
  //get data from database
  $response = $db->query("SELECT Username FROM user");
  // get all username and passwords
  while ($data = $response->fetch()) {

    $dbuser = $data["Username"];

    // search for same username
    if($dbuser == $username){
      exit("username taken -> <a href=\"#\">take anoter<a>");
    }

  }

  $newu = $db->prepare("INSERT INTO user VALUES(:username, :password,:mail)");// insert into the database the data
  $array = array("username" => $username,"password"=>$password,"mail"=>$mail);// insert into the database the data
  $newu->execute($array);// insert into the database the data
  $response = login($db,$username,$password);
  if($response){
    echo "logged in";
  }else {
    echo "fail to login";
  }
}
function login($db,$username,$password){
  $sql = "SELECT Username, Password FROM user";
  $query = $db->query($sql);

  while ($data = $query->fetch()) {
    $dusername = $data["Username"];
    $dpassword = $data["Password"];
    if($username == $dusername){
      if($password == $dpassword){


        //LOGED IN
        $_SESSION["logged_in"] = true;
        $_SESSION["user"] = $username;


      return true;

      }else {
        return false;
      }
    }
  }
  return false;
}



// login( database , username , password );
// signup( databse , username , password, email );
// signup( $db , "username" , "password", "email@gmail.com" );



 ?>
