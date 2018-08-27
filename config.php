<?php
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$table = 'entries';
	$val = $conn->query('select 1 from ' . $table);
	if($val === FALSE) {
		// sql to create table
		$sql = "CREATE TABLE " . $table . " (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		name VARCHAR(255) NOT NULL,
		city VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		last_carrier VARCHAR(255) NOT NULL,
		switch_reason VARCHAR(255) NOT NULL,
		entry_type VARCHAR(255) NOT NULL,
		created_date DATETIME DEFAULT CURRENT_TIMESTAMP,
		updated_date TIMESTAMP
		)";

		if ($conn->query($sql) === TRUE) {
			// echo 'Table "' . $table . '" created successfully';
		} else {
			echo 'Error creating table: ' . $conn->error;
		}
	}
	$conn->close();