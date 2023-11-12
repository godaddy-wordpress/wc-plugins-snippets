<?php // only copy this line if needed

/**
 * Change Memberships email "thank you" footer message
 *
 * @param string $message the thank you message HTML
 * @param int $order_id the order ID from the purchase, unused
 * @param array $memberships associative array of membership IDs and granting access details found for the given order, unused
 *
 * @return string $message the updated string
 */
 
function sv_wcm_change_thank_you_msg( $message, $order_id, $memberships ){

	$message = __( 'Thanks for purchasing a membership! You can view more details about your membership from your account.', 'woocommerce-memberships' ); // change this to desired message.
	return $message;

}
add_filter( 'woocommerce_memberships_thank_you_message', 'sv_wcm_change_thank_you_msg', 10, 3);
