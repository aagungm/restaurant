var map;
var mymarker;
var geocoder;
var placesServ;
var center;
var placeholder = document.getElementById("userLocation");
var markers = [];
var dragListener;


function init() {
  
  var mapOpts = {
    center: {lat: -27.4980876, lng: 152.9933706},
    zoom: 15
  }
  map = new google.maps.Map(document.getElementById("rest-maps"), mapOpts);
  map.setTilt(45);


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(swooty);
  } else {
    placeholder.innerHTML = "Geolocation service is not supported by your browser."
  }

 
  dragListener = google.maps.event.addListener(map, 'dragend', function() {

    window.setTimeout(function() {
      var getCenter = map.getCenter();
      getPlaces(getCenter);
    }, 2000);
  });
}

function searchPlaces(query) {
  var temp = map.getCenter();
  var coords = temp.lat() + "," + temp.lng();
  var muppet = new XMLHttpRequest();
  muppet.onreadystatechange = function() {
    if (muppet.readyState == 4 && muppet.status == 200) {
      var result = JSON.parse(muppet.responseText);
      var bleh;
      for (var i=0; i<result.length; i++) {
      
        var marker = new google.maps.Marker({
          position: {lat: parseFloat(result[i].location["lat"]), lng: parseFloat(result[i].location["lng"])},
          map: map,
          title: result[i].name,
           icon: 'img/marker/red_Marker'+i+'.png'
        });
    
        if (i==0 && markers.length > 0) {
          for (var j=0; j<markers.length; j++) {
            markers[j].setMap(null);
          }
          markers = [];
          $('restaurantsTable').html('');
        }
        markers.push(marker);
       


        if(bleh == null){
        bleh ="<div class='row restaurant'>" 
        + "<div class='col-md-2 col-xs-2 marker'>" + "<img class='img-responsive' src='img/marker/red_Marker"+i+".png'>"
        + "</div>" +"<div class='col-md-8 col-xs-8'>"+ "<p><b>"+result[i].name+"</b><br>"
        + result[i].address + "<br>" 
        + "<a href='moreInfo.php?ref="+result[i].id+"'>More Info</a>"
        + "</div>"
        + "</div>";
      }else {
        bleh = bleh + "<div class='row restaurant'>" 
        + "<div class='col-md-2 col-xs-2 marker'>" + "<img class='img-responsive' src='img/marker/red_Marker"+i+".png'>"
        + "</div>" +"<div class='col-md-8 col-xs-8'>"+ "<p><b>"+result[i].name+"</b><br>"
        + result[i].address + "<br>" 
        + "<a href='moreInfo.php?ref="+result[i].id+"'>More Info</a>"
        + "</div>"
        + "</div>";

      }
      
      }
      $('#restaurantsTable').html(bleh);
    }
  };
  muppet.open("GET", "searchPlaces.php?coords="+coords+"&query="+query, true);
  muppet.send();
}

function getPlaces(location) {
  var coords = location.lat() + "," + location.lng();
  var muppet = new XMLHttpRequest();
  muppet.onreadystatechange = function() {
    if (muppet.readyState == 4 && muppet.status == 200) {
      var result = JSON.parse(muppet.responseText);
      var bleh;
      for (var i=0; i<result.length; i++) {
    
        var marker = new google.maps.Marker({
          position: {lat: parseFloat(result[i].location["lat"]), lng: parseFloat(result[i].location["lng"])},
          map: map,
          title: result[i].name,
          icon: 'img/marker/red_Marker'+i+'.png'
        });
    
        if (i==0 && markers.length > 0) {
          for (var j=0; j<markers.length; j++) {
            markers[j].setMap(null);
          }
          markers = [];
          $('restaurantsTable').html('');
        }
        markers.push(marker);
      

       if(bleh == null){
        bleh ="<div class='row restaurant'>" 
        + "<div class='col-md-2 col-xs-2 marker'>" + "<img class='img-responsive' src='img/marker/red_Marker"+i+".png'>"
        + "</div>" +"<div class='col-md-8 col-xs-8'>"+ "<p><b>"+result[i].name+"</b><br>"
        + result[i].address + "<br>" 
        + "<a href='moreInfo.php?ref="+result[i].id+"'>More Info</a>"
        + "</div>"
        + "</div>";
      }else {
        bleh = bleh + "<div class='row restaurant'>" 
        + "<div class='col-md-2 col-xs-2 marker'>" + "<img class='img-responsive' src='img/marker/red_Marker"+i+".png'>"
        + "</div>" +"<div class='col-md-8 col-xs-8'>"+ "<p><b>"+result[i].name+"</b><br>"
        + result[i].address + "<br>" 
        + "<a href='moreInfo.php?ref="+result[i].id+"'>More Info</a>"
        + "</div>"
        + "</div>";

      }
        
      }
      $('#restaurantsTable').html(bleh);
    }
  };
  muppet.open("GET", "getPlaces.php?coords="+coords, true);
  muppet.send();
}

function swooty(pos) {
  
  center = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
  map.setCenter(center);

  geocoder = new google.maps.Geocoder();
  geocoder.geocode({'latLng': {lat: pos.coords.latitude, lng: pos.coords.longitude}}, function(results, status) {
   
      var result = results[0];
     
      var swiggity = result.address_components.length;
      var street, suburb;
         if (status == google.maps.GeocoderStatus.OK) {
               mymarker = new google.maps.Marker({
                        position: center,
                        map: map,
                        icon: 'img/marker/blue.png'
                    });

           
           
      for (var i=0; i<swiggity; i++) {
        var temp = result.address_components[i];
        if (temp.types.indexOf("route") >= 0) {
          street = result.address_components[i].long_name;
        }
        if (temp.types.indexOf("locality") >= 0) {
          suburb = result.address_components[i].short_name;
        }
      }

      placeholder.innerHTML = "You are at " + suburb + ".";

    } else {
      placeholder.innerHTML = "Geolocation service failed to get your location information.";
    }
  });
  getPlaces(center);
}

function loadMap() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?callback=init";
  document.body.appendChild(script);
}

window.onload = loadMap;