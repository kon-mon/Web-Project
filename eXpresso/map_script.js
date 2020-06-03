var geocoder;
var map;
var marker;
var infowindow = new google.maps.InfoWindow({size: new google.maps.Size(150,50)});
function initMap()
{
	geocoder = new google.maps.Geocoder();
	var latlng = new google.maps.LatLng(38.246639, 21.734573);
	var mapOptions = {
		zoom:15,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	}

	document.getElementById('address-text').innerHTML='<strong>Διεύθυνση: </strong>';
	
	map = new google.maps.Map(document.getElementById('map'), mapOptions);

	var input = document.getElementById('pac-input');

	var autocomplete = new google.maps.places.Autocomplete(input);

	autocomplete.bindTo('bounds', map);

	var address = document.getElementById('address').value;
	geocoder.geocode( { 'address': address}, function(results, status) {
		if (status == google.maps.GeocoderStatus.OK)
		{
			map.setCenter(results[0].geometry.location);
			if (marker) {
				marker.setMap(null);
				if (infowindow) infowindow.close();
			}
			marker = new google.maps.Marker({
				map: map,
				draggable: true,
				position: results[0].geometry.location
			});
			
			google.maps.event.addListenerOnce(map, 'idle', function () {
				google.maps.event.trigger(map, 'resize');
			});
			
			google.maps.event.addListener(marker, 'dragend', function() {
				geocodePosition(marker.getPosition());
				
			});

			google.maps.event.trigger(marker, 'click');
			
		}
		else
		{
			alert('Geocode was not successful for the following reason: ' + status);
		}
	});

	autocomplete.addListener('place_changed', function() {

		marker.setVisible(false);
		var place = autocomplete.getPlace();
		if (!place.geometry) {
			window.alert("Καμία διαθέσιμη πληροφορία για τη διεύθυνση: '" + place.name + "'");
			return;
		}

		if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		} else {
			map.setCenter(place.geometry.location);
			map.setZoom(17);
		}
		marker.setPosition(place.geometry.location);
		marker.setVisible(true);

		var address = '';
		if (place.address_components) {
			address = [
			(place.address_components[1] && place.address_components[1].short_name || ''), //odos prwta
			(place.address_components[0] && place.address_components[0].short_name || ''), //arithmos meta
			(place.address_components[2] && place.address_components[2].short_name || ''),
			(place.address_components[3] && place.address_components[3].short_name || ''),
			(place.address_components[4] && place.address_components[4].short_name || ''),
			(place.address_components[5] && place.address_components[5].short_name || '')
			].join(' ');
		}

		document.getElementById('address-text').innerHTML='<strong>Διεύθυνση: </strong>'+address;

		document.getElementById('location-address').value=address;
		document.getElementById('latitude').value=place.geometry.location.lat();
		document.getElementById('longitude').value=place.geometry.location.lng();
		
	});

}

function geocodePosition(pos) 
{
	geocoder.geocode({latLng: pos}, function(responses) {
		if (responses && responses.length > 0) {
			marker.formatted_address = responses[0].formatted_address;
		} else {
			marker.formatted_address = 'Δε μπορεί να προσδιοριστεί η διεύθυνση γι`αυτή την τοποθεσία!';
		}

		document.getElementById('address-text').innerHTML='<strong>Διεύθυνση: </strong>'+marker.formatted_address;
		
		document.getElementById('location-address').value=marker.formatted_address;
		document.getElementById('latitude').value=marker.getPosition().lat();
		document.getElementById('longitude').value=marker.getPosition().lng();
	});
}