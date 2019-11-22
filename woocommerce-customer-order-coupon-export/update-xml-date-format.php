<?php // only copy if needed

/**
 * Re-format date output for the customer XML Export
 * REQUIRES v2.0.2
 *
 * @param string $date the date output for the XML document
 * @param \WC_Customer_Order_XML_Export_Suite_Generator $generator generator instance
 * @return string the updated date output
 */
function sv_wc_format_xml_date_output( $date, $generator ) {

	if ( 'customers' === $generator->export_type ) {
		$date = date( 'c', strtotime( $date ) );
	}

	return $date;
}
add_filter( 'wc_customer_order_export_xml_format_date', 'sv_wc_format_xml_date_output', 10, 2 );
