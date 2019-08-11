var init_map = function(isDetail) {

	var mapOptions = {
		zoom: 10,
		center: new google.maps.LatLng(-7.7918791, 110.4086587)
	};

	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	console.log("tes"+map);
	/* create marker and line by click */
	google.maps.event.addListener(map, 'click', function(event)
	{
		var location = event.latLng;
	});

	// handle click and dblclick same time
	google.maps.event.addListener(map, 'dblclick', function(event) {

	});

	if (navigator.geolocation) {
    my_location = JSON.parse('{"lat": -7.7935128, "lng": 110.4054529}');
    navigator.geolocation.getCurrentPosition(function(position){

			setUserLocToMap(position.coords.latitude, position.coords.longitude);

      console.log("shit "+position.coords.latitude);
      console.log(position.coords.longitude);
			my_location = JSON.parse('{"lat": '+position.coords.latitude+', "lng": '+position.coords.longitude+'}');
			my_marker = new Marker(map,
											my_location,
	                    "mymarker",
	                    "lokasiku");
      console.log("ini lokasiku "+my_location.lat);

			map.setCenter(my_location);
			if(isDetail){
				buatJalur($("#id_wisata").val());
			} else {
				ambilSemuaWisata();
			}
    });
  }else{
    console.log("pret");
  }
}
