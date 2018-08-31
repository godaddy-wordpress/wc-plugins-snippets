<?php // only copy this line if needed

/**
 * Removes restriction messages from showing in RSS feed items.
 *
 * @param string $message the restriction message
 * @return string
 */
function sv_wc_hide_restriction_messages_in_rss_feeds( $message ) {
	global $wp_query;

	if ( $wp_query && $wp_query->is_feed() ) {
		$message = '';
	}

	return $message;
}

add_filter( 'wc_memberships_restricted_message', 'sv_wc_hide_restriction_messages_in_rss_feeds' );
