<?php
//Count Posts and send to browser
function count_post( $response, $data ): mixed {
    $response['bisnu_post_count'] = wp_count_posts( 'post' );
    return $response;
}

add_filter( 'heartbeat_received', 'count_post', 10, 2 );

// function random_cat_images() {
//     $get_cat_details = wp_remote_get( "https://api.thecatapi.com/v1/images/search?limit=10" );
//     $cats_details = wp_remote_retrieve_body( $get_cat_details );

//     $response['random_cat_image_bisnu'] = $cats_details;
//     return $response;
// }

// add_filter( 'heartbeat_received', 'random_cat_images' );

function changing_heartbeat_timing( $settings ) {
    $settings['interval'] = 4;
    return $settings;
}

add_filter( 'heartbeat_settings', 'changing_heartbeat_timing' );
