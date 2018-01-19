<?php // only copy if needed!


/**
 * Removes invoice generation on "processing" so only completed orders generate invoices
 */
function sv_wc_pip_generate_invoice_on_complete() {

	if ( function_exists( 'wc_pip' ) ) {
		remove_action( 'woocommerce_order_status_processing', array( wc_pip()->get_handler_instance(), 'generate_invoice_number' ), 20 );
	}
}
add_action( 'init', 'sv_wc_pip_generate_invoice_on_complete' );


/**
 * Removes invoice emails for processing hooks.
 *
 * @param string[] $actions actions to send PIP emails
 * @return string[] updated set of actions
 */
function sv_wc_pip_remove_invoice_sending_triggers( $actions ) {

	$actions = array_flip( $actions );
	unset( $actions['woocommerce_order_status_failed_to_processing_notification'], $actions['woocommerce_order_status_pending_to_processing_notification'], $actions['woocommerce_order_status_on-hold_to_processing_notification'] );
	$actions = array_flip( $actions );

	return $actions;
}
add_filter( 'wc_pip_invoice_email_order_status_change_trigger_actions', 'sv_wc_pip_remove_invoice_sending_triggers' );

