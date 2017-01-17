<?php // only copy if needed

/**
 * The wc_admin_custom_order_field_options filter lets you dynamically add options 
 *  for fields that have them, such as select, multiselect, radio, and checkbox types.
 */


/**
 * Populate options for a field from Shipping Zones
 *
 * @param array $options the field options
 * @param \WC_Custom_Order_Field $field the field instance
 * @return array updated options
 */
function sv_wc_acof_generate_custom_fields( $options, $field ) {

	// bail unless we're targeting our desired field
	if ( 'Zones' !== $field->label ) {
		return $options;
	}

	// clear out any passed options so we can set our own
	$options = array();

	// get the options we should show
	$zones = WC_Shipping_Zones::get_zones();

	foreach ( $zones as $zone_id => $zone_data ) {

		$zone = WC_Shipping_Zones::get_zone( $zone_id );

		$options[] = array( 
			'label'   => $zone->get_zone_name(),
			'value'   => $zone->get_id(),
			'default' => false,
		);
	}

	return $options;
}
add_filter( 'wc_admin_custom_order_field_options', 'sv_wc_acof_generate_custom_fields', 10, 2 );