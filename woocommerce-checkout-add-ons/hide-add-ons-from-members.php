<?php 

add_filter( 'woocommerce_checkout_add_on_get_enabled', function( $value, $checkout_add_on ) {

	// bail if Memberships is not active
	if ( ! function_exists( 'wc_memberships_is_user_member' ) ) {
		
		return $value;
	}
	
	// if you have more than one checkout add-on, check if it is the one you want to hide
	if ( 'my-addon' === $checkout_add_on->get_name() ) {
		
		// return false if user is member of any plan (if you have more plans, you will want to set the 2nd param)
		$value = ! wc_memberships_is_user_member();
	}
	
	return $value;
}, 10, 2 );
