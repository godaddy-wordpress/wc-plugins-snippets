<?php // only copy this line if needed

/**
 * Remove the tracking code added by WooCommerce Google Analytics Pro
 * This is usefull if your theme or another plugin is adding the tracking code
 * and you wish to use that instead
 *
 * Requires at least v1.5.1 of Google Analytics Pro
 */
add_filter( 'wc_google_analytics_pro_remove_tracking_code', '__return_true' );



// OR



/**
 * IMPORTANT NOTE: Use this only if you're running a version older than v1.5.1
 *
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

	// remove pageviews
	// uncomment the following line if your Google Analytics plugin tracks pageviews
	// remove_action( 'wp_head', array( wc_google_analytics_pro()->get_integration(), 'pageview' ) );
}

add_action( 'init', 'sv_wc_google_analytics_pro_remove_tracking_code' );
