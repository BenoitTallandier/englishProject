<?php
    session_start();
    include("DBConnection.php");
    if(isset($_GET['time'])){
        mysqli_query($db,"UPDATE user SET time=".$_GET['time']." WHERE idUser='".$_SESSION['user']."'");
    }
?>
