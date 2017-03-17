<?php // only copy if needed

/**
 * Removes add to cart buttons from single product page if:
 *	- the product is sold-individually,
 *	- has a voucher attached, and
 *	- the product is already in the cart
 * to prevent multiple purchases of a voucher in an order.
 */
function sv_wc_pdf_product_vouchers_disable_multiple_quantities() {
	global $product;

	// Bail if PDF Product vouchers isn't active
	if ( ! function_exists( 'wc_pdf_product_vouchers' ) ) {
		return;
	}

	$has_voucher = is_callable( array( 'WC_PDF_Product_Vouchers_Product', 'has_voucher_template' ) ) ? WC_PDF_Product_Vouchers_Product::has_voucher_template( $product ) : WC_PDF_Product_Vouchers_Product::has_voucher( $product );

	// bail unless there's a voucher and the product is sold individually
	if ( ! ( $product->is_sold_individually() && $has_voucher ) ) {
		return;
	}

	// check if the item is already in the cart
	foreach ( WC()->cart->get_cart() as $cart_key => $cart_item ) {

		$cart_product = $cart_item['data'];

		// if our product ID matches an item in the cart, disable purchasing
		if ( $product->get_id() === $cart_product->id ) {

			// remove add to cart button
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

			// add a notice that you can only purchase one
			function no_purchase_message() {
				echo '<div class="woocommerce-info">Looks like this product is already in your cart! You can only purchase one per order.</div>';
			}
			add_action( 'woocommerce_single_product_summary', 'no_purchase_message', 30 );
   		}
	}
}
add_action( 'woocommerce_before_single_product', 'sv_wc_pdf_product_vouchers_disable_multiple_quantities', 11 );
