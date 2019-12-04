<?php // only copy if needed!


/**
 * Remove the order number from generated voucher numbers.
 *
 * Works for newly generated vouchers, will not update historical vouchers.
 *
 * @param string $number generated voucher number
 * @param string $prefix voucher number prefix, if available
 * @param string $random random part of the voucher number
 * @param int $order_id order ID associated with the voucher, if available
 * @return string the updated number
 */
add_filter( 'wc_pdf_product_vouchers_generated_voucher_number', function( $number, $prefix, $random, $order_id ) {

	// only proceed if there was an order ID to begin with
	if ( $order_id ) {

		$order = wc_get_order( $order_id );

		if ( $order instanceof \WC_Order ) {
			$number = str_replace( '-' . $order->get_order_number(), '', $number );
		}
	}

	return $number;

}, 10, 4 );