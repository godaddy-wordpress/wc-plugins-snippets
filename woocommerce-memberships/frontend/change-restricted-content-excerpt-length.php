<?php // only copy this if needed

/**
 * The wc_memberships_the_restricted_content filter allows you to adjust the way
 * restricted content is displayed when a visitor doesn't have access
 *
 * NOTE: THIS FILTER IS DEPRECATED as of v1.9
 *
 * Use the wc_memberships_{message_code}_html filters instead to adjust restricted content display.
 *
 * With this snippet specifically, the_excerpt filter could replace it.
 */


/**
 * Example of adjusting restricted content (v1.6.0+)
 * 	Changes excerpts to use 120 words instead of WordPress default
 *
 * @param string $content the content being restricted
 * @param bool $restricted true if the content is restricted for the viewer
 * @param string $message the restricted content notice HTML
 * @param object $post the post object being restricted
 * @return string - the updated restricted content
 */
function sv_wc_memberships_filter_restricted_content( $content, $restricted, $message, $post ) {

	if ( true === $restricted ) {
		return wp_trim_words( $content, 120 ) . $message;
	}

	return $content;
}
add_filter( 'wc_memberships_the_restricted_content', 'sv_wc_memberships_filter_restricted_content', 10, 4 );
