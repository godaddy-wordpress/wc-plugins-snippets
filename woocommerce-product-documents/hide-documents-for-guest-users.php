<?php
/**
 * Don't show document sections unless there is a logged in user.
 *
 * @param array $sections array of sections
 * @param WC_Product_Documents_Collection $collection the collection object
 * @param boolean $include_empty whether to include empty sections in the result
 * @return array sections for display
 */
function sv_wc_product_documents_only_for_logged_in_users( $sections, $collection, $include_empty ) {

    // this check can be made as specific (by user role, etc) as desired
    if ( ! get_current_user_id() ) {
        return array();
    }

    return $sections;

}
add_filter( 'wc_product_documents_get_sections', 'sv_wc_product_documents_only_for_logged_in_users', 10, 3 );