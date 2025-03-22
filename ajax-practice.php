<?php 

function testing_selector(){
    $html = "<select class='testing_selector'> <option value=''>Select Option</option> <option value='a'>A</option> <option value='b'>B</option> <option value='c'>C</option> </select>";
    echo $html;
}

add_shortcode('testing_ajax','testing_selector');

function ajax_testing(){
    check_ajax_referer('my_tag_count_nonce', '_ajax_nonce');
    
    return wp_send_json("This is response");
}

add_action("wp_ajax_bisnu_ajax_testing","ajax_testing");

