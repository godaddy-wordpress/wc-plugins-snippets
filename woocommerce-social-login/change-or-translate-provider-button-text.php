
<?php // only copy this line if needed

add_filter( 'wc_social_login_provider_login_button_text', 'sv_social_login_change_login_button_text', 10, 3 );


/**
 * Change Facebook log in button text with an italian translation.
 *
 * @param string $text The login button text.
 * @param string $provider The social login provider ID. (e.g. "facebook", "twitter", etc.).
 */
function sv_social_login_change_login_button_text( $text, $provider ) {

	if ( 'facebook' === $provider ) {
	
		if ( 'it_IT' === get_locale() ) {

			$text = 'Fai login con Facebook';
		} 
	}

	return $text;
}
