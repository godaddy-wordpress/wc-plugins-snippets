<?php // only copy if needed

/**
 * REQUIRES PDF Product Vouchers 3.0+!
 * Lets you set a prefix for voucher numbers, helpful if managing
 *  vouchers from multiple sources
 */


/**
 * Adds a voucher number prefix
 *
 * @param string $prefix the voucher prefix (empty by default)
 * @return string the updated prefix
 */
function sv_wc_pdf_vouchers_add_voucher_number_prefix( $prefix ) {

	// a hyphen is added between this and the voucher number automatically
	return 'SV';
}
add_filter( 'pre_option_wc_pdf_product_vouchers_voucher_number_prefix', 'sv_wc_pdf_vouchers_add_voucher_number_prefix' );