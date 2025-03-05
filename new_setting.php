<?php

function add_menu_page_adib() {

    add_menu_page(
        'Adib-Page',
        'Adib-Page',
        'manage_options',
        'adib-page',
        'adib_page_fn',
    );

    function adib_page_fn() {
        echo "<div class='wrap'><h1>Adib-Page</h1></div>";
    }

    add_submenu_page(
        'adib-page',
        'Adib-Sub-page',
        'Adib-Sub-Page',
        'manage_options',
        'adb-sub-fn',
        'adb_sub_fn',
    );
    function adb_sub_fn() {
        echo "<div class='wrap'><h1>Adib-Sub-Page</h1></div>";
    }
}
add_action( 'admin_menu', 'add_menu_page_adib' );

function add_meta_box_bisnu_fn() {
    add_meta_box(
        'meta_box_id',
        'Developer Name',
        'add_meta_box_html',
        'post',
        'side'

    );

    function add_meta_box_html() {?>
    <input type="text" placeholder="Developer Name..." name="dev_name" value="">
    <?php }
}
add_action( 'add_meta_boxes', 'add_meta_box_bisnu_fn' );

function save_post_meta_bisnu_fn( $post_id ) {
//  var_dump($_POST);
//  wp_die("wait");

    if ( isset( $_POST['dev_name'] ) ) {

        update_post_meta(
            $post_id,
            'dev_name',
            $_POST['dev_name']
        );
    }

};

add_action( 'save_post', 'save_post_meta_bisnu_fn' );

add_action( 'save_post', function ( $post_id ) {
   add_post_meta($post_id,'_testing_bisnu',meta_value: "Testing");
} );
