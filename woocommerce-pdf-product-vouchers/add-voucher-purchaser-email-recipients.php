<?php // only copy if needed!

/**
 * Add admins as recipients for the voucher purchaser email.
 *
 * @param string $recipient a comma-separated string of email recipients (will turn into an array after this filter!)
 * @param string[] $object the object data for the email {
 * 	@type \WC_Order|null $order voucher order object, null if manually re-sending
 * 	@type int $voucher_count number of vouchers purchased
 * 	@type \WC_Voucher[] $vouchers vouchers generated in the order
 * }
 * @return string $recipient the updated list of email recipients
 */
function sv_wc_pdf_vouchers_voucher_email_recipient( $recipient, $object ) {

	// add a list of email addresses to send this email to
	$recipient .= ', warehouse-manager@example.com, admin@example.com';
	return $recipient;
}
add_filter( 'woocommerce_email_recipient_wc_pdf_product_vouchers_voucher_purchaser', 'sv_wc_pdf_vouchers_voucher_email_recipient', 10, 2 );
