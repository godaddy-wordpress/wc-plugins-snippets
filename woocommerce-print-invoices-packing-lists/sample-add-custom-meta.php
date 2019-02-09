<?php // only copy this line if needed

/**
 * Sample code for displaying custom order meta on Print Invoices/Packing Lists documents
 *
 * @param string $type the document type
 * @param string $action current action running on Document
 * @param \WC_PIP_Document $document document object
 * @param \WC_Order $order order object
 */
function sv_wc_pip_sample_add_custom_meta( $type, $action, $document, $order ) {

	// uncomment if you want to only add this to invoices
	// if ( 'invoice' !== $document_type ) { return; }

	$order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;

	echo get_post_meta( $order_id, '_meta_key_here', true );
}
add_action( 'wc_pip_after_customer_addresses', 'sv_wc_pip_sample_add_custom_meta', 10, 4 );
