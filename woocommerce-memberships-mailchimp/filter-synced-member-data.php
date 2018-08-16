<?php // only copy if needed!

/**
 * Filters the member data sent to MailChimp to add or adjust subscriber data.
 *
 * @param array $member_data the MailChimp subscription data
 * @param \WP_User $user the WP user object for the member being synced
 */
function sv_wcm_mailchimp_member_list_data( $member_data, $user ) {

	// TODO: enter the name of your phone merge field
	$phone = 'PHONE';

	if ( isset( $member_data['merge_fields'] ) ) {
		$member_data['merge_fields'][ $phone ] = get_user_meta( $user->ID, 'billing_phone', true );
	}

	return $member_data;
}
add_filter('wc_memberships_mailchimp_list_member_data', 'sv_wcm_mailchimp_member_list_data', 10, 2 );