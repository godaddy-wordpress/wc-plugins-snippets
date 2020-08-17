<?php // only copy this line if needed

/**
 * Hides specific product(s) from active members
 */

function sv_hide_products_from_members( $is_visible, $id ) {

	$product_ids_to_hide = array(216); //<-- replace with array of product ids to hide

	if ( in_array($id, $product_ids_to_hide) && !empty( wc_memberships_get_user_active_memberships() ) ) {
		$is_visible = false;
    }

	return $is_visible;
}
add_filter( 'woocommerce_product_is_visible', 'sv_hide_products_from_members', 10, 2 );