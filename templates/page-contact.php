<?php
/* 
====================
	CONTACT FORM
====================
*/
?>
<?php
function spamcheck($field) {
	// Sanitize e-mail address
	$field = filter_var($field, FILTER_SANITIZE_EMAIL);
	// Validate e-mail address
	if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
		return TRUE;
	} else {
		return FALSE;
	}
}
?>
<?php // Display form if user has not clicked submit
	if (!isset($_POST["submit"])) { ?>
	<form method="POST">
		<input type="text" name="fullName" placeholder="Full Name">
		<input type="email" name="email" placeholder="Email">
		<textarea name="comment" placeholder="Message"></textarea>
		<input type="submit" name="submit" value="Submit" class="button">
	</form>
<?php } else { // The user has submitted the form. Check if the "from" input field is filled out
		if (isset($_POST["email"])) {
			// Check if email address is valid
			$mailcheck = spamcheck($_POST["email"]);
			if ($mailcheck==FALSE) {
				echo "Invalid input!";
			} else {
				// Grab form data
				$fullName 	= $_POST["fullName"];
				$email 		= $_POST["email"];
				$comment 	= $_POST["comment"];
				// Set mail() variables http://php.net/manual/en/function.mail.php
				$to = "rich@sorensonadvertising.com";
				$subject 	= "Website Contact Form";
				$message 	= "Name: ".$fullName.
							  "\nEmail: ".$email.
							  "\nComment: ". $comment;
				$from = "noreply@website.com";
				// Message lines should not exceed 70 characters (PHP rule), so wrap it
				$message = wordwrap($message, 70);
				// Send mail
				mail($to,$subject,$message,"From: $from\n");
				echo "<p>Thank you for contacting us!</p>";
			}
	  	}
	}
?>
