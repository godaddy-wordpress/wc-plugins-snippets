<?php // only copy if needed

/**
 * Ensure all orders and customers are included with all automatic exports
 */
add_filter( 'wc_customer_order_export_auto_export_new_orders_only',    '__return_false' );
add_filter( 'wc_customer_order_export_auto_export_new_customers_only', '__return_false' );
