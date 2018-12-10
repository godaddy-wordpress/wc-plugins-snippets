<?php // only copy this line if needed

/**
 * Filter the document table headers to add a custom column header for line tax
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_add_line_item_tax( $table_headers, $order_id, $document_type ) {

	// add custom columns for invoices
	if ( 'invoice' === $document_type ) {

		$new_headers = array();

		foreach ( $table_headers as $key => $name ) {

			// add tax column right before the price column
			if ( 'price' === $key ) {
				$new_headers['line_item_tax'] = 'Tax';
			}

			$new_headers[ $key ] = $name;
		}

		$table_headers = $new_headers;
	}

	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_add_line_item_tax', 10, 3 );

/**
 * Filter the document table row cells to add custom column data for line tax
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @param \WC_Order $order Order object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_add_line_item_tax( $table_row_cells, $document_type, $item_id, $item, $product, $order ) {

	// set custom column content for invoices
	if ( 'invoice' === $document_type ) {

		$new_row_cells = array();

		foreach ( $table_row_cells as $key => $value ) {

			// add tax column right before the price column
			if ( 'price' === $key ) {
				$new_row_cells['line_item_tax'] = '<span class="price">' . wc_price( $item->get_total_tax() ) . '</span>';
			}

			$new_row_cells[ $key ] = $value;
		}

		$table_row_cells = $new_row_cells;
	}

	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_add_line_item_tax', 10, 6 );
