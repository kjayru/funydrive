const btnzip = document.getElementById("zipcode");

let num = 0;
let total = 0;
btnzip.addEventListener('keyup',function(e){
   
   
    if(num<4){
        num +=1;
        console.log(num);
    }else{
        console.log('ejecuta..');
        num = 0;
        total = 0;
       conteo();
    }
    
});

function conteo(){     
        consultacode();
}

let boxmsg = document.querySelector('.box-msn');
function consultacode(){
    let codigo = document.getElementById("zipcode").value;
    
    let url = `/getpostal/${codigo}`;

    fetch(url).then(function(response){
           // return response;
            return response.json();
            
        })
        .then(function(data){
            boxmsg.style.display = "block";
           if(data.rpta==='ok'){
                boxmsg.innerHTML= `Great! We have certified mobile mechanics in ${data.poblacion}, ${data.provincia}`;
                document.querySelector(".btn-confirmar").style.display='block';
                zipmapa(data);
           }else{
                boxmsg.innerHTML= `${data.mensaje}`;   
           }
        })
        .catch(function(error){
            console.log(`error ${error}`);
            
        });
}

/**mapas */

function initMap() {
    var map = new google.maps.Map(document.getElementById('canvas'), {
        
        center: {lat: -34.397, lng: 150.644},
        zoom: 11
           
    });
  
   

    var infoWindow = new google.maps.InfoWindow({map: map});
    

   

// Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('tu localización');
            map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
    // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
infoWindow.setPosition(pos);
infoWindow.setContent(browserHasGeolocation ?
                      'Error: The Geolocation service failed.' :
                      'Error: Your browser doesn\'t support geolocation.');
console.log('no soporta ');
// $(".provincias").show();
}
/*
var e = document.getElementById("province");

document.getElementById("province").addEventListener('change',function(){
var provincia = e.options[e.selectedIndex].value;

$.ajax({
    url:'/getmarker/'+provincia,
    type:'GET',
    dataType:'json',
    success:function(response){
        puntos(response);
    // marcadores(response.marker);
    }
});

});*/
function zipmapa(provincia){
    let latitud = parseFloat(provincia.lon);
    let longitud = parseFloat(provincia.lat);
    var position = {lat: latitud ,lng: longitud };
   // var position = {lat: -2.712437310, lng: 42.939811580};
    console.log(position);
    var map = new google.maps.Map(document.getElementById('canvas'),{
        zoom:14,
        center:position
    });
   

    var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<h1 id="firstHeading" class="firstHeading">Ubicación</h1>'+
    '<div id="bodyContent">'+
    '<p>'+provincia.poblacion+'</p>'+
    '</div>'+
    '</div>';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

   
    var marker = new google.maps.Marker({
        position: position,
        map:map,
        title: provincia.provincia
    });

    marker.addListener('click',function(){
        infowindow.open(map, marker);
    });

}
function puntos(provincia){

var map = new google.maps.Map(document.getElementById('canvas'), mapOptions);
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'                    
    };


var infoWindow = new google.maps.InfoWindow(), marker, i;

var markers = marcadores(provincia);
var infoWindowContent = contenidos(provincia);



for( i = 0; i < markers.length; i++ ) {
    console.log(i+" - "+markers[i]['lat']);

        var position = new google.maps.LatLng(markers[i]['lat'], markers[i]['lng']);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i]['provincia']
        });
        
        // Allow each marker to have an info window    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i]['poblacion']);
                infoWindow.open(map, marker);
               // $("#comercio_id").val(infoWindowContent[i]['id']);
            }
        })(marker, i));

        // Automatically center the map fitting all markers on the screen
        map.fitBounds(bounds);
}

// Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
this.setZoom(14);
google.maps.event.removeListener(boundsListener);
});
}

function marcadores(valor){
var ic="";
var len = valor.marker.length;
var j=1;

// Multiple Markers
var markers = valor.marker;

return markers;
}
function contenidos(valor){
// Info Window Content

var infoWindowContent =  valor.marker;

return infoWindowContent;
}


(function() {
    initMap();
 
 })();