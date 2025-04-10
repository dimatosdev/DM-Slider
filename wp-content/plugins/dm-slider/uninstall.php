<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

delete_option( 'dm_slider_options' );
$posts = get_posts( 
    array( 
        'post_type' => 'dm-slider', 
        'numberposts' => -1, 
        'post_status' => 'any' 
        ) 
);
foreach( $posts as $post ){
    wp_delete_post( $post->ID, true );
}
