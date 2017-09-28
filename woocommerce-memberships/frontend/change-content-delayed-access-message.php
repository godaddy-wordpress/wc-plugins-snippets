<?php // only copy this line if needed

/**
 * Change the "content delayed" message displayed to members who will have access, but not yet
 * Example: change the delayed content message for the "Projects" post type
 *
 * @param string $message the message html
 * @param string[] $args {
 *	@type string $context whether the message appears in the context of a notice or elsewhere
 *	@type \WP_Post $post the post object
 *	@type int $post_id the ID of the restricted post
 *	@type int $access_time the user access timestamp
 *	@type int[] $products the product IDs that grant access
 *	@type string $rule_type the related rule type
 *	@type string|string[] $classes optional message CSS classes
 * }
 * @return string $message the updated message text
 */
function sv_wc_memberships_change_content_delayed_message( $message, $args ) {

	// only change the delayed message if a project is being viewed
	// {date} will be replaced automatically after this filter with access date
	if ( 'project' === get_post_type( $args['post_id'] ) ) {
		$message = 'This project is part of your membership, but not yet! You will gain access on {date}';
	}

	return $message;
}
add_filter( 'wc_memberships_content_delayed_message', 'sv_wc_memberships_change_content_delayed_message', 10, 2 );
