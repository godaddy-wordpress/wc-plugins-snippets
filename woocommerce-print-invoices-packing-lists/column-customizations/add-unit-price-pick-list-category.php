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
	if  ('pick-list' === $type ) {
		$table_headers['unit_price'] = 'Price';
	}

	return $table_headers;
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers', 10, 3 );

/**
 * Filter the document table row cells to add custom column data when set to category
 *
 */
function sv_wc_pip_document_table_row_cells( $item, $item_data ) {

	$product = $item_data['product'];

	if ( $product instanceof \WC_Product ) {

		// display the value of the `unit_price`
		$item['unit_price'] = wc_price( $product->get_price() );
	}

	return $item;
}
add_filter( 'wc_pip_pick_list_grouped_by_category_table_row_cells', 'sv_wc_pip_document_table_row_cells', 10, 2 );
