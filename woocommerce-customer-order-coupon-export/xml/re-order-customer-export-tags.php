<?php // only copy this line if needed

/**
 * Re-order Customer XML Export Tags
 *
 * Example: move CustomerId after LastName
 * unset the tag, then reset it in the desired location
 *
 * @param array $data XML data array
 * @return array the updated XML data array
 */
function sv_wc_csv_export_reorder_customer_tags( $data ) {

	$customers = array();

	foreach ( $data['Customer'] as $idx => $customer ) {

		// store the customerId value for use
		$customer_id = $customer['CustomerId'];
		$new_tags = array();

		foreach ( $customer as $key => $value) {

			// skip copying the customerId in it's current place
			if ( 'CustomerId' === $key ) {
				continue;
			}

			$new_tags[ $key ] = $value;

			if ( 'LastName' === $key ) {
				// re-add CustomerId immediately after LastName
				$new_tags['CustomerId'] = $customer_id;
			}
		}

		$customers[$idx] = $new_tags;
	}

	return array( 'Customer' => $customers );
}
add_filter( 'wc_customer_order_export_xml_customers_xml_data', 'sv_wc_csv_export_reorder_customer_tags' );
