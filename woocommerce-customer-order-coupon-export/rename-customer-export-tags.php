<?php // only copy this line if needed

/**
 * Rename Customer XML Export Tags
 *
 * Example: rename the CustomerID column to UserID
 *
 * @param array $data XML data array
 * @return array the updated XML data array
 */
function sv_wc_csv_export_reorder_customer_tags( $data ) {

	$customers = array();

	foreach ( $data['Customer'] as $idx => $customer ) {

		$new_tags = array();

		foreach ( $customer as $key => $value) {

			if ( 'CustomerId' === $key ) {
				$new_tags['UserID'] = $value;
				continue;
			}

			$new_tags[ $key ] = $value;
		}

		$customers[$idx] = $new_tags;
	}

	return array( 'Customer' => $customers );
}
add_filter( 'wc_customer_order_export_xml_customers_xml_data', 'sv_wc_csv_export_reorder_customer_tags' );
