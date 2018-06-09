<?php // only copy this line if needed

/**
 * Replace the Legacy Bambora merchant ID based on the order's (or store's) currency
 *
 * @param string $merchant_id API merchant ID
 * @param \WC_Order|null $order order object
 * @return string merchant ID
 */
function sv_wc_beanstream_legacy_merchant_id( $merchant_id, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$merchant_id = 'CAD merchant ID here';
		break;

		case 'EUR':
			$merchant_id = 'EUR merchant ID here';
		break;

	}

	return $merchant_id;
}
add_filter( 'wc_beanstream_legacy_merchant_id', 'sv_wc_beanstream_legacy_merchant_id', 10, 2 );


/**
 * Replace the Legacy Bambora hash key based on the order's (or store's) currency
 *
 * @param string $hash_key API hash key
 * @param \WC_Order|null $order order object
 * @return string hash key
 */
function sv_wc_beanstream_legacy_hash_key( $hash_key, $order ) {

	$currency = $order instanceof WC_Order ? $order->get_currency() : get_woocommerce_currency();

	switch ( $currency ) {

		case 'CAD':
			$hash_key = 'CAD hash key here';
		break;

		case 'EUR':
			$hash_key = 'EUR hash key here';
		break;

	}

	return $hash_key;
}
add_filter( 'wc_beanstream_legacy_hash_key', 'sv_wc_beanstream_legacy_hash_key', 10, 2 );
