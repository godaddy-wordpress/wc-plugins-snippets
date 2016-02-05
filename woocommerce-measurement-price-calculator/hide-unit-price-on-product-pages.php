<?php
/**
 * Hide the unit price from the top of the product page
 * for Measurement Calculator products
 */
function sv_wc_measurement_price_calculator_hide_unit_price() {

	// bail if the calculator isn't active or this isn't a product page
	if ( ! class_exists( 'WC_Price_Calculator_Product' ) || ! is_product() ) {
		return;
	}
	
	global $product;
	$measurement = WC_Price_Calculator_Product::calculator_enabled( $product );
	
	// if the calculator is enabled, hide unit price
	if ( $measurement ) {
		echo '<style>.product form .price { display: none; }</style>';
	}
}
add_action( 'wp_print_footer_scripts', 'sv_wc_measurement_price_calculator_hide_unit_price' );