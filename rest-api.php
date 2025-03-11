<?php
function first_custom_rest_api(){
    register_rest_route(
        'bisnu',
        '/first',
        [
            'method' => 'GET',
            'callback'=> function($request){
                return rest_ensure_response(['message' => "Hello This is my first custom route in wordpress",'testing'=> $request['name']]);
            }
        ]
    );
}

add_action('rest_api_init','first_custom_rest_api');


