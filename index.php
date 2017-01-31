<!DOCTYPE html>
<?php
	session_start();
	include("DBConnection.php");
	$_SESSION['user']=rand	(0,1);
	echo "<div id='session'>".$_SESSION['user']."</div>";
	$_SESSION['joueur'] = Array(0,1);
	$_SESSION['index'] = $_SESSION['user'];

?>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src='js/app.js'></script>
		
	</head>
	<body>
		<div style='display:inline-block;'>
			<img id='user0' class='user' style='border:solid;'width=100px src='img/user.jpg'>
			<span id='proposition0'></span>
			<div id="compteur0"></div>
		</div>
		<div style='display:inline-block;'>
			<img id='user1' class='user' style='border:solid;' width=100px src='img/user.jpg'>
			<span id='proposition1'></span>
			<div id="compteur1"></div>
		</div><br><br>
		<?php
			$r = mysqli_query($db,"SELECT * FROM vocabulaire ORDER BY RAND() LIMIT 1");
			if($l = mysqli_fetch_array($r)){
				extract($l);
				$length = strlen($mot);
				$nb = rand(0,$length-3);
				$_SESSION['model'] = substr($mot,$nb,3);
				echo "<span id='model' >".$_SESSION['model']."</span><br>";
			}
			
		?>
		<!--<img src='img/bomb.png' id='bomb'>-->

		<br><input type='text' id='word' style='border:solid;border-width:1px;border-color:black;'>
		
	</body>
</html>