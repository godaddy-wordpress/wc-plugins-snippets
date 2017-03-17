<?php // only copy this line if needed

/**
 * Removes the product short description / excerpt column from "My Products"
 * section of the member area
 *
 * @param array $columns the columns in the "My Products" table
 * @return array $columns the updated array of columns
 */
function sv_wc_memberships_my_products_table_columns( $columns ) {

	unset( $columns['membership-product-excerpt'] );
	return $columns;
}
add_filter('wc_memberships_members_area_my_membership_products_column_names', 'sv_wc_memberships_my_products_table_columns', 10, 1 );
