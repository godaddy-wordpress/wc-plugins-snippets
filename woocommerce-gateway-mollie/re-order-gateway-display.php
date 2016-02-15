<?php // only keep this line if needed

/** 
 * Re-orders the display of enabled gateways with WC Mollie
 * 
 * @param array $gateways the available gateways
 * @return array the updated gateway list
 */
function sv_wc_mollie_reorder_gateways( $gateways ) {

	$gateway_order = array(
		// Rearrange these payment options into the order you wish
		'WC_Gateway_Mollie_iDEAL',
		'WC_Gateway_Mollie_CreditCard',
		'WC_Gateway_Mollie_MisterCash',
		'WC_Gateway_Mollie_BankTransfer',
		'WC_Gateway_Mollie_Bitcoin',
		'WC_Gateway_Mollie_PayPal',
		'WC_Gateway_Mollie_Paysafecard',
		'WC_Gateway_Mollie_SOFORT',
		'WC_Gateway_Mollie_Belfius',
	);
	
	return array_intersect( $gateway_order, $gateways );

}
add_filter( 'wc_gateway_mollie_gateways', 'sv_wc_mollie_reorder_gateways' );