var map;

//location of all restaurants (latitude and longitude)
var locations = [
				[-27.4694421, 153.0032058,'Arrivederci Pizza Al Metro','img/marker/red_MarkerA.png'],
				[-27.4786706,153.0140952,'Ouzeri','img/marker/red_MarkerB.png'],
				[-27.4792893,153.0136446,'Little Greek Taverna','img/marker/red_MarkerC.png']
				]

										
function initialize() {
	var marker;
	var i;

    //map variable
    var mapOptions = {
    center: { lat: -27.4718335, lng: 153.0129446},
    zoom: 14
    };

    //represent map is the google map class
    var map = new google.maps.Map(document.getElementById('rest-maps'),
    mapOptions);

    //info window
    var infowindow = new google.maps.InfoWindow();

    //markers
    for (i=0; i < locations.length;i++){
    	marker = new google.maps.Marker({
    		position: new google.maps.LatLng(locations[i][0], locations[i][1]),
    		map: map,
    		title: locations[i][2],
            icon: locations[i][3]
    		
    	});

        //info window
    	google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][2]);
              infowindow.open(map, marker);
            }
          })(marker, i));
    }

}



google.maps.event.addDomListener(window, 'load', initialize);
