<?php // only copy this line if needed

/**
 * Removes orphaned plan rules from the database.
 *
 * Posts which are restricted for seemingly no reason may be restricted due to
 * rules associated with plans that no longer exist. While Memberships typically
 * deletes a plan's rules when the plan is deleted, this process can fail to run
 * due to a conflict or other site errors.
 *
 * This function loops through all rules and deletes those which are associated
 * with non-existent plans. The function ensures it runs only once for best performance. 
 *
 * IMPORTANT: Make sure you back up your database before adding this code to your site.
 */
function sv_wc_memberships_remove_orphaned_rules() {

	if ( 'yes' === get_option( 'sv_wc_memberships_removed_orphaned_rules' ) ) {
		return;
	}

	// find orphaned rules and delete them
	$plan_rules   = wc_memberships()->get_rules_instance()->get_rules();
	$delete_rules = array();

	foreach ( $plan_rules as $rule ) {

		// if plan post doesn't exist, mark rule for deletion
		if ( false === get_post_status( $rule->get_membership_plan_id() ) ) {
			$delete_rules[] = $rule->get_id();
		}
	}

	wc_memberships()->get_rules_instance()->delete_rules( $delete_rules );

	update_option( 'sv_wc_memberships_removed_orphaned_rules', 'yes' );
}
add_action( 'init', 'sv_wc_memberships_remove_orphaned_rules' );
