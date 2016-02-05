<?php
/**
 * Remove Customer CSV Columns
 *
 * Example: remove shipping_country column
 * Unset the column you'd like to remove
 * the list of column keys can be found in class-wc-customer-order-csv-export-generator.php
 *
 * @param array $column_headers the original headers of the column export
 * @return array $column_headers the updated headers array
 */
function sv_wc_csv_export_remove_customer_column( $column_headers ) {

	unset( $column_headers['shipping_country'] );
	return $column_headers;
	
}
add_filter( 'wc_customer_order_csv_export_customer_headers', 'sv_wc_csv_export_remove_customer_column' );