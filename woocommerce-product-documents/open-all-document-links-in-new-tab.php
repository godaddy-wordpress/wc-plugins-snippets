<?php
/**
 * Open all product documents links in new window/tabs
 * 
 * @param string $target the link's target attribute
 * @return string $target the updated target for the link
 */
function sv_wc_product_documents_all_links_in_new_tab( $target ) {
	return '_blank';
}
add_filter( 'wc_product_documents_link_target', 'sv_wc_product_documents_all_links_in_new_tab' );