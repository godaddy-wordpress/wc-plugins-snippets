<?php // only copy this line if needed

/**
 * v1.9+: Changes the navigation title of the members area section
 * For example, show "Exclusive Discounts" instead of "Discounts"
 *
 * < v1.9: Changes the section header
 *
 * @param string $title the heading text for the member area section
 * @return string $title the updated heading text
 */
function sv_wc_memberships_members_area_section_title( $title ) {
	return __( 'Exclusive Discounts', 'your-textdomain' );
}
add_filter( 'wc_memberships_members_area_my_membership_discounts_title', 'sv_wc_memberships_members_area_section_title' );
