<?php
	session_start();
	require ("dbcontroller.php");
	$db_handle = new DBController();
	$katasthma = $db_handle->selectQuery("SELECT * FROM katasthma WHERE manager_fk='".$_SESSION ['AFM_man']."'");
?> 
 <div id="product-grid" style = "text-align: center">
		<div class="txt-heading" style="font-size: 15px">Εκκρεμούν</div>
		<?php
		$product_array = $db_handle->runQuery("SELECT paraggelia.*, periexei.*, pelaths.email, dianomeas.username_dian FROM paraggelia 
												INNER JOIN pelaths ON pelaths.id_pelath=paraggelia.pelaths_fk 
												INNER JOIN dianomeas ON dianomeas.AFM_dian=paraggelia.dianomeas_fk 
												INNER JOIN periexei ON paraggelia.id_par=periexei.id_par 
												WHERE katasthma_fk ='".$katasthma["onoma"]."' AND katastash_par='Εκκρεμεί' 
												GROUP BY paraggelia.id_par ORDER BY paraggelia.id_par ASC");
		if (!empty($product_array)) 
		{
		?>
			<table cellpadding="10" cellspacing="1" style="width:100%;">
				<tbody>
					<tr height="25" style="border-bottom:#9c5959 2px solid;">
						<th style="text-align:center;"><strong>ID Παραγγελίας</strong></th>
						<th style="text-align:center;"><strong>Κόστος</strong></th>
						<th style="text-align:center;"><strong>Διανομέας</strong></th>
						<th style="text-align:center;"><strong>Πελάτης</strong></th>
						<th style="text-align:center;"><strong>Διεύθυνση</strong></th> 
						<th style="text-align:center;"></th>
					</tr>	
					<?php		
					foreach($product_array as $key=>$value)
					{
						$id_par = $product_array[$key]["id_par"];
					?>
							<tr height="25">
								<td style="text-align:center; width:10%; border-bottom:#9c5959 1px solid;">
									<?php echo $product_array[$key]["id_par"]; ?>
								</td>
								<td style="text-align:center; width:10%; border-bottom:#9c5959 1px solid;">
									<?php echo $product_array[$key]["kostos"]." €"; ?>
								</td>
								<td style="text-align:center; width:20%; border-bottom:#9c5959 1px solid;">
									<?php echo $product_array[$key]["username_dian"]; ?>
								</td>
								<td style="text-align:center; width:20%; border-bottom:#9c5959 1px solid;">
									<?php echo $product_array[$key]["email"]; ?>
								</td>
								<td style="text-align:center; width:40%; border-bottom:#9c5959 1px solid;">
									<?php echo $product_array[$key]["dieuthunsh"]; ?>
								</td>
								<td style="text-align:center; width:10%; border-bottom:#9c5959 1px solid;">
									<a href="orders.php?id_par=<?php echo $id_par; ?>"><div style="background-color: #ffffff; border: none; padding: 1px 10px; color: #9c5959; font-size: 12px; float: right; text-decoration: none; border-radius: 4px;">Λεπτομέρειες</div></a>
								</td>
							</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		<?php
		}
		else
		{
		?>
			<br><br>
			<div style="color: #9c5959; font-size: 16px; text-align: center"><?php echo 'Δεν υπάρχουν παραγγελίες προς παράδοση που εκκρεμούν αυτή τη στιγμή!';?></div>
		<?php
		}
		?>
		<br>
	</div>
	