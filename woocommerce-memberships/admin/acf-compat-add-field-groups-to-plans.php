<?php // only copy this line if needed

/**
 * Allows Advanced Custom Fields field groups to be displayed on the Memberships
 * plan edit page
 *
 * @param string[] array of meta box IDs
 */
function sv_wc_memberships_allow_acf_meta_box_ids_on_plans( $allowed_meta_box_ids ) {

	if ( function_exists( 'acf_get_field_groups' ) ) {

		$field_groups = acf_get_field_groups( array( 'post_type' => 'wc_membership_plan' ) );

		foreach ( $field_groups as $field_group ) {
			$allowed_meta_box_ids[] = 'acf-' . $field_group['key'];
		}
	}

	return $allowed_meta_box_ids;
}

add_filter( 'wc_memberships_allowed_meta_box_ids', 'sv_wc_memberships_allow_acf_meta_box_ids_on_plans' );
