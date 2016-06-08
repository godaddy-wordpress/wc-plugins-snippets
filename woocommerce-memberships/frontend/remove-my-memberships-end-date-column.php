<?php // only copy this line if needed

/**
 * Remove the "End Date" column from the My Memberships table
 *
 * @param array $columns the columns in the "My Memberships" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_remove_end_date_column( $columns ) {

	unset( $columns['membership-end-date'] );
	return $columns;
}
add_filter( 'wc_memberships_my_memberships_column_names', 'sv_wc_memberships_remove_end_date_column' );
