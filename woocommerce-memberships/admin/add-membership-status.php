<?php // only copy this line if needed

/**
 * Add custom user membership statuses
 *
 * @param array $statuses the array of membership statuses
 * @return array $statuses the updated status array
 */
function sv_wc_memberships_add_membership_statuses( $statuses ) {

	$new_statuses = array(
		'wcm-refunded' => array(
			'label'       => 'Refunded',
			'label_count' => _n_noop( 'Refunded <span class="count">(%s)</span>', 'Refunded <span class="count">(%s)</span>' ),
		),

		'wcm-some-status' => array(
			'label'       => 'Another Status',
			'label_count' => _n_noop( 'SomeStatus <span class="count">(%s)</span>', 'SomeStatus <span class="count">(%s)</span>' ),
		),
	);

	$statuses = array_merge( $statuses, $new_statuses );
	return $statuses;
}
add_filter( 'wc_memberships_user_membership_statuses', 'sv_wc_memberships_add_membership_statuses' );
