<?php

$img_path = '/images/1000bornes/';
$cartes = array();

foreach (range(0, 105) as $i) {
    if($i < 10){
    	$cartes[$i] = $img_path . '25.png';
    }
    elseif($i < 20){
    	$cartes[$i] = $img_path . '50.png';
    }
    elseif($i < 30){
    	$cartes[$i] = $img_path . '75.png';
    }
    elseif($i < 42){
    	$cartes[$i] = $img_path . '100.png';
    }
    elseif($i < 46){
    	$cartes[$i] = $img_path . '200.png';
    }


    elseif($i < 47){
    	$cartes[$i] = $img_path . 'as_volant.png';
    }
    elseif($i < 48){
    	$cartes[$i] = $img_path . 'pompier.png';
    }
    elseif($i < 49){
    	$cartes[$i] = $img_path . 'citerne.png';
    }
    elseif($i < 50){
    	$cartes[$i] = $img_path . 'increvable.png';
    }


    elseif($i < 64){
    	$cartes[$i] = $img_path . 'vert.png';
    }
    elseif($i < 70){
    	$cartes[$i] = $img_path . 'fin_limite_vitesse.png';
    }
    elseif($i < 76){
    	$cartes[$i] = $img_path . 'roue_secours.png';
    }
    elseif($i < 82){
    	$cartes[$i] = $img_path . 'essence.png';
    }
    elseif($i < 88){
    	$cartes[$i] = $img_path . 'reparation.png';
    }


    elseif($i < 93){
    	$cartes[$i] = $img_path . 'rouge.png';
    }
    elseif($i < 96){
    	$cartes[$i] = $img_path . 'accident.png';
    }
    elseif($i < 99){
    	$cartes[$i] = $img_path . 'panne_essence.png';
    }
    elseif($i < 102){
    	$cartes[$i] = $img_path . 'creve.png';
    }
    else{
    	$cartes[$i] = $img_path . 'limite_vitesse.png';
    }
}

print('

            <div class="row">
                <div class="col-md-1">
                    <img src="images/1000bornes/accident.png"/>
                </div>
                <div class="col-md-1"></div>
                <div id="conteneur_main">
');
$i = 0;
while($i < 6){
	$r = rand(0,105);
	print('
		<div class="col-md-1 carte_main">
			<img src="'.$cartes[$r].'"/>
		</div>
	');	$i = $i + 1;
}
print('
                    
                    
                    <div class="col-md-1"></div>
                    <div class="col-md-1 defausse">Défausse</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-1">
                    <img src="images/1000bornes/limite_vitesse.png"/>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1">
                	<img src="images/1000bornes/citerne.png"/>
                </div>
                <div class="col-md-1">
                    Botte increvable
                </div>
                <div class="col-md-1">
                    <img src="images/1000bornes/as_volant.png"/>
                </div>
                <div class="col-md-1">
                    Botte Camion des pompoms
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div class="col-md-1"></div>
                <div id="conteneur_main">
                    <img src="images/1000bornes/roue_secours.png"/>
                </div>
            </div>
');

?>