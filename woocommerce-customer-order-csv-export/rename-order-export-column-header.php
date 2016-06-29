<?php // only copy this line if needed

/**
 * Rename Order CSV Export columns
 * Example: Rename order_notes to Notes
 *  make sure to not change the key (`order_notes`) in this case
 *  as this matches the column to the relevant data
 *  change the value of the array to change the column header that's exported
 *
 * @param array $column_headers the original headers of the order export
 * @return array the updated column headers
 */
function sv_wc_csv_export_rename_column( $column_headers ) {

	$column_headers['order_notes'] = 'Notes';

	return $column_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_rename_column' );
