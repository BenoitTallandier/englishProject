<?php
    include("DBConnection.php");
	session_start();
    extract(mysqli_fetch_array(mysqli_query($db,"SELECT model FROM user WHERE idUSer=".$_SESSION['user'])));
    $r = mysqli_query($db,"SELECT mot FROM vocabulaire WHERE mot LIKE '%".$model."%' ORDER BY RAND");
    extract(mysqli_fetch_array($r));
    $tmp = exec("python AnglaisBeuhBeuh.py $mot");
    parse_str($tmp,$output);
    echo "word : ".$mot."</br>";
    if(!empty($output['translation']) && !empty($output['translation'])){
        echo "translation : ".$output['translation']."</br>";
        echo "definition : ".$output['definition']."</br>";
    }
?>
