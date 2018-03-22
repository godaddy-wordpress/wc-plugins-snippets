<?php // only copy this line if needed

/**
 * Removes product category images from Nested Category Layout template
 */
add_filter( 'wc_nested_category_layout_category_image', '__return_empty_string' );
