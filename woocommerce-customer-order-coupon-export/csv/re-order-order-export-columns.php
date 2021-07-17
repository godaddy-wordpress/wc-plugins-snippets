<?php // only copy this line if needed

/**
 * Re-order Order CSV Export columns
 * Example: move order_total after order_number
 * unset the column, then reset it in the desired location
 *
 * @param array $column_headers the original headers of the order export
 * @return array the updated column headers
 */
function sv_wc_csv_export_reorder_columns( $column_headers ) {

	// remove order total from the original set of column headers, otherwise it will be duplicated
	unset( $column_headers['order_total'] );

	$new_column_headers = [];

	foreach ( $column_headers as $column_key => $column_name ) {

		$new_column_headers[ $column_key ] = $column_name;

		if ( 'order_number' == $column_key ) {

			// add order total immediately after order_number
			$new_column_headers['order_total'] = 'order_total';
		}
	}

	return $new_column_headers;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_wc_csv_export_reorder_columns' );
