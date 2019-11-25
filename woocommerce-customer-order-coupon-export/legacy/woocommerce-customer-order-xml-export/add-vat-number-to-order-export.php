<?php // only copy this line if needed

/**
 * NOTE: This is not needed for the AvaTax plugin, as it will add VAT ID automatically to order / customer exports.
 */


/**
 * Add `VATNumber` tag
 *
 * REQUIRES v2.0+ of XML Export; earlier versions should use the `wc_customer_order_xml_export_suite_order_export_order_list_format` filter
 *
 * @param array $format the original format tags
 * @param \WC_Order $order the order instance
 * @return array - the updated format tags
 */
function sv_wc_xml_export_add_vat_number_item( $format, $order ) {

	$new_format = array();

	foreach ( $format as $key => $data ) {

		$new_format[ $key ] = $data;

		if ( 'TaxTotal' === $key ) {
			$new_format['VATNumber'] = sv_wc_xml_export_vat_number_data( $order );
		}
	}

	return $new_format;
}
add_filter( 'wc_customer_order_xml_export_suite_order_data', 'sv_wc_xml_export_add_vat_number_item', 10, 2 );


/**
 * Add `VATNumber` tag data
 *
 * this function searches for a VAT number order meta key used by the more
 * popular Tax/VAT plugins
 *
 * @param \WC_Order $order the order object
 * @return string - the VAT data to print
 */
function sv_wc_xml_export_vat_number_data( $order ) {

	$vat_number = '';
	$order_id   = is_callable( array( $order, 'get_id' ) ) ? $order->get_id() : $order->id;

	// find VAT number if one exists for the order
	$vat_number_meta_keys = array(
		'_vat_number',               // EU VAT number
		'VAT Number',                // Legacy EU VAT number
		'vat_number',                // Taxamo
	);

	foreach ( $vat_number_meta_keys as $meta_key ) {

		if ( metadata_exists( 'post', $order_id, $meta_key ) ) {
			return get_post_meta( $order_id, $meta_key, true );
		}
	}

	return $vat_number;
}
