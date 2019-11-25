<?php // only copy if needed

// Don't mark an item as exported unless it's via auto-export


/**
 * Don't mark orders as exported if exported manually.
 *
 * @param bool $mark_exported true if the order should be marked as exported
 * @param \WC_Order $_ the order being exported, unused
 * @param string $method the export method ( 'download', 'ftp', 'http_post', 'email' )
 * @return bool whether to mark exported
 */
function sv_wc_csv_export_conditonally_mark_order_exported( $mark_exported, $_, $method ) {

	if ( 'download' === $method )  {
		$mark_exported = false;
	}

	return $mark_exported;
}
add_filter( 'wc_customer_order_csv_export_mark_order_exported', 'sv_wc_csv_export_conditonally_mark_order_exported', 10, 3 );


// OR
// Customers


/**
 * Don't mark registered customers as exported if exported manually.
 *
 * @param bool $mark_exported true if the customer should be marked as exported
 * @param int $_ the id of the customer being exported (0 for guests), unused
 * @param string $method the export method ( 'download', 'ftp', 'http_post', 'email' )
 * @return bool whether to mark exported
 */
function sv_wc_csv_export_conditonally_mark_customer_exported( $mark_exported, $_, $method ) {

	if ( 'download' === $method )  {
		$mark_exported = false;
	}

	return $mark_exported;
}
add_filter( 'wc_customer_order_csv_export_mark_customer_exported', 'sv_wc_csv_export_conditonally_mark_customer_exported', 10, 3 );
