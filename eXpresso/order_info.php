<?php
session_start();
require ("dbcontroller.php");
$db_handle = new DBController();
$info = $db_handle->selectQuery("SELECT paraggelia.*, pelaths.onoma_pelath, pelaths.thlefwno_pelath 
										FROM paraggelia INNER JOIN pelaths ON pelaths.id_pelath=paraggelia.pelaths_fk  
										WHERE dianomeas_fk ='".$_SESSION["AFM_dian"]."' AND katastash_par='Εκκρεμεί'");
if (!empty($info)) 
{
?>
	<h5>Λεπτομέρειες Παραγγελίας:</h5>
	<br>
	<table cellpadding="10" cellspacing="1" style="width:100%;">
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>ID Παραγγελίας:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["id_par"]; ?></td>
	  </tr>
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>Κόστος:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["kostos"]; ?></td>
	  </tr>
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>Κατάστημα:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["katasthma_fk"]; ?></td>
	  </tr>
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>Ονοματεπώνυμο Πελάτη:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["onoma_pelath"]; ?></td>
	  </tr>
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>Διεύθυνση:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["dieuthunsh"]; ?></td>
	  </tr>
	  <tr height="25" style="border-bottom:#9c5959 2px solid;">
		<th style="padding:10px"><strong>Τηλέφωνο:</strong></th>
		<td style="padding:10px; border-bottom:#9c5959 1px solid;"><?php echo $info["thlefwno_pelath"]; ?></td>
	  </tr>
	</table>
	<br>
	<a href="paradosh_par.php?id_paradoshs=<?php echo $info["id_par"]; ?>"><div style="width: 120px; text-align:center; margin: auto" class="button">Παραδόθηκε</div></a>
<?php
}
else
{
?>
	<h5>Λεπτομέρειες Παραγγελίας:</h5>
	<p>Καμία διαθέσιμη παραγγελία αυτή τη στιγμή</p>
<?php
}

$infoPAR = $db_handle->selectQuery("SELECT id_par, dieuthunsh, latitude, longitude FROM paraggelia WHERE dianomeas_fk ='".$_SESSION["AFM_dian"]."' AND katastash_par='Εκκρεμεί'");
$infoKAT = $db_handle->selectQuery("SELECT katasthma.latitude, katasthma.longitude FROM katasthma INNER JOIN paraggelia ON paraggelia.katasthma_fk=katasthma.onoma WHERE paraggelia.dianomeas_fk ='".$_SESSION["AFM_dian"]."' AND paraggelia.id_par='".$infoPAR["id_par"]."'");
if (!empty($infoPAR) AND !empty($infoKAT)) 
{
	echo "|".$infoKAT["latitude"]."|".$infoKAT["longitude"]."|".$infoPAR["latitude"]."|".$infoPAR["longitude"];
}
?>