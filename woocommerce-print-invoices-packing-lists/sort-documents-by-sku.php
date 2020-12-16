<?php // only copy this line if needed

/**
 * Change the Print Invoices/Packing Lists order items sort column key to SKU
 *
 * @param string $sort_order_items_key The column key (such as 'sku', 'price', 'weight', etc.) to sort order items by
 * @param int $order_id                The WC_Order id
 * @param string $document_type        The type of document being viewed
 * @return string                      The filtered sort column key
 */
function sv_wc_pip_document_sort_order_items_by_sku( $sort_by, $order_id, $type ) {

	// uncomment if you want to only change the sort key for packing lists
	// if ( 'packing-list' !== $document_type ) { return; }

	return 'sku';
}
add_filter( 'wc_pip_document_sort_order_items_key', 'sv_wc_pip_document_sort_order_items_by_sku', 10, 3 );


/**
 * Changes the sorting function callback to sort order items using natural
 * alphanumeric sorting when the sort key is SKU
 *
 * @param int $compare       usort callback return value (an integer between -1 and 1)
 * @param array $filter_args array of arguments used to compare 2 items at one time
 * @param \WC_PIP_Document   $document the current document object
 * @return int               an updated ustort callback return value based on natural sorting
 */
function sv_wc_pip_sort_order_item_rows_natural_sku_sorting( $compare, $filter_args ) {

	if ( isset( $filter_args['sort_key'] ) && 'sku' === $filter_args['sort_key'] ) {

		// make sure filter args are as we'd expect them to be
		if ( isset( $filter_args['item_1'] ) && is_array( $filter_args['item_1'] )
			&& isset( $filter_args['item_2'] ) && is_array( $filter_args['item_2'] ) ) {

				$item_1_value = reset( $filter_args['item_1'] );
				$item_2_value = reset( $filter_args['item_2'] );

				$compare = strnatcmp( $item_1_value, $item_2_value );
		}
	}

	return $compare;
}
add_filter( 'wc_pip_sort_order_item_rows', 'sv_wc_pip_sort_order_item_rows_natural_sku_sorting', 10, 2 );
