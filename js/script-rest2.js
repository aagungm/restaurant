function initialize(){
        var myLatlng = new google.maps.LatLng(-27.4786706,153.0140952);
        var mapOptions = {
          zoom: 14,
          center: myLatlng
        }
        var map = new google.maps.Map(document.getElementById("map-rest2"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            title:"Hello World!"
        });

        // To add the marker to the map, call setMap();
        marker.setMap(map);

}

google.maps.event.addDomListener(window, 'load', initialize);