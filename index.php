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
		<title>TicTac</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script type="text/javascript" src='js/app.js'></script>	
	</head>
	<body>
		<div class="container" >
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-centered">
					<button id="buttonReady" type="button" class="btn btn-danger">Ready</button>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 col-centered">
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-centered">
					<div class='row'>					
						<div class="col-sm-4 col-sm-offset-4 col-centered">
							<div style='display:inline-block;margin:20px;'>
								<div id='user0' class='user'>
									<div id='name0'></div>
									<img  width=100px src='img/user.png'>
								</div>
								<div id='proposition0'></div>
								<div id="compteur0"></div>
							</div>
							<div style='display:inline-block;'>
								<div id='user1' class='user'>
									<div id='name1'></div>
									<img  width=100px src='img/user.png'>
								</div>
								<div id='proposition1'></div>
								<div id="compteur1"></div>
							</div>
						</div>
					</div>
					<div class='row'>
						<div class="col-sm-3 col-centered">
							<div class='item'>
								<div id='model'></div>
							</div>
							<!--<img src='img/bomb.png' id='bomb'>-->

							<div class='item'>
								<input type="text" id='word' style="width:150px" class="input-sm form-control" placeholder="Mot">								
							</div>	
						</div>
					</div>
				</div>
			</div>
		<!--modal-->
		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Login to Your Account</h1><br>
				  <form>
					<input type="text" name="user" placeholder="Username">
					<input type="password" name="pass" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				  </form>
					
				  <div class="login-help">
					<a href="#">Register</a> - <a href="#">Forgot Password</a>
				  </div>
				</div>
			</div>
		  </div>
		<!--modal-->
		</div>

	</body>
</html>