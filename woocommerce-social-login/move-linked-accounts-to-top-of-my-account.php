<?php // only copy if needed

/**
 * Moves linked social login profiles section to the account page dashboard
 * Instead of "Account Details" (WC 2.6+)
 */
function sv_wc_social_login_move_my_account_profiles() {

	// Be sure Social Login is active
	if ( function_exists( 'wc_social_login' ) ) {
		remove_action( 'woocommerce_after_edit_account_form', array( wc_social_login()->get_frontend_instance(), 'render_social_login_profile' ) );
		add_action( 'woocommerce_account_dashboard', array( wc_social_login()->get_frontend_instance(), 'render_social_login_profile' ), 5 );
	}
}
add_action( 'init', 'sv_wc_social_login_move_my_account_profiles' );
