<?php // only copy this if needed

/**
 * Changes excerpts displayed on restricted membership content to use 120 words
 * instead of WordPress default.
 *
 * Requires v1.10.1+ of Memberships
 */
function sv_wc_memberships_restricted_excerpt_length() {
	return 120;
}
add_filter( 'wc_memberships_restricted_excerpt_length', 'sv_wc_memberships_restricted_excerpt_length' );
