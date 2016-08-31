<?php // only copy if needed

/**
 * Replace contribution titles with the contribution content, as title is always preferred in widget contributions
 *
 * NOTE: requires version higher than 1.6.3 to use this filter
 *
 * @param string $title the contribution title
 * @param \WC_Contribution $contribution the contribution object with comment data
 * @return string - updated title
 */
function sv_wc_prp_replace_widget_contribution_title( $title, $contribution ) {
	return $contribution->get_content();
}
add_filter( 'wc_product_reviews_pro_widget_contribution_title', 'sv_wc_prp_replace_widget_contribution_title', 10, 2 );


/**
 * Changes the length of contribution excerpts used in widgets
 *
 * @param int $length the number of words in the excerpt
 * @param string $contribution_type the type of contribution comment in the widget
 * @return int - the updated length
 */
function sv_wc_prp_change_widget_contribution_length( $length, $contribution_type ) {

	// You could check for the type to adjust this only for certain widgets
	// such as having longer excerpts for questions
	// if ( 'question' !== $contribution_type ) { return $length; }

	return 15;
}
add_filter( 'wc_product_reviews_pro_widget_contribution_length', 'sv_wc_prp_change_widget_contribution_length', 10, 2 );
