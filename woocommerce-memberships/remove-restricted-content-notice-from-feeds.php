<?php // only copy this line if needed

/**
 * Removes the restricted content notice HTML from RSS feeds.
 *
 * @param string $message The restricted content notice message.
 * @return string
 */
function sv_wc_memberships_restricted_message_remove_from_feeds( $message ) {
	global $wp_query;

	if ( $wp_query instanceof \WP_Query && $wp_query->is_feed() ) {
		$message = '';
	}

	return $message;
}
add_filter( 'wc_memberships_restricted_message', 'sv_wc_memberships_restricted_message_remove_from_feeds' );
