<?php // only copy this line if needed

/**
 * Remove Customer XML Tags
 *
 * Example: remove ShippingCountry tag
 * Unset the tag you'd like to remove
 * the list of tag keys can be found in XML_Export_Generator.php
 *
 * @param array $data XML data array
 * @return array the updated XML data array
 */
function sv_wc_csv_export_reorder_customer_tags( $data ) {

	foreach ( $data['Customer'] as $idx => $customer ) {

		// unset the ShippingCountry tag
		unset( $data['Customer'][$idx]['ShippingCountry'] );
	}

	return $data;
}
add_filter( 'wc_customer_order_export_xml_customers_xml_data', 'sv_wc_csv_export_reorder_customer_tags' );
