$(document).ready(function(){
    
    L.Mappy.setImgPath("images/");
    // Création de la carte
    var map = new L.Mappy.Map("map", {
        clientId: 'dri_24hducode',
        center: [43.6044, 1.44295],
        zoom: 7
    });
    
    map.setOverlay();
    // Création d'un layer contenant les marqueurs à afficher
    var mLayer = L.layerGroup().addTo(map);
     
    // Création d'un marqueur qu'on ajoute au layer
    var marker = L.marker([map._lastCenter.lat, map._lastCenter.lng]).addTo(mLayer);
    var marker = L.marker([48.003767, 0.197248]).addTo(mLayer);
    


    /*var sUrl = "https://api.apipagesjaunes.fr/pros/find?what=restaurant&where=43.6044,1.44295&proximity=true&max=5&app_id=d140a6f6&app_key=26452728b034374bccb462e880bfb0e5";

    $.ajax({
        type: 'GET',
        url: sUrl,
        jsonp: "callback",
        dataType: 'json',
        headers: { 'Content-type': 'application/json' },
        success: function (res) {
            alert('test');
        }
    });*/
    
    // Gestion des cartes de la main
    $('.carte_main').each(function(){
        //$(this).draggable({ containment: "#conteneur_main", scroll: false })
        $(this).click(function(){
            var conteneur_main = $('#conteneur_main div');
            conteneur_main.each(function(){
                $(this).removeClass('selected');
            });
            $(this).addClass('selected');
        });
    });
    
    
    $.ajaxSetup({
        type: 'get',
        error: function(data, textStatus, jqXHR) {
            console.log(data);
            console.log(textStatus);
            console.log(jqXHR);
        }
    });

});

var img_path = 'images/1000bornes';
var images = {
    distance25: img_path + '25.png',
    distance50: img_path + '50.png',
    distance75: img_path + '75.png',
    distance100: img_path + '100.png',
    distance200: img_path + '200.png',
    vert: img_path + 'vert.png',
    rouge: img_path + 'rouge.png',
    accident: img_path + 'accident.png',
    reparation: img_path + 'reparation.png',
    panne_essence: img_path + 'panne_essence.png',
    essence: img_path + 'essence.png',
    creve: img_path + 'creve.png',
    roue_secours: img_path + 'roue_secours.png',
    limite_vitesse: img_path + 'limite_vitesse.png',
    fin_limite_vitesse: img_path + 'fin_limite_vitesse.png',
    as_volant: img_path + 'as_volant.png',
    pompier: img_path + 'pompier.png',
    citerne: img_path + 'citerne.png',
    increvable: img_path + 'increvable.png',
};

var timer = {
    attentePartie: 2500,
    monTour: 2500,
};

var idTimer = {
    debutPartie: undefined,
    monTour: undefined,
};

// On inscript le joueur.
function inscription() {
    var nom = $('#nom').val();
    $.ajax({
        url: 'serveur',
        data: {nom : nom},
        success: function (data, textStatus, jqXHR) {
            if(data == 'ok'){
                idTimer.debutPartie = window.setInterval(debutPartie, timer.attentePartie);
                console.log("Joueur inscrit.");
                $('#form-inscription').hide();
                $('#plateau').show();
                $("#load").removeClass('hidden');
            }
        }
    });
}

// On interroge le serveur afin de savoir quand la partir commence;
function debutPartie() {
    $.ajax({
        url: 'debutPartie',
        success: function (data, textStatus, jqXHR) {
            if(data != 'non'){
                $("#map").show();
                // On affecte les cartes au joueurs.
                data = JSON.parse(data);
                $('.carte_main').each(function(){
                    var img = $(this).children('img');
                    var image = data[img.data('img')];
                    if(image !== undefined)
                        img.attr('src', 'images/1000bornes/' + image + '.png');
                });
                console.log('recuperation des cartes.');

                idTimer.monTour = window.setInterval(monTour, timer.monTour);
                window.clearInterval(idTimer.debutPartie);
            }
        }
    });
}

// On demande au serveur si c'est mon tour.
function monTour() {
    $.ajax({
        url: "tour",
        success: function (data, textStatus, jqXHR) {
            if(data == 'ok'){
                $("#load").addClass('hidden');
                // On stop les appels ajax, c'est a moi de jouer.
                window.clearInterval(idTimer.monTour);
            }
            else{
                $("#load").removeClass('hidden');
            }
        }
    });
}

/*

Gestion APIs

*/

var m_aCommerce = ['restaurant'];
var m_iNbMaxValParCommerce = 10;

/*
check la présence de tous les commerces autours d'un point et les affiches sur la carte
*/
function checkAndDisplayPointAround(latitude,longitude,distanceMax,map){
	for (var i = 0; i < m_aCommerce.length; i++) {
		var currentCom = m_aCommerce[i];
		sendRequestAndPlacePointWithDistMax(createUrl(currentCom,latitude,longitude),distanceMax,latitude,longitude,currentCom,map);
	}
}
	
/*
Créer un itinéraire entre deux coordonnées et l'affiche sur la map
*/
function createAndDisplayRoutefromCoord(latitude1,longitude1,latitude2,longitude2,map){
	
	/* Itineraire entre deux points */
	L.Mappy.setClientId("dri_24hducode");
	
	var options = {
		vehicle: L.Mappy.Vehicles.comcar,
		cost: "length", // or "time" or "price"
		gascost: 1.0,
		gas: "petrol", // or diesel, lpg
		nopass: 0, // 1 pour un trajet sans col
		notoll: 0, // 1 pour un trajet sans péage
		infotraffic: 0 // 1 pour un trajet avec trafic
	};
	
	L.Mappy.Services.route([L.latLng(latitude1, longitude1), L.latLng(latitude2,longitude2)],
		options,
		// Callback de succès
		function(result) {
			L.Mappy.route(result.routes).addTo(map);
			var summary = result.routes.route[0].summary;
			var roadbook = result.routes.route[0].actions.action;
		},
		// Callback d'erreur
		function(errorType) {
			// Error during route calculation
		}
	);
}

/*
Créer une url d'appel des WS page jaunes pour les commerces autours de la coordonée GPS en param
*/
function createUrl(commerceCherche,latitude,longitude){
	/* !!! inversement des latitudes et longitudes dans le WS */
	return "https://api.apipagesjaunes.fr/pros/find?what="+commerceCherche+"&where=cZ"+longitude+","+latitude+"&proximity=true&max=5&app_id=d140a6f6&app_key=26452728b034374bccb462e880bfb0e5";
}

/*
envoie la requête de récupération des commerces en paramètre et ajoute un marker pour chaque commerce trouvé
*/
function sendRequestAndPlacePointWithDistMax(p_sUrl,distMax,lat_centre,long_centre,currentCom,mLayer){
	$.ajax({
    url: 'http://localhost/OperationCodeCouennu/ToutNouveauToutBeau/request.php',
	data: {callUrl : p_sUrl},
    type: 'GET',
    success: function (data) {
		// console.log(data);
		var jsonObj = JSON.parse(data);
		var jsonResult = jsonObj.search_results.listings;
		if (typeof jsonResult !== 'undefined') {
			// if response contain value
			//console.log(m_iNbMaxValParCommerce);
			for (var i = 0; i < (jsonResult.length && m_iNbMaxValParCommerce); i++) {
				if (typeof jsonResult[i] !== 'undefined') {
		
					var jsonCom = jsonResult[i];
					
					//console.log(gpsDistance(lat_centre,long_centre,jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude));
					
					if(distMax > gpsDistance(lat_centre,long_centre,jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude)){
						var marker = L.marker([jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude]).addTo(mLayer);
						marker.bindPopup("<b>"+ currentCom +"</b><br>"+jsonCom.merchant_name+"<br> <button type=\"button\" onclick=\"atteindreDest(" + lat_centre+","+long_centre+"," + jsonCom.inscriptions[0].latitude + ","+jsonCom.inscriptions[0].longitude+");\">S'y rendre !</button> ");				
					}
				}
			}
		}
    }
	});
}

function atteindreDest(lat_deb,lon_deb,lat_dest,lon_dest,map){
	console.log("atteindreDest");
}


/*
Converti un angle en degre en radian
*/
function convertRad(input){
        return (Math.PI * input)/180;
}
 
 /*
	Calcule la distance entre deux coordonnées GPS
 */
function gpsDistance(lat_a_degre, lon_a_degre, lat_b_degre, lon_b_degre){
     
        R = 6378000 //Rayon de la terre en mètre
 
    lat_a = convertRad(lat_a_degre);
    lon_a = convertRad(lon_a_degre);
    lat_b = convertRad(lat_b_degre);
    lon_b = convertRad(lon_b_degre);
     
    d = R * (Math.PI/2 - Math.asin( Math.sin(lat_b) * Math.sin(lat_a) + Math.cos(lon_b - lon_a) * Math.cos(lat_b) * Math.cos(lat_a)))
    return d;
}