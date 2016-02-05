<?php
/**
 * Move the documents from before the add to cart button 
 * to the bottom of the product page
 */
function sv_wc_product_documents_move_display() {

	if ( function_exists( 'wc_product_documents' ) ) {
		remove_action( 'woocommerce_single_product_summary', array( wc_product_documents(), 'render_product_documents' ), 25 );
		add_action( 'woocommerce_after_single_product', array( wc_product_documents(), 'render_product_documents' ), 10 );
	}

}
add_action( 'init', 'sv_wc_product_documents_move_display' );