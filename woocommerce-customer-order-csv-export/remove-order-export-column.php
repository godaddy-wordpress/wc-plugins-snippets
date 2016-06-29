<?php // only copy this line if needed

/**
 * Remove Order CSV Export columns
 * Example: remove coupon_items column
 * Unset the column you'd like to remove
 * the list of column keys can be found in class-wc-customer-order-csv-export-generator.php
 *
 * @param array $column_headers the original headers of the order export
 * @return array the updated column headers
 */
function sv_wc_csv_export_remove_column( $column_headers ) {

	unset( $column_headers['coupon_items'] );

	return $column_headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_remove_column' );
