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

	// Account for PDF Vouchers 2.x and 3.x
	$voucher_item = is_callable( array( $voucher, 'get_order_item' ) ) ? $voucher->get_order_item() : $voucher->get_item();

	// TODO: this method will likely be deprecated at some point after WC 3.0 {BR 2017-03-17}
	// replace it with $item->get_product() if callable in the future
	$product = $order->get_product_from_item( $voucher_item );

	if ( $product && $short_description = get_post( $product->get_id() )->post_excerpt ) {
		$name .= ' - ' . $short_description;
	}

	return $name;
}
add_filter( 'wc_pdf_product_vouchers_get_product_name', 'sv_wc_pdf_vouchers_add_product_description', 50, 2 );

