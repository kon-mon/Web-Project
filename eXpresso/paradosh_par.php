<?php
	$title='Διανομή Παραγγελίας | eXpresso';
	$tab=3;
	include 'header.php';
	
	require ("dbcontroller.php");
	$db_handle = new DBController();
	
	if ($user_type != 3)
	{
		header('Location: index.php');
		exit();
	}
	
	$report = "";
	
	if(isset($_GET['id_paradoshs']))
	{
		$paraggelia = $db_handle->selectQuery("SELECT * FROM paraggelia WHERE id_par ='".$_GET['id_paradoshs']."'");
		$db_handle->updateQuery("UPDATE paraggelia SET katastash_par='Παραδόθηκε' WHERE id_par ='".$_GET['id_paradoshs']."'");
		$stoixeia = $db_handle->selectQuery("SELECT * FROM dianomeas WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
		$dianomes = $stoixeia["dianomes"] + 1;
		$km = $stoixeia["km"] + $paraggelia["apostash"];
		$db_handle->updateQuery("UPDATE dianomeas SET katastash_dian='Ενεργός', latitude='".$paraggelia["latitude"]."', longitude='".$paraggelia["longitude"]."', dianomes='".$dianomes."', km='".$km."' 
								 WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
		
		$tziros_mhna = $db_handle->selectQuery("SELECT tziros FROM misthodosia_man WHERE katasthma ='".$paraggelia["katasthma_fk"]."' AND mhnas='".date("Y-m-00")."'");
		if ($tziros_mhna)
		{
			$tziros = $tziros_mhna["tziros"] + $paraggelia["kostos"];
			$db_handle->updateQuery("UPDATE misthodosia_man SET tziros='" . $tziros . "' WHERE katasthma ='".$paraggelia["katasthma_fk"]."' AND mhnas='".date("Y-m-00")."'");
		}
		else
		{
			$db_handle->insertQuery("INSERT INTO misthodosia_man (katasthma, mhnas, tziros, misthos_man) VALUES ('".$paraggelia["katasthma_fk"]."', '".date("Y-m-00")."', '".$paraggelia["kostos"]."', '0')");	
		}
		
		header('Location: paradosh_par.php');
		exit();
	}
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow&libraries=places"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
window.onload = function() {
  get_order();
};

$(function() {
    get_order();
});

var map;
var newmap = 0;
var markerKAT;
var markerPAR;
var myLatLngKAT = new google.maps.LatLng(38.246639, 21.734573);
var myLatLngPAR;

function get_order()
{
	$.ajax
	({
		url: "order_info.php",
		success: function (data) {
			resp = data.split('|');
			$( '#display_order' ).html(resp[0]);
			if (resp[1] != null) {
				myLatLngKAT = new google.maps.LatLng(resp[1], resp[2]);
				myLatLngPAR = new google.maps.LatLng(resp[3], resp[4]);
				map.setCenter(myLatLngPAR);
				getmarkers();
				newmap = 1;
			}
			else if (newmap == 1)
			{
				newmap = 0;
				markerKAT = [];
				markerPAR = [];
				initialize();
			}
			setTimeout(get_order, 10000);
		}
	});
}

function initialize(){
	var mapOptions = {
		zoom: 14,
		center: myLatLngKAT,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};

	map = new google.maps.Map(document.getElementById("map"), mapOptions);
}

google.maps.event.addDomListener(window, 'load', initialize);

function getmarkers(){
	markerKAT = new google.maps.Marker({
		map: map,
		icon:
			{
				url: 'images/katasthma.png',
				scaledSize: new google.maps.Size(55, 55)
			},
		position: myLatLngKAT
	});

	markerPAR = new google.maps.Marker({
		map: map,
		position: myLatLngPAR
	});
}
</script>

			<div class="wrapper" style="width:50%">
				<div class="border"></div>
				<article class=" fullwidth menu">
					<h5>Διεύθυνση Παραγγελίας:</h5>
					<br>
					<div id="map" style="height: 400px; width: 500px; margin: auto;"></div>
					<br>
				</article>

				<div id="display_order"> </div>
				<br>
			</div>
 
<?php
	include 'footer.php';
?>