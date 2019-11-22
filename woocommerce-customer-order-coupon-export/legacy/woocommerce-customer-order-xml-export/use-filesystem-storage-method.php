<?php // only copy this line if needed

/**
 * Use the (legacy) filesystem storage method for Customer/Order XML Export Suite
 *
 * @param array $export_args the arguments being passed in to this export
 * @return array the modified export arguments
 */
function sv_wc_customer_order_xml_export_suite_use_filesystem_storage( $export_args ) {

	$export_args['storage_method'] = 'filesystem';

	return $export_args;
}
add_filter( 'wc_customer_order_xml_export_suite_start_export_args', 'sv_wc_customer_order_xml_export_suite_use_filesystem_storage' );
