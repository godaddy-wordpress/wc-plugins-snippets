<?php // only use if needed!

// remove SkyVerge support dashboard
add_action( 'admin_menu', function() { remove_menu_page( 'skyverge' ); }, 99 );

// remove dashboard stylesheet
add_action( 'admin_enqueue_scripts', function() { wp_dequeue_style( 'sv-wordpress-plugin-admin-menus' ); }, 20 );
