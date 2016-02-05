<?php
/**
 * Allow Order editing for custom statuses
 * 
 * @param bool $editable if the order is editable
 * @param \WC_order $order
 * @return bool if the order is editable for this status
 */
function sv_wc_order_status_manager_order_is_editable( $editable, $order ) {

	// list the slugs of all order statuses that should be editable.
	// Note 'pending', 'on-hold', 'auto-draft' are editable by default
	$editable_custom_statuses = array( 'packaging', 'awaiting-shipment' );

	if ( in_array( $order->get_status(), $editable_custom_statuses ) ) {
		$editable = true;
	}

	return $editable;
}
add_filter( 'wc_order_is_editable', 'sv_wc_order_status_manager_order_is_editable', 10, 2 );
