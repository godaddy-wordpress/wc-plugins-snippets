<?php // only copy this line if needed

/**
 * Adds a description to the PDF Product Vouchers message form field on the product page
 *
 * @param array $fields the voucher fields
 * @return array the updated fields
 */
function sv_wc_pdf_product_vouchers_voucher_fields_add_message_description( $fields ) {

	$fields['message']['description'] = '<small>' . __( 'For best results, please avoid using emojis.', 'text-domain' ) . '</small>';

	return $fields;
}
add_filter( 'wc_pdf_product_vouchers_voucher_fields', 'sv_wc_pdf_product_vouchers_voucher_fields_add_message_description' );
