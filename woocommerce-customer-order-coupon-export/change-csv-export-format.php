<?php // only copy if needed!

/**
 * Adjust the output format of the CSV export, by setting the
 * delimiter, enclosure and BOM.
 */

// change CSV delimiter to a semi-colon (;)
function wc_csv_export_modify_delimiter() {
	return ';';
}
add_filter( 'wc_customer_order_export_csv_delimiter', 'wc_csv_export_modify_delimiter' );

// change CSV enclosure to a pipe (|)
function wc_csv_export_modify_enclosure() {
	return '|';
}
add_filter( 'wc_customer_order_export_csv_enclosure', 'wc_csv_export_modify_enclosure' );

// enable the BOM (byte-order mark) for all CSVs
add_filter( 'wc_customer_order_export_csv_enable_bom', '__return_true' );
