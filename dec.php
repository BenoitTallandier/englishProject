<?php
    session_start();
    include("DBConnection.php");
    $r = mysqli_query($db,"DELETE FROM user WHERE idUser=".$_SESSION['user']."");
    session_destroy();
?>
