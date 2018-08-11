<?php // only copy this line if needed

/**
 * Tracks the product's brand attribute
 *
 * Adds the custom brand attribute's value to product details and impressions
 * tracking data.
 *
 * Requires version 1.6.1+ of Google Analytics Pro
 */
function sv_wc_google_analytics_pro_product_impression_data_brand_attribute( $data, $product ) {

	$brand_attribute = $product->get_attribute( 'brand' );

	if ( isset( $data['brand'] ) ) {
		$data['brand'] = $brand_attribute;
	}

	if ( isset( $data['il1pi1br'] ) ) {
		$data['il1pi1br'] = $brand_attribute;
	}

	return $data;
}
add_filter( 'wc_google_analytics_pro_product_details_data',       'sv_wc_google_analytics_pro_product_impression_data_brand_attribute', 10, 2 );
add_filter( 'wc_google_analytics_pro_product_impression_data',    'sv_wc_google_analytics_pro_product_impression_data_brand_attribute', 10, 2 );


/**
 * Tracks the product's brand attribute
 *
 * Adds the custom brand attribute's value to the purchase tracking data
 */
function sv_wc_google_analytics_pro_api_ec_purchase_parameters_brand_attribute( $params, $order ) {

	foreach ( $order->get_items() as $item ) {

		$count++;

		$product = wc_get_product( ! empty( $item['variation_id'] ) ? $item['variation_id'] : $item['product_id'] );

		$params["pr{$count}br"] = $product->get_attribute( 'brand' );
	}

	return $params;
}
add_filter( 'wc_google_analytics_pro_api_ec_purchase_parameters', 'sv_wc_google_analytics_pro_api_ec_purchase_parameters_brand_attribute', 10, 2 );
add_filter( 'wc_google_analytics_pro_api_ec_checkout_parameters', 'sv_wc_google_analytics_pro_api_ec_purchase_parameters_brand_attribute', 10, 2 );
