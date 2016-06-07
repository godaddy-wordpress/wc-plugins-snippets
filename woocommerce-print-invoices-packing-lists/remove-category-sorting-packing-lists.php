<?php // only copy if needed

/**
 * Examples for adjusting whether packing / pick lists should sort products by category or not
 */ 

/**
 * Removes packing list / pick list sorting by category and
 *   outputs line items in alphabetical order
 */
add_filter( 'wc_pip_packing_list_group_items_by_category', '__return_false' );


/**
 * Example: Remove product grouping if an order is not yet paid. (WC 2.5+)
 * Only removes grouping for pick lists
 * Requires PIP 3.1.1+
 *
 * @param bool $group_items true if items should be grouped by category
 * @param int $order_id the ID for the document's order
 * @param string $document_type the type for the current document
 * @return bool
 */
function sv_wc_pip_packing_list_grouping( $group_items, $order_id, $document_type ) {

	// bail unless we're looking at a pick list
	if ( 'pick-list' !== $document_type ) {
		return $group_items;
	}

	$order = wc_get_order( $order_id );

	if ( ! $order->is_paid() ) {
		return false;
	}

	return $group_items;
}
add_filter( 'wc_pip_packing_list_group_items_by_category', 'sv_wc_pip_packing_list_grouping', 10, 3 );