<?php
// http://localhost/eXpresso/misthodosia.php?Month=09&Year=2018
require ("dbcontroller.php");
$db_handle = new DBController();
$managers = $db_handle->runQuery("SELECT manager.*, katasthma.onoma FROM manager INNER JOIN katasthma ON manager.AFM_man = katasthma.manager_fk");
$dianomeis = $db_handle->runQuery("SELECT * FROM dianomeas");

header('Content-Type: text/plain');

$xmlString = '<xml>
	<header>
		<transaction>
			<period month="';
$xmlString .= $_GET["Month"];
$xmlString .= '" year="';
$xmlString .= $_GET["Year"];
$xmlString .= '"/>
		</transaction>
	</header>
	<body>
		<employees>'."\r\n";

		foreach ($managers as $key=>$value)
		{
			$pay_man = $db_handle->selectQuery("SELECT tziros FROM misthodosia_man WHERE katasthma='".$managers[$key]["onoma"]."' AND mhnas='".$_GET["Year"]."-".$_GET["Month"]."-00'");
			if ($pay_man)
			{
				$amoibh = 800 + (0.02 * $pay_man["tziros"]);
			}
			else
			{
				$amoibh = 'Μη διαθέσιμα δεδομένα';
			}
			
			$db_handle->updateQuery("UPDATE misthodosia_man SET misthos_man='" . $amoibh . "' 
									 WHERE katasthma ='".$managers[$key]["onoma"]."' AND mhnas='".$_GET["Year"]."-".$_GET["Month"]."-00'");
			
			$xmlString .= "\t\t\t".'<employee>'."\r\n";
				$xmlString .= "\t\t\t\t".'<firstName>'.$managers[$key]["onoma_man"].'</firstName>'."\r\n";
				$xmlString .= "\t\t\t\t".'<lastName>'.$managers[$key]["epwnumo_man"].'</lastName>'."\r\n";
				$xmlString .= "\t\t\t\t".'<amka>'.$managers[$key]["AMKA_man"].'</amka>'."\r\n";
				$xmlString .= "\t\t\t\t".'<afm>'.$managers[$key]["AFM_man"].'</afm>'."\r\n";
				$xmlString .= "\t\t\t\t".'<iban>'.$managers[$key]["IBAN_man"].'</iban>'."\r\n";
				$xmlString .= "\t\t\t\t".'<ammount>'.$amoibh.'</ammount>'."\r\n";
			$xmlString .= "\t\t\t".'</employee>'."\r\n";
		}
		foreach ($dianomeis as $key=>$value)
		{
			$pay_dian = $db_handle->selectQuery("SELECT misthos_dian FROM misthodosia_dian WHERE AFM_dian ='".$dianomeis[$key]["AFM_dian"]."' AND mhnas='".$_GET["Year"]."-".$_GET["Month"]."-00'");
			if ($pay_dian)
			{
				$amoibh = $pay_dian["misthos_dian"];
			}
			else
			{
				$amoibh = 0;
			}
			$xmlString .= "\t\t\t".'<employee>'."\r\n";
				$xmlString .= "\t\t\t\t".'<firstName>'.$dianomeis[$key]["onoma_dian"].'</firstName>'."\r\n";
				$xmlString .= "\t\t\t\t".'<lastName>'.$dianomeis[$key]["epwnumo_dian"].'</lastName>'."\r\n";
				$xmlString .= "\t\t\t\t".'<amka>'.$dianomeis[$key]["AMKA_dian"].'</amka>'."\r\n";
				$xmlString .= "\t\t\t\t".'<afm>'.$dianomeis[$key]["AFM_dian"].'</afm>'."\r\n";
				$xmlString .= "\t\t\t\t".'<iban>'.$dianomeis[$key]["IBAN_dian"].'</iban>'."\r\n";
				$xmlString .= "\t\t\t\t".'<ammount>'.$amoibh.'</ammount>'."\r\n";
			$xmlString .= "\t\t\t".'</employee>'."\r\n";
		}
$xmlString .= 
'		</employees>
	</body>
</xml>';

$dom = new DOMDocument;
$dom->loadXML($xmlString);

//Dhmiourgia kai apothhkeush arxeiou misthodosias mhna
$dom->save('misthodosia_'.$_GET["Year"].'_'.$_GET["Month"].'.xml');

//Emfanish dedomenwn ston browser
$dom->formatOutput = TRUE;
echo $xmlString;
?>