<?php
$host_name  = "137.74.194.232";
$database   = "anglais";
$user_name  = "remoteAcces";
$password   = "paozie";
$db = mysqli_connect($host_name, $user_name, $password, $database);
if(mysqli_connect_errno()) {die('The connection to the database could not be established.');}
$db->set_charset("utf8");
?>
