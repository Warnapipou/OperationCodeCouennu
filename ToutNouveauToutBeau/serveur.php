<?php
	$iteration = 0;
	$nom = $_GET['nom'];
    $ip = $_SERVER['REMOTE_ADDR'];

	$dom = new DomDocument();
	$dom->load('./config.xml');
	
	$racine = $dom->documentElement;
	$joueurs = $dom->getElementsByTagName('Joueur');
	foreach($joueurs as $joueur)
		$iteration = $iteration + 1;
	
	$nouveauJoueur = $dom->createElement('Joueur');
	$nomJoueur = $dom->createElement('Nom');
	$nomJoueurTXT = $dom->createTextNode($nom);
	$nomJoueur->appendChild($nomJoueurTXT);
	
	$ipJoueur = $dom->createElement('Ip');
	$ipJoueurTXT = $dom->createTextNode($ip);
	$ipJoueur->appendChild($ipJoueurTXT);
	
	$nouveauJoueur->appendChild($nomJoueur);
	$nouveauJoueur->appendChild($ipJoueur);
	
	$cartesJoueur = $dom->createElement('Cartes');	
	$cartes = tirer6Cartes();
	foreach($cartes as $c){
		$carte = $dom->createElement('Carte');
		$txtCarte = $dom->createTextNode($c);
		
		$carte->appendChild($txtCarte);
		$cartesJoueur->appendChild($carte);
	}
		

	$nouveauJoueur->appendChild($cartesJoueur);
	$racine->appendChild($nouveauJoueur);
	
	if ($iteration > 0){
		echo "\n le jeu peut commencer\n ";
	}
		
	$dom->save('./config.xml');
	
	function tirer6Cartes(){
		$listCartes= array("panne_essence","50");
		return $listCartes;
	}
	

/*$listJoueur= array();
attente();
echo "je suis le serveur";

$nom = $_GET['nom'];
array_push($listJoueur, $nom);
if (listJoueur.size > 1){
	echo "debut de partie";
}
var_dump($listJoueur);


*/

/*private list;

class joueur{
	nom
	listcartes
}

public function attente(){
	$nom = $_GET['nom'];
	list.add(nom, ip);
	if list.taille > 1{
		call debutpartie;
	}
}

public function debutpartie(){
	distributioncartes();
	
}*/
?>