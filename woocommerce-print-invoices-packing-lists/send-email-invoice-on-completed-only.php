<?php // only copy this line if needed

/**
 * Removes triggers to ensure Print Invoices/Packing Lists emails are sent only
 * when orders are completed only.
 *
 * @return string[] actions which trigger PIP emails
 */
function sv_wc_pip_send_emails_on_completed_only() {

	return array( 'woocommerce_order_status_completed_notification' );
}
add_filter( 'wc_pip_invoice_email_order_status_change_trigger_actions', 'sv_wc_pip_send_emails_on_completed_only' );
