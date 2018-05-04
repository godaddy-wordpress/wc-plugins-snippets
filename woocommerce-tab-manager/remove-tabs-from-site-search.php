<?php // only copy if needed

/**
 * Completely removes product tab content from the site search
 */

function sv_wc_tab_manager_disable_tab_search() {

	// bail if Tab Manager isn't active
	if ( ! function_exists( 'wc_tab_manager' ) ) {
		return;
	}

	remove_filter( 'posts_clauses', array( wc_tab_manager()->get_search_instance(), 'modify_search_clauses' ), 20 );
}
add_action( 'init', 'sv_wc_tab_manager_disable_tab_search' );
