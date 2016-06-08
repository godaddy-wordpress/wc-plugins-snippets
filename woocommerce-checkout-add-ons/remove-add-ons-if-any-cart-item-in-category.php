<?php // only copy if needed

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
			// flag the cart as containing this category, we only need one "true" to break
			$cat_check = true;
			break;
		}
	}

	// get the position of checkout add-ons so we can remove them properly
	$position = get_option( 'wc_checkout_add_ons_position', 'woocommerce_checkout_after_customer_details' );

	// if a product in the cart is in our category, remove the add-ons
	if ( $position && $cat_check ) {
		remove_action( $position, array( wc_checkout_add_ons()->get_frontend_instance(), 'render_add_ons' ), 20 );
	}

}
add_action( 'woocommerce_before_checkout_form', 'sv_wc_checkout_add_ons_remove_add_ons_for_giftboxes' );
