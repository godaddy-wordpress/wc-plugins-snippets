/**
 * Removes the regular price when logged in as a member.
 * Makes use of the wc_memberships_member_prices_use_discount_format filter
 * which normally defaults to 'true'.
 */

add_filter( 'wc_memberships_member_prices_use_discount_format', '__return_false' );
