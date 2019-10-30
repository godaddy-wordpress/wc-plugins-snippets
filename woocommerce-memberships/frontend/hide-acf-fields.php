function wc_memberships_hide_acf_fields( $value, $post_id, $field ) {
    
    if ( ! function_exists( 'wc_memberships' ) ) {
      return $value;
    }
  
    // Check if the user has access to the post.
   if ( wc_memberships_is_post_content_restricted( $post_id ) && ! current_user_can( 'wc_memberships_view_restricted_post_content', $post_id ) ) {
        $value = '';
    }
    
    // return
    return $value;
}
add_filter( 'acf/format_value', 'wc_memberships_hide_acf_fields', 10, 3 );
