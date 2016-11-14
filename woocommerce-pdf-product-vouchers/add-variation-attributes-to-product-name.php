<?php // only copy if needed

/**
 * Adds variation attributes to the product name in vouchers.
 *
 * @param string $name the product name for the voucher
 * @param \WC_Voucher $voucher voucher instance
 * @return string updated product name
 */
function sv_wc_pdf_voucher_product_name( $name, $voucher ) {

	$item_data = $voucher->get_item();

	// use the variation name instead of product name if available
	if ( isset( $item_data['variation_id'] ) && $variation = wc_get_product( $item_data['variation_id'] ) ) {

		return $variation->get_title() . ' - ' . implode( ', ', $variation->get_variation_attributes() );
	}

	return $name;
}
add_filter( 'wc_pdf_product_vouchers_get_product_name', 'sv_wc_pdf_voucher_product_name', 10, 2 );