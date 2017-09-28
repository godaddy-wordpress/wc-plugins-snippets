<?php // only copy this line if needed


/**
 * Creates a shortcode to output the "My Memberships" table anywhere on the site
 * Outputs this section only if the current user has 1 or more memberships
 *
 * Use the shortcode: [wcm_my_memberships]
 *
 * @return void|string buffered HTML contents
 */
function sv_wc_memberships_my_memberships_shortcode() {

	// bail if Memberships isn't active or we're in the admin
	if ( ! function_exists( 'wc_memberships' ) || is_admin() ) {
		return;
	}

	// buffer contents
	ob_start();

	?>
	<div class="woocommerce">
	<h2><?php esc_html_e( 'My Memberships', 'textdomain' ); ?></h2>
	<?php
		wc_get_template( 'myaccount/my-memberships.php', array(
			'customer_memberships' => wc_memberships_get_user_memberships(),
			'user_id'              => get_current_user_id(),
		) );
	?>
	</div>
	<?php

	// output buffered content
	return ob_get_clean();
}
add_shortcode( 'wcm_my_memberships', 'sv_wc_memberships_my_memberships_shortcode' );
