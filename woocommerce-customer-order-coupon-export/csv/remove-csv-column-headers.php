<?php // only copy this line if needed

/**
 * Remove CSV Export column headers
 * This could be adjusted to only remove the headers for a specific automation, or output type (e.g. ftp, local)
 * by comparing the properties of the job $attrs
 * Example: removes the headers if the format is `default_one_row_per_item`
 *
 * @param array $column_headers the original headers of the order export
 * @return array the updated column headers
 */
function sv_wc_customer_order_csv_export_remove_header_row( $attrs, $job_id ) {

	if ( 'default_one_row_per_item' === $attrs['format_key'] && has_filter( 'wc_customer_order_export_background_export_new_job_attrs' ) ) {
		remove_filter( 'wc_customer_order_export_background_export_new_job_attrs', array( wc_customer_order_csv_export()->get_export_handler_instance(), 'export_header' ), 10 );
	}

	return $attrs;
}
add_filter( 'wc_customer_order_export_background_export_new_job_attrs', 'sv_wc_customer_order_csv_export_remove_header_row', 9, 2 );
