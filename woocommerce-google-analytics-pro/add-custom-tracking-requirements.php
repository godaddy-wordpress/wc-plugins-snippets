<?php // only copy if needed!


/**
 * Allows actors to add additional GA settings, such as requiring Optimize tracking codes.
 *
 * @param string $ga_function tracking js function name
 */
function sv_wc_ga_pro_add_optimize_tracking_code( $ga_function ) {

	// ENTER YOUR CODE HERE INSTEAD
	$optimize_code = 'ABC123';

	echo "{$ga_function}( 'require', '{$optimize_code}' );";
}
add_action( 'wc_google_analytics_pro_after_tracking_code_setup', 'sv_wc_ga_pro_add_optimize_tracking_code' );