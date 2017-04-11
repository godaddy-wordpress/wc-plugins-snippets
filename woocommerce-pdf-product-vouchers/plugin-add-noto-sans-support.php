<?php
/**
 * Plugin Name: WC PDF Product Vouchers - Add Noto Sans
 * Plugin URI: http://skyverge.com/
 * Description: Adds support for Noto Sans via WooCommerce PDF Product Vouchers
 * Author: SkyVerge
 * Author URI: http://www.skyverge.com/
 * Version: 1.0.0
 * Text Domain: wc-pdf-product-vouchers-noto-sans
 *
 * Copyright: (c) 2017 SkyVerge, Inc. (info@skyverge.com)
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package   WC-PDF-Product-Vouchers-Noto-Sans
 * @author    SkyVerge
 * @category  Admin
 * @copyright Copyright (c) 2017, SkyVerge, Inc.
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 *
 */

defined( 'ABSPATH' ) or exit;

/**
 * Adds Google Font external loading for PDF Product Vouchers
 *
 * This is on the roadmap for the plugin (a search box to allow external font loading), but in the meantime
 *   can be used to custom-load fonts.
 *
 * This example uses Noto Sans, which should work for any character set.
 */


/**
 * Step 1: Allow custom wp_head action to output generated voucher styles.
 *
 * Allows the custom font action to add styles.
 *
 * @param bool $allow true if an action is allowed
 * @param string[] $action wp_filter action details
 * @return bool
 */
function sv_wc_pdf_product_vouchers_allow_custom_styles( $allow, $action ) {

	if ( is_string( $action['function'] ) && 'sv_wc_pdf_product_vouchers_use_noto_font' === $action['function'] ) {
		$allow = true;
	}

	return $allow;
}
add_filter( 'wc_pdf_product_vouchers_allow_wc_voucher_template_wp_head_action', 'sv_wc_pdf_product_vouchers_allow_custom_styles', 10, 2 );


/**
 * Step 2: Add styles to the header to load the font at run time.
 *
 * Use Noto Sans for vouchers instead of whatever font is configured.
 */
function sv_wc_pdf_product_vouchers_use_noto_font() {

	echo "<style>
	@font-face {
		font-family: 'Noto Sans';
		font-style: normal;
		src: url(https://fonts.gstatic.com/s/notosans/v6/LeFlHvsZjXu2c3ZRgBq9nKCWcynf_cDxXwCLxiixG1c.ttf) format('ttf');
	}</style>";
}
add_action( 'wp_head', 'sv_wc_pdf_product_vouchers_use_noto_font' );


/**
 * Step 3: Enqueue the font externally
 *
 * Enqueue Noto Sans on the site from Google Fonts.
 */
function sv_wc_enqueue_google_font() {

	// pay attention to the stylesheet handle, you'll use it in step 4
	wp_enqueue_style( 'wcpdf-google-noto', 'https://fonts.googleapis.com/css?family=Noto+Sans&amp;subset=cyrillic-ext,latin-ext' );
}
add_action( 'wp_enqueue_scripts', 'sv_wc_enqueue_google_font' );


/**
 * Step 4: Allow the font on the voucher preview
 *
 * Allow Noto Sans to load on voucher previews.
 *
 * @param bool $allowed true if the stylesheet is allowed
 * @param string $handle the stylesheet handle
 * @return bool
 */
function sv_wc_pdf_product_vouchers_custom_font_in_template_preview( $allowed, $handle ) {

	if ( 'wcpdf-google-noto' === $handle ) {
		$allowed = true;
	}

	return $allowed;
}
add_filter( 'wc_pdf_product_vouchers_allow_wc_voucher_template_style', 'sv_wc_pdf_product_vouchers_custom_font_in_template_preview', 10, 2 );


/**
 * Step 5: Add the font to the font picker.
 *
 * Adds Noto Sans to the font selector for a template.
 *
 * @param string[] $fonts the fonts in the font selector
 * @return string[] updated fonts
 */
function sv_wc_pdf_product_vouchers_add_custom_font_option( $fonts ) {

	$fonts['Noto Sans'] = 'Noto Sans';
	return $fonts;
}
add_filter( 'wc_pdf_product_vouchers_font_family_options', 'sv_wc_pdf_product_vouchers_add_custom_font_option' );
