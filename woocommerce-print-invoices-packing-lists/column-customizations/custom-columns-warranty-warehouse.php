<?php // only copy this line if needed

/**
 * Filter the document table headers to add custom column headers
 *
 * @param array $table_headers Table column headers
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers( $table_headers, $order_id, $type ) {

	// add custom columns for invoices
	if ( 'invoice' === $type ) {

		$table_headers['warranty'] = 'Warranty';

	// add custom columns for packing and pick lists
	} elseif ( 'packing-list' === $type || 'pick-list' === $type ) {

		$table_headers['warehouse_location'] = 'Warehouse';
	}

	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers', 10, 3 );

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
function sv_wc_pip_document_table_row_cells( $table_row_cells, $document_type, $item_id, $item, $product, $order ) {

	// set custom column content for invoices
	if ( 'invoice' === $document_type ) {

		$table_row_cells['warranty'] = wc_get_order_item_meta( $item_id, '_warranty' );
	}

	// set custom column content for packing and pick lists
	elseif ( 'packing-list' === $document_type || 'pick-list' === $document_type ) {

		// display the value of the `_warehouse_location` order meta if it exists
		$table_row_cells['warehouse_location'] = $order->warehouse_location;
	}

	return $table_row_cells;
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells', 10, 6 );

/**
 * Filter the table column widths for our custom coulmns. This is optional as a
 * default width is already set on all custom columns. Note that the width you set
 * is proportional to the widths of the rest of the columns.
 *
 * @param array $column_widths Column widths
 * @param int $order_id WC_Order id
 * @param string $document_type WC_PIP_Document type
 * @return array The updated column widths
 */
function sv_wc_pip_document_column_width_proportions( $column_widths ) {

	$column_widths['warranty']           = 15;
	$column_widths['warehouse_location'] = 20;

	return $column_widths;
}
add_filter( 'wc_pip_document_column_widths', 'sv_wc_pip_document_column_width_proportions' );
