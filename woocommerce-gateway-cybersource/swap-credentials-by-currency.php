<?php // only copy this line if needed

/**
 * Filter the CyberSource Merchant ID based on the order's currency.
 *
 * Requires v2.0.2+
 *
 *
 * @param string $merchant_id the merchant ID
 * @param \WC_Order $order order instance
 * @return string the updated merchant ID
 */
function sv_wc_cybersource_swap_merchant_id_by_currency( $merchant_id, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$merchant_id = 'CAD Merchant ID here';
		break;

		case 'USD':
			$merchant_id = 'USD Merchant ID here';
		break;
	}

	return $merchant_id;
}
add_filter( 'wc_cybersource_api_credentials_merchant_id', 'sv_wc_cybersource_swap_merchant_id_by_currency', 10, 2 );


/**
 * Filter the CyberSource API Key based on the order's currency.
 *
 * Requires v2.0.2+
 *
 *
 * @param string $api_key the API Key
 * @param \WC_Order $order order instance
 * @return string the updated API Key
 */
function sv_wc_cybersource_swap_api_key_by_currency( $api_key, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$api_key = 'CAD API Key here';
		break;

		case 'USD':
			$api_key = 'USD API Key here';
		break;
	}

	return $api_key;
}
add_filter( 'wc_cybersource_api_credentials_api_key', 'sv_wc_cybersource_swap_api_key_by_currency', 10, 2 );


/**
 * Filter the CyberSource API Shared Secret based on the order's currency.
 *
 * Requires v2.0.2+
 *
 *
 * @param string $api_shared_secret the API Shared Secret
 * @param \WC_Order $order order instance
 * @return string the updated API Shared Secret
 */
function sv_wc_cybersource_swap_api_shared_secret_by_currency( $api_shared_secret, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$api_shared_secret = 'CAD API Shared Secret here';
		break;

		case 'USD':
			$api_shared_secret = 'USD API Shared Secret here';
		break;
	}

	return $api_shared_secret;
}
add_filter( 'wc_cybersource_api_credentials_api_shared_secret', 'sv_wc_cybersource_swap_api_shared_secret_by_currency', 10, 2 );
