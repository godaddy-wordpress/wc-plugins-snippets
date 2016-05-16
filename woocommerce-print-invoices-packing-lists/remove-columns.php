<?php // only copy this line if needed

/**
 * Filter the document table headers and row cells to remove column headers
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_remove_columns( $table_headers, $order_id, $type ) {

	// remove SKU columns on invoices
	if ( 'invoice' === $type ) {

		unset( $table_headers['sku'] );
	}

	// remove weight column from packing and pick lists
	elseif ( 'packing-list' === $type || 'pick-list' === $type ) {

		unset( $table_headers['weight'] );
	}

	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_remove_columns', 10, 3 );

/**
 * Filter the document table row cells to remove column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @param \WC_Order $order Order object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_remove_columns( $table_row_cells, $type, $item_id, $item, $product, $order ) {

	// remove SKU columns on invoices
	if ( 'invoice' === $type ) {

		unset( $table_row_cells['sku'] );
	}

	// remove weight column from packing and pick lists
	elseif ( 'packing-list' === $type || 'pick-list' === $type ) {

		unset( $table_row_cells['weight'] );
	}

	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_remove_columns', 10, 6 );
