<?php
	echo "start";
	include("DBConnection.php");

	class workerThread extends Thread{

		public function __construct($word){
			$this->word = $word;
		}
		public function run(){
			extract(mysqli_fetch_array($r));
			$tmp = exec("python AnglaisBeuhBeuh.py $this->word");
			parse_str($tmp,$output);
			if(!empty($output['translation']) && !empty($output['definition'])){
				echo "mot : ".$this->word."</br>";
				flush();
				mysqli_query($db,$query);
				$query = "UPDATE vocabulaire SET definition='".$output['definition']."', translation='".$output['translation']."' WHERE mot=".$this->word;
			}
			exit();
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
		$workers[$i]=new workerThread($word);
		$workers[$i]->start();
		$i++;
	}

?>
