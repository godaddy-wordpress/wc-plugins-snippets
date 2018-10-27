<?php // only copy this line if needed

/**
 * Disable alphabetical item sorting on Print Invoices/Packing Lists documents
 * and use default WooCommerce sorting
 */
add_filter( 'wc_pip_document_sort_order_items_alphabetically', '__return_false' );
