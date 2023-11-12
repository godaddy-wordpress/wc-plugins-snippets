<?php // only copy if necessary

/*
 * Edits the default content category restriction messages displayed to customers.
 * 
 * @param array $messages containing default restriction messages
 * @return array $messages the updated array
 */
function sv_wc_memberships_default_messages( $messages ) {
    
    /* Content Category Restriction messages 
     *
     * Basic HTML is allowed. You can also use the following merge tags:
     * {products} automatically inserts the product(s) needed to gain access.
     * {date} inserts the date when the member will gain access to delayed content.
     * {discount} inserts the highest product discount obtainable by becoming a member.
     * {login_url} inserts the URL to the “My Account” page with the login form.
     * {login} inserts a login link to the “My Account” page with the login form.
     */

    // edits message displayed when the content is time-delayed so not available _yet_
    $messages['content_category_delayed_message'] = 'DESIRED_MESSAGE_GOES_HERE';

    // edits message displayed when a category is restricted, but customers can purchase a product to get access
    $messages['content_category_restricted_message'] = 'DESIRED_MESSAGE_GOES_HERE';

    // edits message displayed when category is restricted and no product is available to purchase access to view category
    $messages['content_category_restricted_message_no_products'] = 'DESIRED_MESSAGE_GOES_HERE';

    // return the updated array
    return $messages;
};

add_filter( 'wc_memberships_default_messages', 'sv_wc_memberships_default_messages', 10, 1 );
