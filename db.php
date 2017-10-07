<?php

//function for getting a protected value from an object
function getProtectedValue($obj,$name) {
  $array = (array)$obj;
  $prefix = chr(0).'*'.chr(0);
  return $array[$prefix.$name];
}


try {//try to connect to the database
  $db = new PDO('mysql:host=localhost;dbname=spotifyJAJAJA;charset=utf8', 'root', '');
  // database existst
} catch (Exception $e) { //dealing with errors
  // database missing
  $code = getProtectedValue($e,"code");
  $db = new PDO('mysql:host=localhost;charset=utf8', 'root', '');
  if($code == 1049){
    // create new database
    $sql = "CREATE DATABASE IF NOT EXISTS spotifyJAJAJA";
    $response = $db->exec($sql);

    // create new table
    $table= "user";
    $columns = "Username VARCHAR( 20 ) NOT NULL , Password VARCHAR( 255 ) NOT NULL , Mail VARCHAR( 250 ) NOT NULL" ;
    $createTable = $db->exec("CREATE TABLE spotifyJAJAJA.$table ($columns)");
    
  }
}





 ?>
