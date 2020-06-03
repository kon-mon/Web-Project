<?php
	$id_pelath = 0;
	
	ob_start();
	session_start();

	if (isset($_SESSION ['id_pelath']) OR isset($_SESSION ['AFM_man']) OR isset($_SESSION ['AFM_dian']))
	{
		header('Location: index.php');
		exit();
	}
	
	require "reg_check.php";
?>
<html>
	<head>
		<title>Εγγραφή | eXpresso</title>
		<link rel="stylesheet" href="styles/style2.css">
	</head>
	<body>
		<a href="index.php" ><img src="images/eXpresso.png" alt="logo" style="display: block; margin-top:20px; margin-left:auto; margin-right:auto"></a>
		<div class="login-page">
			<div class="reg_report"><?php echo $report ?></div><br>
			<div class="form">			
				<form method="post" action="registration.php">
					<h2 style="color:#800000; font-size:28px"><b>Εγγραφή Χρήστη</b></h2>  <!-- Αν υπάρξει λάθος κρατάει τα δεδομένα που έβαλε στη φόρμα και εμφανίζει μήνυμα λάθους -->
					<input type="text" name="email" placeholder="email" value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>" required>
					<div class="error_reg_field"><?php echo $email_error ?></div>
					
					<input type="password" name="password" placeholder="Κωδικός Πρόσβασης" value="<?php if (!isset($_POST['password'])) echo ""; ?>" autocomplete="off" required>
					<div class="error_reg_field"><?php echo $pass_error ?></div>
					
					<input type="password" name="password_conf" placeholder="Επιβεβαίωση Κωδικού Πρόσβασης" required>
					<div class="error_reg_field"></div>
					
					<input type="text" name="name" placeholder="Ονοματεπώνυμο" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>" required>
					<div class="error_reg_field"><?php echo $name_error ?></div>
					
					<input type="text" name="phone" placeholder="Τηλέφωνο" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>" required>
					<div class="error_reg_field"><?php echo $phone_error ?></div>
					
					<button type="submit" name="submit">ΕΓΓΡΑΦΗ</button>
					<p class="message">Έχω λογαριασμό <a href="login.php">Σύνδεση</a></p>
				</form>
			
			</div>
		
<?php
	include 'footer.php';
?>