<?php // only use if needed!
// move or remove SkyVerge helper menu
add_action( 'admin_menu', function() {
	// remove the SkyVerge menu item
	remove_menu_page( 'skyverge' );
	// add SkyVerge submenus under WooCommerce instead
	add_submenu_page( 'woocommerce', 'SkyVerge', 'SkyVerge<div id="skyverge-dashboard-react-dashboard-menu-item"></div>', 'manage_options', 'skyverge', 'render_skyverge_dashboard', 998 );
	add_submenu_page( 'woocommerce', 'SkyVerge support', 'SkyVerge support', 'manage_options', 'skyverge-support', 'render_skyverge_dashboard', 999 );
	function render_skyverge_dashboard() {
		?><div id="skyverge-dashboard-react-root" style="margin-left: -20px;"></div><?php
	}
}, 99 );
// REQUIRED if SkyVerge menu is moved to WooCommerce menu
add_action( 'admin_enqueue_scripts', function() {
	global $current_screen;
	$screen_ids = [ 'woocommerce_page_skyverge', 'woocommerce_page_skyverge-support' ];
	if ( ! class_exists( '\SkyVerge\WordPress\Plugin_Admin\Package' ) || empty( $current_screen ) || ! in_array( $current_screen->id, $screen_ids, true ) ) {
		return;
	}
	wp_enqueue_style( 'sv-wordpress-plugin-admin-fonts', 'https://use.typekit.net/fsd0oby.css', [], \SkyVerge\WordPress\Plugin_Admin\Package::VERSION );
	wp_enqueue_script( 'sv-wordpress-plugin-admin-client', 'https://dashboard-assets.skyverge.com/scripts/index.js', [], \SkyVerge\WordPress\Plugin_Admin\Package::VERSION, true );
	wp_localize_script( 'sv-wordpress-plugin-admin-client', 'SVWPPluginAdminAPIParams', [
		'root'  => esc_url_raw( rest_url() ),
		'nonce' => wp_create_nonce( 'wp_rest' )
	] );
} );