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
	shuffle($cartes);
}

function Tirer6cartes(&$deck){
	$res = array();
	foreach(range(1,6) as $i){
		$res[] = Piocher($deck);
	}
	return $res;
}

function Piocher(&$deck){
	return array_shift($deck);;
}

?>