<?php // only copy this line if needed

/**
 * Adds product attributes to the one row per item order export
 */


/**
 * Add a 'product_attributes' column to the export file
 *
 * @param array $headers
 * @return array
 */
function sv_wc_csv_export_add_product_attributes_column( $headers ) {

	$headers['product_attributes'] = 'product_attributes';

	return $headers;
}
add_filter( 'wc_customer_order_csv_export_order_headers', 'sv_wc_csv_export_add_product_attributes_column' );


/**
 * Add the WC_Product object to the line item data for use by the one row per item
 * filter below
 *
 * @param array $line_item
 * @param array $_ item data, unused
 * @param \WC_Product $product
 * @return array
 */
function sv_wc_csv_export_add_product_to_order_line_item( $line_item, $_, $product ) {

	$line_item['product'] = $product;

	return $line_item;
}
add_filter( 'wc_customer_order_csv_export_order_line_item', 'sv_wc_csv_export_add_product_to_order_line_item', 10, 3 );


/**
 * Add the product attributes in the format:
 *
 * attribute name=attribute value 1, attribute value 2, etc.
 *
 * @param array $order_data
 * @param array $item
 * @return array
 */
function sv_wc_csv_export_add_product_attributes( $order_data, $item ) {

	$order_data['product_attributes'] = '';

	foreach ( array_keys( $item['product']->get_attributes() ) as $attribute ) {
		$order_data['product_attributes'] .= str_replace( 'pa_', '', $attribute ) . '=' . $item['product']->get_attribute( $attribute );
	}

	return $order_data;
}
add_filter( 'wc_customer_order_csv_export_order_row_one_row_per_item', 'sv_wc_csv_export_add_product_attributes', 10, 2 );
