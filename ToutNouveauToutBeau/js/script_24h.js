var m_aCommerce = ['restautant'];
var m_iNbMaxValParCommerce = 10;

function mappy(){
	L.Mappy.setImgPath("./images");

	// Création de la carte
	var exampleMap1 = new L.Mappy.Map("MAP", {
		clientId: 'dri_24hducode',
		center: [43.604445,1.442954],
		zoom: 7
	});

	// Création d'un layer contenant les marqueurs à afficher
	var mLayer = L.layerGroup().addTo(exampleMap1);
	 
	
	var applicationId  = "d140a6f6";
	var applicationKey  = "26452728b034374bccb462e880bfb0e5";
	
	
	checkAndDisplayPointAround(43.604445,1.442954,750,mLayer);

}

/*
check la présence de tous les commerces autours d'un point et les affiches sur la carte
*/
function checkAndDisplayPointAround(latitude,longitude,distanceMax,map){
	for (var i = 0; i < m_aCommerce.length; i++) {
		var currentCom = m_aCommerce[i];
		sendRequestAndPlacePointWithDistMax(createUrl(currentCom,latitude,longitude),distanceMax,latitude,longitude,map);
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
function sendRequestAndPlacePointWithDistMax(p_sUrl,distMax,lat_centre,long_centre,mLayer){
	$.ajax({
    url: 'http://localhost/24h/request.php',
	data: {callUrl : p_sUrl},
    type: 'GET',
    success: function (data) {
		// console.log(data);
		var jsonObj = JSON.parse(data);
		var jsonResult = jsonObj.search_results.listings;
		if (typeof jsonResult !== 'undefined') {
			// if response contain value
			console.log(m_iNbMaxValParCommerce);
			for (var i = 0; i < (jsonResult.length && m_iNbMaxValParCommerce); i++) {
				var jsonCom = jsonResult[i];
				console.log(gpsDistance(lat_centre,long_centre,jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude));
				if(distMax > gpsDistance(lat_centre,long_centre,jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude)){
					var marker = L.marker([jsonCom.inscriptions[0].latitude, jsonCom.inscriptions[0].longitude]).addTo(mLayer);
					marker.bindPopUp("Votre texte");					
				}
			} 
		}
    }
	});
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