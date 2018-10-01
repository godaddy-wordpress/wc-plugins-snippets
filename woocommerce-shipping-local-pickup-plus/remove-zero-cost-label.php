<?php // only copy if needed

/**
 * Remove cost label for pickup with no fees or discount.
 *
 * @param string $label the shipping label
 * @param \WC_Shipping_Rate $rate the current shipping rate
 * @return string maybe updated label
 */
function sv_wc_lpp_remove_no_cost_price( $label, $rate ) {

	// modify the label for $0 local pickup
	if ( $rate && 'local_pickup_plus' === $rate->method_id && (float) 0 === (float) $rate->get_cost() ) {

		// get the html we want to remove
		$replace = wc_price( 0 );
		$label   = str_replace( ": {$replace}", '', $label );
	}

	return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label', 'sv_wc_lpp_remove_no_cost_price', 10, 2 );