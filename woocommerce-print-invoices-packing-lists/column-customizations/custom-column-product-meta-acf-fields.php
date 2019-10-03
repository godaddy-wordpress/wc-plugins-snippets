<?php // only copy this line if needed


/**
 * Filter the document table headers to add custom column headers
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_product_meta_acf_fields_sample( $table_headers, $order_id, $type ) {

	// add custom columns for invoices
	if ( 'invoice' === $type ) {

		$table_headers['warranty'] = 'Warranty';

	// add custom columns for packing and pick lists
	} elseif ( 'packing-list' === $type || 'pick-list' === $type ) {

		$table_headers['warehouse_location'] = 'Warehouse';
	}

	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_product_meta_acf_fields_sample', 10, 3 );


/**
 * Filter the document table row cells to add custom column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @param \WC_Order $order Order object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_product_meta_acf_fields_sample( $table_row_cells, $document_type, $item_id, $item, $product, $order ) {

	// set custom column content for invoices
	if ( 'invoice' === $document_type ) {

		$table_row_cells['warranty'] = $product->get_meta( '_warranty' );
	}

	// set custom column content for packing and pick lists
	elseif ( 'packing-list' === $document_type || 'pick-list' === $document_type ) {

		$warehouse_location = '';

		// ensure ACF is active
		if ( function_exists( 'get_field' ) ) {

			// display the value of the `warehouse_location` ACF field if it exists
			$warehouse_location = get_field( 'warehouse_location', $product->get_id() );
		}

		$table_row_cells['warehouse_location'] = $warehouse_location;
	}

	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_product_meta_acf_fields_sample', 10, 6 );
