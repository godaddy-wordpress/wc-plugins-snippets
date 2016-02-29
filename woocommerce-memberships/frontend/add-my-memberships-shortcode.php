<?php // only copy this line if needed
/** 
 * Creates a shortcode to output the "My Memberships" table anywhere on the site
 * Outputs this section only if the current user has 1 or more memberships
 * 
 * Use the shortcode: [wcm_my_memberships]
 */
function sv_wc_memberships_my_memberships_shortcode() {

	// buffer contents
	ob_start();
	
	?><div class="woocommerce"><?php
	wc_memberships()->frontend->my_account_memberships();
	?></div><?php

	// output buffered content
	echo ob_get_clean();
}
add_shortcode( 'wcm_my_memberships', 'sv_wc_memberships_my_memberships_shortcode' );