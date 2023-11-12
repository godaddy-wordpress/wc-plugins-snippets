<?php // only copy if needed!

/**
 * Filters the members area section list so members land on the "Manage" section by default.
 *
 * @param string[] $sections the list of members area sections in their default order
 * @return string[] updated list of sections
 */
function sv_wc_memberships_default_members_area_section( $sections ){

	//Only modify if the current plan has access to 'Manage' section
	if( in_array( 'Manage', $sections, true ) ){

		// Move 'Manage' section to the beginning of the array so it appears on first load
		$sections = array('my-membership-details' => $sections['my-membership-details']) + $sections;
	}

	return $sections;
}
add_filter( 'wc_membership_plan_members_area_sections', 'sv_wc_memberships_default_members_area_section', 10, 1);