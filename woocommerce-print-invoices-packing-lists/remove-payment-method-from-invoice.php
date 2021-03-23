<?php // only copy this line if needed
/**
 * Removes "Payment Method" from the footer table of invoices
 * 
 * @param array $rows array containing the rows of the footer table
 * @param string $type the type of document being viewed
 * @param \WC_Order $order the order object the document is for
 * @return array $rows the updated array
 */

function sv_wc_pip_document_table_footer( $rows, $type, $order_id ) {
    
    //bail if document type is not invoice
    if ( 'invoice' !== $type ) { return $rows; }

    //remove payment method from array
	if ( isset( $rows['payment_method'] ) ) {
		unset( $rows['payment_method'] );
	}

    return $rows; //return updated array
}
add_filter( 'wc_pip_document_table_footer', 'sv_wc_pip_document_table_footer', 10, 3 );
