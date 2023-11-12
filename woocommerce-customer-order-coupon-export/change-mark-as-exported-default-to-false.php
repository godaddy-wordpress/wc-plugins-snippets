<?php //only copy this line if needed

/**
 * Set "Mark as exported" option on the Manual Export page to false (unchecked) by default
 * 
 * @param array $options the array of options for the export tab
 */
add_filter( 'wc_customer_order_export_options', function( $options ){
	
	foreach ( [ \WC_Customer_Order_CSV_Export::EXPORT_TYPE_ORDERS, \WC_Customer_Order_CSV_Export::EXPORT_TYPE_CUSTOMERS ] as $export_type ) {
		
		$options[ "${export_type}_mark_as_exported" ]['default'] = 'no';
	}
  
	return $options;
} );
