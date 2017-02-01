<?php
session_start();
include("DBConnection.php");
if(isset($_GET['timeOut'])){
	mysqli_query($db,"UPDATE partie SET tour='".$_SESSION['joueur'][($_SESSION['index']+1)%count($_SESSION['joueur'])]."'");
	echo "no";
}
if(isset($_GET['word'])){
	mysqli_query($db,"UPDATE resultat SET proposition='".$_GET['word']."' WHERE idUser='".$_SESSION['user']."'");
	
	if(preg_match("/".$_SESSION['model']."/",$_GET['word'])){
		$r = mysqli_query($db,"SELECT * FROM vocabulaire WHERE mot='".$_GET['word']."'");
		if($l = mysqli_fetch_array($r)){			
			mysqli_query($db,"UPDATE partie SET tour='".$_SESSION['joueur'][($_SESSION['index']+1)%count($_SESSION['joueur'])]."'");
			echo "yes";
		}
	}
	else{
		echo "no";
	}
}
else{
	echo "no";
}
?>