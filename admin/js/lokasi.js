function updateMarkerPosition(latLng) {
		document.getElementById('lati').value = [latLng.lat()];
		document.getElementById('long').value = [latLng.lng()];
	}

var myOptions = {
	zoom: 12,
	scaleControl: true,
	center:  new google.maps.LatLng(-5.143662,119.426339),
	mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map = new google.maps.Map(document.getElementById("map14"), myOptions);

var marker1 = new google.maps.Marker({
	position : new google.maps.LatLng(-5.143662,119.426339),
	title : 'Lokasi',
	map : map,
	draggable : true
});
	
//updateMarkerPosition(latLng);

google.maps.event.addListener(marker1, 'drag', function() {
	updateMarkerPosition(marker1.getPosition());
});	