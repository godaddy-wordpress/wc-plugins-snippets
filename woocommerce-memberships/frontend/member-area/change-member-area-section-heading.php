<?php 
/**
 * Changes "My Discounts" header to "Exclusive Discounts"
 * Every Member Area section header can be changed in a similar fashion 
 *
 * @param string $title the heading text for the member area section
 * @return string $title the updated heading text
 */
function sv_wc_memberships_members_area_section_title( $title ) {
    return __( 'Exclusive Discounts', 'your-textdomain' );
}
add_filter( 'wc_memberships_members_area_my_membership_discounts_title', 'sv_wc_memberships_members_area_section_title' );