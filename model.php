<?php
	session_start();
	include("DBConnection.php");

	$r = mysqli_query($db,"SELECT * FROM vocabulaire ORDER BY RAND() LIMIT 1");
	if($l = mysqli_fetch_array($r)){
		extract($l);
		$length = strlen($mot);
		$nb = rand(0,$length-3);
		$_SESSION['model'] = substr($mot,$nb,3);
		$query = "UPDATE user SET model='".$_SESSION['model']."' WHERE idUser='".$_SESSION['user']."'";
		mysqli_query($db,$query);
		echo $_SESSION['model'];
	}

?>
