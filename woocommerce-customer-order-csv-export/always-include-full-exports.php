<?php // only copy if needed

// Ensures orders and customers are never marked as exported
// This results in *every* automated export containing full records
add_filter( 'wc_customer_order_csv_export_mark_order_exported',    '__return_false' );
add_filter( 'wc_customer_order_csv_export_mark_customer_exported', '__return_false' );