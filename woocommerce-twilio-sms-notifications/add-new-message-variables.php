<?php
/**
 * Add new WooCommerce Twilio message variables
 * Adds shipping method provider and Sequential Order Numbers support
 *
 * Can work with any custom order meta as well.
 *
 * @param string $message the SMS message
 * @param \WC_Order $order the order object
 *
 * @return string updated message
 */
function sv_wc_twilio_sms_variable_replacement( $message, $order ) {

	$order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;

	// Shipment tracking
	$tracking_provider = get_post_meta( $order_id, '_tracking_provider', true );
	$tracking_number   = get_post_meta( $order_id, '_tracking_number', true );

	$message = str_replace( '%tracking_provider%', $tracking_provider, $message );
	$message = str_replace( '%tracking_number%', $tracking_number, $message );

	// Custom order numbers
	$message = str_replace( '%order_id%', $order->get_order_number(), $message );

	return $message;
}
add_filter( 'wc_twilio_sms_customer_sms_before_variable_replace', 'sv_wc_twilio_sms_variable_replacement', 10, 2 );
