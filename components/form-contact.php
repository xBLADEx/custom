<?php
/**
 * Form Contact
 *
 * @package Custom
 */

if ( isset( $_POST['submit'] ) && ! wp_verify_nonce( 'custom_form_contact_name', 'custom_form_contact_action' ) ) :
	// If trap value is set redirect to home page.
	if ( '' !== sanitize_text_field( wp_unslash( $_POST['main_address'] ) ) ) {
		echo '<html><head><meta http-equiv="refresh" content="0; url=/"></head><body></body></html>';
		exit;
	}

	// Define emails, website, and domain.
	$form_email    = get_field( 'global_form_email', 'options' );
	$email_address = $form_email ? $form_email : get_bloginfo( 'admin_email' );

	define( 'EMAIL', $email_address );
	define( 'WEBSITE', get_bloginfo( 'name' ) );
	define( 'DOMAIN', str_replace( 'www.', '', $_SERVER['HTTP_HOST'] ) );

	// Fields.
	$full_name = wp_unslash( $_POST['full_name'] );
	$email     = $_POST['email'];
	$phone     = $_POST['phone'];
	$question  = $_POST['comment'];
	$captcha   = custom_get_recaptcha( $_POST['g-recaptcha-response'] );

	// Set required fields.
	$required_fields = [
		'full_name',
		'email',
	];

	// Check if required fields are blank.
	$field_errors = false;

	foreach ( $required_fields as $field ) {
		if ( '' === $_POST[ $field ] ) {
			$field_errors = true;
		}
	}

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

	$to       = EMAIL;
	$subject  = wp_strip_all_tags( $full_name ) . ' - ' . html_entity_decode( WEBSITE ) . ' Contact Form' . "\r\n";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	$headers .= 'From: contact@' . DOMAIN . "\r\nReply-To: noreply@" . DOMAIN . "\r\n";
	$message  = '<html><body>';
	$message .= '<table rules="all" style="border-color: #B8B8B8;" cellpadding="10">';
	$message .= '<tr style="background: #5979FF; color: #FFF; font-weight: bold;"><th>FIELD</th><th>INFORMATION</th></tr>';
	$message .= '<tr><td><strong>Name:</strong></td><td>' . wp_strip_all_tags( $full_name ) . '</td></tr>';
	$message .= '<tr><td><strong>Email:</strong></td><td>' . wp_strip_all_tags( $email ) . '</td></tr>';
	$message .= '<tr><td><strong>Phone:</strong></td><td>' . wp_strip_all_tags( $phone ) . '</td></tr>';
	$message .= '<tr><td><strong>Comments:</strong></td><td>' . wp_strip_all_tags( $question ) . '</td></tr>';
	$message .= '</table>';
	$message .= '</body></html>';

	// PHP Rule: Message lines should not exceed 70 characters, so wrap it.
	$message = wordwrap( $message, 70 );

	// If no errors - send. Else - alert.
	if ( ! $field_errors && $captcha->success ) :
		wp_mail( $to, $subject, $message, $headers );
		?>
		<p class="c-notification-box c-notification-box--success"><?php esc_html_e( 'Thank you for contacting us!', 'custom' ); ?></p>
		<?php
	else :
		?>
		<p class="c-notification-box c-notification-box--error"><?php esc_html_e( 'Please fill out all the required fields.', 'custom' ); ?></p>
		<?php
	endif;
else :
	?>
	<form method="POST" class="form form--contact">
		<?php wp_nonce_field( 'custom_form_contact_action', 'custom_form_contact_name' ); ?>
		<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

		<div class="form__section form__group">
			<label for="form-full-name"><?php esc_html_e( 'Full Name *', 'custom' ); ?></label>
			<input type="text" name="full_name" id="form-full-name" class="form__input" placeholder="<?php esc_attr_e( 'Full Name', 'custom' ); ?>" required>
		</div>

		<div class="form__section form__group">
			<label for="form-email"><?php esc_html_e( 'Email *', 'custom' ); ?></label>
			<input type="email" name="email" id="form-email" class="form__input" placeholder="<?php esc_attr_e( 'name@example.com', 'custom' ); ?>" required>
		</div>

		<div class="form__section form__group">
			<label for="form-phone"><?php esc_html_e( 'Phone', 'custom' ); ?></label>
			<input type="tel" name="phone" id="form-phone" class="form__input" maxlength="12" pattern="\d{3}[\-]?\d{3}[\-]?\d{4}" placeholder="<?php esc_attr_e( '555-555-5555', 'custom' ); ?>">
		</div>

		<div class="form__section form__group">
			<label for="form-comment"><?php esc_html_e( 'Questions or Comments', 'custom' ); ?></label>
			<textarea name="comment" id="form-comment" class="form__textarea" placeholder="<?php esc_attr_e( 'What is on your mind?', 'custom' ); ?>"></textarea>
		</div>

		<div class="form__section form__group">
			<input type="text" name="main_address" value="" class="h-hidden">
			<input type="submit" name="submit" value="Submit" class="button">
		</div>
	</form>
	<?php
endif;
