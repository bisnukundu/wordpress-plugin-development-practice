<?php 
//Count Posts and send to browser
function count_post($response, $data): mixed{
    $response['bisnu_post_count'] = wp_count_posts('post');
    return $response;
}

add_filter('heartbeat_received','count_post',10,2);