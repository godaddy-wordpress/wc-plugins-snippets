<?php // only copy this line if needed
/**
 * Add another email recipient for PIP invoice emails
 *
 * @param string $recipient a comma-separated string of email recipients (will turn into an array after this filter!)
 * @param \WC_PIP_Document $document the document object for which the email is sent
 * @return string $recipient the updated list of email recipients
 */
function sv_wc_pip_invoice_email_recipient( $recipient, $document ) {

	$recipient .= ', warehouse-manager@example.com, admin@example.com';

	return $recipient;
}
add_filter( 'woocommerce_email_recipient_pip_email_invoice', 'sv_wc_pip_invoice_email_recipient', 10, 2 );
