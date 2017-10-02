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

	// if we bail here, you need to upgrade your Twilio plugin
	if ( ! class_exists( 'SV_WC_Order_Compatibility' ) ) {
		return $message;
	}

	// Shipment tracking: use first package
	$tracking_data     = SV_WC_Order_Compatibility::get_meta( $order, '_wc_shipment_tracking_items' );
	$tracking_provider = $tracking_data[0]['tracking_provider'];
	$tracking_number   = $tracking_data[0]['tracking_number'];

	$message = str_replace( '%tracking_provider%', $tracking_provider, $message );
	$message = str_replace( '%tracking_number%', $tracking_number, $message );

	// Custom order numbers
	$message = str_replace( '%order_id%', $order->get_order_number(), $message );

	return $message;
}
add_filter( 'wc_twilio_sms_customer_sms_before_variable_replace', 'sv_wc_twilio_sms_variable_replacement', 10, 2 );
