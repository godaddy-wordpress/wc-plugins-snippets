<?php // only copy if needed

/**
 * Send "ending soon" emails to subscription-tied memberships
 *
 * These memberships CANNOT be renewed early, so this email is typically skipped.
 * This snippet enables the email sending so you could use this as a reminder to renew with the next notification.
 */
function sv_wc_memberships_send_ending_soon_subscription_emails() {

	if ( function_exists( 'wc_memberships' ) ) {
		remove_filter( 'woocommerce_email_enabled_WC_Memberships_User_Membership_Ending_Soon_Email', array( wc_memberships()->get_integrations_instance()->get_subscriptions_instance()->get_user_memberships_instance(), 'skip_ending_soon_emails' ), 20, 2 );
	}
}
add_action( 'init', 'sv_wc_memberships_send_ending_soon_subscription_emails' );