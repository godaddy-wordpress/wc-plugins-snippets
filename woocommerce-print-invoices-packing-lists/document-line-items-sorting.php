<?php // only copy this line if needed
/**
 * Change the order items sort order in documents
 *
 * @param string $sort_order_items_key The column key (such as 'sku', 'price', 'weight', etc.) to sort order items by
 * @param int $order_id The WC_Order id
 * @param string $document_type The type of document being viewed
 * @return string The filtered sort column key
 */
 function sv_wc_pip_document_sort_order_items_key( $sort_by, $order_id, $type ) {

	// sort order items in all document types by SKU.
	// note: uncomment this line and remove the `switch` statement below
	// $sort_by = 'sku';

	// sort order items depending on the document type
	switch ( $type ) {

		case 'invoice':
			$sort_by = 'price';
		break;

		case 'packing-list':
			$sort_by = 'weight';
		break;

		case 'pick-list':
			$sort_by = 'sku';
		break;
	}

	return $sort_by;
 }
 add_filter( 'wc_pip_document_sort_order_items_key', 'sv_wc_pip_document_sort_order_items_key', 10, 3 );
