<?php
	require "db_config.php";

	$email_error_msg = "";
	$pass_error_msg = "";

	if (isset($_POST['submit']))
	{
		if (!empty($_POST['email'])) 
		{ 
			if (!empty($_POST['password'])) 
			{
				
				$email = mysqli_real_escape_string($db,$_POST['email']);
				$query = "SELECT id_pelath, email, password_pelath, thlefwno_pelath FROM `pelaths` WHERE email = '$email';";

				$result = mysqli_query ($db,$query);
				
				if(mysqli_num_rows($result) != 0)
				{
					$_SESSION = mysqli_fetch_array($result);
					$password = sha1(mysqli_real_escape_string($db,$_POST['password']));     //kruptografhmenos kwdikos prosbashs me to sha1
					if($password != $_SESSION ['password_pelath']) 
					{
						$_SESSION = array();
						$pass_error_msg = "Ελέγξτε τον κωδικό ασφαλείας!";
						$email_error_msg = "Ελέγξτε τη διεύθυνση email!";
					}
					else  // Meta apo epituxhmeno login mas stelnei sthn arxikh selida tou katasthmatos
					{ 
						mysqli_free_result($result);
						mysqli_close($db);
						ob_end_clean(); // Katharismos buffer
						header("Location: index.php");
						exit();
					}
				}
				
				else
				{
					$email = mysqli_real_escape_string($db,$_POST['email']);
					$query = "SELECT * FROM `manager` WHERE username_man = '$email';";

					$result = mysqli_query ($db,$query);
					
					if(mysqli_num_rows($result) != 0)
					{
						$_SESSION = mysqli_fetch_array($result);
						$password = mysqli_real_escape_string($db,$_POST['password']);     //mh kruptografhmenos kwdikos prosbashs giati ton thetoume apo th bash
						if($password != $_SESSION ['password_man'])
						{
							$_SESSION = array();
							$pass_error_msg = "Ελέγξτε τον κωδικό ασφαλείας!";
							$email_error_msg = "Ελέγξτε τη διεύθυνση email!";
						}
						else
						{
							mysqli_free_result($result);
							mysqli_close($db);
							ob_end_clean();
							header("Location: index.php");
							exit();
						}
					}
				
					else
					{
						$email = mysqli_real_escape_string($db,$_POST['email']);
						$query = "SELECT * FROM `dianomeas` WHERE username_dian = '$email';";

						$result = mysqli_query ($db,$query);
						
						if(mysqli_num_rows($result) != 0)
						{
							$_SESSION = mysqli_fetch_array($result);
							$password = mysqli_real_escape_string($db,$_POST['password']);
							if($password != $_SESSION ['password_dian'])
							{
								$_SESSION = array();
								$pass_error_msg = "Ελέγξτε τον κωδικό ασφαλείας!";
								$email_error_msg = "Ελέγξτε τη διεύθυνση email!";
							}
							else
							{
								mysqli_free_result($result);
								mysqli_close($db);
								ob_end_clean();
								header("Location: index.php");
								exit();
							}
						}
						else
						{
							$pass_error_msg = "Ελέγξτε τον κωδικό ασφαλείας!";
							$email_error_msg = "Ελέγξτε τη διεύθυνση email!";
						}
					}
				
				}
			} 
			else 
			{
			$password = FALSE;
			$pass_error_msg = "Ξεχάσατε να εισάγετε κωδικό!";
			}
		} 
		else 
		{
			$email = FALSE;
			$email_error_msg = "Ξεχάσατε να εισάγετε διεύθυνση email!";
		}
		mysqli_close($db);
	}
?>