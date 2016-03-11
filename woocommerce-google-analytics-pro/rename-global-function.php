<?php // only copy this line if needed

/**
 * Rename the Google Analytics function name
 *
 * This allows you to use WooCommerce Google Analytics Pro along with other
 * Google Analytics code or integrations without function name conflicts.
 *
 * Note: This filter is only available in version 1.0.3+
 */
function sv_wc_google_analytics_pro_tracking_function_name() {
	return 'ga';
}
add_filter( 'wc_google_analytics_pro_tracking_function_name', 'sv_wc_google_analytics_pro_tracking_function_name' );
