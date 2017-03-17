<?php // only copy this line if needed
/**
 * Adds Order Delivery date to the "Shipping Method" section of invoices and packing lists
 * 'Show shipping method' should be enabled for invoices!
 *
 * @param string $shipping the shipping method text
 * @param string $document_type the type of document being viewed
 * @param \WC_Order $order the order object the document is for
 * @return string the updated shipping string
 */
function sv_wc_pip_add_order_delivery_shipping( $shipping, $document_type, $order ) {

	// if you want to only add this to invoices, you can add another check for document type
	// if ( 'invoice' !== $document_type ) { return $shipping; }

	// bail if Order Delivery plugin is not active
	if ( ! function_exists( 'WC_OD' ) ) {
		return $shipping;
	}

	$order_id      = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;
	$delivery_date = get_post_meta( $order_id, '_delivery_date', true );

	if ( $delivery_date ) {
		$delivery_date_i18n = wc_od_localize_date( $delivery_date );
		$shipping .= '<p>We will try our best to deliver your order on: ' . $delivery_date_i18n . '</p>';
	}

	return $shipping;
}
add_filter( 'wc_pip_document_shipping_method', 'sv_wc_pip_add_order_delivery_shipping', 10, 3 );
