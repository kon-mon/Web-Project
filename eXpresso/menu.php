<?php
	$title='Μενού | eXpresso';
	$tab=2;
	include 'header.php';
	
	if ($user_type != 0 && $user_type != 1)
	{
		header('Location: index.php');
		exit();
	}

	require_once("dbcontroller.php");
	$db_handle = new DBController();
	if(!empty($_GET["action"])) 
	{
		switch($_GET["action"]) 
		{
			case "add":
				if (isset($_SESSION ['id_pelath']))
				{
					if(!empty($_POST["quantity"]))
					{
						$productByCode = $db_handle->runQuery("SELECT * FROM proionta WHERE code='" . $_GET["code"] . "'");
						$itemArray = array($productByCode[0]["code"]=>array('eidos'=>$productByCode[0]["eidos"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'timh'=>$productByCode[0]["timh"]));
						
						if(!empty($_SESSION["cart_item"]))
						{
							if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"])))
							{
								foreach($_SESSION["cart_item"] as $k => $v)
								{
										if($productByCode[0]["code"] == $k)
										{
											if(empty($_SESSION["cart_item"][$k]["quantity"]))
											{
												$_SESSION["cart_item"][$k]["quantity"] = 0;
											}
											$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
										}
								}
							}
							else
							{
								$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
							}
						} 
						else
						{
							$_SESSION["cart_item"] = $itemArray;
						}
					}
				}
				else
					{
							echo 'Πρέπει να <a href="login.php" style="color:#990000; font-size:16px; font-family: Palatino Linotype">συνδεθείτε</a> για να συνεχίσετε!';
					}
			break;
			case "remove":
				if(!empty($_SESSION["cart_item"]))
				{
					foreach($_SESSION["cart_item"] as $k => $v)
					{
							if($_GET["code"] == $k)
								unset($_SESSION["cart_item"][$k]);				
							if(empty($_SESSION["cart_item"]))
								unset($_SESSION["cart_item"]);
					}
				}
			break;
			case "empty":
				unset($_SESSION["cart_item"]);
			break;	
		}
	}
?>
		  
			<div class="wrapper">
				<div class="border"></div>
				<article class=" fullwidth menu">

					<div id="shopping-cart">
						<div class="txt-heading">Παραγγελία <a id="btnEmpty" href="menu.php?action=empty">Καθαρισμός Παραγγελίας</a></div>
						 <?php
						if(isset($_SESSION["cart_item"]))
						{
							$item_total = 0;
						 ?>	
							<table cellpadding="10" cellspacing="1">
								<tbody>
									<tr>
										<th style="text-align:left;"><strong>Προϊόν</strong></th>
										<th style="text-align:right;"><strong>Ποσότητα</strong></th>
										<th style="text-align:right;"><strong>Τιμή</strong></th>
										<th style="text-align:center;"><strong>Ενέργεια</strong></th>
									</tr>	
									<?php		
										foreach ($_SESSION["cart_item"] as $item)
										{
											?>
													<tr>
													<td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["eidos"]; ?></strong></td>
													<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
													<td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["timh"]." €"; ?></td>
													<td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="menu.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Αφαίρεση Προϊόντος</a></td>
													</tr>
													<?php
											$item_total += ($item["timh"]*$item["quantity"]);
										}
									?>

									<tr>
										<td colspan="4" align=right><strong>Σύνολο:</strong> <?php echo number_format((float)$item_total, 2, '.', '')." €"; ?></td> <!--Emsanizei thn timh me akribeia 2 dekadikwn-->
									</tr>
									<tr>
										<td colspan="4" align=right><a id="btn" href="kalathi.php">Ολοκλήρωση Παραγγελίας</a></td>
									</tr>
								</tbody>
							</table>		
						 <?php
						}
						 ?>
					</div>

					<div id="product-grid">
						<div class="txt-heading">Προϊόντα</div>
						<?php
						$product_array = $db_handle->runQuery("SELECT * FROM proionta ORDER BY code ASC"); 
						if (!empty($product_array)) 
						{ 
							foreach($product_array as $key=>$value)
							{
						?>
								<div class="left">
									<form method="post" action="menu.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
										<img src="<?php echo $product_array[$key]["eikona"]; ?>" class="left clear item" width="150" alt="">
										<h6><strong><?php echo $product_array[$key]["eidos"]; ?></strong></h6>
										<div style="font-size:18px; font-family: Palatino Linotype; color: #9c5959"><?php echo $product_array[$key]["timh"]." €"; ?></div>
										<div><input type="text" name="quantity" value="1" size="2" />
									</form>
									
									<input type="submit" value="Παραγγελία" class="menu-order button" /></div>
									<br>
								</div>							
						<?php
							}
						}
						?>
						<br>
					</div>
				</article>
				<br>	  
			</div>

<?php
	include 'footer.php';
?>