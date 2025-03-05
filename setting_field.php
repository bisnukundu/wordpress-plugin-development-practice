<?php 
function setting_2_fn(){
    register_setting("reading","bk_testing_two");
    add_settings_section('bk_testing','Bk Testing two','bk_section_callback','reading');
    add_settings_field('testing_field_two','Testing Field tow','testing_field_callback','reading','bk_testing');
}
function bk_section_callback(){
    echo "BK Testing Two";
}
function testing_field_callback(){
    echo "<input value='' name='bk_testing_two' />";
}

add_action('admin_menu','setting_2_fn');