<?php 

	$server = "localhost";
	$username = "root";
	$password = "";
	$database_name = "db_test";

	$first_name = "";
	
	$conn = mysqli_connect($server, $username, $password, $database_name);

	if (!$conn) {
		die("Connection failed" . mysqli_connect_error());
	}

?>