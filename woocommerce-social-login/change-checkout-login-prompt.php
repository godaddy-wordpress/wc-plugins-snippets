<?php // only copy this line if needed

/**
 * Changes "Checkout" notice text to be different from settings
 *
 * Example: http://cloud.skyver.ge/290K3X2T0x1M
 *
 * @param string $login_text original login text
 * @return string - updated login text depending on settings
 */
function sv_wc_social_login_change_notice_text( $login_text ) {

	// bail unless we're at checkout and using a "checkout" notice
	if ( ! ( function_exists( 'is_checkout' ) && is_checkout() && in_array( 'checkout', get_option( 'wc_social_login_display' ), true ) ) ) {
		return $login_text;
	}

	// set a flag so we only update the first appearance of the login text
	static $updated = false;

	if ( ! $updated ) {

		// update the Social Login text for the checkout notice
		$login_text = __( 'Want to save time by using a social network?', 'my-textdomain' );
		$updated    = true;
	}

	return $login_text;
}
add_filter( 'pre_option_wc_social_login_text', 'sv_wc_social_login_change_notice_text', 15 );
