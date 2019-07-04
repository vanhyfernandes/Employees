<?php
	session_start();
	if($_SESSION['user']){
		$user = $_SESSION['user'];
		echo "<h2>Welcome ".$user['username']."! You are successfully logged into the system.</h2>";
		echo "<h3>Privilege: ".$user['type']."</h3>";

		echo "<a href='display.php'>4. Display employee data</a><br/><br/>";
		echo "<a href='search.html'>5. Search employee data</a><br/><br/>";

		if ($user['type'] == "administrator")
			echo "<a href='insert.php'>6. Insert Employee Data</a><br/><br/>";
	} else
		echo "Sorry! You need to be logged to access this page!";
?>
    
    