<?php // only copy if needed

/**
 * NOTE: Not needed if using PDF Product Vouchers v3.0+, there is a template setting now :)
 */


/**
 * Change voucher image DPI
 * requires at least version 2.3.0 of WooCommerce PDF Product Vouchers
 *
 * @param int $dpi the image's DPI value
 * @param object $voucher the voucher object
 * @return int the updated DPI
 */
function sv_wc_pdf_product_vouchers_image_dpi( $dpi, $voucher ) {

	// can use $voucher->get_image_id() to check for a specific attachment id
	// example: if ( 42 === $voucher->get_image_id() ) { bail or change DPI }
	return 300;
}
add_filter( 'wc_pdf_product_vouchers_voucher_image_dpi', 'sv_wc_pdf_product_vouchers_image_dpi', 10, 2 );
