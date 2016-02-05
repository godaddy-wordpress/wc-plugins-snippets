<?php
/**
 * Change the "content delayed" message displayed to members who will have access, but not yet
 * Example: change the delayed content message for the "Projects" post type
 *
 * @param string $message the message text to use in the notice
 * @param int $post_id the ID of the post being viewed
 * @param string $access_time timestamp when member can access this content
 * @return string $message the updated message text
 */
function sv_wc_memberships_change_content_delayed_message( $message, $post_id, $access_time ) {

	// only change the delayed message if a project is being viewed
	// {date} will be replaced automatically after this filter with access date
	if ( 'project' === get_post_type( $post_id ) ) {
		$message = 'This project is part of your membership, but not yet! You will gain access on {date}';
	}

	return $message;
}
add_filter( 'wc_memberships_get_content_delayed_message', 'sv_wc_memberships_change_content_delayed_message', 10, 3 );