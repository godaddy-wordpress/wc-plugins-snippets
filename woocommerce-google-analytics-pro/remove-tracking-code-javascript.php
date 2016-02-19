<?php // only copy this line if needed

/**
 * Remove the tracking code added by WooCommerce Google Analytics Pro
 * - this is usefull if your theme or another plugin is adding the tracking code
 * - and you wish to use that instead
 */
function sv_wc_google_analytics_pro_remove_tracking_code() {

	// check if Google Analytics Pro is active
	if ( ! function_exists( 'wc_google_analytics_pro' ) ) {
		return;
	}

	remove_action( 'wp_head',    array( wc_google_analytics_pro()->get_integration(), 'ga_tracking_code' ), 9 );
	remove_action( 'login_head', array( wc_google_analytics_pro()->get_integration(), 'ga_tracking_code' ), 9 );
}

add_action( 'init', 'sv_wc_google_analytics_pro_remove_tracking_code' );
