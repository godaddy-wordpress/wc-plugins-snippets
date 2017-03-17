<?php // only copy this line if needed

/**
 * Change the Measurement Price Calculator measurement precision to 2 decimal
 * places
 *
 * This controls the number of decimal places used to display the total
 * measurement on product pages
 *
 * @return int The number of decimal places
 */
function sv_wc_measurement_price_calculator_change_measurement_precision() {
	return 2;
}
add_filter( 'wc_measurement_price_calculator_measurement_precision', 'sv_wc_measurement_price_calculator_change_measurement_precision' );


/**
 * Round the Measurement Price Calculator total measurement on the cart page to
 * 2 decimal places.
 *
 * Requrires v3.10.2+
 *
 * @param float $value The total measurement value
 * @return float The total measurement value rounded to 2 decimal places
 */
function sv_wc_measurement_price_calculator_humanize_cart_item_data_total_amount_value( $value ) {

	return round( $value, 2 );
}
add_filter( 'wc_measurement_price_calculator_cart_item_data_total_amount_value', 'sv_wc_measurement_price_calculator_humanize_cart_item_data_total_amount_value' );
