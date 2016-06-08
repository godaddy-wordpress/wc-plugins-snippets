<?php // only copy this line if needed

/**
 * Remove add-ons if _all products_ in the cart are in a given category
 *
 * Example: remove add-ons if all products in cart are in the "Gift box" category
 * (and thus are gift-wrapped already)
 */
function sv_wc_checkout_add_ons_remove_add_ons_only_giftboxes() {

	// bail if Checkout Add-ons isn't active
	if ( ! function_exists( 'wc_checkout_add_ons' ) ) {
		return;
	}

	// holds checks for all products in cart to see if they're in our category
	$category_checks = array();

	// check each cart item for our category
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

		$product = $cart_item['data'];

		// replace 'gift_box' with your category's slug
		$product_in_cat = has_term( 'gift_box', 'product_cat', $product->id ) ? true : false;

		array_push( $category_checks, $product_in_cat );
	}

	// get the position of checkout add-ons so we can remove them properly
	$position = get_option( 'wc_checkout_add_ons_position', 'woocommerce_checkout_after_customer_details' );

	// if all items are in this category, remove the checkout add-ons
	if ( ! in_array( false, $category_checks ) && $position ) {
		remove_action( $position, array( wc_checkout_add_ons()->get_frontend_instance(), 'render_add_ons' ), 20 );
	}

}
add_action( 'woocommerce_before_checkout_form', 'sv_wc_checkout_add_ons_remove_add_ons_only_giftboxes' );
