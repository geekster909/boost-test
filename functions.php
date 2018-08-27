<?php
include('./config.php');
// echo '<pre>'; print_r($servername); echo '</pre>';die('here');

function addNewEntry($full_name, $city, $last_carrier, $switch_reason, $email, $ref_email = NULL, $entry_type = 'original') {
	global $servername, $username, $password, $dbname, $table;


	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check if email already exists as original
	$sql = "SELECT * FROM " . $table . " WHERE email = '".$email."' AND entry_type = 'original'";
	if ($result = $conn->query($sql)) {
		
	} else {

		$sql = "INSERT INTO " . $table . "
			(name, city, email, last_carrier, switch_reason, entry_type)
			VALUES
			('" . $full_name . "', '" . $city . "', '" . $email . "', '" . $last_carrier . "', '" . $switch_reason . "', '" . $entry_type . "')
		";
		if ($conn->query($sql) === TRUE) {
			// echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			die();
		}
		$conn->close();

		if($ref_email) {
			addReferalEntry($ref_email);
		}
	}
}

function addReferalEntry($ref_email) {
	global $servername, $username, $password, $dbname, $table;
	$conn = new mysqli($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM " . $table . " WHERE email = '".$ref_email."'";
	if ($result = $conn->query($sql)) {
		while ($row = $result->fetch_assoc()) {
			$ref_name = $row['name'];
			$ref_city = $row['city'];
			$ref_last_carrier = $row['last_carrier'];
			$ref_switch_reason = $row['switch_reason'];

			addNewEntry($ref_name, $ref_city, $ref_last_carrier, $ref_switch_reason, $ref_email, '', 'referall');
			break;
		}
	}


	$conn->close();
}