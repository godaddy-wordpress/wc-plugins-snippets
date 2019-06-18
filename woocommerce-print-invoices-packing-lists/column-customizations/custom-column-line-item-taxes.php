<?php // only copy this line if needed

/**
 * Filters the document table headers to add a custom column header for line taxes.
 *
 * @param array $table_headers table column headers
 * @param int $order_id \WC_Order id
 * @param string $document_type \WC_PIP_Document type
 * @return array the updated table column headers
 */
function sv_wc_pip_document_table_headers_add_line_item_taxes( $table_headers, $order_id, $document_type ) {

	if ( 'invoice' === $document_type ) {

		$new_headers = $tax_labels = [];
		$order       = wc_get_order( $order_id );
				
		// get the order taxes by ID and label
		foreach ( $order->get_items( 'tax' ) as $tax_item ) {
    		$tax_labels[ $tax_item->get_id() ] = $tax_item->get_label();
		}		
		
		foreach ( $table_headers as $key => $name ) {

			// create columns for all taxes before the price column
			if ( 'price' === $key ) {
				foreach ( $tax_labels as $tax_id => $tax_label ) {
					$new_headers[ 'tax_' . $tax_id ] = $tax_label;	
				}
			}

			$new_headers[ $key ] = $name;
		}

		$table_headers = $new_headers;
	}

	return $table_headers;
	
}

add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_add_line_item_taxes', 10, 3 );


/**
 * Filters the document table row cells to add custom column data for line taxes.
 *
 * @param string $table_row_cells the table row cells
 * @param string $type \WC_PIP_Document type
 * @param string $item_id the item id
 * @param array $item the item data
 * @param \WC_Product $product the product object
 * @param \WC_Order $order the order object
 * @return array the filtered table row cells
 */
function sv_wc_pip_document_table_row_cells_add_line_item_taxes( $table_row_cells, $document_type, $item_id, $item, $product, $order ) {

	if ( 'invoice' === $document_type ) {
		
		$new_row_cells = $tax_labels = [];
		
		// get the order taxes by ID and label
		foreach ( $order->get_items( 'tax' ) as $tax_item ) {
    		$tax_labels[ $tax_item->get_rate_id() ] = $tax_item->get_label();
		}		

		foreach ( $table_row_cells as $key => $value ) {

			if ( 'price' === $key ) {
				
				$taxes = $item->get_taxes();
				$taxes = isset( $taxes['subtotal'] ) ? $taxes['subtotal'] : [];
				
				// populate row cells with the item's tax amounts
				foreach ( $tax_labels as $tax_id => $tax_label ) {
					if ( isset( $taxes[ $tax_id ] ) ) {
						$new_row_cells[ 'tax_' . $tax_id ] =  '<span class="price">' . wc_price( $taxes[ $tax_id ] ) . '</span>';
					} else {
						$new_row_cells[ 'tax_' . $tax_id ] = '';
					}
				}
			}

			$new_row_cells[ $key ] = $value;
		}

		$table_row_cells = $new_row_cells;
	}

	return $table_row_cells;
	
}

add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_add_line_item_taxes', 10, 6 );
