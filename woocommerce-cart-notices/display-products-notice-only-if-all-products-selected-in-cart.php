<?php // only copy this line if needed

/**
 * Displays the Cart Notices "Products in Cart" notice only if all of the slected
 * products have been added to the cart.
 *
 * @param string   $notice_html the notice HTML
 * @param stdClass $notice the notice settings object
 * @return string  the updated notice HTML
 */
add_filter( 'woocommerce_cart_notice_products_notice', function( $notice_html, $notice ) {

	$cart_products     = array_values( wp_list_pluck( WC()->cart->get_cart(), 'product_id' ) );
	$selected_products = $notice->data['product_ids'];

	if ( ! empty ( $cart_products ) && ( count( array_intersect( $selected_products, $cart_products ) ) !== count( $selected_products ) ) ) {
		$notice_html = '';
	}

	return $notice_html;
}, 10, 2 );
