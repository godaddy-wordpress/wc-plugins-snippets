<?php  // only copy this line if needed

/**
 * Removes the "Expires" column from the Vouchers section of My Account
 *
 * @param array $columns the columns in the "Vouchers" table
 * @return array $columns the updated array of columns
 */
function sv_wc_pdf_product_vouchers_account_vouchers_columns( $columns ) {

	// unset the "Voucher Expires" column
	unset( $columns['voucher-expires'] );
	return $columns;

}

add_filter( 'wc_pdf_product_vouchers_account_vouchers_columns', 'sv_wc_pdf_product_vouchers_account_vouchers_columns', 11 );
