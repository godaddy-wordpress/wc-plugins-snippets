<?php // only copy this line if needed

/**
 * Display quantities as floats in Print Invoices/Packing Lists documents.
 * Minimum v3.5.1 of Print Invoices/Packing Lists required.
 *
 * @param int $item_quantity order item quantity
 * @param array $item WC_Order item
 * @return int order item quantity
 */
function sv_wc_pip_display_quantity_as_float( $qty, $item ) {
	return isset( $item['qty'] ) ? max( 0, (float) $item['qty'] ) : 0;
}
add_filter( 'wc_pip_get_order_item_quantity', 'sv_wc_pip_display_quantity_as_float', 10, 2 );
