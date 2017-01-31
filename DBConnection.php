<?php
$host_name  = "localhost";
$database   = "anglais";
$user_name  = "root";
$password   = "";
$db = mysqli_connect($host_name, $user_name, $password, $database);
if(mysqli_connect_errno()) {die('The connection to the database could not be established.');}
$db->set_charset("utf8");
?>