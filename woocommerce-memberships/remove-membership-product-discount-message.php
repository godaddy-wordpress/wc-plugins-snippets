<?php // only copy if needed

/**
 * Remove the default "Want a discount? Become a member!" promotional banner from all product pages.
 */
function remove_discount_message()
{

	if (function_exists('wc_memberships')) {

		remove_action(
			'woocommerce_single_product_summary',
			[wc_memberships()->get_restrictions_instance()->get_products_restrictions_instance(), 'display_product_purchasing_discount_message'],
			30
		);
	}
}

add_action('init', 'remove_discount_message');
