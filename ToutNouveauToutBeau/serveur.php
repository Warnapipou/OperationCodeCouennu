<?php
	include("gestionCartes.php");
	$deck = initDeck();
	melangerDeck($deck);


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
	$cartes = Tirer6cartes($deck);
	foreach($cartes as $c){
		$carte = $dom->createElement('Carte');
		$txtCarte = $dom->createTextNode($c);
		
		$carte->appendChild($txtCarte);
		$cartesJoueur->appendChild($carte);
	}
	
        
        $tour = $dom->getElementsByTagName('Tour');
        if($tour->length == 0) {
            $tour = $dom->createElement('Tour');
            $nomJoueurTXT = $dom->createTextNode($ip);
            $tour->appendChild($nomJoueurTXT);
            $racine->appendChild($tour);
        }
            
	$nouveauJoueur->appendChild($cartesJoueur);
	$racine->appendChild($nouveauJoueur);

		
	$dom->save('./config.xml');
	echo "ok";
	
	
?>