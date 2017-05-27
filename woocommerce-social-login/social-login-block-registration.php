<?php // only copy if needed

/**
 * Don't allow new user registrations via Social Login.
 *
 * @throws \SV_WC_Plugin_Exception
 */
function sv_wc_social_login_prevent_registration() {
	throw new SV_WC_Plugin_Exception( __( 'Hmm, this profile is not linked to an account.', 'my-textdomain' ) );
}
add_action( 'wc_social_login_before_create_user', 'sv_wc_social_login_prevent_registration' );


// OR, le fancy way - show the provider name + a login prompt


/**
 * Don't allow new user registrations via Social Login; ask users to link the account instead.
 *
 * @param \WC_Social_Login_Provider_profile $profile profile instance
 * @param string $provider_id Social Login provider ID
 * @throws \SV_WC_Plugin_Exception
 */
function sv_wc_social_login_prevent_registration( $profile, $provider_id ) {

	// we don't need to check that we've got a provider, an exception would have already been thrown if not
	throw new SV_WC_Plugin_Exception( sprintf(
		/* translators: Placeholder: %s is social network name, ie "Facebook" */
		__( 'Hmm, this %s profile is not linked to an account. Please log in with your password to link it.', 'my-textdomain' ),
		wc_social_login()->get_provider( $provider_id )->get_title()
	) );
}
add_action( 'wc_social_login_before_create_user', 'sv_wc_social_login_prevent_registration', 10, 2 );