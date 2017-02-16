<?php
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
				if($compteur == 0 && $tour<$idUser){//cas d'initialisation
					mysqli_query($db,"UPDATE partie SET tour='".$idUser."'");
				}
			}
			echo "<div id='user".$idUser."' class='user'>
					<div id='name".$idUser."'>".$name.",".$idUser."</div>";
					if($idUser == $tour){
						echo "<img  width=100px src='img/userRed.png'>";
					}
					else{
						echo "<img  width=100px src='img/user.png'>";
					}
				echo"</div>
			<div id='proposition".$idUser."'>".$proposition."</div>
		</div>";
		$compteur++;
		}
	}


?>
