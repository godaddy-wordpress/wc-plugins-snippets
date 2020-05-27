<?php // only copy if needed!


/**
 * Add custom tracking code immediately after Google Analytics Pro prints GA tracking code.
 *
 * @param string $ga_function tracking js function name
 */
function sv_wc_google_analytics_pro_add_custom_tracking_code( $ga_function ) {

	?>

	// enter your JavaScript code here

	<?php
}
add_action( 'wc_google_analytics_pro_after_tracking_code_setup', 'sv_wc_google_analytics_pro_add_custom_tracking_code' );
