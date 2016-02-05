<?php
/**
 * Allow Automatic linking for custom customer roles
 *
 * @param array $roles the allowed roles for automatic account linking by email
 * @return array the updated roles
 */
function sv_wc_social_login_email_link_additional_roles( $roles ) {

    $roles = array( 'customer', 'subscriber', 'wholesale-customer' );
    return $roles;

}
add_filter( 'wc_social_login_find_by_email_allowed_user_roles', 'sv_wc_social_login_email_link_additional_roles' );