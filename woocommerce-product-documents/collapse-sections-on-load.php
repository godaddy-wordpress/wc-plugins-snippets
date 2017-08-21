<?php // only copy if needed!

/**
 * Closes all active Product Documents sections when the product is loaded.
 */
function sv_wc_product_documents_collapse_sections() {

	// quick sanity check
	if ( ! function_exists( 'is_product' ) || ! is_product() ) {
		return;
	}

	wc_enqueue_js("
		jQuery(function($) {
			$('.ui-accordion-header.ui-accordion-header-active').each(function() {
				this.click();
			});
		});
	");
}
add_action( 'woocommerce_single_product_summary', 'sv_wc_product_documents_collapse_sections', 50 );
