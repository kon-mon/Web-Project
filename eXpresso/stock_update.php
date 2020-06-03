<?php
	$title='Απόθεμα | eXpresso';
	$tab=2;
	include 'header.php';
	
	if ($user_type != 2)
	{
		header('Location: index.php');
		exit();
	}
	
	require ("dbcontroller.php");
	$db_handle = new DBController();
	$katasthma = $db_handle->selectQuery("SELECT * FROM katasthma WHERE manager_fk='".$_SESSION ['AFM_man']."'");
	if(isset($_POST['submit']))  //thetei ws apothema th nea timh pou bazei o upeuthunos
	{
		$db_handle->updateQuery("UPDATE diathetei SET apothema='" . $_POST['quantity'] . "' WHERE onoma_kat='".$katasthma["onoma"]."' AND code_proiontos='" . $_GET["code"] . "'");
	}
?>
		
		  <div class="wrapper">
			  <div class="border"></div>
				<article class="fullwidth menu">
				  <h4>Ενημέρωση Αποθέματος</h4>
				  <br>
						
				  <div id="product-grid">
						<div class="txt-heading">Προϊόντα</div>
						<?php
						$product_array = $db_handle->runQuery("SELECT diathetei.apothema, proionta.* FROM diathetei INNER JOIN proionta ON diathetei.code_proiontos=proionta.code WHERE onoma_kat ='".$katasthma["onoma"]."' AND apothema<>'άπειρο' ORDER BY code ASC"); //emfanizei mono ta geumata gia na enhmerwsei to apothema tous
						if (!empty($product_array)) 
						{ 
							foreach($product_array as $key=>$value)
							{
						?>
							<div class="left">
								<form method="post" action="stock_update.php?code=<?php echo $product_array[$key]["code"]; ?>">
									<img src="<?php echo $product_array[$key]["eikona"]; ?>" class="left clear item" width="150" alt="">
									<h6><strong><?php echo $product_array[$key]["eidos"]; ?></strong></h6>
									<div style="font-size:18px; font-family: Palatino Linotype; color: #9c5959"><?php echo 'Κωδικός: '.$product_array[$key]["code"]; ?></div>
									<div style="font-size:18px; font-family: Palatino Linotype; color: #9c5959"><?php echo 'Τιμή: '.$product_array[$key]["timh"]." €"; ?></div>
									<div style="font-size:18px; font-family: Palatino Linotype; color: #9c5959"><?php echo 'Απόθεμα: '.$product_array[$key]["apothema"]; ?></div>
									<input type="text" name="quantity" value="1" size="2" />
									<input type="submit" name="submit" value="Ενημέρωση" class="menu-order button" />
								</form>
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