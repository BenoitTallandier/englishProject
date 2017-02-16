<?php
    session_start();
    include("DBConnection.php");
    echo "ARRAY";
        print_r($_SESSION['joueur']);
    echo "ARRAY</br>";
?>
