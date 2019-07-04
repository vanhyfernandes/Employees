<?php

	session_start();

	echo "<form action='login.php' method='post'>";
	echo "<table>";
	echo "<tr><td>Name:</td><td><input type=text name=username></td></tr>";
	echo "<tr><td>Password:</td><td><input type=password name=password></td></tr>";
	echo "<tr><td colspan='2'><br><img src='captcha.php' /><input name='captcha' type='text'><br></td></tr>";
	echo "<tr><td colspan=2><input type=submit name='submit' value='login'></td></tr>";
	echo "</table></form>";

	if($_POST['submit']=="login"){
		if($_POST['captcha'] == $_SESSION['captcha']){

			// database connection
			include('bd_connection.php');

			/* get the user name and password from the form*/
			$username = $_REQUEST["username"];
			$password = $_REQUEST["password"];
			
			/*build sql statement */
			$query="SELECT * FROM Login WHERE username='$username'";
			
			/*check the sql statement for errors and if there are errors report them.*/
			$stmt=oci_parse($connect, $query);
			
			if(!$stmt)
			{
				echo("An error occurred in parsing the SQL string. \n");
				exit;
			}
			
			if(oci_execute($stmt)){
				/* complete checking if both or individual username and password are valid */
				$username_exist = false;
				$password_exist = false;
				$valid = false;
				$empty = true;
				while(oci_fetch($stmt))
				{
						$empty = false;
						
						if(oci_result($stmt,"USERNAME") == $username)
						{
							if(openssl_decrypt(oci_result($stmt,"PASSWORD"),"AES-128-ECB","DeakinUniversity") == $password)
							{
								$valid = true;
								$user = array(
									'username' => oci_result($stmt,2),
									'type' => oci_result($stmt,4)
								);
							}
							else
								$username_exist = true;
						}
						else
							$password_exist = true;
				}
				if ($valid){
					$_SESSION['user']=$user;
					//var_dump($_SESSION);
					echo "<script>location.href='welcome.php';</script>";
				}else 
					echo "Sorry, your username or password is incorrect.";
			} else {
				echo "Sorry, your account does not exist. Please try again.";
			}
			
			//close the connection
			oci_close($connect);
		} else
			echo "Invalid captcha!";
	}
?>