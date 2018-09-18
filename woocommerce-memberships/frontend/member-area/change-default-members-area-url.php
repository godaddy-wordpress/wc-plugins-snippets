<?php // only copy if needed!


/**
 * Filters the members area endpoint to use the "Manage" section by default.
 *
 * Requires Memberships v1.11.1+
 *
 * @param string $url the endpoint URL
 * @param \WC_Memberships_User_Memberships[] $memberships
 * @return string updated URL
 */
function sv_wc_memberships_default_members_area_section( $url, $memberships ) {

	if ( 1 === count( $memberships ) && ( $membership = $memberships[0] ) && $membership->is_active() ) {

		$members_area_sections = $membership->get_plan()->get_members_area_sections();

		if ( ! empty( $members_area_sections ) && in_array( 'my-membership-details', $members_area_sections, true ) ) {
			$url = str_replace( wc_get_page_permalink( 'myaccount' ), '', wc_memberships_get_members_area_url( $membership->get_plan(), 'my-membership-details' ) );
		}
	}

	return $url;
}
add_filter( 'wc_memberships_members_area_endpoint', 'sv_wc_memberships_default_members_area_section', 10, 2 );
