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

	$data['brand'] = $product->get_attribute( 'brand' );

	return $data;
}
add_filter( 'wc_google_analytics_pro_product_details_data',    'sv_wc_google_analytics_pro_product_impression_data_brand_attribute', 10, 2 );
add_filter( 'wc_google_analytics_pro_product_impression_data', 'sv_wc_google_analytics_pro_product_impression_data_brand_attribute', 10, 2 );
