<?php include('./includes/header.php'); ?>
<?php include('./functions.php'); ?>

	<?php
		$full_name = isset($_POST['full_name']) ? $_POST['full_name'] : '';
		$city = isset($_POST['city']) ? $_POST['city'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$last_carrier = isset($_POST['last_carrier']) ? $_POST['last_carrier'] : '';
		$switch_reason = isset($_POST['switch_reason']) ? $_POST['switch_reason'] : '';
		
		$ref_email = isset($_GET['ref']) ? $_GET['ref'] : '';

		if ($full_name && $city && $last_carrier && $switch_reason && $email) {
			addNewEntry($full_name, $city, $last_carrier, $switch_reason, $email, $ref_email);
		}
	?>
    <div>
    	<form method="POST">
			<input type="text" name="full_name" placeholder="Full Name" value="<?php echo $full_name; ?>" required>
			<input type="text" name="city" placeholder="City" value="<?php echo $city; ?>" required>
			<input type="email" name="email" placeholder="Email Address" value="<?php echo $email; ?>" required>
			<input type="email" name="ref_email" placeholder="HIDDEN ref email" value="<?php echo $ref_email; ?>">
			<input type="text" name="last_carrier" placeholder="Last carrier" value="<?php echo $last_carrier; ?>" required>
			<textarea name="switch_reason" placeholder="Why Did You Switch to Boost?" value="<?php echo $switch_reason; ?>" style="max-width: 300px;max-height:300px;min-width: 142px;min-height:19px"></textarea>
			<input type="submit" value="Submit" />
		</form>
	</div>
    
<?php include('./includes/footer.php'); ?>