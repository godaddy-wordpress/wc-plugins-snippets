<?php // only copy this line if needed

/**
 * Register Cost of Goods meta to copy to translated posts in Polylang
 *
 * @param string[] $meta_keys the array of meta keys which should be copied to translated posts
 * @return string[] the updated meta keys array
 */
function sv_wc_cost_of_goods_polylang_copy_cost_meta( $meta_keys ) {

	$cogs_meta_keys = array(
		'_wc_cog_cost',
		'_wc_cog_cost_variable',
		'_wc_cog_default_cost',
		'_wc_cog_min_variation_cost',
		'_wc_cog_max_variation_cost',
	);

	return array_merge( $meta_keys, $cogs_meta_keys );
}
add_filter( 'pll_copy_post_metas', 'sv_wc_cost_of_goods_polylang_copy_cost_meta' );
