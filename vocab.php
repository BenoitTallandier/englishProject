<?php
	echo "start";
	include("DBConnection.php");

	class workerThread extends Thread{

		public function __construct($b){
			$this->i = $i;
		}
		public function run(){
			
		}
	}

	$r1 = mysqli_query($db,"SELECT  idMot FROM vocabulaire WHERE definition!='' ORDER BY idMot DESC LIMIT 1");
	extract(mysqli_fetch_array($r1));
	echo $idMot;
	flush();
	$r = mysqli_query($db,"SELECT * FROM vocabulaire WHERE definition='' AND idMot>".$idMot);
	$total = mysqli_num_rows($r);
	$i=0;
	while($l = mysqli_fetch_array($r)){
		extract($l);
		$word = $mot;
		$tmp = exec("python AnglaisBeuhBeuh.py $word");
		parse_str($tmp,$output);
		if(!empty($output['translation']) && !empty($output['definition'])){
			$per = floor($i/$total);
			echo $per."%, mot : ".$word."</br>";
			flush();
			$query = "UPDATE vocabulaire SET definition='".$output['definition']."', translation='".$output['translation']."' WHERE idMot=".$idMot;
			mysqli_query($db,$query);
		}
		$i++;
	}

?>
