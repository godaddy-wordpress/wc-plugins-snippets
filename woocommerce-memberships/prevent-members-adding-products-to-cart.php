<?php // only copy this line if needed

/**
 * Disables specific product(s) - usually other membership products - from active members
 */

function sv_disable_products_from_members( $is_purchasable, $product ) {

	$product_ids_to_hide = array(11,12,13); //<-- replace with array of product ids to prevent purchase

	if ( in_array($product->get_id(), $product_ids_to_hide) && !empty( wc_memberships_get_user_active_memberships() ) ) {
		$is_purchasable = false;
    }

	return $is_purchasable;
}
add_filter( 'woocommerce_is_purchasable', 'sv_disable_products_from_members', 10, 2 );