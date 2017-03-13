<?php
	echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js' type='text/javascript'></script>
			<script src='js/bootstrap.min.js' type='text/javascript'></script>
			<link href='css/bootstrap.min.css rel='stylesheet'>
			<link href='css/theme.css' rel='stylesheet'>";
	session_start();
	include("DBConnection.php");
	extract(mysqli_fetch_array(mysqli_query($db,"SELECT * FROM partie")));

	$r = mysqli_query($db,"SELECT * FROM user");

	$_SESSION['joueur'] = [];
	$compteur = 0;
	if($r){
		while($l = mysqli_fetch_array($r)){
			extract($l);
			array_push($_SESSION['joueur'],$idUser);
			if($idUser == $_SESSION['user']){
				$_SESSION['index'] = $compteur;
				if($compteur == 0 && $tour<$idUser && $_SESSION['init']==0){//cas d'initialisation
					mysqli_query($db,"UPDATE partie SET tour='".$idUser."'");
				}
			}
			echo "<div id='user".$idUser."' class='col-sm-2 col-centered user'>
					<div style='text-align:center;' id='name".$idUser."'>".$name."</div>";
					if($idUser == $tour){
						echo "<img  width=100px src='img/userRed.png'>";
					}
					else{
						echo "<img  width=100px src='img/user.png'>";
					}
					echo"<span>";
						echo "<i class='glyphicon glyphicon-heart' aria-hidden='true'>x".$life."</i>";
					echo "</span>";
				echo"</div>
			<div id='proposition".$idUser."'>".$proposition."</div>
		</div>";
		$compteur++;
		}
	}


?>
