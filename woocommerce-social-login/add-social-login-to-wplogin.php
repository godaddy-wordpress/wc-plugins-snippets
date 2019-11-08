<?php // only copy if needed

/**
 * Add social login buttons to the WP login page and
 * adjust the instructions text appropriately
 */


/**
 * Adds login buttons to the wp-login.php pages
 */
function sv_wc_social_login_add_buttons_wplogin() {

	// bail in the event that the functions aren't defined to avoid errors
	if ( ! function_exists( 'wc_get_page_permalink' ) || ! function_exists( 'woocommerce_social_login_buttons' ) ) {
		return;
	}

	// sisplays login buttons to non-logged in users and redirects users to the My Account page
	woocommerce_social_login_buttons( wc_get_page_permalink( 'myaccount' ) );
}
add_action( 'login_form',    'sv_wc_social_login_add_buttons_wplogin' );
add_action( 'register_form', 'sv_wc_social_login_add_buttons_wplogin' );


/**
 * Changes the login text from what's set in the WooCommerce settings
 * so we're not talking about checkout while logging in.
 *
 * @param string $login_text the original login message
 * @return string the updated login message
 */
function sv_wc_social_login_change_instructions( $login_text ) {
	global $pagenow;

	// bail if Social Login isn't activated to avoid adding the message when it's not needed
	if ( ! function_exists( 'wc_social_login' ) ) {
		return;
	}

	// only modify the text from this option if we're on the wp-login page
	if( 'wp-login.php' === $pagenow ) {

		// adjust the login text as desired
		$login_text = __( 'You can also create an account with a social network.', 'woocommerce-social-login' );
	}

	return $login_text;
}
add_filter( 'pre_option_wc_social_login_text', 'sv_wc_social_login_change_instructions' );
