<?php // only copy this line if needed
 
// Be advised: it may be helpful to limit your code to content that is restricted in some way
// We're using get_the_id() in this example assuming you're in the loop, but be aware you should pass a post ID if not!

if ( wc_memberships_is_post_content_restricted( get_the_id() ) ) {

  if ( wc_memberships_user_can( get_current_user_id(), 'view', [ 'post' => get_the_id() ] ) ) {
    // the user is a member who can view this content
  } else {
    // the user cannot view this content right now
  }
}
