<?php // only copy this line if needed

/**
 * Adjust the Addressy field mapping so that the unit number populates in the
 * line 2 address field.
 *
 * @param array $params associative array of localized script parameters
 * @return array
 */
function sv_wc_address_validation_addressy_line_2_unit_number( $params ) {

	$params['billing'] = array(
		array( 'element' => 'billing_company',   'field' => 'Company',      'mode' => 'DEFAULT|PRESERVE' ),
		array( 'element' => 'billing_address_1', 'field' => '{StreetAddress}' ),
		array( 'element' => 'billing_address_2', 'field' => 'SubBuilding',  'mode' => 'POPULATE' ),
		array( 'element' => 'billing_city',      'field' => 'City',         'mode' => 'POPULATE' ),
		array( 'element' => 'billing_state',     'field' => 'ProvinceCode', 'mode' => 'POPULATE' ),
		array( 'element' => 'billing_postcode',  'field' => 'PostalCode',   'mode' => 'POPULATE' ),
	);

	return $params;
}
add_filter( 'wc_address_validation_addressy_addresses', 'sv_wc_address_validation_addressy_line_2_unit_number' );
