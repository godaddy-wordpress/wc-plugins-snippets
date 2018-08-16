<?php // only copy if needed!

/**
 * Changes the Chase Paymentech BIN to 000001; default is 000002.
 *
 * @param string $bin the BIN value; default is 000002
 * @return string updated BIN
 */
function sv_wc_chase_paymentech_bin( $bin ) {
	return '000001';
}
add_filter( 'wc_payment_gateway_chase_paymentech_request_bin', 'sv_wc_chase_paymentech_bin' );