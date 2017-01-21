$(document).ready(function(){
    
    var img_path = 'images/1000bornes';
    var images = {
        25: img_path + '25.png',
        50: img_path + '50.png',
        75: img_path + '75.png',
        100: img_path + '100.png',
        200: img_path + '200.png',
        feu_vert: img_path + 'vert.png',
        feu_rouge: img_path + 'rouge.png',
        accident: img_path + 'accident.png',
        reparation: img_path + 'reparation.png',
        panne_essence: img_path + 'panne_essence.png',
        plein_essence: img_path + 'essence.png',
        pneu_creve: img_path + 'creve.png',
        pneu: img_path + 'roue_secours.png',
        limite_vitesse: img_path + 'limite_vitesse.png',
        fin_limite_vitesse: img_path + 'fin_limite_vitesse.png',
        as_volant: img_path + 'as_volant.png',
        pompier: img_path + 'pompier.png',
        citerne: img_path + 'citerne.png',
        increvable: img_path + 'increvable.png',
    }
    
    L.Mappy.setImgPath("/images");
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
    
    $('.carte_main').each(function(){
        //$(this).draggable({ containment: "#conteneur_main", scroll: false })
        $(this).click(function(){
            var conteneur_main = $('#conteneur_main div');
            conteneur_main.each(function(){
                $(this).removeClass('selected');
            })
            $(this).addClass('selected');
        });
    });
});