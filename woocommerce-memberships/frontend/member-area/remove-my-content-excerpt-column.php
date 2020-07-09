<?php  // only copy this line if needed

/**
 * Remove the "Excerpt" column from the My Content section of the member area
 *
 * @param array $columns the columns in the "My Content" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_my_content_table_columns( $columns ) {

	// unset the "Excerpt" column, which shows the content excerpt
	unset( $columns['membership-content-excerpt'] );

	return $columns;
}
add_filter( 'wc_memberships_members_area_my_membership_content_column_names', 'sv_wc_memberships_my_content_table_columns', 11 );
