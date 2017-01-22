<?php

function initDeck(){
	$cartes = array();

	foreach (range(0, 105) as $i) {
	    if($i < 10){
	    	$cartes[$i] = '25';
	    }
	    elseif($i < 20){
	    	$cartes[$i] = '50';
	    }
	    elseif($i < 30){
	    	$cartes[$i] = '75';
	    }
	    elseif($i < 42){
	    	$cartes[$i] = '100';
	    }
	    elseif($i < 46){
	    	$cartes[$i] = '200';
	    }


	    elseif($i < 47){
	    	$cartes[$i] = 'as_volant';
	    }
	    elseif($i < 48){
	    	$cartes[$i] = 'pompier';
	    }
	    elseif($i < 49){
	    	$cartes[$i] = 'citerne';
	    }
	    elseif($i < 50){
	    	$cartes[$i] = 'increvable';
	    }


	    elseif($i < 64){
	    	$cartes[$i] = 'vert';
	    }
	    elseif($i < 70){
	    	$cartes[$i] = 'fin_limite_vitesse';
	    }
	    elseif($i < 76){
	    	$cartes[$i] = 'roue_secours';
	    }
	    elseif($i < 82){
	    	$cartes[$i] = 'essence';
	    }
	    elseif($i < 88){
	    	$cartes[$i] = 'reparation';
	    }


	    elseif($i < 93){
	    	$cartes[$i] = 'rouge';
	    }
	    elseif($i < 96){
	    	$cartes[$i] = 'accident';
	    }
	    elseif($i < 99){
	    	$cartes[$i] = 'panne_essence';
	    }
	    elseif($i < 102){
	    	$cartes[$i] = 'creve';
	    }
	    else{
	    	$cartes[$i] = 'limite_vitesse';
	    }
	}
	
	return $cartes;
}

function melangerDeck(&$deck){
	shuffle($deck);
}

function Tirer6cartes(&$deck){
	$res = array();
	foreach(range(1,6) as $i){
		$res[] = Piocher($deck);
	}
	return $res;
}

function Piocher(&$deck){

	$dom = new DomDocument();
	$dom->load('./config.xml');

	$pioche = $dom->getElementsByTagName('Decks');
	


	return array_shift($deck);;
}



function jouerCarte($carte, $name){
	$attaque = array(
		"accident",
		"panne_essence",
		"creve",
		"limite_vitesse",
		"rouge"
		);
	$defense = array(
		"reparation",
		"essence",
		"roue_secours",
		"fin_limite_vitesse",
		"vert"
		);
	$botte = array(
		"as_volant",
		"citerne",
		"increvable",
		"pompier"
		);
	$distance = array(
		"25",
		"50",
		"75",
		"100",
		"200"
		);

	$dom = new DomDocument();
	$dom->load('./config.xml');
	
	$joueurs = $dom->getElementsByTagName('Joueur');
	foreach ($joueurs as $player) {
		if($player.getElementsByTagName('Nom')->nodeValue == $name){
			$listeCartes = $player.getElementsByTagName('Cartes');
			foreach ($listeCartes as $cacarte) {
				if($cacarte->nodeValue == $carte){
					$listeCartes->removeChild($cacarte);
				}
			}
		}
	}
}


?>