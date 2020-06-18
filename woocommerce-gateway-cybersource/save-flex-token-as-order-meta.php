<?php // only copy this line if needed

/**
 * Saves CyberSource Flex token as order meta.
 *
 * @param \WC_Order $order order object
 * @param SV_WC_Payment_Gateway_Direct $gateway payment gateway
 */
function save_cybersource_flex_token( $order, $gateway ) {
	
	if ( ! empty( $order->payment->js_token ) ) {
		$gateway->update_order_meta( $order, 'flex_payment_token', $order->payment->js_token );
	}
}

add_action( 'wc_payment_gateway_cybersource_credit_card_payment_processed', 'save_cybersource_flex_token', 10, 2 );
