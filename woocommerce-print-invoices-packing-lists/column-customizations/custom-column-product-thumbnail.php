<?php // only copy this line if needed

/**
 * Filter the document table headers to add a product thumbnail header
 *
 * @param array $table_headers Table column headers
 * @return array The updated table column headers
 */
function sv_wc_pip_document_table_headers_product_thumbnail( $table_headers ) {

	$thumbnail_header = array( 'product_thumbnail' => 'Thumbnail' );

	// add product thumnail column as the first column
	return array_merge( $thumbnail_header, $table_headers );
}
add_filter( 'wc_pip_document_table_headers', 'sv_wc_pip_document_table_headers_product_thumbnail' );


/**
 * Filter the document table row cells to add product thumbnail column data
 *
 * @param string $table_row_cells The table row cells.
 * @param string $type WC_PIP_Document type
 * @param string $item_id Item id
 * @param array $item Item data
 * @param \WC_Product $product Product object
 * @return array The filtered table row cells.
 */
function sv_wc_pip_document_table_row_cells_product_thumbnail( $table_row_cells, $document_type, $item_id, $item, $product ) {

	// get the product's or variation's thumbnail 'shop_thumbnail' size; we will use CSS to set the width
	$thumbnail_content = array( 'product_thumbnail' => $product->get_image() );

	// add product thumnail column as the first column
	return array_merge( $thumbnail_content, $table_row_cells );
}
add_filter( 'wc_pip_document_table_row_cells', 'sv_wc_pip_document_table_row_cells_product_thumbnail', 10, 5 );


/**
 * Add custom CSS to set the thumbnail's width
 */
function sv_wc_pip_styles_product_thumbnail() {

	echo 'td.product_thumbnail img {
		width: 75px;
		height: auto;
	}';
}
add_action( 'wc_pip_styles', 'sv_wc_pip_styles_product_thumbnail' );
