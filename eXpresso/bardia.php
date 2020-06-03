<?php
	$title='Ενεργοποίηση Βάρδιας | eXpresso';
	$tab=2;
	include 'header.php';
	
	require ("dbcontroller.php");
	$db_handle = new DBController();
	
	if ($user_type != 3)
	{
		header('Location: index.php');
		exit();
	}
	
	$report = "";
	
	if(isset($_POST['start']))
	{
		$katastash = $db_handle->selectQuery("SELECT katastash_dian FROM dianomeas WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
		if ($katastash["katastash_dian"] == 'Ανενεργός')
		{

			if (!empty($_POST['location-address']))
			{
				$db_handle->updateQuery("UPDATE dianomeas SET katastash_dian='Ενεργός', latitude='".$_POST['latitude']."', longitude='".$_POST['longitude']."', start_bardia='".date("Y-m-d H:i:sa")."'  WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
				header('Location: paradosh_par.php');
				exit();
			}
			else
			{
				$report = "Εισάγετε Διεύθυνση!";
			}
		}
		else
		{
			$report = "Η βάρδιά σας έχει ήδη ξεκινήσει!";
		}
	}
	else if (isset($_POST['stop']))
	{
		$stoixeia_bardias = $db_handle->selectQuery("SELECT start_bardia, dianomes, km FROM dianomeas WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
		$db_handle->updateQuery("UPDATE dianomeas SET katastash_dian='Ανενεργός', latitude='0', longitude='0', dianomes='0', km='0' WHERE AFM_dian ='".$_SESSION["AFM_dian"]."'");
		
		$start_t = new DateTime($stoixeia_bardias["start_bardia"]);
		$now = new DateTime();
		$wres = $start_t->diff($now)->format("%d") * 24 + $start_t->diff($now)->format("%h");
		$misthos_meras = (5 * $wres) + (0.1 * $stoixeia_bardias["km"] * 0.001);
		$stoixeia_mhna = $db_handle->selectQuery("SELECT km, wres, misthos_dian FROM misthodosia_dian WHERE AFM_dian ='".$_SESSION["AFM_dian"]."' AND mhnas='".date("Y-m-00")."'");
		if ($stoixeia_mhna)
		{
			$km_mhna = $stoixeia_mhna["km"] + $stoixeia_bardias["km"];
			$wres_mhna = $stoixeia_mhna["wres"] + $wres;
			$misthos_mhna = $stoixeia_mhna["misthos_dian"] + $misthos_meras;
			$db_handle->updateQuery("UPDATE misthodosia_dian SET km='".$km_mhna."', wres='".$wres_mhna."', misthos_dian='".$misthos_mhna."'
									 WHERE AFM_dian ='".$_SESSION["AFM_dian"]."' AND mhnas='".date("Y-m-00")."'");	
		}
		else
		{
			$km_mhna = $stoixeia_bardias["km"];
			$wres_mhna = $wres;
			$misthos_mhna = $misthos_meras;
			$db_handle->insertQuery("INSERT INTO misthodosia_dian (AFM_dian, km, wres, misthos_dian, mhnas) VALUES ('".$_SESSION["AFM_dian"]."', '".$km_mhna."', '".$wres_mhna."', '".$misthos_mhna."', '".date("Y-m-00")."')");	
		}
		$report = 'Σύνολο χρημάτων: '.number_format((float)$misthos_meras, 2, '.', '').' € <br>';
		$report .= 'Ώρες βάρδιας: '.$wres.'<br>';
		$report .= 'Πλήθος διαδρομών: '.$stoixeia_bardias["dianomes"].'<br>';
		$report .= 'Απόσταση που διανύθηκε: '.$stoixeia_bardias["km"].' μέτρα <br>';
	}
?>
			
			<script type="text/javascript" src="map_script.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow&libraries=places&callback=initMap" async defer></script>
			
			<div class="wrapper">
			<br>
			<div style="font-family: Palatino Linotype; font-size: 18px; color: #ff0000;"><?php echo $report ?></div><br>
				<div class="border"></div>
				<article class="fullwidth menu">
					<h4 style="text-align: center;">Εισάγετε τη διεύθυνσή σας</h4>
					<p style="width: 100%; text-align: center;">Πληκτρολογήστε τη διεύθυνσή σας ή μετακινήστε το δείκτη του χάρτη στην τοποθεσία σας</p>
					<br>

					<div style="width: 75%; margin: 0 auto 0 auto;"> <input id="pac-input" type="text" placeholder="Εισαγωγή διεύθυνσης"></div>

					<div style="height: 500px; width:600px; margin: 0 auto 0 auto;"><div id="map"></div></div>

					<form action="bardia.php" method="post">
						<br><br>
						<div style="width: 55%; margin: 0 auto 0 auto;" id="address-text"> </div>
						<input id="location-address" name="location-address" type="hidden">
						<input id="latitude" name="latitude" type="hidden">
						<input id="longitude" name="longitude" type="hidden">	
						<input id="address" type="hidden" value="Πλατεία Γεωργίου Α, Πλ. Γεωρ. Α Πάτρα Αχαΐα GR 262 21"> <!--Arxikh thesh tou marker-->
						<br><br>
						<div style="text-align: center;"><input style="margin-right: 5px;" type="submit" name= "start" value="ΕΝΑΡΞΗ ΒΑΡΔΙΑΣ" class="button" />
						<input style="margin-left: 5px;" type="submit" name= "stop" value="ΛΗΞΗ ΒΑΡΔΙΑΣ" class="button" /></div>
					</form>

					<br>
				</article>
				
				<br>
			</div>
			
<?php
	include 'footer.php';
?>