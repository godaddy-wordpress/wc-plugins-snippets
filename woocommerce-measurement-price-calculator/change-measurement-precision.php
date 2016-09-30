<?php // only copy this line if needed

/**
 * Change the Measurement Price Calculator measurement precision
 *
 * This controls the number of decimal places used to display the total
 * measurement
 */
function sv_wc_measurement_price_calculator_change_measurement_precision() {

	return 2;
}
add_filter( 'wc_measurement_price_calculator_measurement_precision', 'sv_wc_measurement_price_calculator_change_measurement_precision' );
