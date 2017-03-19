<?php
    include("DBConnection.php");
    if(isset($_GET['m'])){
        $r = mysqli_query($db,"SELECT mot FROM vocabulaire WHERE mot LIKE '%".$_GET['m']."%' ORDER BY idMot DESC");
        extract(mysqli_fetch_array($r));
        $tmp = exec("python AnglaisBeuhBeuh.py $mot");
        parse_str($tmp,$output);
        echo "word : ".$mot."</br>";
        echo "translation : ".$output['translation']."</br>";
        echo "definition : ".$output['definition']."</br>";
    }
?>
