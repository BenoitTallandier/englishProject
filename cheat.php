<?php
    session_start();
    include("DBConnection.php");
    $q = mysqli_query($db,"SELECT model FROM user WHERE idUser=(SELECT tour FROM partie)");
    extract(mysqli_fetch_array($q));
    $q = mysqli_query($db,"SELECT mot FROM vocabulaire WHERE mot LIKE '%".$model."%' ");
    extract(mysqli_fetch_array($q));
    echo $mot;

?>
