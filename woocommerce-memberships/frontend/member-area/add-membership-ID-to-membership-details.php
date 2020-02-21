<?php // only copy this line if needed!

/**
 * Add the user membership ID to the members area > details.
 *
 * @param array $details associative array of settings labels and HTML content for each row
 * @param \WC_Memberships_User_Membership $membership the user membership the details are for
 * @return array the updated details
 */
add_filter( 'wc_memberships_members_area_my_membership_details', function( $details, $membership ) {

	$new_details = [
		'member_id' => [
			'label'   => __( 'Membership ID', 'my-textdomain' ),
			'content' => $membership->get_id(),
			'class'   => 'my-membership-detail-user-membership-id',
		],
	];

	foreach ( $details as $detail ) {
		$new_details[] = $detail;
	}

	return $new_details;

}, 10, 2 );
