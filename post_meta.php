<?php

function book_author_input_fn( $post ) {
    $value = get_post_meta( $post->ID, 'book_author', true );
    ?>

    <input type="text" name="book_author_input" value="<?php echo $value ?? '' ?>" placeholder="Book Author">
<?php }

function book_author_meta_box() {
    add_meta_box(
        'book_author',
        'Book Author',
        'book_author_input_fn',
        'books',
        'side'

    );
}

add_action( 'add_meta_boxes', 'book_author_meta_box' );

function book_author_meta_data( $post_id ) {
    if ( isset( $_POST['book_author_input'] ) ) {
        update_post_meta(
            $post_id,
            'book_author',
            $_POST['book_author_input']
        );
    }
}

add_action( 'save_post', 'book_author_meta_data' );


function print_rr($arr){
    echo "<pre>";
        print_r($arr);
    echo "</pre>";
}



function add_tan_name_fn(){
    add_meta_box(
        'tan_name',
        'Ad Tan Name',
        'tan_meth_html_fn',
        'post'
    );
    function tan_meth_html_fn($post){
        $value = get_post_meta($post->ID,'tan',true);
        ?>
    
        <input type="text" name="tan" id="tan" value="<?php echo isset($value) ? $value : ''; ?>" placeholder="Tan Name">
    <?php }
}

add_action("add_meta_boxes",'add_tan_name_fn');

function save_tan_value($post_id){
    if(isset($_POST['tan'])){
        update_post_meta(
            $post_id,
            'tan',
            $_POST['tan'],
        );
    }
}

add_action('save_post','save_tan_value');