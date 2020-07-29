<?php // only copy this line if needed

/**
 * Creates a shortcode to output the "My Memberships Content" table anywhere on the site
 *
 * Use the shortcode: [wcm_my_memberships_content]
 *
 * @return void|string buffered HTML contents
 */
function sv_wc_memberships_my_memberships_content_shortcode() {

	// bail if Memberships isn't active or we're in the admin
	if ( ! function_exists( 'wc_memberships' ) || is_admin() ) {
		return;
	}

	// buffer contents
	ob_start();

	?>
	<div class="woocommerce">
	<h2><?php esc_html_e( 'My Memberships Content', 'textdomain' ); ?></h2>
	<?php
		wc_get_template( 'myaccount/my-membership-content.php', array(
				'customer_membership' => wc_memberships_get_user_memberships()[0],
				'restricted_content'  => wc_memberships_get_user_memberships()[0]->get_plan()->get_restricted_content(),
				'user_id'             => get_current_user_id(),
			) );
	?>
	</div>
	<?php

	// output buffered content
	return ob_get_clean();
}
add_shortcode( 'wcm_my_memberships_content', 'sv_wc_memberships_my_memberships_content_shortcode' );
