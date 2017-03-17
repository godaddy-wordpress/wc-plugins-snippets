<?php // only copy this line if needed

/**
 * Changes MPC width / length inputs to number type inputs
 *   then adds min / max values accepted for each
 *
 * requires HTML5 support
 */
function sv_wc_measurement_price_calculator_input_min_max() {
	global $product;

	// bail unless we're on a product page and MPC is active
	if ( ! ( is_product() && class_exists( 'WC_Price_Calculator_Product' ) ) ) {
		return;
	}

	// bail unless the calculator is enabled for this product, this is also why we hook into the footer scripts
	// since this isn't available immediately at page load
	if ( ! WC_Price_Calculator_Product::calculator_enabled( $product ) ) {
		return;
	}

	wc_enqueue_js("
		$('#length_needed').attr({ type: 'number', min: '.1', max: '24', step: '.1' }).addClass('input-text');
		$('#width_needed').attr({ type: 'number', min: '.1', max: '5', step: '.1' }).addClass('input-text');
	");

}
add_action( 'wp_print_footer_scripts', 'sv_wc_measurement_price_calculator_input_min_max' );


/**------------------------------------------------------------
 Note: if you run into "Error: type property can't be changed",
 then you can also use the jQuery "clone" function,
 then destroy the text field once it's replaced.

 Example:
 $('#length_needed').clone().attr({ type: 'number', min: '.1', max: '24', step: '.1' }).insertAfter('#length_needed').prev().remove();
------------------------------------------------------------**/
