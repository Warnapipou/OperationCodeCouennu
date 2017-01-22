<?php
	$ip = $_SERVER['REMOTE_ADDR'];
	$iteration = 0;
	$dom = new DomDocument();
	$dom->load('./config.xml');
	
	$racine = $dom->documentElement;
	$joueurs = $dom->getElementsByTagName('Joueur');
	foreach($joueurs as $joueur)
		$iteration = $iteration + 1;
	
	if ($iteration > 0)
		echo json_encode(retrouverCarte($ip));
	else
		echo "non";
	
	
	function retrouverCarte($ip){
		$dom = new DomDocument();
		$dom->load('./config.xml');
		
		$racine = $dom->documentElement;
		$listIp = $dom->getElementsByTagName('Ip');
		foreach($listIp as $theIp){
			if($theIp->nodeValue == $ip){
				$joueur = $theIp->parentNode;
				//var_dump($joueur);
			}
			$cartes = $joueur->getElementsByTagName('Carte');
			foreach ($cartes as $c)
				$res[] = $c->nodeValue;
			return $res;
		}
	}
	
	
	}
?>