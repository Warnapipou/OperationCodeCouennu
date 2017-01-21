<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>1000 bornes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="jquery-ui.css" />
        <link rel="stylesheet" type="text/css" href="css/leaflet.css" />
        <link rel="stylesheet" type="text/css" href="css/L.Mappy.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="css/index.css" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript" src="jquery-ui.js"></script>
        <script type="text/javascript" src="js/leaflet.js"></script>
        <script type="text/javascript" src="js/L.Mappy.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
    </head>
    <body>
        <form action="./serveur.php" onclick="inscription">
            <input id="nom" type="text" name="nom"/>
            <input type="button" value="Envoyer"/>
	</form>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div id="map" style="width: 100%; height: 600px;"></div>
                </div>
                <div class="col-md-2"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label>Distance : </label>
                    <label id="distance">125</label>
                    <label> Km</label>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-1">
                    <img src="images/1000bornes/accident.png"/>
                </div>
                <div class="col-md-1"></div>
                <div id="conteneur_main">
                    <div class="col-md-1 carte_main" data-carte="25">
                        <img src="images/1000bornes/25.png" data-img="1"/>
                    </div>
                    <div class="col-md-1 carte_main" data-carte="vert">
                        <img src="images/1000bornes/vert.png" data-img="2"/>
                    </div>
                    <div class="col-md-1 carte_main" data-carte="">
                        <img src="" data-img="3"/>
                    </div>
                    <div class="col-md-1 carte_main" data-carte="">
                        <img src="" data-img="4"/>
                    </div>
                    <div class="col-md-1 carte_main" data-carte="">
                        <img src="" data-img="5"/>
                    </div>
                    <div class="col-md-1 carte_main" data-carte="">
                        <img src="" data-img="6"/>
                    </div>
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
                <div class="col-md-1 nouvellecarte">
                    <img src="images/1000bornes/roue_secours.png"/>
                </div>
            </div>
            
            <div id="load" class="hidden"></div>
        </div>
    </body>
</html>
