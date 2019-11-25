<?php // only copy this line if needed

/**
 * Change the date format for the filename from YYYY_MM_DD_HH_SS to YYYY-MM-DD
 *
 * @param string $post_replace_filename the filename after variables have been replaced
 * @param string $pre_replace_filename the filename before variables have been replaced
 * @return string the updated filename with replace variables
 */
function sv_wc_csv_export_edit_filename( $post_replace_filename, $pre_replace_filename ) {

	// define your variables here - they can be entered in the WooCommerce > Manual Export tab
	$variables = array( '%%timestamp%%' );

	// define the replacement for each of the variables in the same order
	$replacement = array( date( 'Y-m-d' ) );

	// return the filename with the variables replaced
	return str_replace( $variables, $replacement, $pre_replace_filename );

}
add_filter( 'wc_customer_order_export_filename', 'sv_wc_csv_export_edit_filename', 10, 2 );
