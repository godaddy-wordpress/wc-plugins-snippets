<?php // only copy if needed

/**
 * Adds recipients to the membership expiration and renewal reminder emails
 *
 * @param string $recipient the comma-separated list of recipients
 * @param \WC_Memberships_User_Membership $membership the user membership the email is sent for
 * @return string - updated recipient list
 */
function sv_wc_add_membership_expiration_email_recipients( $recipient, $membership ) {

	// You could uncomment this to use the user membership as a condition for adding recipients
	// Example: bail unless this is an admin-assign-only plan (v1.7+ only)
	/* if ( ! $membership->get_plan()->is_access_method( 'manual-only' ) ) {
		return $recipient;
	} */

	// use a comma-sep list as it will turn into an array after this filter
	$recipient .= ',admin@mystore.com, manager@mystore.com';
	return $recipient;
}
// add recipients to the "Ending Soon" email
add_filter( 'woocommerce_email_recipient_WC_Memberships_User_Membership_Ending_Soon_Email', 'sv_wc_add_membership_expiration_email_recipients', 10, 2 );
// add these recipients to the "Membership Ended" email
add_filter( 'woocommerce_email_recipient_WC_Memberships_User_Membership_Ended_Email', 'sv_wc_add_membership_expiration_email_recipients', 10, 2 );
// add these recipients to the "Renewal Reminder" email
add_filter( 'woocommerce_email_recipient_WC_Memberships_User_Membership_Renewal_Reminder_Email', 'sv_wc_add_membership_expiration_email_recipients', 10, 2 );