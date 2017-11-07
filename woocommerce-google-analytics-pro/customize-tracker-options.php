<?php // only copy if needed!


/**
 * Allows actors to customize the GA tracker options.
 *
 * For a list of available options, see to https://developers.google.com/analytics/devguides/collection/analyticsjs/field-reference#create
 *
 * @param array $options tracker options
 */
function sv_wc_ga_pro_customize_tracker_options( $options ) {

	$options['sampleRate'] = 5;

	return $options;
}
add_filter( 'wc_google_analytics_pro_tracker_options', 'sv_wc_ga_pro_customize_tracker_options' );
