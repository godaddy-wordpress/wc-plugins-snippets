<?php // remove this line if not needed

/**
 * Changes the default product availability from 'allowed' to 'disallowed'.
 *
 * When a post meta is not explicitly set on the product, pickup is assumed allowed.
 * With this snippet, this is changed to disallowed, unless manually set otherwise when saving or updating the product.
 *
 * @param string $availability one of 'allowed' (default), 'disallowed' or 'required' (cannot be shipped)
 * @param \WC_Product $product the product object
 * @return string
 */
function sv_local_pickup_plus_default_product_availability( $availability, $product ) {

	if ( 'allowed' === $availability && ! get_post_meta( $product->get_id(), '_wc_local_pickup_plus_local_pickup_product_availability', true ) ) {
		$availability = 'disallowed';
	} 
  
	return $availability;
}

add_filter( 'wc_local_pickup_plus_local_pickup_product_availability', 'sv_local_pickup_plus_default_product_availability', 10, 2 );
