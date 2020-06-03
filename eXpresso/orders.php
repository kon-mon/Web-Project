<?php
	$title='Εξέλιξη | eXpresso';
	$tab=3;
	include 'header.php';
	
	if ($user_type != 2)
	{
		header('Location: index.php');
		exit();
	}
	
	require ("dbcontroller.php");
	$db_handle = new DBController();
	$katasthma = $db_handle->selectQuery("SELECT * FROM katasthma WHERE manager_fk='".$_SESSION ['AFM_man']."'");
	
	if(isset($_GET['id_par']))
	{
		$proionta_paraggelias = $db_handle->runQuery("SELECT id_proiontos, posothta FROM periexei WHERE id_par='".$_GET['id_par']."'");
	}
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
window.onload = function() {
  get_table();
};

$(function() {
    get_table();
});

function get_table()
{
	$.ajax
	({
		url: "orders_table.php",
		success: function (response) {
		   $( '#display_orders' ).html(response);
		   setTimeout(get_table, 10000);
		  }
	});
}
 </script>

			
		  <div class="wrapper">
			  <div class="border"></div>
				<article class="fullwidth menu">
				  <h4>Παραγγελίες σε εξέλιξη</h4>
				  <p>Κατάστημα: <?php echo $katasthma["onoma"]; ?></p>
				  <br>
					
					<div id="display_orders"> </div>
					
					<?php
					if (!empty($proionta_paraggelias)) 
					{
					?>					
						<div id="product-grid" style="width:50%; margin: auto; text-align: center">
							<div class="txt-heading" style="font-size: 15px">Περιεχόμενα Παραγγελίας No.<?php echo $_GET["id_par"]; ?></div>
							
							<table cellpadding="10" cellspacing="1" align="center" style="width:100%;">
								<tbody>
									<tr height="25" style="border-bottom:#9c5959 2px solid;">
										<th style="text-align:center;"><strong>Προϊόν</strong></th>
										<th style="text-align:center;"><strong>Ποσότητα</strong></th>
										<th style="text-align:center;"></th>
									</tr>	
									<?php		
									foreach($proionta_paraggelias as $key=>$value)
									{
									?>
										<tr height="25">
											<td style="text-align:center; border-bottom:#9c5959 1px solid;"><?php echo $proionta_paraggelias[$key]["id_proiontos"]; ?></td>
											<td style="text-align:center; border-bottom:#9c5959 1px solid;"><?php echo $proionta_paraggelias[$key]["posothta"]; ?></td>
										</tr>
									<?php
									}
									?>
									<tr>
										<td align="center" colspan="2"><a href="orders.php"><div style="background-color: #ffffff; border: none; margin-top: 15px; padding: 1px 10px; width: 20%; color: #9c5959; font-size: 15px; text-decoration: none; border-radius: 4px;">Κλείσιμο</div></a></td>
									</tr>
								</tbody>
							</table>
							
							<br>
						</div>
					<?php
					}
					?>
					
				</article>

				<br>
			</div>
<?php
	include 'footer.php';
?>