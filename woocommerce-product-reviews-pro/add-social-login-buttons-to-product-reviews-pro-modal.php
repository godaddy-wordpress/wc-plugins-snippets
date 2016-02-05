<?php
/**
 * Adds social login buttons to the Product Reviews Pro login modal
 * and changes the instruction text to make it more relevant
 */
 

/**
 * Add login buttons to the Product Reviews Pro login modal
 */
function sv_wc_social_login_add_buttons_prpro() {

 	// only do this on the product pages
	if ( is_product() && function_exists( 'woocommerce_social_login_buttons' ) ) {
		woocommerce_social_login_buttons( home_url( add_query_arg( array() ) ) . '#tab-reviews#comment-1' );
	}
}
add_action( 'woocommerce_login_form_end', 'sv_wc_social_login_add_buttons_prpro' );


/**
 * Change the login text from what's set in our WooCommerce settings
 * so we're not talking about checkout for a product review.
 *
 * @param string $login_text the original text from Social Login settings
 * @return strong $login_text the updated text for PRPro use
 */
function sv_wc_social_login_change_prpro_login_text( $login_text ) {

	// Only modify the text from this option if we're on a product page
	if ( is_product() ) {
   		$login_text = __( 'You can also create an account or log in with a social network.', 'my-textdomain' );
   	}
 
 	return $login_text;
}
add_filter( 'pre_option_wc_social_login_text', 'sv_wc_social_login_change_prpro_login_text' );