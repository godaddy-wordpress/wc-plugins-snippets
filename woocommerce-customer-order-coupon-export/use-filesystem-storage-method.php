<?php // only copy this line if needed

/**
 * Use the (legacy) filesystem storage method for Customer/Order/Coupon Export
 *
 * @param array $export_args the arguments being passed in to this export
 * @return array the modified export arguments
 */
function sv_wc_customer_order_coupon_export_use_filesystem_storage( $export_args ) {

	$export_args['storage_method'] = 'filesystem';

	return $export_args;
}
add_filter( 'wc_customer_order_export_start_export_args', 'sv_wc_customer_order_coupon_export_use_filesystem_storage' );
