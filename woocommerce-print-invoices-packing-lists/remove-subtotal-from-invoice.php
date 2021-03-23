<?php // only copy this line if needed
/**
 * Removes "Subtotal" from the footer table of invoices
 * 
 * @param array $rows array containing the rows of the footer table
 * @param string $type the type of document being viewed
 * @param \WC_Order $order the order object the document is for
 * @return array $rows the updated array
 */

function sv_wc_pip_document_table_footer( $rows, $type, $order_id ) {
    
    //bail if document type is not invoice
    if ( 'invoice' !== $type ) { return $rows; }

    //remove subtotal from array
	if ( isset( $rows['cart_subtotal'] ) ) {
		unset( $rows['cart_subtotal'] );
	}

    return $rows; //return updated array
}
add_filter( 'wc_pip_document_table_footer', 'sv_wc_pip_document_table_footer', 10, 3 );
