<?php // only copy if needed!

/**
 * NOTE: We do not officially support this modification because measured quantities can be decimal values.
 *  This drastically increases the likelihood of rounding errors when using add-ons with a
 *  calculated inventory product. As such, we've opted for a "use at your own risk" snippet,
 *  as we can't realistically provide built-in support between add-ons and products using calculated inventory.
 */


/**
 * Adjusts product price when a product with add-ons uses "calculated inventory" in MPC.
 *
 * @param string[] $data cart item data
 * @param string[] $addon add-on data, unused
 * @param int $product_id the product ID for the cart item
 * @return string[] updated data
 */
function sv_wc_mpc_calculated_inventory_product_addons( $data, $_, $product_id ) {

	$product = wc_get_product( $product_id );

	// only modify price if calculated inventory is enabled, otherwise this works out of the box
	if ( $product instanceof WC_Product && WC_Price_Calculator_Product::pricing_calculator_inventory_enabled( $product ) ) {

		$measurements = current( wc_measurement_price_calculator()->get_cart_instance()->get_measurements_needed() );

		foreach ( $data as $key => $add_on ) {
			if ( $add_on['price'] > 0 ) {
				$data[ $key ]['price'] = (float) $data[ $key ]['price'] / (float) $measurements['value'];
			}
		}
	}

	return $data;
}
add_filter( 'woocommerce_product_addon_cart_item_data', 'sv_wc_mpc_calculated_inventory_product_addons', 10, 3 );