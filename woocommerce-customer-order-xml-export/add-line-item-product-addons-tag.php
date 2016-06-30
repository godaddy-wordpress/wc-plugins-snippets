<?php // only copy this line if needed

/**
 * Adds Product Add-ons separately in a new XML tag for each line item
 *
 * Format:
 * <OrderLineItems>
 *   <AddOn>
 *      <Name>
 *      <Value>
 *      <Price>
 *   </AddOn>
 * </OrderLineItems>
 */


/**
 * Adds Product Addons to the Line Item XML if available
 *
 * @param array $item_format line item XML data to write
 * @param \WC_Order $order
 * @param array $item the line item order data
 * @return array - modified line item XML data to write
 */
function sv_wc_xml_export_line_item_addons( $item_format, $order, $item ) {

	$product = $order->get_product_from_item( $item );

	// bail if this line item isn't a product
	if ( ! ( $product && $product->exists() ) ) {
		return $item_format;
	}

	// get the possible add-ons for this line item to check if they're in the order
	$addons         = get_product_addons( $product->id );
	$product_addons = sv_wc_xml_export_get_line_item_addons( $item, $addons );

	if ( ! empty( $product_addons ) ) {
		$item_format['AddOn'] = $product_addons;
	}

	return $item_format;
}
add_filter( 'wc_customer_order_xml_export_suite_order_export_line_item_format', 'sv_wc_xml_export_line_item_addons', 10, 3 );


/**
 * Gets Product Add-ons for a line item
 *
 * @param array $item line item data
 * @param array $addons possible addons for this line item
 * @return array - product addons ordered for the line item
 */
function sv_wc_xml_export_get_line_item_addons( $item, $addons ) {

	$product_addons = array();

	foreach ( $addons as $addon ) {

		// sanity check
		if ( ! is_array( $addon ) || empty ( $addon ) ) {
			return $product_addons;
		}

		// loop line item data
		foreach ( $item as $key => $value ) {

			// check if the beginning of the meta key matches the add-on name
			if ( $addon['name'] == substr( $key, 0, strlen( $addon['name'] ) ) ) {

				// this way, the length will be 0 without a trailing paren to get a "false" $price
				$price = substr( $key, strrpos( $key, '(' ), strrpos( $key, ')' ) );

				if ( $price ) {
					preg_match( '#\((.*?)\)#', $price, $match );
				}

				$product_addons[] = array(
					'Name'  => $addon['name'],
					'Value' => $value,
					'Price' => $price ? html_entity_decode( $match[1] ) : ' - ',
				);
			}
		}
	}

	return $product_addons;
}
