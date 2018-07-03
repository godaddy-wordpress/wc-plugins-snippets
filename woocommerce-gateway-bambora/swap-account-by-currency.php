<?php // only copy this line if needed

/**
 * Replace the Bambora merchant ID based on the order's (or store's) currency
 *
 * @param string $merchant_id API merchant ID
 * @param \WC_Order|null $order order object
 * @return string merchant ID
 */
function sv_wc_beanstream_swap_merchant_id( $merchant_id, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$merchant_id = 'CAD merchant ID here';
		break;

		case 'USD':
			$merchant_id = 'USD merchant ID here';
		break;

	}

	return $merchant_id;
}
add_filter( 'wc_bambora_api_request_merchant_id', 'sv_wc_beanstream_swap_merchant_id', 10, 2 );


/**
 * Replace the Bambora API passcode based on the order's (or store's) currency
 *
 * @param string $api_passcode API passcode
 * @param \WC_Order|null $order order object
 * @return string API passcode
 */
function sv_wc_beanstream_swap_api_passcode_key( $api_passcode, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$api_passcode = 'CAD API passcode here';
		break;

		case 'USD':
			$api_passcode = 'USD API passcode here';
		break;

	}

	return $api_passcode;
}
add_filter( 'wc_bambora_api_request_passcode', 'sv_wc_beanstream_swap_api_passcode_key', 10, 2 );
