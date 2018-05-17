<?php // only copy this line if needed

/**
 * Add an "Author" column to the "My Content" table in the members area
 *
 * @param array $columns the columsn in the "My Content" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_my_content_table_add_column( $columns ) {

	$new_columns = array();

	foreach ( $columns as $column_id => $column_name ) {

		$new_columns[ $column_id ] = $column_name;

		// insert our new "Author" column after the "Title" column
		if ( 'membership-content-title' === $column_id ) {
			$new_columns['membership-content-author'] = __( 'Author', 'your-textdomain' );
		}
	}

	return $new_columns;
}
add_filter( 'wc_memberships_members_area_my_membership_content_column_names', 'sv_wc_memberships_my_content_table_add_column', 11 );


/**
 * Fills the "Author" column with the post author
 *
 * @param \WP_Post $post the post object used for the row's display
 */
function sv_wc_memberships_my_content_table_add_column_content( $post ) {

	$author = get_user_by( 'ID', $post->post_author );
	echo $author->display_name;
}
add_action( 'wc_memberships_members_area_my_membership_content_column_membership-content-author', 'sv_wc_memberships_my_content_table_add_column_content' );
