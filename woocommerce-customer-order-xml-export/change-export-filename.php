<?php // only copy this line if needed

/**
 * Change the date format for the filename from YYYY_MM_DD_HH_SS to YYYY-MM-DD
 *
 * @param string $post_replace_filename the filename after variables have been replaced
 * @param string $pre_replace_filename the filename before variables have been replaced
 * @return string the updated filename with replace variables
 */
function sv_wc_xml_export_suite_edit_file_name( $post_replace_file_name, $pre_replace_file_name ) {

	// define your variables here - they can be entered in the WooCommerce > XML Export Suite > Settings tab
	$variables = array( '%%timestamp%%' );

	// define the replacement for each of the variables in the same order
	$replacement = array( date( 'Y-m-d' ) );

	// return the filename with the variables replaced
	return str_replace( $variables, $replacement, $pre_replace_file_name );

}
add_filter( 'wc_customer_order_xml_export_suite_export_file_name', 'sv_wc_xml_export_suite_edit_file_name', 10, 2 );
