<?php // only copy if needed


// Completely removes product tab content from the site search
remove_filter( 'posts_clauses', array( wc_tab_manager()->get_search_instance(), 'modify_search_clauses' ), 20, 2 );