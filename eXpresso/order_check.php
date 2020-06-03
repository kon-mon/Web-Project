<?php
	require ("dbcontroller.php");
	$db_handle = new DBController();
	
	
	$odos_error = "";
	$arithmos_error = "";
	$tk_error = "";
	$report = "";
	$neo_apothema = 0; 
	$epilegmeno_katasthma = "";
	$epilegmenos_dianomeas = 0;

	if(isset($_POST['submit']))
	{
		if(!empty($_SESSION["cart_item"]))
		{
			if (!empty($_POST['location-address']))
			{
				$katasthmata = $db_handle->runQuery("SELECT * FROM katasthma");
				$elaxisth_apostash_kat = 99999999;
				foreach ($katasthmata as $key=>$value)
				{
					$epilegmeno = TRUE;
					foreach ($_SESSION["cart_item"] as $item)
					{
						$product_array = $db_handle->selectQuery("SELECT apothema FROM diathetei WHERE onoma_kat ='".$katasthmata[$key]["onoma"]."' AND code_proiontos = '".$item["code"]."'");
						if(($product_array["apothema"] != 'άπειρο') AND ($product_array["apothema"] < $item["quantity"]))
						{
							$epilegmeno = FALSE;
							break;
						}
					}
					if($epilegmeno == TRUE)
					{
						$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$katasthmata[$key]['latitude'].",".$katasthmata[$key]['longitude']."&destinations=".$_POST['latitude'].",".$_POST['longitude']."&key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow";
						$json = file_get_contents($url);
						$responce = json_decode($json, true);
						$apostash = $responce['rows'][0]['elements'][0]['distance']['value'];
						if ($apostash < $elaxisth_apostash_kat)
						{
							$elaxisth_apostash_kat = $apostash;
							$epilegmeno_katasthma = $katasthmata[$key]["onoma"];
						}
					}
				}
				
				if ($epilegmeno_katasthma)
				{
					$stoixeia_katasthmatos = $db_handle->selectQuery("SELECT * FROM katasthma WHERE onoma ='".$epilegmeno_katasthma."'");
					$dianomeis = $db_handle->runQuery("SELECT * FROM dianomeas");
					$elaxisth_apostash_dian = 99999999;
					foreach ($dianomeis as $key=>$value)
					{
						if ($dianomeis[$key]['katastash_dian'] == 'Ενεργός')
						{
							$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$dianomeis[$key]['latitude'].",".$dianomeis[$key]['longitude']."&destinations=".$stoixeia_katasthmatos['latitude'].",".$stoixeia_katasthmatos['longitude']."&key=AIzaSyDG_IHU60IbTL92TRjbj6vJVoB6yvzMDow";
							$json = file_get_contents($url);
							$responce = json_decode($json, true);
							$apostash = $responce['rows'][0]['elements'][0]['distance']['value'];
						
							if ($apostash < $elaxisth_apostash_dian)
							{
								$elaxisth_apostash_dian = $apostash;
								$epilegmenos_dianomeas = $dianomeis[$key]["AFM_dian"];
							}
							
						}
					}
					
					if ($epilegmenos_dianomeas)
					{
						$apostash_paraggelias = $elaxisth_apostash_kat + $elaxisth_apostash_dian;
						$cost = 0;
						foreach ($_SESSION["cart_item"] as $item)
						{
							$cost += ($item["timh"]*$item["quantity"]);
						}
						$id_par = $db_handle->insertQuery("INSERT INTO paraggelia (kostos, apostash, katasthma_fk, dianomeas_fk, pelaths_fk, dieuthunsh, latitude, longitude, hmeromhnia) VALUES ('".$cost."', '".$apostash_paraggelias."', '".$epilegmeno_katasthma."', '".$epilegmenos_dianomeas."', '".$_SESSION ['id_pelath']."','".$_POST['location-address']."','".$_POST['latitude']."','".$_POST['longitude']."','".date("Y-m-d")."')");
						if ($id_par)
						{
							$db_handle->updateQuery("UPDATE dianomeas SET katastash_dian='Μη διαθέσιμος' WHERE AFM_dian ='".$epilegmenos_dianomeas."'");
							foreach ($_SESSION["cart_item"] as $item)
							{
								$result = $db_handle->insertQuery("INSERT INTO periexei (id_par, id_proiontos, posothta) VALUES ('".$id_par."','".$item["code"]."','".$item["quantity"]."')");
								$product_array = $db_handle->selectQuery("SELECT apothema FROM diathetei WHERE onoma_kat ='".$epilegmeno_katasthma."' AND code_proiontos = '".$item["code"]."'");
								foreach($product_array as $product)
								{
									if($product != 'άπειρο')
									{
										$neo_apothema = $product - $item["quantity"];
										$db_handle->updateQuery("UPDATE diathetei SET apothema='" . $neo_apothema . "' WHERE onoma_kat ='".$epilegmeno_katasthma."' AND code_proiontos = '".$item["code"]."'");
									}
								}
							}
							unset($_SESSION["cart_item"]);
							$report = "Η παραγγελία σας ολοκληρώθηκε με επιτυχία και καταχωρήθηκε στο κατάστημα ".$epilegmeno_katasthma."!";
						}
						else
						{
							$report = "Αποτυχία ολοκλήρωσης παραγγελίας: Δοκιμάστε ξανά ή επικοινωνήστε μαζί μας!";
						}
					}
					else
					{
						$report = "Αποτυχία ολοκλήρωσης παραγγελίας: Δοκιμάστε αργότερα!"; //mh diathesimoi dianomeis
					}
				}
				else
				{
					$report = "Αποτυχία ολοκλήρωσης παραγγελίας: Μη επαρκές απόθεμα!"; //mhdeniko apothema
				}
			}
			else
			{
				$report = "Εισάγετε Διεύθυνση!";
			}
		}
		else
		{
			$report = "Άδειο Καλάθι!";
		}
	}
?>