<?php
/**
 * Add product page information if calculator is enabled
 * Example: Add a heading above the calculator section
 */
function sv_wc_measurement_price_calculator_heading() {

	// bail if MPC isn't active
	if ( ! class_exists( 'WC_Price_Calculator_Product' ) ) {
		return;
	}

	global $product;
	$measurement = WC_Price_Calculator_Product::calculator_enabled( $product );
	
	// if the calculator is enabled, add the heading
	if ( $measurement ) {
		echo '<h4>Enter Your Needed Measurements</h4>';
	}
	
}
add_filter( 'woocommerce_before_add_to_cart_button', 'sv_wc_measurement_price_calculator_heading', 4 );
