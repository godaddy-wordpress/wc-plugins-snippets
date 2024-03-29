<?php // only copy if needed

/**
 * Replaces variation SKUs with the parent SKU
 *
 * @param array $line_item the line item's data in the export
 * @param array $item the order item being exported
 * @param \WC_Product $product the product associated with the item
 * @return array - updated line item
 */
function sv_wc_csv_export_order_line_item_sku( $line_item, $item, $product ) {

	if ( $product->is_type( 'variation' ) ) {

		$sku = wc_get_product( $product->get_parent_id() )->get_sku();
		
		$line_item['sku'] = $sku;
	}

	return $line_item;
}
add_filter( 'wc_customer_order_export_csv_order_line_item', 'sv_wc_csv_export_order_line_item_sku', 10, 3 );
