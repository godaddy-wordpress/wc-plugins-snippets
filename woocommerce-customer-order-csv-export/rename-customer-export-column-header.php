<?php
/**
 * Rename Customer CSV Export Columns
 *
 * Example: rename the customer_id column to User ID
 * make sure to not change the key (`customer_id`) as this matches the column to the relevant data
 * change the value of the array to change the column header that's exported 
 *
 * @param array $column_headers the original headers of the column export
 * @return array $column_headers the updated headers array
 */
function sv_wc_csv_export_rename_customer_column( $column_headers ) {

	$column_headers['customer_id'] = 'User ID'; 
	return $column_headers;

}
add_filter( 'wc_customer_order_csv_export_customer_headers', 'sv_wc_csv_export_rename_customer_column' );
