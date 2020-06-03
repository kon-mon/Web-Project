<?php
	$id_pelath = 0;
	$AFM_man = 0;
	$AFM_dian = 0;
	
	ob_start();
	session_start();

	if (isset($_SESSION ['id_pelath']) OR isset($_SESSION ['AFM_man']) OR isset($_SESSION ['AFM_dian'])){
		header('Location: index.php');
		exit();
	}

	require "log_check.php";
?>
<html>
	<head>
		<title>Σύνδεση | eXpresso</title>
		<link rel="stylesheet" href="styles/style2.css">
	</head>
	<body>
		
		<a href="index.php" ><img src="images/eXpresso.png" alt="logo" style="display: block; margin-top:20px; margin-left:auto; margin-right:auto"></a>
		
		<div class="login-page">
			<div class="form">
				<form method="post" action="login.php">   <!-- Αν υπάρξει λάθος κρατάει τα δεδομένα που έβαλε στη φόρμα (value) και εμφανίζει μήνυμα λάθους -->
					<h2 style="color:#800000; font-size:28px"><b>Σύνδεση Χρήστη</b></h2>
					<input type="text" name="email" placeholder="Όνομα Χρήστη / email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" required>
					<div class="error_login_field"><?php echo $email_error_msg ?></div>
					
					<input type="password" name="password" placeholder="Κωδικός Πρόσβασης" required>
					<div class="error_login_field"><?php echo $pass_error_msg ?></div>
					
					<button type="submit" name="submit">ΣΥΝΔΕΣΗ</button>
					<p class="message">Δεν έχεις λογαριασμό; <a href="registration.php">Εγγραφή</a></p>
				</form>
			</div>
			
<?php
	include 'footer.php';
?>