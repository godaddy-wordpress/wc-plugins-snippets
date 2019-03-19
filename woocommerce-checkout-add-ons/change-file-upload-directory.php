<?php // only copy this line if needed


/**
 * Changes the default directoy files are uploaded to through the File add-on in Checkout Add-ons.
 *
 * New directory: wp-uploads/checkout_add_ons
 *
 * @param array $upload_dir array of upload directory data with keys of 'path', 'url', 'subdir, 'basedir', and 'error'.
 * @return array the updated array of upload directoy data
 */
function sv_wc_checkout_add_ons_change_uploads_file_directory( $upload_dir ) {

	$subdir = '/checkout_add_ons';

	$upload_dir['subdir'] = $subdir;
	$upload_dir['path']   = $upload_dir['basedir'] . $subdir;
	$upload_dir['url']    = $upload_dir['baseurl'] . $subdir;

	return $upload_dir;
}


/**
 * Add filter to change the file upload directory immediately before Checkout Add-ons uploads or removes a file.
 */
function sv_wc_checkout_add_ons_change_uploads_file_directory_add_filter() {

	add_filter( 'upload_dir', 'sv_wc_checkout_add_ons_change_uploads_file_directory' );
}
add_action( 'wp_ajax_wc_checkout_add_on_upload_file',        'sv_wc_checkout_add_ons_change_uploads_file_directory_add_filter', 9 );
add_action( 'wp_ajax_nopriv_wc_checkout_add_on_upload_file', 'sv_wc_checkout_add_ons_change_uploads_file_directory_add_filter', 9 );
add_action( 'wp_ajax_wc_checkout_add_on_remove_file',        'sv_wc_checkout_add_ons_change_uploads_file_directory_add_filter', 9 );
add_action( 'wp_ajax_nopriv_wc_checkout_add_on_remove_file', 'sv_wc_checkout_add_ons_change_uploads_file_directory_add_filter', 9 );


/**
 * Remove filter which changes the file upload directory immediately after Checkout Add-ons uploads or removes a file.
 */
function sv_wc_checkout_add_ons_change_uploads_file_directory_remove_filter() {

	remove_filter( 'upload_dir', 'sv_wc_checkout_add_ons_change_uploads_file_directory' );
}
add_action( 'wp_ajax_wc_checkout_add_on_upload_file',        'sv_wc_checkout_add_ons_change_uploads_file_directory_remove_filter', 11 );
add_action( 'wp_ajax_nopriv_wc_checkout_add_on_upload_file', 'sv_wc_checkout_add_ons_change_uploads_file_directory_remove_filter', 11 );
add_action( 'wp_ajax_wc_checkout_add_on_remove_file',        'sv_wc_checkout_add_ons_change_uploads_file_directory_remove_filter', 11 );
add_action( 'wp_ajax_nopriv_wc_checkout_add_on_remove_file', 'sv_wc_checkout_add_ons_change_uploads_file_directory_remove_filter', 11 );
