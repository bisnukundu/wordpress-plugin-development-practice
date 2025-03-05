<?php


function add_new_user_bk(){
    // $username = 'bisnukundu44';
    // $user_email ='bisnu@gmail44.com';
    // $user_id = username_exists($username);
    // // wp_die($user_id);
    
    // if(!$user_id && email_exists($user_email) === false){
    //     wp_create_user(
    //         $username,
    //         'bisnu123',
    //         $user_email
    //     );
    // }

    // if(!is_wp_error($user_id)){
    //     $user = new WP_User($user_id);
    //     $user->set_role('administrator');
    // }

    // wp_delete_user(3,1);
   
}

add_action('admin_init','add_new_user_bk');