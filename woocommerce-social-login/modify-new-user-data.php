<?php // only copy this line if needed

/**
 * Customize user data for new users registered via WC Social Login
 * Example: set a custom role other than "customer" on registration
 */

 
/** 
 * Filters the new user data for every provider
 */
function sv_wc_social_login_new_user_data_add_filters() {

	foreach ( array_keys( wc_social_login()->get_available_providers() ) as $provider ) {
		add_filter( 'wc_social_login_' . $provider . '_new_user_data', 'sv_wc_social_login_new_user_data' );
	}

}
add_action( 'init', 'sv_wc_social_login_new_user_data_add_filters' );


/**
 * Helper function to set the new user data on registration
 * 
 * @param array $user_data the data set for the new user at registration
 * @return array the updated user data
 */
function sv_wc_social_login_new_user_data( $user_data ) {

	$user_data['role'] = 'my_custom_role';
	return $user_data;

}