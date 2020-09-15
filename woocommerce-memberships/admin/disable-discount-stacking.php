<?php // only copy this line if needed

/**
 * Disable Discount Stacking
 *
 * By default, Memberships will assume that members should always have all
 * benefits of a membership plan. However, this could potentially result in
 * a member receiving 2 discounts or more on a product if the member has
 * multiple plans with discounts.
 *
 */

add_filter( 'wc_memberships_allow_cumulative_member_discounts', '__return_false' );