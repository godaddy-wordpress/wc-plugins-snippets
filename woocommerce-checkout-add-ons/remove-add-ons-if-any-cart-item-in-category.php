<?php
/**
 * Remove add-ons if _any product_ in the cart is in a given category
 * Example: remove add-ons if any product is in the "Gift box" category
 */
function sv_wc_checkout_add_ons_remove_add_ons_for_giftboxes() {

	// bail if Checkout Add-ons isn't active
	if ( ! function_exists( 'wc_checkout_add_ons' ) ) {
		return;
	}
	
	// set a flag
	$cat_check = false;
		
	// check each cart item for our category
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        	
		$product = $cart_item['data'];
		$product_in_cat = false;
	
		// replace 'gift_box' with your category's slug
		if ( has_term( 'gift_box', 'product_cat', $product->id ) ) {
			// flag the cart as containing this category
			$cat_check = true;
		}
	}
    	
	// if a product in the cart is in our category, remove the add-ons
	if ( $cat_check ) {
		remove_action( 'woocommerce_checkout_after_customer_details', array( wc_checkout_add_ons()->frontend, 'render_add_ons' ) );
	}

}
add_action( 'woocommerce_before_checkout_form', 'sv_wc_checkout_add_ons_remove_add_ons_for_giftboxes' );