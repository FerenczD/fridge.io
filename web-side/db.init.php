<?php

header("Access-Control-Allow-Origin: *");
//error_reporting(E_ALL);

function OpenCon()
 {
 $dbhost = "127.0.0.1";
 $dbuser = "ferencz";
 $dbpass = "ese123";
 $db = "fridgeio";

 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);


 return $conn;
 }

 function CloseCon($conn)
 {
 $conn -> close();
 }
 ?>
