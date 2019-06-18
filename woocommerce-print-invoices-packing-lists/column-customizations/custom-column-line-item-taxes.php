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

		$new_headers = array();

		foreach ( $table_headers as $key => $name ) {

			if ( 'price' === $key ) {
				$new_headers['line_item_tax'] = 'Taxes';
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
		
		$tax_items_labels = [];
		
		// get the order taxes by ID and label
		foreach ( $order->get_items( 'tax' ) as $tax_item ) {
    		$tax_items_labels[ $tax_item->get_rate_id() ] = $tax_item->get_label();
		}		

		$new_row_cells = [];

		foreach ( $table_row_cells as $key => $value ) {

			if ( 'price' === $key ) {
				
				$taxes = $item->get_taxes();
				$taxes = isset( $taxes['subtotal'] ) ? $taxes['subtotal'] : [];
				
				if ( ! empty( $taxes ) ) {
					
					$line_item_taxes = '';
				
					// list all item taxes 
					foreach( $taxes as $tax_id => $tax_amt ) {
						if ( isset( $tax_items_labels[ $tax_id ] ) ) {
							$line_item_taxes .= '<dt>' . $tax_items_labels[ $tax_id ] . ':</dt> <dd>' . wc_price( $tax_amt ) . '</dd>'; 
						}
					}
					
					if ( empty( $line_item_taxes ) ) {
						$line_item_tax = wc_price( $item->get_total_tax() );	
					} else {
						$line_item_tax = '<dl>' . $line_item_taxes . '</dl>';
					}					
					
				} else {
				
					$line_item_tax = wc_price( $item->get_total_tax() );	
				}
				
				$new_row_cells['line_item_tax'] =  '<span class="price">' . $line_item_tax . '</span>';
			}

			$new_row_cells[ $key ] = $value;
		}

		$table_row_cells = $new_row_cells;
	}

	return $table_row_cells;
	
}

add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_add_line_item_taxes', 10, 6 );
