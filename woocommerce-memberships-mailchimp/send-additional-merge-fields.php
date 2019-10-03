<?php // only copy this line if needed


/**
 * Filter the default member data that is used to send additional merge fields
 * to MailChimp.
 *
 * @param array $member_data associative array of basic member data
 * @param \WP_User $member the member user the data is being built for
 * @return array
 */
function sv_wc_memberships_mailchimp_custom_merge_fields( $member_data, $member ) {

	$member_data['merge_fields']['FIELDNAME'] = 'VALUE';

	$member_data['merge_fields']['CITY']  = $member->billing_city;
	$member_data['merge_fields']['STATE'] = $member->billing_state;

	return $member_data;
}
add_filter( 'wc_memberships_mailchimp_list_default_member_data', 'sv_wc_memberships_mailchimp_custom_merge_fields', 10, 2 );
