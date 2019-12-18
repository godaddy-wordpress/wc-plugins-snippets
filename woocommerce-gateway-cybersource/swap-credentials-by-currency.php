<?php // only copy this line if needed

/**
 * Filter the CyberSource credentials based on the order's currency.
 * Requires v2.0.2.
 *
 * @param array $gateway_credentials the associative array of gateway credentials
 * @param \WC_Order $order order instance
 * @return array the updated gateway credentials
 */
function sv_wc_cybersource_swap_credentials_by_currency( $gateway_credentials, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$gateway_credentials = [
				'merchant_id'       => 'CAD Merchant ID here',
				'api_key'           => 'CAD API Key here',
				'api_shared_secret' => 'CAD API Shared Secret here',
			];
		break;

		case 'USD':
			$gateway_credentials = [
				'merchant_id'       => 'USD Merchant ID here',
				'api_key'           => 'USD API Key here',
				'api_shared_secret' => 'USD API Shared Secret here',
			];
		break;
	}

	return $gateway_credentials;
}
add_filter( 'wc_cybersource_api_gateway_credentials', 'sv_wc_cybersource_swap_credentials_by_currency', 10, 2 );
