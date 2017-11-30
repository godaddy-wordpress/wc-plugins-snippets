<?php // only copy if needed

/**
 * Sorts PIP invoice documents by product menu order.
 * REQUIRES WOOCOMMERCE 3.0+
 */


/**
 * Filters PIP invoice rows to sort by menu order.
 *
 * @param string[] $table_rows all table rows being printed
 * @param string[] $items the document items
 * @param int $order_id the order ID for the document
 * @param string $type document type
 * @param \WC_PIP_Document $document the current document object
 * @return string[] updated rows
 */
function sv_wc_pip_sort_rows_by_menu_order( $table_rows, $items, $order_id, $type, $document ) {

	if ( 'invoice' !== $type ) {
		return $table_rows;
	}

	$order = wc_get_order( $order_id );

	foreach ( $table_rows as &$all_rows ) {
		 foreach( $all_rows['items'] as &$item ) {

			preg_match( '/<span data-item-id="(.*?)"><\/span>/', $item['id'], $match );
			$menu_order = $order->get_item( $match[1] )->get_product()->get_menu_order();

			$item['menu_order'] = "<span data-menu-order=\"{$menu_order}\"></span>";
		 }

		usort( $all_rows['items'], 'sv_wc_pip_compare_menu_order' );
	}

	return $table_rows;
}
add_filter( 'wc_pip_document_table_rows', 'sv_wc_pip_sort_rows_by_menu_order', 10, 5 );


/**
 * Sorts items by menu order.
 *
 * @param array $row_1 First row to compare for sorting
 * @param array $row_2 Second row to compare for sorting
 * @return int
 */
function sv_wc_pip_compare_menu_order( $row_1, $row_2 ) {

	preg_match( '/<span data-menu-order="(.*?)"><\/span>/', $row_1['menu_order'], $match );
	$row_1_menu_order = $match[1];

	preg_match( '/<span data-menu-order="(.*?)"><\/span>/', $row_2['menu_order'], $match );
	$row_2_menu_order = $match[1];

    if ( $row_1_menu_order === $row_2_menu_order ) {
        return 0;
    }

    return ( $row_1_menu_order < $row_2_menu_order ) ? -1 : 1;
}


/**
 * Hide the menu order column we've added for sorting
 */
function sv_wc_hide_menu_order_cells() {
 	 echo 'td.menu_order {
		display:none;
	}';
}
add_action( 'wc_pip_styles', 'sv_wc_hide_menu_order_cells' );
