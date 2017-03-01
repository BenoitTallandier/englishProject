<?php
	session_start();
	include("DBConnection.php");

	if(!isset($_GET['ready'])){
		$r = mysqli_query($db,"SELECT * FROM user WHERE ready=0");
		if(mysqli_fetch_array($r)){
			echo "false";
		}
		else{
			$_SESSION['init']=1;
			echo "true";
		}
	}
	else{
		$_SESSION['pseudo'] = $_GET['pseudo'];
		$query = "UPDATE user SET ready=1,name='".$_GET['pseudo']."' WHERE idUser='".$_SESSION['user']."'";
		mysqli_query($db,$query);
		echo $query;
	}
?>
