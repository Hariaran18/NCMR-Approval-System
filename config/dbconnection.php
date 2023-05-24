<?php
	$servername = "localhost:8808";
	$username = "root";
	$password = "";
	$dbname = "ncmr";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if (!$conn) {
		printf("Connection failed: %s\n " . mysqli_connect_error());
		exit();
	}
?>