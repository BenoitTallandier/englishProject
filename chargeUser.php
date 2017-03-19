<?php
	//echos "<link href='css/bootstrap.min.css rel='stylesheet'><link href='css/theme.css' rel='stylesheet'>";
	session_start();
	include("DBConnection.php");
	extract(mysqli_fetch_array(mysqli_query($db,"SELECT * FROM partie")));

	$mod = mysqli_query($db,"SELECT model AS playingModel FROM user WHERE idUser=".$tour."");
	if($l = mysqli_fetch_array($mod)){
		extract($l);
	}

	$_SESSION['joueur'] = [];
	$compteur = 0;
	$r = mysqli_query($db,"SELECT * FROM user WHERE life>0");
	$total = mysqli_num_rows($r);
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
			$compteur++;
		}
	}

	$r = mysqli_query($db,"SELECT * FROM user");
	$total = mysqli_num_rows($r);

	if($r){
		$total = mysqli_num_rows($r);
		if($total==1){
			$line = mysqli_fetch_array($r);
			extract($line);
			echo "<div class='col-sm-2 col-centered'>";
				echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
			echo "</div>";
		}
		if($total==2){
			echo "<div class='row' >";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-1 col-sm-offset-0' >";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
				echo "<div class='col-sm-4 col-sm-offset-3' >";
				if(isset($playingModel)){
					if($_SESSION['user']==$tour){
						echo "<h3 style='color:blue;'>You have to find a word with : <span style='font-weight:bold;'>".$playingModel."</span></h3>";
					}
					else{
						echo "<h3 style='color:blue;'>He has to find a word with : <span style='font-weight:bold;'>".$playingModel."</span></h3>";
					}
				}
				echo "</div>";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-1 col-sm-offset-2'>";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
			echo "</div>";

		}
		if($total==3){
			echo "<div class='row' >";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-3 col-sm-offset-4'>";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
			echo "</div>";
			echo "<div class='row spaceRow'>";
				echo "<div class='col-sm-4 col-sm-offset-4'>";
					if(isset($playingModel)){
						if($_SESSION['user']==$tour){
							echo "<h3 style='color:blue;'>You have to find a word with : <span style='font-weight:bold;'>".$playingModel."</span>11</h3>";
						}
						else{
							echo "<h3 style='color:blue;'>He has to find a word with : <span style='font-weight:bold;'>".$playingModel."</span>11</h3>";
						}
					}
				echo "</div>";
			echo "</div>";
			echo "<div class='row' >";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-0'>";
				echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";

				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-7'>";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
			echo "</div>";

		}
		else if($total==4){
			echo "<div class='row' >";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-0'>";
				echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";

				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-7'>";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
			echo "</div>";

			echo "<div class='row spaceRow'>";
				echo "<div class='col-sm-4 col-sm-offset-4'>";
					if(isset($playingModel)){
						echo "<h3>He has to find a word with : <span style='font-weight:bold;'>".$playingModel."</span>11</h3>";
					}
				echo "</div>";
			echo "</div>";

			echo "<div class='row' >";
				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-0'>";
				echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";

				$line = mysqli_fetch_array($r);
				extract($line);
				echo "<div class='col-sm-2 col-sm-offset-7'>";
					echo afficheJoueur($idUser,$tour,$name,$proposition,$life);
				echo "</div>";
			echo "</div>";

		}

	}




/*		while($l = mysqli_fetch_array($r)){
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
						echo "<i class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red;'>&times;".$life."</i>";
					echo "</span>";
				echo"</div>
			<div id='proposition".$idUser."'>".$proposition."</div>
		</div>";
		$compteur++;
		}
	}*/


function afficheJoueur($idUser, $tour,$name,$proposition, $life){
	if($life<=0){
		$x = "<div id='user".$idUser."' class='col-sm-10 col-centered user' ><div style='text-align:center;' id='name".$idUser."'>".$name."</div><img  width=100px src='img/dead.jpg'><span><i class='glyphicon glyphicon-heart' aria-hidden='true' style='color:black;'>&times;".$life."</i></span></div><div id='proposition".$idUser."'>".$proposition."</div>";
	}
	else if($idUser==$tour){
		$x = "<div id='user".$idUser."' class='col-sm-10 col-centered user' ><div style='text-align:center;' id='name".$idUser."'>".$name."</div><img  width=100px src='img/userRed.png'><span><i class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red;'>&times;".$life."</i></span></div><div id='proposition".$idUser."'>".$proposition."</div>";
	}
	else{
		$x = "<div id='user".$idUser."' class='col-sm-10 col-centered user' ><div style='text-align:center;' id='name".$idUser."'>".$name."</div><img  width=100px src='img/user.png'><span><i class='glyphicon glyphicon-heart' aria-hidden='true' style='color:red;'>&times;".$life."</i></span></div><div id='proposition".$idUser."'>".$proposition."</div>";
	}
	return $x;
}
?>
