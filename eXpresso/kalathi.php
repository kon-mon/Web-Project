<?php
	$title='Καλάθι | eXpresso';
	$tab=3;
	include 'header.php';
	
	if ($user_type != 0 && $user_type != 1)
	{
		header('Location: index.php');
		exit();
	}
	
	require ("order_check.php");
?>
			
			<script type="text/javascript" src="map_script.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow&libraries=places&callback=initMap" async defer></script>
			
			<div class="wrapper">
				<br>
				<div style="font-family: Palatino Linotype; font-size: 18px; color: #ff0000;"><?php echo $report ?></div><br>
				<div class="border"></div>
				<article>
					<h4>Εισάγετε τη διεύθυνσή σας</h4>
					<p style="font-family: Palatino Linotype; font-size: 18px; color: #9c5959;">Πληκτρολογήστε τη διεύθυνσή σας ή μετακινήστε το δείκτη του χάρτη στην τοποθεσία σας</p>
					<br>

					<input id="pac-input" type="text" placeholder="Εισαγωγή διεύθυνσης">

					<div style="height: 500px; width:600px;"><div id="map"></div></div>

					<form action="kalathi.php" method="post">
						<br><br>
						<div id="address-text"> </div>
						<input id="location-address" name="location-address" type="hidden">
						<input id="latitude" name="latitude" type="hidden">
						<input id="longitude" name="longitude" type="hidden">	
						<input id="address" type="hidden" value="Πλατεία Γεωργίου Α, Πλ. Γεωρ. Α Πάτρα Αχαΐα GR 262 21"> <!--Arxikh thesh tou marker-->
						<br><br>
						<div style="text-align: center;"><input type="submit" name= "submit" value="ΟΛΟΚΛΗΡΩΣΗ ΠΑΡΑΓΓΕΛΙΑΣ" class="button" /></div>
					</form>

					<br>
				</article>
				
				<aside class="sidebar">
				  <h5>Προϊόντα στο καλάθι: </h5>
				  <br>
				<?php								
					if(isset($_SESSION["cart_item"])) //Emsanizei se pinaka ta proionta pou exei balei o xrhsths sto kalathi kathws kai th sunolikh timh
					{
						$item_total = 0;
						$quantity_total = 0;
				?>	
						<table cellpadding="10" cellspacing="1">
							<tbody>
								<tr style="color: #9c5959; border-bottom:#9c5959 2px solid;">
									<th style="text-align:left;"><strong>Προϊόν</strong></th>
									<th style="text-align:left;"><strong>Ποσότητα</strong></th>
									<th style="text-align:right;"><strong>Τιμή</strong></th>
								</tr>
								<?php		
								foreach ($_SESSION["cart_item"] as $item)
								{
								?>
									<tr style="border-bottom:#9c5959 1px solid;">
										<td style="text-align:left;"><strong><?php echo $item["eidos"]; ?></strong></td>
										<td style="text-align:center;"><?php echo $item["quantity"]; ?></td>
										<td style="text-align:right;"><?php echo $item["timh"]." €"; ?></td>
									</tr>
								<?php
									$item_total += ($item["timh"]*$item["quantity"]);
									$quantity_total += $item["quantity"];
								}
								?>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="1" align=center><span class="price" style="color: #9c5959"><i class="fa fa-shopping-cart"></i> <b><?php echo $quantity_total; ?></b></span></td>
									<td colspan="3" align=right><strong>Σύνολο:</strong> <?php echo number_format((float)$item_total, 2, '.', '')." €"; ?></td> <!--Emsanizei thn timh me akribeia 2 dekadikwn-->
								</tr>
							</tbody>
						</table>
					<?php
					}
					else
					{
					?>
						<div class="price" style="color: #9c5959;"><?php echo 'Το καλάθι σας είναι άδειο: '; ?><i class="fa fa-shopping-cart"></i> <b><?php echo '0'; ?></b></div>
					<?php
					}
					?>
				  
				</aside>
				<br>
			</div>
			
<?php
	include 'footer.php';
?>