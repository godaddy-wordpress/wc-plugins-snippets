<?php // only copy this line if needed

/**
 * Rename the section links for the "Member Area"
 * Can rename any section links using the section ID
 *
 * @param array $sections the array of section link IDs and text
 * @return array $sections the updated array of section links
 */
function sv_wc_memberships_rename_member_area_sections( $sections ) {

    $sections['my-membership-content'] = __( 'Club Articles', 'my-text-domain' );
    $sections['my-membership-products'] = __( 'Club Products', 'my-text-domain' );
    $sections['my-membership-discounts'] = __( 'Exclusive Discounts', 'my-text-domain' );
    $sections['my-membership-notes'] = __( 'Notes from MySite', 'my-text-domain' );

    return $sections;
}
add_filter( 'wc_membership_plan_members_area_sections', 'sv_wc_memberships_rename_member_area_sections' );
