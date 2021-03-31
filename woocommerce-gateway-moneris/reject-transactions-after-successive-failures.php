<?php // only copy this line if needed

/**
 * Reject further transaction processing through the Moneris payment gateway if the order
 * has encountered too many successive transaction failures due to suspected fraud.
 * 
 * @param bool|array $result
 * @param int|string $order_id
 * @return bool|array
 */
add_filter( 'wc_payment_gateway_moneris_process_payment', function ( $result, $order_id ) {

	// bail if payment would fail anyway and return no payment method so do same
	if ( is_array( $result ) && isset( $result['result'] ) && 'failure' === $result['result'] ) {
		return $result;
	}

	// make sure WooCommerce session is initialized first
	if ( ! WC()->session ) {
		WC()->initialize_session();
	}

	$session_key = 'wc_moneris_order_' . $order_id . '_attempts_count';

	// set attempts count to 0 if not set before
	$attempts_count = absint( WC()->session->get( $session_key, 0 ) );
	$attempts_count++;

	// log attempt count
	wc_moneris()->log( "Order number: {$order_id} | Attempts count: {$attempts_count}" );

	// fail order if too many attempts
	if ( $attempts_count > 5 ) {
		return [
			'result'  => 'failure',
			'message' => 'Too many payment attempts!',
		];
	}

	// update session value
	WC()->session->set( $session_key, $attempts_count );

	return $result;
}, 1, 2 );

