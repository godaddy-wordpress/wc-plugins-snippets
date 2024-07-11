<?php //only copy if needed

/**
 * Sorts the members listed in the directory shortcode alphabetically by first name. 
 *
 * @param array $members the members returned by the shortcode args (associative array of user IDs and user memberships per user)
 */
add_filter( 'wc_memberships_member_directory_included_members', function( $members ){

    //First, we need to get the users and their names
    foreach( $members as $user_id => $member_id ){
        $user_ids[ $user_id ] = get_user_meta( $user_id, 'first_name', true );
    }

    //Then, we need to sort the new array based on the names
    asort( $user_ids );

    //Lastly, we use the new, sorted array and replace its values with the values of the $members array using the array keys
    //to maintain the order
    $user_ids_sorted = array_flip( array_keys( $user_ids ) );
    $members_new_order = array_replace( $user_ids_sorted, $members );

    return $members_new_order;
});
