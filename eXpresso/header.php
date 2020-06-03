<?php
		$id_pelath = 0;
		$AFM_man = 0;
		$AFM_dian = 0;
		 
		ob_start(); //energopoihsh proswrinhs apothhkeushs e3odou se eswteriko buffer
		 
		session_start(); //arxikopoihsh sunedrias gia apothhkeush metablhtwn pou mporoun na einai diathesimes se pollaples selides tou site
		
		if (isset($_SESSION ['id_pelath']))
		{
			$user_type = 1;
		}
		else if (isset($_SESSION ['AFM_man']))
		{
			$user_type = 2;
		}
		else if (isset($_SESSION ['AFM_dian']))
		{
			$user_type = 3;
		}
		else 
		{
			$user_type = 0;
		}
	?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <!-- gia ta ellhnika -->
		<title><?php echo $title ?></title>
		<link rel="icon" type="image/ico" href="images/logo.png" />
		<link href="styles/style.css" rel="stylesheet" type="text/css" media="screen" />  <!--style gia olo to site-->
		<link href="styles/style3.css" type="text/css" rel="stylesheet" />                <!--style gia to kalathi-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="styles/base.css" rel="stylesheet" type="text/css" media="screen" />   <!---style gia to slideshow--->
		<script type="text/javascript" src=" https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.js"></script>
		<script type="text/javascript" src="scripts/jquery.pikachoose.js"></script>       <!---Gia to slideshow--->
		<script type="text/javascript">     
					$(document).ready(function() {
					$("#pikame").PikaChoose();	});
		</script>
	</head>
	
	<body>
		<div style="float:right">
			<?php 
				if ($user_type != 0)
				{
						echo '<a href="logout.php">Αποσύνδεση</a>';
				}
				else 
				{
						echo '<a href="login.php" style="display: inline-block">Σύνδεση </a> / <a href="registration.php" style=" display: inline-block">Εγγραφή</a>';
				}
			?>
		</div>
		
		<div id="container">
			<header>
				<nav>
					<ul id="nav">   <!--Analoga me to eidos xrhsth emfanizei to katallhlo menou-->
						<?php 
						if ($user_type==0 || $user_type==1)
						{
							echo '<li><a href="index.php"';
							if ($tab==1) echo 'class="current"';
							echo '>Αρχική</a></li>';
							
							echo '<li><a href="menu.php"';
							if ($tab==2) echo 'class="current"';
							echo '>Μενού</a></li>';
							
							echo '<li><a href="kalathi.php"';
							if ($tab==3) echo 'class="current"';
							echo '>Καλάθι</a></li>';
							
							echo '<li><a href="contact.php"';
							if ($tab==4) echo 'class="current"';
							echo '>Χάρτης</a></li>';
						}
						else if ($user_type==2)
						{
							echo '<li><a href="index.php"';
							if ($tab==1) echo 'class="current"';
							echo '>Αρχική</a></li>';
							
							echo '<li><a href="stock_update.php"';
							if ($tab==2) echo 'class="current"';
							echo '>Απόθεμα</a></li>';
							
							echo '<li><a href="orders.php"';
							if ($tab==3) echo 'class="current"';
							echo '>Εξέλιξη</a></li>';
						}
						else if ($user_type==3)
						{
							echo '<li><a href="index.php"';
							if ($tab==1) echo 'class="current"';
							echo '>Αρχική</a></li>';
							
							echo '<li><a href="bardia.php"';
							if ($tab==2) echo 'class="current"';
							echo '>Βάρδια</a></li>';
							
							echo '<li><a href="paradosh_par.php"';
							if ($tab==3) echo 'class="current"';
							echo '>Διανομή</a></li>';
						}
						?>
					</ul>
				</nav>
				<div class="intro">
					  <h1 class="title"><a href="index.php">eXpresso</a></h1>
					  <h3 class="tagline" style="font-family:Palatino Linotype; font-size:18px">Online παραγγελία και διανομή καφέ/γεύματος</h3>
				</div>
					
				<br><br><br><br><br><br><br>
				
			</header>
		  
		  <br>