<?php // only copy this line if needed

/**
 * Allow Braintree for WooCommerce Apple Pay to work with additional currencies
 *
 * @param string[] $currencies the original array of currencies
 * @return string[] the updated array
 */
function sv_wc_braintree_apple_pay_accepted_currencies( $currencies ) {

	return array_merge( [ 'GBP', 'CAD' ],  $currencies );
}
add_filter( 'sv_wc_apple_pay_accepted_currencies', 'sv_wc_braintree_apple_pay_accepted_currencies' );
