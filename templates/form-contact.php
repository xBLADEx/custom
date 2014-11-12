<?php
/* 
====================
	CONTACT FORM
====================
*/
?>
<?php 
if ( isset( $_POST['submit'] ) ) { 
	// Define emails, website, and domain.
	define( 'EMAIL',	'rich@sorensonadvertising.com' );
	define( 'WEBSITE',	get_bloginfo( 'name' ) );
	define( 'DOMAIN',	str_replace( "www.", "", $_SERVER['HTTP_HOST'] ) );
	// If trap value is set redirect to home page.
	if ( $_POST['mainAddress'] != '' ) {
		echo '<html><head><meta http-equiv="refresh" content="0; url=/"></head><body></body></html>';
		exit;
	}
	// Set required fields
	$required_fields = array(
		'fullName',
		'email',
		'phone'
	);
	// Check if required fields are blank
	$field_errors = true;
	foreach ( $required_fields as &$field ) {
		if ( $_POST[$field] == '' ) {
			$field_errors = false;
		}
	}
	// Grab form fields
	$fullName 	= $_POST["fullName"];
	$email 		= $_POST["email"];
	$phone 		= $_POST["phone"];
	$comment 	= $_POST["comment"];
	// Sanitize Information
	if ( $fullName != '' ) {
		$fullName = filter_var( $fullName, FILTER_SANITIZE_STRING );
	}
	if ( $email != '' ) {
		$email = filter_var( $email, FILTER_SANITIZE_EMAIL );
	}
	if ( $phone != '' ) {
		$regex = '/([0-9]{3})\.?([0-9]{3})\.?([0-9]{4})/';
		$phone = preg_replace( $regex, '$1-$2-$3', $phone ); // http://php.net/manual/en/function.preg-match.php
	}
	// Set mail() variables http://php.net/manual/en/function.mail.php
	$to 		= EMAIL;
	$subject 	= WEBSITE . ' Contact Form'. "\r\n";
	$headers	= 'MIME-Version: 1.0' . "\r\n";
	$headers	.= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers  	.= "From: contact@" . DOMAIN . "\r\nReply-To: noreply@" . DOMAIN . "\r\n";
	$message 	= '<html><body>';
	$message 	.= '<table rules="all" style="border-color: #B8B8B8;" cellpadding="10">';
	$message 	.= '<tr style="background: #5979FF; color: #FFF; font-weight:bold;"><th>FIELD</th><th>INFORMATION</th></tr>';
	$message 	.= "<tr><td><strong>Name:</strong></td><td>" . strip_tags( $fullName ) . "</td></tr>";
	$message 	.= "<tr><td><strong>Email:</strong></td><td>" . strip_tags( $email ) . "</td></tr>";
	$message 	.= "<tr><td><strong>Phone:</strong></td><td>" . strip_tags( $phone ) . "</td></tr>";
	$message 	.= "<tr><td><strong>Comment:</strong></td><td>" . strip_tags( $comment ) . "</td></tr>";
	$message 	.= "</table>";
	$message 	.= "</body></html>";
	// Message lines should not exceed 70 characters (PHP rule), so wrap it
	$message = wordwrap( $message, 70 );
	// If no errors - send. Else - alert.
	if ( $field_errors ) {
		wp_mail( $to, $subject, $message, $headers );
		echo '<p class="alert-box success">Thank you for contacting us!</p>';
	} else {
		echo '<p class="alert-box alert">Please fill out the required fields.</p>';
	}
?>
<?php
} else { ?>
	<form method="POST">
		<input type="text" name="fullName" placeholder="Full Name" required>
		<input type="email" name="email" placeholder="Email" required>
		<input type="tel" maxlength="10" name="phone" pattern="\d{3}\d{3}\d{4}" placeholder="Phone" required>
		<textarea name="comment" placeholder="Message"></textarea>
		<input type="text" name="mainAddress" value="" class="hidden">
		<input type="submit" name="submit" value="Submit" class="button">
	</form>
<?php
} ?>