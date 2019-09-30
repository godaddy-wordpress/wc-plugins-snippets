<?php // only copy this line if needed

/**
 * Sample code for displaying value of fields created by Advanced Custom Fields (ACF)
 * on Print Invoices/Packing Lists documents
 *
 * Note: Please refer to https://www.advancedcustomfields.com/resources on information
 * on how to use ACF and get details about the `get_field_object()` function
 *
 * @param string $type the document type
 * @param string $action current action running on Document
 * @param \WC_PIP_Document $document document object
 * @param \WC_Order $order order object
 */
function sv_wc_pip_sample_add_acf_field( $type, $action, $document, $order ) {

	// ensure ACF is active
	if ( ! function_exists( 'get_field_object' ) ) {
		return;
	}

	// uncomment if you want to only add this to invoices
	// if ( 'invoice' !== $document_type ) { return; }

	$order_id = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;

	$acf_field = get_field_object( 'field_key', $order_id );

	echo '<strong>' . $acf_field['label'] . '</strong>: ' . $acf_field['value'];
}
add_action( 'wc_pip_after_customer_addresses', 'sv_wc_pip_sample_add_acf_field', 10, 4 );
