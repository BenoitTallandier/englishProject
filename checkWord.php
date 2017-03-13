<?php
session_start();
include("DBConnection.php");
if(isset($_GET['timeOut'])){
	$r = mysqli_query($db,"SELECT * FROM user WHERE idUser=".$_SESSION['user']);
	$l = mysqli_fetch_array($r);
	extract($l);
	if($life>1){
		$life = $life - 1;
		echo "UPDATE FROM user SET life=".$life." WHERE idUser=".$_SESSION['user'];
		mysqli_query($db,"UPDATE user SET life=".$life." WHERE idUser=".$_SESSION['user']);
	}
	else{
		mysqli_query($db,"DELETE FROM user WHERE idUser=".$_SESSION['user']);
		echo "out";
	}
	mysqli_query($db,"UPDATE partie SET tour='".$_SESSION['joueur'][($_SESSION['index']+1)%count($_SESSION['joueur'])]."'");
}
elseif(isset($_GET['word'])){
	mysqli_query($db,"UPDATE user SET proposition='".$_GET['word']."' WHERE idUser='".$_SESSION['user']."'");

	if(preg_match("/".$_SESSION['model']."/",$_GET['word'])){
		$r = mysqli_query($db,"SELECT * FROM vocabulaire WHERE mot='".$_GET['word']."'");
		if($l = mysqli_fetch_array($r)){
			mysqli_query($db,"UPDATE partie SET tour='".$_SESSION['joueur'][($_SESSION['index']+1)%count($_SESSION['joueur'])]."'");
			echo "yes";
		}
		else{
			echo "no";
		}
	}
	else{
		echo "no";
	}
}
elseif(isset($_GET['wordW'])){
	mysqli_query($db,"UPDATE user SET proposition='".$_GET['wordW']."' WHERE idUser='".$_SESSION['user']."'");
}
else{
	echo "no";
}
?>
