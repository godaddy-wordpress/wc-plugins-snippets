<?php // only copy if needed

/**
 * Add social login buttons to the WP login page and
 * adjust the instructions text appropriately
 */


/**
 * Adds login buttons to the wp-login.php pages
 */
function sv_wc_social_login_add_buttons_wplogin() {

	// Displays login buttons to non-logged in users + redirect back to login
	woocommerce_social_login_buttons();
}
add_action( 'login_form',    'sv_wc_social_login_add_buttons_wplogin' );
add_action( 'register_form', 'sv_wc_social_login_add_buttons_wplogin' );


/**
 * Changes the login text from what's set in our WooCommerce settings
 * so we're not talking about checkout while logging in.
 *
 * @param string $login_text the login message
 *
 * @return string the updated message
 */
function sv_wc_social_login_change_instructions( $login_text ) {

	global $pagenow;

	// Only modify the text from this option if we're on the wp-login page
	if( 'wp-login.php' === $pagenow ) {
		// Adjust the login text as desired
		$login_text = __( 'You can also create an account with a social network.', 'woocommerce-social-login' );
	}

 	return $login_text;
}
add_filter( 'pre_option_wc_social_login_text', 'sv_wc_social_login_change_instructions' );
