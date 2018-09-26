<?php
/**
 * Form Contact
 *
 * @package Custom
 */

if ( isset( $_POST['submit'] ) ) :
	// Define emails, website, and domain.
	define( 'EMAIL',   'javablood@hotmail.com' );
	define( 'WEBSITE', get_bloginfo( 'name' ) );
	define( 'DOMAIN',  str_replace( 'www.', '', $_SERVER['HTTP_HOST'] ) );

	// If trap value is set redirect to home page.
	if ( '' !== $_POST['main_address'] ) {
		echo '<html><head><meta http-equiv="refresh" content="0; url=/"></head><body></body></html>';

		exit;
	}

	// Set required fields.
	$required_fields = array(
		'full_name',
		'email',
		'phone',
	);

	// Check if required fields are blank.
	$field_errors = true;

	foreach ( $required_fields as &$field ) {
		if ( '' === $_POST[ $field ] ) {
			$field_errors = false;
		}
	}

	// Grab form fields.
	$full_name = $_POST['full_name'];
	$email     = $_POST['email'];
	$phone     = $_POST['phone'];
	$comment   = $_POST['comment'];

	// Sanitize Information.
	if ( '' !== $full_name ) {
		$full_name = filter_var( $full_name, FILTER_SANITIZE_STRING );
	}
	if ( '' !== $email ) {
		$email = filter_var( $email, FILTER_SANITIZE_EMAIL );
	}
	if ( '' !== $phone ) {
		$regex = '/([0-9]{3})\.?([0-9]{3})\.?([0-9]{4})/';
		$phone = preg_replace( $regex, '$1-$2-$3', $phone );
	}

	// Check if theme options email field is set.
	if ( '' === EMAIL ) {
		$to = 'javablood@hotmail.com';
	} else {
		$to = EMAIL;
	}

	$subject = WEBSITE . ' Contact Form' . "\r\n";

	$headers = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: contact@' . DOMAIN . "\r\nReply-To: noreply@" . DOMAIN . "\r\n";

	$message = '<html><body>';
	$message .= '<table rules="all" style="border-color: #B8B8B8;" cellpadding="10">';
	$message .= '<tr style="background: #5979FF; color: #FFF; font-weight: bold;"><th>FIELD</th><th>INFORMATION</th></tr>';
	$message .= '<tr><td><strong>Name:</strong></td><td>' . strip_tags( $full_name ) . '</td></tr>';
	$message .= '<tr><td><strong>Email:</strong></td><td>' . strip_tags( $email ) . '</td></tr>';
	$message .= '<tr><td><strong>Phone:</strong></td><td>' . strip_tags( $phone ) . '</td></tr>';
	$message .= '<tr><td><strong>Comment:</strong></td><td>' . strip_tags( stripslashes( $comment ) ) . '</td></tr>';
	$message .= '</table>';
	$message .= '</body></html>';

	// PHP Rule: Message lines should not exceed 70 characters, so wrap it.
	$message = wordwrap( $message, 70 );

	// If no errors - send. Else - alert.
	if ( $field_errors ) :
		wp_mail( $to, $subject, $message, $headers );
		?>
		<p class="alert-box success"><?php esc_html_e( 'Thank you for contacting us!', 'custom' ); ?></p>
		<?php
	else :
		?>
		<p class="alert-box alert"><?php esc_html_e( 'Please fill out the required fields.', 'custom' ); ?></p>
		<?php
	endif;
else :
	?>
	<form method="POST" class="form-contact">
		<label>
			<?php esc_html_e( 'Full Name', 'custom' ); ?>
			<input type="text" name="full_name" placeholder="<?php esc_attr_e( 'John Doe', 'custom' ); ?>" required>
		</label>
		<label>
			<?php esc_html_e( 'Email', 'custom' ); ?>
			<input type="email" name="email" placeholder="<?php esc_attr_e( 'john@example.com', 'custom' ); ?>" required>
		</label>
		<label>
			<?php esc_html_e( 'Phone', 'custom' ); ?>
			<input type="tel" maxlength="12" name="phone" pattern="\d{3}[\-]?\d{3}[\-]?\d{4}" placeholder="<?php esc_attr_e( '555-555-5555', 'custom' ); ?>" required>
		</label>
		<label>
			<?php esc_html_e( 'Questions or Comments', 'custom' ); ?>
			<textarea class="form-comment" name="comment" placeholder="<?php esc_attr_e( 'What\'s on your mind?', 'custom' ); ?>"></textarea>
		</label>
		<input type="text" name="main_address" value="" class="hide">
		<input type="submit" name="submit" value="Submit" class="button">
	</form>
	<?php
endif;
