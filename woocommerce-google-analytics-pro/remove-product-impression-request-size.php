<?php // only copy this line if needed

/**
 * Filter the product impression data to remove parameters in an effort to reduce
 * the size of the request data.
 *
 * Use this code if you run into "No http response detected." errors on pages
 * with a number of products. Google Analytics has a small request size limit
 * of 8KB which the product impression data quickly fills up. This function
 * removes some less needed parameters in an attempt to reduce request size and
 * avoid the error on most pages.
 *
 * @link https://developers.google.com/analytics/devguides/collection/analyticsjs/enhanced-ecommerce#impression-data
 * @param array $impression_data An associative array of product impression data
 * @return array The altered impression data array
 */
function sv_wc_google_analytics_pro_remove_product_impression_data( $impression_data ) {

	// unset unneeded and nice-to-have data that note that 'id' and 'name' parameters are required
	unset( $impression_data['list'] );
	unset( $impression_data['brand'] );
	unset( $impression_data['position'] );

	// uncomment the lines below if you continue to run into issues on some pages
	//unset( $impression_data['category'] );
	//unset( $impression_data['variant'] );
	//unset( $impression_data['price'] );

	return $impression_data;
}
add_filter( 'wc_google_analytics_pro_product_impression_data', 'sv_wc_google_analytics_pro_remove_product_impression_data' );
