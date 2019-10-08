//--------------------------------------------------------------
// GOOGLE RECAPTCHA
//--------------------------------------------------------------

const siteKey = '';

const captchaField = document.querySelector('#g-recaptcha-response');

if (captchaField) {
	grecaptcha.ready(function() {
		grecaptcha.execute(`${siteKey}`, { action: 'homepage' }).then(function(token) {
			captchaField.value = token;
		});
	});
}
