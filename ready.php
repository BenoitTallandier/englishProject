<?php
	session_start();
	include("DBConnection.php");

	if(!isset($_GET['ready'])){
		$r = mysqli_query($db,"SELECT * FROM user WHERE ready=0");
		if(mysqli_fetch_array($r)){
			echo "false";
		}
		else{
			echo "true";
		}
	}
	else{
		$query = "UPDATE user SET ready=1 WHERE idUser='".$_SESSION['user']."'";
		mysqli_query($db,$query);
		echo $query;
	}
?>