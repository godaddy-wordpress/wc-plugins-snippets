<?php // only copy if needed

/**
 * Changes the name of the members area menu item.
 *
 * @param string $title the endpoint title
 * @param \WC_Memberships_Membership_Plan|null $plan the current membership plan or null if viewing the memberships list (unused)
 * @return string updated title
 */
function sv_wc_memberships_change_account_menu_item( $title, $plan ) {

	// change this to your desired text
	return 'For members';
}
add_filter( 'wc_memberships_my_account_memberships_title', 'sv_wc_memberships_change_account_menu_item', 10, 2 );