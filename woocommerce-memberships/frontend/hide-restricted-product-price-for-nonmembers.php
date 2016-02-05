<?php
/**
 * Modify membership product pricing display for non-members:
 * hides price display if purchasing is restricted to members;
 * active members will see the price instead of a message
 *
 * @param string $price the WC price HTML
 * @return string $price the updated price HTML
 */
function sv_wc_memberships_change_member_product_price_display( $price ) {

	// bail if Memberships isn't active
	if ( ! function_exists( 'wc_memberships' ) ) {
		return;
	}
	
	// get any active user memberships (requires Memberships 1.4+)
	$user_id = get_current_user_id();
	$args = array( 
		'status' => array( 'active', 'complimentary', 'pending' ),
	);
	
	$active_memberships = wc_memberships_get_user_memberships( $user_id, $args );
	
	// only proceed if the user has no active memberships
	if ( empty( $active_memberships ) ) {
	
		// change price display if purchasing is restricted
		if ( wc_memberships_is_product_purchasing_restricted() ) {
			$price = 'Price for members only';
		} 
	}
	
	return $price;
}
add_filter( 'woocommerce_get_price_html', 'sv_wc_memberships_change_member_product_price_display' );
add_filter( 'woocommerce_cart_item_price', 'sv_wc_memberships_change_member_product_price_display' );