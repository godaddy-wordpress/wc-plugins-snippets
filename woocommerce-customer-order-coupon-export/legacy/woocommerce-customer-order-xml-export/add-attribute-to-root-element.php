<?php // only copy this line if needed

/**
 * Add XML attributes to the root element of orders XML export
 *
 * @param string $header the XML header
 * @return string the modified XML header
 */
function sv_wc_customer_order_xml_export_suite_orders_xml_data_add_attributes_to_root_element( $header ) {
	return str_replace( '<Orders>', '<Orders attributename="attributevalue">', $header );
}
add_filter( 'wc_customer_order_xml_export_suite_orders_header', 'sv_wc_customer_order_xml_export_suite_orders_xml_data_add_attributes_to_root_element' );
