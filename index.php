<!DOCTYPE html>
<?php
	session_start();
	include("DBConnection.php");
		mysqli_query($db,"INSERT INTO user (name,ready,proposition,model,life) VALUES ('titi',0,'','',3)");
		$_SESSION['user'] = mysqli_insert_id($db);
		$_SESSION['pseudo'] = "";
		echo "<div id='session'>".$_SESSION['user']."</div>";
		$_SESSION['joueur'] = []; // MAJ dans charge
		$_SESSION['index'] = 0; //MAJ dans chargeUser
		$_SESSION['init'] = 0;
		echo "init : ".$_SESSION['init'];
?>
<html>
	<head>
		<title>TicTac</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="text/javascript"></script>
		<script src="js/bootstrap.min.js" type="text/javascript"></script>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/theme.css" rel="stylesheet">
		<script type="text/javascript" src='js/app.js'></script>
	</head>
	<body>
		<div class="container" >
			<div class="row startRow" >
				<!-- Button trigger modal -->
				<div class="col-sm-2 col-sm-offset-6 col-centered">
					<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
						Start
					</button>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
				    	<div class="modal-content">
				      		<div class="modal-body">
								<label for="recipient-name" class="control-label">nickname:</label>
								<input type='text' id='inputPseudo' class="form-control" placeholder="NickName">
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        		<button type="button" id="buttonReady" class="btn btn-primary">Ready</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
			</div>
			<div class="modal fade danger " id="loose" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-body">
							<strong>Error!</strong> You loose this game
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
			<div class="row playRow">
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
				    	<div class="modal-content">
				      		<div class="modal-body">
								<label for="recipient-name" class="control-label">nickname:</label>
								<input type='text' id='inputPseudo' class="form-control" placeholder="NickName">
				      		</div>
				      		<div class="modal-footer">
				        		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        		<button type="button" id="buttonReady" class="btn btn-primary">Ready</button>
				      		</div>
				    	</div>
				  	</div>
				</div>
				<div class="col-sm-4 col-sm-offset-4 col-centered">
					<div class="progress">
						<div class="progress-bar"></div>
					</div>
				</div>
			</div>
			<div class="row playRow">
				<div class='row' style='margin-top:30px;'>
					<div class="col-sm-3 col-centered">
						<div class='item'>
							You have to find a word with &quot;<span id='model'style="font-weight:bold;font-size:20px;"></span>&quot;
						</div>
						<div class='item'>
							<input type="text" id='word' style="width:150px" class="input-sm form-control" placeholder="Mot">
						</div>
					</div>
				</div>
				<div class="col-sm-12 col-centered">
					<div class='row'>
						<div class="col-sm-4 col-sm-offset-4 col-centered">
							<div id='blockUser' style='display:inline-block;margin:20px;'>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
