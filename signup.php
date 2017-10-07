<?php

//get the database
require_once 'db.php';

// get the user requested username and password
$username = "felix2";
$password = "test1234";
$mail = "felix2@test124.com";

$response = $db->query("SELECT * FROM user"); //get data from database

while ($data = $response->fetch()) {
  $dbuser = $data["Username"];
  if($dbuser == $username){
    exit("username taken -> <a href=\"#\">take anoter<a>"); // search for same username
  }
}
$newu = $db->prepare("INSERT INTO user VALUES(:username, :password,:mail)");// insert into the database the data
$array = array("username" => $username,"password"=>$password,"mail"=>$mail);// insert into the database the data
$newu->execute($array);// insert into the database the data

 ?>
