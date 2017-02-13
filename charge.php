<?php
	header('Content-Type: application/json');
	session_start();
	include("DBConnection.php");

if(!isset($_GET['id'])){	
	$r = mysqli_query($db,"SELECT * FROM partie");
	if($l = mysqli_fetch_array($r)){
		extract($l);
	}
}else{
	$tour = $_GET['id'];
}
$r1 = mysqli_query($db,"SELECT * FROM resultat WHERE idUser='".$tour."'");
if($l1 = mysqli_fetch_array($r1)){
	extract($l1);
	echo json_encode(array('tour' => $tour,'model'=>$model,'proposition'=> $proposition));
	//$_SESSION['model']=$model;
}
else{
	echo json_encode(array('tour'=> $tour,'query' => "SELECT * FROM resultat WHERE idUser='".$tour."'"));
}
?>
