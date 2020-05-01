<?php // only copy this line if needed

/**
 * Adds product categories to the one row per item order export
 * CANNOT be used with non-one row per item formats
 */


/**
 * Add a 'item_categories' column to the export file
 *
 * @param array $headers
 * @return array
 */
function sv_wc_csv_export_add_item_categories_column( $headers ) {

	$new_headers = array();

	foreach ( $headers as $key => $header ) {

		$new_headers[ $key ] = $header;

		if ( 'item_name' === $key )  {
			$new_headers['item_categories'] = 'item_categories';
		}
	}

	return $new_headers;
}
add_filter( 'wc_customer_order_export_csv_order_headers', 'sv_wc_csv_export_add_item_categories_column' );


/**
 * Add the WC_Product object to the line item data for use by the one row per item
 * filter below
 *
 * @param array $line_item
 * @param array $_ item data, unused
 * @param \WC_Product $product
 * @return array
 */
function sv_wc_csv_export_item_categories_add_product_to_order_line_item( $line_item, $_, $product ) {

	$line_item['product'] = $product;
	return $line_item;
}
add_filter( 'wc_customer_order_export_csv_order_line_item', 'sv_wc_csv_export_item_categories_add_product_to_order_line_item', 10, 3 );


/**
 * Add the product categories in the format:
 *
 * category 1, category 2, category 3, etc.
 *
 * @param array $order_data
 * @param array $item
 * @return array
 */
function sv_wc_csv_export_add_item_categories( $order_data, $item ) {

	$order_data['item_categories'] = '';

	if ( ! is_object( $item['product'] ) ) {
		return $order_data;
	}

	$categories = get_terms( [
		'taxonomy' => 'product_cat',
		'fields'   => 'id=>slug',
		'include' => array_map( 'intval', $item['product']->get_category_ids() ),
	] );

	$order_data['item_categories'] = implode( ';', $categories );

	return $order_data;
}
add_filter( 'wc_customer_order_export_csv_order_row_one_row_per_item', 'sv_wc_csv_export_add_item_categories', 10, 2 );
