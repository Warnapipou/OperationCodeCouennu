<?php
	$dom = new DomDocument();
	$dom->load('./config.xml');
	
	$racine = $dom->documentElement;
	$joueurs = $dom->getElementsByTagName('Joueur');
	foreach($joueurs as $joueur)
		$iteration = $iteration + 1;
	
	if ($iteration > 0){
		return "ok";
	else
		return "non";
	}
?>