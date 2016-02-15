<?php // only copy opening tag if needed

/**
 * Forces a step on user-defined measurement entry, ie. only allow measurements in
 * increments of 0.1m
 *
 * Will be enforced on all user-defined measurements, could be scoped to specific products
 * if needed
 */
function sv_wc_measurement_price_calculator_amount_needed() {

	// bail if we're not on a product page
	if ( ! is_product() ) {
		return;
	}

	wc_enqueue_js( '
		$( "input.amount_needed" ).attr( { "step" : "0.1", "type" : "number" } );
	' );

}
add_action( 'wp_enqueue_scripts', 'sv_wc_measurement_price_calculator_amount_needed' );
