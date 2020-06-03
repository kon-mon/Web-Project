<?php
	$title='Χάρτης Καταστημάτων | eXpresso';
	$tab=4;
	include 'header.php';
	
	if ($user_type != 0 && $user_type != 1)
	{
		header('Location: index.php');
		exit();
	}
?>
			<div class="wrapper">
				<div class="border"></div>
				<article>
				  <h3>Βρείτε μας εδώ:</h3>
				  <br />
				  <div id="map2" style="height: 500px; width: 600px;"></div>
				  
				  <script type="text/javascript">
					function myMap()
					{
						var locations = [
						  ['eXpresso Benizelou, Ελ. Βενιζέλου 5', 38.22876, 21.742261, 4],
						  ['eXpresso Rio, Σώμερσετ 2', 38.300957, 21.782196, 5],
						  ['eXpresso Maragkopoulou, Μαραγκοπούλου 2', 38.237795, 21.747575, 3],
						  ['eXpresso Agias Sofias, Αγίας Σοφίας 54', 38.256099, 21.74548, 2],
						  ['eXpresso kentro, Παντανάσσης 65', 38.244496, 21.734825, 1]
						];

						var map = new google.maps.Map(document.getElementById('map2'), {
						  zoom: 12,
						  center: new google.maps.LatLng(38.261746, 21.755794),
						  mapTypeId: google.maps.MapTypeId.ROADMAP
						});

						var infowindow = new google.maps.InfoWindow();

						var marker, i;

						for (i = 0; i < locations.length; i++) 
						{ 
						  marker = new google.maps.Marker({
							position: new google.maps.LatLng(locations[i][1], locations[i][2]),
							map: map
						  });

						  google.maps.event.addListener(marker, 'click', (function(marker, i) {
							return function() {
							  infowindow.setContent(locations[i][0]);
							  infowindow.open(map, marker);
							}
						  })(marker, i));
						}
					}
				  </script>
				  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow&libraries=places&callback=myMap"></script>
				</article>
				
			    <aside class="sidebar" style="text-align: center;">
					<h3>Καταστήματα:</h3>
					<br>
					<ul>
						<li><h6>eXpresso kentro</h6><div style="font-size:18px; font-family: Palatino Linotype;">* Παντανάσσης 65, 261021436, 26225 *</div></li><br />
						<li><h6>eXpresso Agias Sofias</h6> <div style="font-size:18px; font-family: Palatino Linotype;">* Αγίας Σοφίας 54, 2610354987, 26441 *</div></li><br />
						<li><h6>eXpresso Maragkopoulou</h6> <div style="font-size:18px; font-family: Palatino Linotype;">* Μαραγκοπούλου 2, 261012365, 26331 *</div></li><br />
						<li><h6>eXpresso Rio</h6> <div style="font-size:18px; font-family: Palatino Linotype;">* Σώμερσετ 2, 2610342112, 26444 *</div></li><br />
						<li><h6>eXpresso Benizelou</h6><div style="font-size:18px; font-family: Palatino Linotype;">* Ελ. Βενιζέλου 5, 2610234530, 26222 *</div></li><br />
					</ul>  
				</aside>
				<br>	
			</div>

<?php
	include 'footer.php';
?>