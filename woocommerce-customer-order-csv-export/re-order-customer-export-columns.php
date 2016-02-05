<?php
/**
 * Re-order Customer CSV Export Columns
 *
 * Example: move customer_id after last_name
 * unset the column, then reset it in the desired location
 *
 * @param array $column_headers the original headers of the column export
 * @return array $new_column_headers the updated headers array
 */
function sv_wc_csv_export_reorder_customer_columns( $column_headers ) {

	// remove customer_id from the original set of column headers, otherwise it will be duplicated
	unset( $column_headers['customer_id'] );

	$new_column_headers = array();
	
	foreach ( $column_headers as $key => $name ) {
		
		$new_column_headers[ $key ] = $name;
		
		if ( 'last_name' == $key ) {
			// re-add customer_id immediately after last_name
			$new_column_headers['customer_id'] = 'customer_id';
		}

	}

	return $new_column_headers;
}
add_filter( 'wc_customer_order_csv_export_customer_headers', 'sv_wc_csv_export_reorder_customer_columns' );
