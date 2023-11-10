<?php // only copy if needed!


/**
 * Filters the data for a new subscriber in Constant Contact.
 *
 * @param array $data the customer data
 * @param \WC_Order $order the customer's current order
 * @return array updated customer data
 */
function sv_wc_constant_contact_new_subscriber_info( $data, $order ) {

	if ( $order instanceof WC_Order && class_exists( 'SV_WC_Order_Compatibility' ) ) {

		// ConstantContact only allows up to 50 chars
		$data['WorkPhone']   = SV_WC_Order_Compatibility::get_prop( $order, 'billing_phone' );
		$data['CompanyName'] = SV_WC_Helper::str_truncate( SV_WC_Order_Compatibility::get_prop( $order, 'billing_company' ), 50 );
	}

	return $data;
}
add_filter( 'wc_constant_contact_new_contact_data', 'sv_wc_constant_contact_new_subscriber_info', 10, 2 );