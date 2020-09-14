<?php // only copy this line if needed

/**
 * Force Measurement Price Calculator products set to be sold individually to
 * only be added to the cart once, regardless of the measurement needed.
 *
 * Note: By default, a product marked as 'Sold Individually' can be added to the
 * cart more than once if the entered dimensions differ each time the product is
 * added to the cart.
 *
 * @param bool $found_in_cart true if the product has been found in the cart
 * @param int $product_id the product being added to the cart
 * @param int $variation_id the variation being added to the cart, if applicable
 * @return bool
 */
function sv_wc_mpc_force_sold_individually( $found_in_cart, $product_id, $variation_id ) {

	$product = wc_get_product( $product_id );

	// is this a product with a pricing calculator?
	if ( class_exists( 'WC_Price_Calculator_Product' ) && WC_Price_Calculator_Product::pricing_calculator_enabled( $product ) ) {

		if ( $variation_id ) {
			$check_key = 'variation_id';
			$check_id = $variation_id;
		} else {
			$check_key = 'product_id';
			$check_id = $product_id;
		}

		// check if this product ID is already in the cart
		foreach ( WC()->cart->get_cart() as $cart_item_key => $values ) {

			if ( isset( $values[ $check_key ] ) && $values[ $check_key ] === $check_id ) {
				$found_in_cart = true;
				break;
			}
		}
	}

	return $found_in_cart;
}
add_filter( 'woocommerce_add_to_cart_sold_individually_found_in_cart', 'sv_wc_mpc_force_sold_individually', 10 , 3 );
