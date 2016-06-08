<?php  // only copy this line if needed

/**
 * Remove the "Type" column from the My Content section of the member area
 *
 * @param array $columns the columsn in the "My Content" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_my_content_table_columns( $columns ) {

    // unset the "type" column, which shows post, page, etc
    unset( $columns['membership-content-type'] );
    return $columns;
}
add_filter( 'wc_memberships_members_area_my_membership_content_column_names', 'sv_wc_memberships_my_content_table_columns', 11 );
