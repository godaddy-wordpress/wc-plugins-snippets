<?php // only copy if needed

/**
 * Compatibility snippet for WPComplete plugin: https://wordpress.org/plugins/wpcomplete/
 */


/**
 * Add a "Completed" column to the "My Content" table in the members area.
 * Removes the "Type" column.
 *
 * @param array $columns the columsn in the "My Content" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_my_content_table_add_column( $columns ) {

	$new_columns = array();

	// only modify the columns if the WPComplete plugin is active
	if ( class_exists( 'WPComplete' ) ) {

		// unset the "type" column, which shows post, page, etc
   		unset( $columns['membership-content-type'] );

		foreach ( $columns as $column_id => $column_name ) {

			$new_columns[ $column_id ] = $column_name;

			// insert our new "Complete" column after the "Title" column
			if ( 'membership-content-title' === $column_id ) {
				$new_columns['membership-content-completed'] = __( 'Complete?', 'your-textdomain' );
			}
		}
	}

	return ! empty( $new_columns ) ? $new_columns : $columns;
}
add_filter( 'wc_memberships_members_area_my_membership_content_column_names', 'sv_wc_memberships_my_content_table_add_column', 11 );


/**
 * Fills the "Complete?" column with the completion status.
 *
 * @param \WP_Post $post the post object used for the row's display
 */
function sv_wc_memberships_my_content_table_add_column_content( $post ) {

	if ( class_exists( 'WPComplete_Public') ) {

		$plugin = new WPComplete();
		$public = new WPComplete_Public( $plugin->get_plugin_name(), $plugin->get_version() );

		switch( $public->post_completion_status( $post->ID ) ) {

			case 'not complete-able':
				$value = '<span title="not complete-able">&ndash;</span>';
			break;

			case 'incomplete':
				$value = '<span title="incomplete">&#10060;</span>';
			break;

			// this only exists in WPComplete premium, but including it for completeness
			case 'partial':
				$value = '<span title="partially completed">&#128338;</span>';
			break;

			case 'completed':
				$value = '<span title="completed">&#9989;</span>';
			break;

			default:
				$value = '';
		}

		// no escaping given we're being explicit with value above
		echo $value;
	}
}
add_action( 'wc_memberships_members_area_my_membership_content_column_membership-content-completed', 'sv_wc_memberships_my_content_table_add_column_content' );
