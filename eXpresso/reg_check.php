<?php
	require "db_config.php";
	
	$email_error = "";
	$pass_error = "";
	$name_error = "";
	$phone_error = "";
	$report = "";

	if(isset($_POST['submit']))
	{
		$email = $password = $password_conf = $name = $phone = FALSE;
		if (preg_match ('/^[^\W_]+([.\-_][^\W_]+)*@[^\W_]+([.-_][^\W_]+)*.[A-Za-z]{2,3}$/', $_POST['email'])) 
		{
			$email = mysqli_real_escape_string($db,$_POST['email']);
		}
		else 
		{
			$email_error = "Μη έγκυρη διεύθυνση email!";
		}
		
		if (preg_match('/^[\S]{4,25}$/', $_POST['password']))
		{
			if ($_POST['password'] == $_POST['password_conf']) 
			{
				$password_pelath = sha1(mysqli_real_escape_string($db,$_POST['password']));  //kruptografhmenos kwdikos prosbashs me to sha1
			}
			else
			{
				$pass_error = "Ο κωδικός επαλήθευσης δεν ταυτίζεται με τον κωδικό ασφαλείας!";
			}
		} 
		else
		{
			$pass_error = "Μη έγκυρος κωδικός ασφαλείας! (4-25 ψηφία)";
		}
		
		if (preg_match ('/^([a-zA-Z ]*|[Α-Ωαάβγδεέζηήθιίϊΐκλμνξοόπρστυύϋΰφχψωώς ]*)?$/', $_POST['name']))
		{
			$onoma_pelath = mysqli_real_escape_string($db,$_POST['name']);
		}
		else 
		{
			$name_error = "Μη έγκυρo όνομα!";
		}
		
		if(isset($_POST['phone']) && preg_match("/^(2[1-9][0-9]{8}|69[0-9]{8})?$/", $_POST['phone'])) 
		{
			$thlefwno_pelath = mysqli_real_escape_string($db,$_POST['phone']);
		}
		else
		{
			$phone_error = "Μη έγκυρος αριθμός! (Δεκαψήφιο Ελληνικό Σταθερό ή Κινητό)"; 
		}
		
		
		if (($email_error == "") && ($pass_error == "") && ($name_error == "") && ($phone_error == "")) {
			$query = "SELECT id_pelath FROM `pelaths` WHERE email= '$email';";
			$result = mysqli_query($db,$query);
			if (mysqli_num_rows($result) != 0) { // To email den einai diathesimo
				$email_error = "Μη έγκυρη διεύθυνση email!";
				$report = "Σφάλμα Εγγραφής: Η διεύθυνση email έχει καταχωρηθεί ήδη!";
			} 
			else { // Einai diathesimo
				
				$register_query = "INSERT INTO `pelaths`(`email`, `password_pelath`,  `onoma_pelath`, `thlefwno_pelath`) VALUES ('$email','$password_pelath', '$onoma_pelath', '$thlefwno_pelath')";
				
				$result = mysqli_query($db,$register_query);
				if (mysqli_affected_rows($db) != 0) {
					$report = "Ευχαριστούμε για την εγγραφή σας στο σύστημα!";
					mysqli_free_result($result);
					mysqli_close($db);
					ob_end_clean();
					header('Location: login.php');
					exit();
				} 
				else {
					$report = "Αποτυχία Εγγραφής: Δοκιμάστε ξανά ή επικοινωνήστε μαζί μας!";
				}
			}
		}
		else {
			$report = "Σφάλμα Εγγραφής: Παρακαλώ ελέγξτε τα δεδομένα που εισάγατε!";
		}
		mysqli_close($db);
	}
	else{
		$report = "Εισάγετε τα στοιχεία σας στη φόρμα εγγραφής!";
	}
?>