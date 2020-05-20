<?php // only copy this line if needed

/**
 * Rename the <Order> element
 *
 * @param array $order_data XML data array
 * @return array XML data array with the renamed element
 */
function sv_wc_customer_order_export_xml_rename_order_element( $order_data ) {

	$new_data[ 'DI' ] = $order_data[ 'Order' ];

	return $new_data;
}
add_filter( 'wc_customer_order_export_xml_get_orders_xml_data', 'sv_wc_customer_order_export_xml_rename_order_element' );
