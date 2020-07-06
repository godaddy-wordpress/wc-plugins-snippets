<?php // only copy if needed!


/**
 * Add new WooCommerce Twilio message variables.
 * Adds shipping method provider, Sequential Order Numbers support, and customer first name.
 *
 * Can work with any custom order meta as well.
 *
 * @param string $message the SMS message
 * @param \WC_Order $order the order object
 * @return string updated message
 */
function sv_wc_twilio_sms_variable_replacement( $message, $order ) {

	// Shipment tracking: use first package
	$tracking_data     = $order->get_meta( '_wc_shipment_tracking_items', true );
	$tracking_provider = $tracking_data[0]['tracking_provider'];
	$tracking_number   = $tracking_data[0]['tracking_number'];

	$message = str_replace( '%tracking_provider%', $tracking_provider, $message );
	$message = str_replace( '%tracking_number%', $tracking_number, $message );

	// Custom order numbers
	$message = str_replace( '%order_id%', $order->get_order_number(), $message );

	// Customer first name
	$message = str_replace( '%first_name%', $order->get_billing_first_name(), $message );

	return $message;
}
add_filter( 'wc_twilio_sms_customer_sms_before_variable_replace', 'sv_wc_twilio_sms_variable_replacement', 10, 2 );
