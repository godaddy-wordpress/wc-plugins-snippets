<?php // only copy this line if needed

/**
 * Add additional pickup appointment durations to the Local Pickup Plus settings.
 *
 * @param array $form_fields settings fields
 * @return array the updated settings fields
 */
function sv_wc_local_pickup_plus_add_duration_settings( $form_fields ) {

	$addition_durations = [
		5  * MINUTE_IN_SECONDS  => __( '5 minutes', 'woocommerce-shipping-local-pickup-plus' ),
		10 * MINUTE_IN_SECONDS  => __( '10 minutes', 'woocommerce-shipping-local-pickup-plus' ),
		120 * MINUTE_IN_SECONDS => __( '2 hours', 'woocommerce-shipping-local-pickup-plus' ),
	];

	$form_fields['default_appointment_duration']['options'] = array_merge( $addition_durations, $form_fields['default_appointment_duration']['options'] );

	return $form_fields;
}
add_filter( 'wc_local_pickup_plus_settings', 'sv_wc_local_pickup_plus_add_duration_settings' );
