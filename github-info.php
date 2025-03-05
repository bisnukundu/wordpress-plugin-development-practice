<?php

function github_info_fn() {
    function github_profile_info( $atts, $content, $tag ) {

        $atts = shortcode_atts( [
            'github_username' => 'bisnukundu',
        ], $atts, $tag );

        $get_transient = get_transient('github_profile');

        if(false === $get_transient){
            $github_profile_response = wp_remote_get( "https://api.github.com/users/{$atts['github_username']}" );
            $get_the_body = wp_remote_retrieve_body($github_profile_response);
            set_transient('github_profile',$get_the_body,60);
           $get_transient = $get_the_body;
        }
// delete_transient('github_profile');
        $response = json_decode($get_transient);
        

        $content.= "<center><img src={$response->avatar_url} alt='github-user-image'/> <p>{$response->name}</p></center>";
// var_dump($get_transiant);
        return $content;
    }
    add_shortcode( "github_profile_info", 'github_profile_info' );
}

add_action( 'init', 'github_info_fn' );