const btnzip = document.getElementById("zipcode");

let num = 0;
let total = 0;
let clatitud = "";
let clongitud = "";
let namestore = "";
btnzip.addEventListener("keypress", function (event) {

  if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
    event.preventDefault(); //stop character from entering input  

  } else {
    
    num = num + 1;
  }
});

btnzip.addEventListener("keyup",function(event){
  if (num > 4) {

   
   
    consultacode();
  }
});

$(document).on("keydown","#zipcode",function (event) {
  var letter = String.fromCharCode(event.which);
  if (event.keyCode == 32) {
    event.preventDefault();
    return false;
  }
  if (event.keyCode == 46) {
    num = num - 1;
  }
  if (event.keyCode == 8) {
    num = num - 1;
  }
  if (event.keyCode === 13) {
    event.preventDefault();

    return false;
  }

});


$(document).on("keyup keypress", "#zipcode", function (e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) {
    e.preventDefault();
    return false;
  }
});

$(document).on("cut copy paste", "#zipcode", function (e) {
  e.preventDefault();
});



$("#btnservice").on("click", function () {
  $(this).hide();
  $(".detallesservicio").show();
  if(!$(this).hasClass('busqueda')){
    $("#appoint").fadeIn();
  }else{
    $("#notes").fadeIn();
  }

});

function conteo() {
  consultacode();
}

$(".btn-fecha").click(function (e) {
  $(".slot").removeClass("bd-timeline--hour__disabled");
  $(this).addClass("bd-timeline--hour__disabled");

  let fechaservicio = $("#fechaservicio").val();
  $("#datework").val(fechaservicio);


  $("#appoint").hide();
  $("#notes").fadeIn();
});
let codigo = "";
let boxmsg = document.querySelector(".box-msn");
var mensaje = $(".box-msn").children('span').html();

function consultacode() {
  codigo = document.getElementById("zipcode").value;

  let url = `/getpostal/${codigo}`;

  fetch(url)
    .then(function (response) {
      // return response;
      return response.json();
    })
    .then(function (data) {
      boxmsg.style.display = "block";
      if (data.rpta === "ok") {
        console.log(data.postal[0].poblacion);
        
       
        boxmsg.innerHTML = `${mensaje} ${
          data.postal[0].poblacion
          }, ${data.postal[0].provincia}`;
        document.querySelector(".btn-confirmar").style.display = "inline-block";
        zipmapa(data.postal[0]);
        $("#sidebar-zip").html(`${codigo} - ${data.postal[0].poblacion}`);
      } else {
        $(".respuestas").html(`Error en proceso`);
      }
    })
    .catch(function (error) {
      console.log(`error ${error}`);
    });
}

$(".btn-confirmar").on("click", function () {
  document.getElementById("tipocar").style.display = "block";
  $("html, body").animate(
    {
      scrollTop: $("#tipocar").offset().top
    },
    350
  );
});
//global vars
var idmake = "";
var make = "";
var yearcar = "";
var modelcar = "";
var listmodel = "";
var listserv = "";
var namesubservice = "";
$("#box1 li").on("click", function () {
  idmake = $(this).data("id");
  make = $(this).data("make");
  $("#box1").hide();
  $("#box2").fadeIn(350);
  $(".ymake").html(make);
});

$("#box2 li").on("click", function () {
  yearcar = $(this).data("year");

  //envian peticion
  token = document.getElementsByName("_token")[0].value;
  let datosend = {
    idmake: idmake,
    _token: token,
    year: yearcar,
    _method: "POST"
  };
  let url = "/getmodel";
  fetch(url, {
    method: "POST",
    body: JSON.stringify(datosend),
    headers: {
      "Content-Type": "application/json"
    }
  })
    .then(res => res.json())
    .catch(error => console.error("error", error))
    .then(response => {
      console.log(response);
      if (response.rpta == "ok") {
        $(".yyear").remove();
        $.each(response.data, function (i, e) {
          listmodel =
            listmodel +
            `<li data-nombre="${e.name}" data-id="${e.id}">${e.name}</li>`;
        });
        $("#mimodelo").html(listmodel);
        $(".respuestas").html("");
        $("#box2").hide();
        $("#box3").fadeIn(350);
        $(".botones").append(
          `<div class="bd-car-selection-car-option yyear">${yearcar}</div>`
        );
      } else {
        alert(response.mensaje);
      }
    });
});



$(document).on("click", "#mimodelo li", function () {
  let idmodelo = $(this).data("id");
  let nombre = $(this).data("nombre");
  $(".botones").append(
    `<div class="bd-car-selection-car-option ymodel">${nombre}</div>`
  );
  $("#box3").hide();
  $("#seccioncar").hide();
  $("#sidebar-car").html(`${make} ${yearcar}, ${nombre}`);
  //price or cost service
  //$(".bd-sidebar-price-box__price span").html("75");
  $("#services").fadeIn(350);
});

$(document).on("click", ".ymake", function () {
  console.log("makee");
  $("#box1").fadeIn();
  $("#box2").hide();
  $("#box3").hide();
});
$(document).on("click", ".yyear", function () {
  $("#box2").fadeIn();
  $("#box3").hide();
});
$(document).on("click", ".ymodel", function () {
  $("#box3").hide();
  $("#services").fadeIn();
});

$(".bd-service-list--items li").click(function () {
  let idservice = $(this).data("id");
  let token = document.getElementsByName("_token")[0].value;
  let datosend = { idservice: idservice, _token: token, _method: "GET" };
  let url = `/getservice/${idservice}/edit`;
  fetch(url)
    .then(res => res.json())
    .catch(error => console.error("error", error))
    .then(response => {
      console.log(response);
      if (response.rpta == "ok") {
        $("#contsubs").html("");
        listserv = "";
        $.each(response.data, function (i, e) {
          listserv =
            listserv +
            `<div class="bd-service-list--service">
                <div class="bd-icon-service-plus pull-left">
                </div>
                <span data-id="${e.id}" data-iduserservice="${e.user_id}" data-name="${e.name}">${e.name}</span>
                </div>`;
        });
        $("#contsubs").html(listserv);
        $(".respuestas").html("");
      } else {
        $(".respuestas").html(response.mensaje);
        $("#contsubs").html("");
      }
    });
});

$(document).on("click", ".bd-service-list--service span", function () {
  let id = $(this).data("id");
  let nombre = $(this).data("name");
  let iduserservice = $(this).data('iduserservice');
  namesubservice = nombre;
  $(".g-section-header-text").html(namesubservice);
  $(".bd-sidebar-job-name").html(namesubservice);
  $("#services").hide();
//busca rama
 let rama = $(this).data("rama");
  if(!rama){
    $("#detalle").fadeIn(350);
  }else{
    $("#detalle").fadeIn(350);
    $("#detalle button").addClass('busqueda');
  }
});

$(".btn-notas").on("click", function (e) {
  e.preventDefault();


  $("#iduserservice").val(iduserservice);
  $("#codepostal").val(codigo);
  $("#makecar").val(make);
  $("#modelcar").val(modelcar);
  $("#yearcar").val(yearcar);
  $("#service").val(service);
  $("#subservice").val(namesubservice);

  $("#price").val("75");
  $("#latitud").val(clatitud);
  $("#longitud").val(clongitud);
  $("#namestore").val(namestore);

  $("#fr-worked").submit();
});



/**mapas */

var map, infoWindow;

function initMap() {
  map = new google.maps.Map(document.getElementById("canvas"), {
    center: { lat: -34.397, lng: 150.644 },
    zoom: 11
  });

  infoWindow = new google.maps.InfoWindow({ map: map });

  // Try HTML5 geolocation.
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      function (position) {
        var pos = {
          lat: position.coords.latitude,
          lng: position.coords.longitude
        };

        infoWindow.setPosition(pos);
        infoWindow.setContent("tu localización");
        map.setCenter(pos);
        //icon

        var iconBase = `${pathurl}/marker/`;
        var icons = {
            icon: `${iconBase}/iconbase.png`
        };


        //places start
        map = new google.maps.Map(document.getElementById("canvas"), {
          center: pos,
          zoom: 11
        });

        var infowindow = new google.maps.InfoWindow();
        var service = new google.maps.places.PlacesService(map);
        service.nearbySearch(
          {
            location: pos,
            radius: 1000,
            type: ["car_repair"]
          },
          callback
        );

        function callback(results, status) {
          if (status === google.maps.places.PlacesServiceStatus.OK) {
            for (var i = 0; i < results.length; i++) {
              createMarker(results[i]);
            }
          }
        }

        function createMarker(place) {
          var placeLoc = place.geometry.location;
          var marker = new google.maps.Marker({
            map: map,
            position: placeLoc,
            icon: icons.icon,
          });
          let rating = '';
          google.maps.event.addListener(marker, "click", function () {
            console.log("evento0");
            $('.gicon .stars').stars();
            if(place.rating){
              rating = place.rating;
            }else{
              rating = '0';
            }
            infowindow.setContent(`${place.name} <br>Valoración: <div class="gicon"><span class="stars"> ${rating}</span></div>`);
            infowindow.open(map, this);
            // console.log(place.geometry.);
          });
        }
        //end places
      },
      function () {
        handleLocationError(true, infoWindow, map.getCenter());
      }
    );
  } else {
    // Browser doesn't support Geolocation
    handleLocationError(false, infoWindow, map.getCenter());
  }
}

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  infoWindow.setPosition(pos);
  infoWindow.setContent(
    browserHasGeolocation
      ? "Error: The Geolocation service failed."
      : "Error: Your browser doesn't support geolocation."
  );
  console.log("no soporta ");
}



function zipmapa(provincia) {
 
  let longitud = parseFloat(provincia.lat);
  let  latitud = parseFloat(provincia.lon);
 
  
  var pos = { lat: latitud, lng: longitud };
  // var position = {lat: -2.712437310, lng: 42.939811580};
  var iconBase = `${pathurl}/marker/`;
        var icons = {
            icon: `${iconBase}/iconbase.png`
        };

  var map = new google.maps.Map(document.getElementById("canvas"), {
    zoom: 14,
    center: pos
  });

  //places start
  map = new google.maps.Map(document.getElementById("canvas"), {
    center: pos,
    zoom: 15
  });

  var marker = new google.maps.Marker({
    position: pos,
    map: map,
    title: "Estoy aqui"
  });

  marker.addListener("click", function () {
    infowindow.open(map, marker);
  });

  var infowindow = new google.maps.InfoWindow();
  var service = new google.maps.places.PlacesService(map);
  service.nearbySearch(
    {
      location: pos,
      radius: 1000,
      type: ["car_repair"]
    },
    callback
  );

  function callback(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        createMarker(results[i]);
      }
    }
  }

  function createMarker(place) {
    var placeLoc = place.geometry.location;
    var marker = new google.maps.Marker({
      map: map,
      position: placeLoc,
      icon: icons.icon,
    });
 
    google.maps.event.addListener(marker, "click", function () {
      
      if(place.rating){
        r = place.rating;
      }else{
        r = '0';
      }
      let rv = rating(r);
      console.log(rv);
      infowindow.setContent(`${place.name} <br>Valoración: <div class="gicon">${rv}</div>`);
      infowindow.open(map, this);

      namestore = place.name;
      clatitud = place.geometry.location.lat();
      clongitud = place.geometry.location.lng();
    });
  }
  //end places
}
$(".icon input").keyup(function (e) {
  console.log("enveii");
  $(this)
    .parent()
    .children("label")
    .addClass("float");
});

$(".icon input").focusout(function (e) {
  if ($(this).val.length > 0) {
  } else {
    $(this)
      .parent()
      .children("label")
      .removeClass("float");
  }
});

function puntos(provincia) {
  var map = new google.maps.Map(document.getElementById("canvas"), mapOptions);
  var bounds = new google.maps.LatLngBounds();
  var mapOptions = {
    mapTypeId: "roadmap"
  };

  var infoWindow = new google.maps.InfoWindow(),
    marker,
    i;

  var markers = marcadores(provincia);
  var infoWindowContent = contenidos(provincia);

  for (i = 0; i < markers.length; i++) {
    console.log(i + " - " + markers[i]["lat"]);

    var position = new google.maps.LatLng(markers[i]["lat"], markers[i]["lng"]);
    bounds.extend(position);
    marker = new google.maps.Marker({
      position: position,
      map: map,
      title: markers[i]["provincia"]
    });

    // Allow each marker to have an info window
    google.maps.event.addListener(
      marker,
      "click",
      (function (marker, i) {
        return function () {
          infoWindow.setContent(infoWindowContent[i]["poblacion"]);
          infoWindow.open(map, marker);
          // $("#comercio_id").val(infoWindowContent[i]['id']);
        };
      })(marker, i)
    );

    // Automatically center the map fitting all markers on the screen
    map.fitBounds(bounds);
  }

  // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
  var boundsListener = google.maps.event.addListener(
    map,
    "bounds_changed",
    function (event) {
      this.setZoom(14);
      google.maps.event.removeListener(boundsListener);
    }
  );
}

function marcadores(valor) {
  var ic = "";
  var len = valor.marker.length;
  var j = 1;

  // Multiple Markers
  var markers = valor.marker;

  return markers;
}
function contenidos(valor) {
  // Info Window Content

  var infoWindowContent = valor.marker;

  return infoWindowContent;
}

$(document).ready(function () {
  $("#zipcode").bind({
    paste: function () {
      conteo();
    }
  });

  $("#zipcode").on("click", function (e) {
    if (e.ctrlKey && e.keyCode == 13) {
      conteo();
    }
  });
});

(function () {
  initMap();
})();

$(document).ready(function () {
  var minDateTime = new Date();
  $("#datetimepicker1").datetimepicker({
    inline: true,
    sideBySide: true,

    minDate: minDateTime
  });
});

let searchs = document.getElementById('cd-search');
let token = document.getElementsByName("_token")[0].value;

searchs.addEventListener('keyup',function busqueda(e){
  e.preventDefault();
 
  let words = this.value;
  let data = ({'words':words,'_token':token,'_method':'POST'});
  let url ='/buscarservicio';
  fetch(url,{
    method :'POST',
    body:JSON.stringify(data),
    headers:{
      "Content-Type":"application/json"
    } 
  }).then(res=>res.json()
  ).catch(error=>console.error('error',error)
  ).then(response => {
       
        listserv = "";
        $.each(response.resultado, function (i, e) {
          listserv += `<div class="bd-service-list--service">
                <div class="bd-icon-service-plus pull-left">
                </div>
                <span data-id="${e.id}" data-rama="busqueda" data-iduserservice="${e.user_id}" data-name="${e.name}">${e.name}</span>
                </div>`;
        });
        document.getElementById('contsub2').innerHTML=listserv;
      

  })
});
//bd-service--tab__active
let tabs = document.querySelectorAll('.bd-service--tab');


Array.from(tabs).forEach(link=>{
  link.addEventListener('click',function(e){
      $(".bd-service--tab").removeClass('bd-service--tab__active');
      let id = this.dataset.id;

      this.classList.add('bd-service--tab__active');

      $(".content-tab").removeClass('active');

      $(`.tab-servicio-${id}`).addClass('active');

  })
});

$("modal").hide();



function rating(valor) {
  
      let w = Math.max(0, (Math.min(5, parseFloat(valor)))) * 16;
      
      punto = `<span class="stars"><span style="width: ${w}px;"></span></span>`;
  
  return punto;
};