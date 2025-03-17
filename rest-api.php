<?php
function first_custom_rest_api(){
    register_rest_route(
        'bisnu',
        '/first',
        [
            'methods' => 'GET',
            'callback'=> function($request){
                return rest_ensure_response(['message' => "Hello This is my first custom route in wordpress",'testing'=> $request['name']]);
            }
        ]
    );


    register_rest_route('post_bisnu','/bisnu_post',[
        'methods'=>'GET',
        'callback'=>function($request){
          $posts = new WP_REST_Request("GET",'/wp/v2/posts');
          $response = rest_do_request( $posts ); // Process request

          return $response->get_data();
        }
    ]);
}

add_action('rest_api_init','first_custom_rest_api');



