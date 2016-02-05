<?php
/**
 * Moves linked social login profiles section to the top of the My Account page
 */
function sv_wc_social_login_move_my_account_profiles() {
	// Be sure Social Login is active
	if ( function_exists( 'wc_social_login' ) ) {
	
		remove_action( 'woocommerce_before_my_account', array( wc_social_login()->frontend, 'render_social_login_profile' ) );
		add_action( 'woocommerce_before_my_account', array( wc_social_login()->frontend, 'render_social_login_profile' ), 1 );
	}
}
add_action( 'init', 'sv_wc_social_login_move_my_account_profiles' );