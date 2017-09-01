<?php // only copy if needed!


/**
 * Adds a list of user memberships to admin new order emails.
 *
 * @param \WC_Order $order order generating the email
 * @param bool $sent_to_admin true if an admin email
 */
function sv_wc_memberships_add_memberships_to_admin_email( $order, $sent_to_admin ) {

	// pre-flight checks
	if ( ! function_exists( 'wc_memberships' ) ||  ! $order instanceof WC_Order || ! $sent_to_admin ) {
		return;
	}

	// be sure the person was logged in rather than getting WP_User by email
	$user_id = $order->get_user_id();

	// ignore guest purchases since they wouldn't leverage member perks
	if ( $user_id ) {

		$statuses    = array( 'active', 'complimentary', 'pending', 'free_trial' );
		$memberships = wc_memberships()->get_user_memberships_instance()->get_user_memberships( $user_id, array( 'status' => $statuses ) );

		if ( ! empty( $memberships ) ) {

			printf( '<h2>%s</h2>', esc_html__( 'Active Memberships:', 'woocommerce-memberships' ) );

			foreach ( $memberships as $membership ) {

				$plan = $membership->get_plan();
				printf( '<a href="%1$s">%2$s</a><br />',
					admin_url( "post.php?post={$membership->id}&action=edit" ),
					$plan->get_name()
				);
			}
		}
	}
}
add_filter( 'woocommerce_email_order_meta', 'sv_wc_memberships_add_memberships_to_admin_email', 5, 2 );
