<?php // only copy this line if needed

/**
 * Increase the timeout when rendering the voucher HTML to avoid cURL timeout errors.
 */
function sv_wc_pdf_product_vouchers_render_voucher_html_timeout() {
	return 10;
}
add_filter( 'wc_pdf_product_vouchers_render_voucher_html_timeout', 'sv_wc_pdf_product_vouchers_render_voucher_html_timeout' );
