<?php // only copy if needed

/**
 * Adds a product short description after the name
 *
 * @param string $name the product name
 * @param \WC_Voucher $voucher voucher instance
 * @return string updated name
 */
function sv_wc_pdf_vouchers_add_product_description( $name, $voucher ) {

	$order = $voucher->get_order();

	// preview context, just add a placeholder
	if ( ! is_object( $order ) ) {
		return $name . ' - product short description';
	}

	$product = $order->get_product_from_item( $voucher->get_item() );

	if ( $product && $short_description = $product->get_post_data()->post_excerpt ) {
		$name .= ' - ' . $short_description;
	}

	return $name;
}
add_filter( 'wc_pdf_product_vouchers_get_product_name', 'sv_wc_pdf_vouchers_add_product_description', 50, 2 );

