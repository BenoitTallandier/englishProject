<?php
	session_start();
	include("DBConnection.php");

	if(!isset($_GET['t'])){	
		$r = mysqli_query($db,"SELECT * FROM partie");
		if($l = mysqli_fetch_array($r)){
			extract($l);
			echo $time;
		}
	}
	else{
		$r = mysqli_query($db,"UPDATE partie SET time='".$_GET['t']."'");
	}
?>
