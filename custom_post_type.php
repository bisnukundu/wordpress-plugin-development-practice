<?php 

function add_custom_post_type_fn(){
    register_post_type(
        'product',
        array(
            'labels'=> array(
                'name'=> __('Products'),
                'singular_name'=> __('Product'),
            ),
            'public'=> true,
            'rewrite'=> array(
                'slug'=>'bisnu-product'
            )

        )  
    );
}

add_action('init','add_custom_post_type_fn');