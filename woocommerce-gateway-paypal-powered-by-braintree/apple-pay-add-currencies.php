<?php // only copy this line if needed

/**
 * Allow PayPal powered by Braintree Apple Pay to work with additional currencies
 *
 * @param array $currencies the original array of currencies
 * @return array the updated array
 */
function sv_wc_braintree_apple_pay_accepted_currencies( $currencies ) {

	return array_merge( array( 'GBP', 'CAD' ),  $currencies );
}
add_filter( 'sv_wc_apple_pay_accepted_currencies', 'sv_wc_braintree_apple_pay_accepted_currencies' );
