<?php
/**
 * Remove parent category name from child category names in nested layout
 *
 * @param string $title the category title
 * @param array $categories the categories the product is in 
 * @return string the updated title 
 */
function sv_wc_nested_category_layout_category_title_html( $title, $categories ) {

	// get the first / parent category
	$category = $categories[ count( $categories ) - 1 ];
	
	// get the the category archive link
	$url = esc_attr( get_term_link( $category ) );
	
	// rebuild the link to this category with its name
	$link = '<a href="' . $url . '">' . wptexturize( $category->name ) . '</a>';
	
	// package it as a heading
	return sprintf( '<h2 class="wc-nested-category-layout-category-title">%s</h2>', $link );

}
add_filter( 'wc_nested_category_layout_category_title_html', 'sv_wc_nested_category_layout_category_title_html', 10, 2 );