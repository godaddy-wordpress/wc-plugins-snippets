<?php // only copy this line if needed
/**
 * Removes the photo and video attachments from Product Reviews Pro review form
 *
 * @param array $fields the default contribution fields
 * @return array the updated fields
 */
function sv_wc_product_reviews_pro_remove_review_attachments( $fields ){
	return $fields[ 'attachment_type' ] = [];
}
add_filter( 'wc_product_reviews_pro_default_fields' , 'sv_wc_product_reviews_pro_remove_review_attachments' );