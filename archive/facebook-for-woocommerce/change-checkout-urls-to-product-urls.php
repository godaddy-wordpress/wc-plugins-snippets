<?php // only copy this line if needed

/**
 * Change checkout URLs to product URLs for Facebook products
 */
 
function sv_fbw_checkout_url_to_product( $product_data, $id ){
  
	$product_data['checkout_url'] = $product_data['url'];

	return $product_data;

}
add_filter( 'facebook_for_woocommerce_integration_prepare_product', 'sv_fbw_checkout_url_to_product', 100, 2 );