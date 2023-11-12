<?php

/*
 * Add email variable for custom order statuses: {order_pay_url}
 */
function sv_email_find_variables_callback( $find ) {
	$find['order-pay-url'] = '{order_pay_url}';
	return $find;
}
add_filter( 'wc_order_status_manager_order_status_email_find_variables', 'sv_email_find_variables_callback', 10, 1 );

function sv_email_replace_variables_callback( $replace, $id, $type, $order ) {
	$replace['order-pay-url'] = $order->get_checkout_payment_url();
	return $replace;
}
add_filter( 'wc_order_status_manager_order_status_email_replace_variables', 'sv_email_replace_variables_callback', 10, 4 );
