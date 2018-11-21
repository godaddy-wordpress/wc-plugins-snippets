<?php // only copy if needed!

/**
 * Only allow registration-based memberships when registering via WooCommerce.
 *
 * Blocks creation of memberships for manually-created users.
 */
add_action( 'init', function() {

	if ( function_exists( 'wc_memberships' ) && $plans = wc_memberships()->get_plans_instance() ) {

		// don't grant access for just any registration
		remove_action( 'user_register', array( $plans, 'grant_access_to_free_membership' ), 10, 2 );

		// grant access for WC account registrations only
		add_action( 'woocommerce_created_customer', array( $plans, 'grant_access_to_free_membership' ), 10, 1 );
	}
} );