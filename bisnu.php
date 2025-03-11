<?php
/*
Plugin Name:Bisnu
Plugin URI:https://www.bisnu.com
Author:Bisnu
Author URI:https://www.bisnu.com
Version:1.0.0
License:GPL2
 */
if ( !class_exists( 'WP_List_Table' ) ) {
    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

function enqueueTailwidCss() {
    wp_enqueue_script( 'tailwind', 'https://unpkg.com/@tailwindcss/browser@4"', [], null );
}

add_action( 'wp_enqueue_scripts', 'enqueueTailwidCss' );

function bisnu_post_type() {
    register_post_type( 'books', array(
        'public' => true,
        'label'  => 'Books',
    ) );
}

add_action( 'init', 'bisnu_post_type' );

function bisnu_activation() {
    bisnu_post_type();
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'bisnu_activation' );

function bisnu_deactivation() {
    unregister_post_type( 'books' );
    flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'bisnu_deactivation' );

// Add menu page in WordPress Admin
function bisnu_register_custom_page() {
    add_menu_page(
        'All Posts', // Page Title
        'All Posts', // Menu Title
        'manage_options', // Capability (Admin only)
        'bisnu-all-posts', // Menu Slug
        'bisnu_render_table' // Function to display content
    );
}
add_action( 'admin_menu', 'bisnu_register_custom_page' );

function bisnu_render_table() {

    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">All Published Posts</h1>';

    $table = new Bisnu_Posts_Table(); // Create the table object
    $table->prepare_items();
    echo "<form method='post'>"; // Prepare the table data
    $table->display(); // Display the table
    echo "</form>"; // Prepare the table data

    echo '</div>';
}

class Bisnu_Posts_Table extends WP_List_Table {
    function __construct() {
        parent::__construct( [
            'singular' => 'post',
            'plural'   => 'posts',
            'ajax'     => false,
        ] );
    }

    // Fetch Data
    function get_posts_data() {
        global $wpdb;
        $query = "SELECT ID, post_title, post_date, post_type FROM {$wpdb->posts} WHERE post_status = 'publish'";
        return $wpdb->get_results( $query, ARRAY_A );
    }

    // Define columns
    function get_columns() {
        return [
            'cb'         => '<input type="checkbox" />',
            'ID'         => 'ID',
            'post_title' => 'Title',
            'post_date'  => 'Published Date',
            'post_type'  => 'Post Type',
        ];
    }
    // Add a checkbox for bulk actions
    function column_cb( $item ) {
        return sprintf( '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID'] );
    }
    function get_bulk_actions() {
        return [
            'bulk-delete' => 'Delete Selected',
        ];
    }

    function process_bulk_action() {
        global $wpdb;

        if ( $this->current_action() === 'bulk-delete' && !empty( $_POST['bulk-delete'] ) ) {
            $ids = implode( ',', array_map( 'intval', $_POST['bulk-delete'] ) );
            $wpdb->query( "DELETE FROM {$wpdb->posts} WHERE ID IN ($ids)" );
        }
    }

    // Prepare table items
    function prepare_items() {

        $columns = $this->get_columns();
        $hidden = [];
        $sortable = [
            'post_date' => ['post_date', true],
        ];
        $this->process_bulk_action();

        $this->_column_headers = [$columns, $sortable, $hidden];
        $this->items = $this->get_posts_data();
    }

    // Display the column data
    function column_default( $item, $column_name ) {
        return $item[$column_name];
    }
}

function custom_menu_page_bk() {
    echo "<form method='post'> <input name='testing_hook' type='submit' value='Testing Hook'/> </form>";

    if ( isset( $_POST['testing_hook'] ) && $_POST['testing_hook'] ) {
        bk_hook_fn();
    }
}
function add_admin_menu_fn() {
    add_menu_page( "Custom Hook", "Custom Hook", "manage_options", 'custom-hook', 'custom_menu_page_bk' );

}

add_action( 'admin_menu', 'add_admin_menu_fn' );

function output_test_page() {
    echo "<div calss='wrap'><h1>Testing is working..</h1></div>";
}

function add_page_page_test() {
    add_posts_page(
        "testin",
        "Testing",
        'manage_options',
        'testing',
        'output_test_page'
    );
}

add_action( 'admin_menu', 'add_page_page_test' );

// surge modify doctor provide seminar mutual master inform expect nothing wonder fatigue

function new_menu_html() {
    echo "<div calss='wrap'>Working</div>";
}
function testing_fun_bisnu() {
    echo "<script> alert('run before page load')</script>";
}

function menu_page_for_shamim() {
    $new_menu_fn = add_menu_page(
        'Shamim',
        "Samim",
        'manage_options',
        'shamim-page',
        'new_menu_html'
    );
    add_action( "load-$new_menu_fn", 'testing_fun_bisnu' );
}

add_action( 'admin_menu', 'menu_page_for_shamim' );

function print_data() {
    return "Working Shortcode";
}

add_shortcode( 'bisnu_code', 'print_data' );

function testing_shortcode_with_paramiter_fn( $atts, $content, $tag ) {

    $atts = shortcode_atts(
        array(
            'title' => "This is testing title",
        ),
        $atts,
        $tag
    );

    ob_start();
    include_once plugin_dir_path( file: __FILE__ ) . "template/card.php";
    $output = ob_get_clean();

    return $output;

}
add_shortcode( 'testing_shortcode_with_paramiter', 'testing_shortcode_with_paramiter_fn' );

// function print_all_shortcodes() {
//     global $shortcode_tags;

//     echo '<pre>';
//     print_r($shortcode_tags);
//     echo '</pre>';
// }
// add_action('admin_notices', 'print_all_shortcodes');

function testing_2_fn( $atts, $content, $tag ) {
    $atts = shortcode_atts(
        array( 'name' => '' ),
        $atts,
        $tag
    );
    $content .= $atts['name'];
    return $content;
}

add_shortcode( 'testing_2', "testing_2_fn" );

function bisnu_page_fn() {
    // echo "<div class='wrap'> <h1> Bisnu-Page </h1> </div>";
    echo "<div class='wrap'><h1>Bisnu Page</h1></div>";
}

function bisnu_subpage_fn() {
    // echo "<div class='wrap'> <h1> Bisnu-Page </h1> </div>";
    echo "<div class='wrap'><h1>Bisnu Sub Page</h1></div>";
}

function bisnu_page_menu() {
    add_menu_page(
        "Bisnu",
        "Bisnu",
        'manage_options',
        'bisnu-slug',
        'bisnu_page_fn'
    );
    add_submenu_page(
        "bisnu-slug",
        "Bisnu-SubPage",
        "Bisnu-SubPage-Title",
        'manage_options',
        'bisnu_subpage',
        "bisnu_subpage_fn"
    );
}

add_action( 'admin_menu', 'bisnu_page_menu' );

/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */
function wporg_settings_init() {
    // Register a new setting for "wporg" page.
    register_setting( 'wporg', 'wporg_options' );

    // Register a new section in the "wporg" page.
    add_settings_section(
        'wporg_section_developers',
        __( 'The Matrix has you.', 'wporg' ), 'wporg_section_developers_callback',
        'wporg'
    );

    // Register a new field in the "wporg_section_developers" section, inside the "wporg" page.
    add_settings_field(
        'wporg_field_pill', // As of WP 4.6 this value is used only internally.
        // Use $args' label_for to populate the id inside the callback.
        __( 'Pill', 'wporg' ),
        'wporg_field_pill_cb',
        'wporg',
        'wporg_section_developers',
        array(
            'label_for'         => 'wporg_field_pill',
            'class'             => 'wporg_row',
            'wporg_custom_data' => 'custom',
        )
    );
}

/**
 * Register our wporg_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'wporg_settings_init' );

/**
 * Custom option and settings:
 *  - callback functions
 */

/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */
function wporg_section_developers_callback( $args ) {
    ?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
	<?php
}

/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function wporg_field_pill_cb( $args ) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option( 'wporg_options' );
    ?>
	<select
			id="<?php echo esc_attr( $args['label_for'] ); ?>"
			data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
			name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
		<option value="red" <?php echo isset( $options[$args['label_for']] ) ? ( selected( $options[$args['label_for']], 'red', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'red pill', 'wporg' ); ?>
		</option>
 		<option value="blue" <?php echo isset( $options[$args['label_for']] ) ? ( selected( $options[$args['label_for']], 'blue', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'blue pill', 'wporg' ); ?>
		</option>
	</select>
	<p class="description">
		<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
	</p>
	<p class="description">
		<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
	</p>
	<?php
}

/**
 * Add the top level menu page.
 */
function wporg_options_page() {
    add_menu_page(
        'WPOrg',
        'WPOrg Options',
        'manage_options',
        'wporg',
        'wporg_options_page_html'
    );
}

/**
 * Register our wporg_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'wporg_options_page' );

/**
 * Top level menu callback function
 */
function wporg_options_page_html() {
    // check user capabilities
    if ( !current_user_can( 'manage_options' ) ) {
        return;
    }

    // add error/update messages

    // check if the user have submitted the settings
    // WordPress will add the "settings-updated" $_GET parameter to the url
    if ( isset( $_GET['settings-updated'] ) ) {
        // add settings saved message with the class of "updated"
        add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
    }

    // show error/update messages
    settings_errors( 'wporg_messages' );
    ?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
// output security fields for the registered setting "wporg"
    settings_fields( 'wporg' );
    // output setting sections and their fields
    // (sections are registered for "wporg", each field is registered to a specific section)
    do_settings_sections( 'wporg' );
    // output save settings button
    submit_button( 'Save Settings' );
    ?>
		</form>
	</div>
	<?php
}

function creating_options_fn() {
// array of options
// $data_r = array('title' => 'hello world!', 1, false );
// // add a new option
// add_option('wporg_custom_option', $data_r);
// // get an option
// $options_r = get_option('wporg_custom_option');
// // output the title
// echo esc_html($options_r['title']);

    delete_option( "wporg_custom_option" );

};
add_action( 'admin_init', 'creating_options_fn' );

require_once plugin_dir_path( __FILE__ ) . '/setting_field.php';

// Trying to make a field in setting option api in General menu

function setting_api_fn() {
    // Register the settings
    register_setting( 'general', 'bk_setting' ); // For the first field
    register_setting( 'general', 'bk_email' ); // For the second field
    register_setting( 'general', 'bk_phone' ); // For the third field

    // Add a section
    add_settings_section(
        'bk_id', // Section ID
        'BK Section', // Section Title
        'section_fn', // Callback to display section description
        'general' // Page to display the section
    );

    // Add the first field
    add_settings_field(
        'bk_field', // Field ID
        'BK Name', // Field Title
        'field_fn_name', // Callback to render the field
        'general', // Page to display the field
        'bk_id' // Section ID
    );

    // Add the second field
    add_settings_field(
        'bk_email_field', // Field ID
        'BK Email', // Field Title
        'field_fn_email', // Callback to render the field
        'general', // Page to display the field
        'bk_id' // Section ID
    );

    // Add the third field
    add_settings_field(
        'bk_phone_field', // Field ID
        'BK Phone', // Field Title
        'field_fn_phone', // Callback to render the field
        'general', // Page to display the field
        'bk_id' // Section ID
    );
}

// Section description callback
function section_fn() {
    echo "BK Setting Section";
}

// Callback for the first field: BK Name
function field_fn_name() {
    $value = get_option( 'bk_setting' ); // Retrieve the value of the first field
    echo "<input name='bk_setting' type='text' value='" . esc_attr( $value ) . "' />";
}

// Callback for the second field: BK Email
function field_fn_email() {
    $value = get_option( 'bk_email' ); // Retrieve the value of the second field
    echo "<input name='bk_email' type='email' value='" . esc_attr( $value ) . "' />";
}

// Callback for the third field: BK Phone
function field_fn_phone() {
    $value = get_option( 'bk_phone' ); // Retrieve the value of the third field
    echo "<input name='bk_phone' type='tel' value='" . esc_attr( $value ) . "' />";
}

// Hook into admin_init to initialize the settings
add_action( 'admin_init', 'setting_api_fn' );

require_once plugin_dir_path( __FILE__ ) . "new_setting.php";

require_once plugin_dir_path( __FILE__ ) . 'post_meta.php';
require_once plugin_dir_path( __FILE__ ) . 'custom_post_type.php';

function wporg_register_taxonomy_course() {
    $labels = array(
        'name'              => _x( 'Courses', 'taxonomy general name' ),
        'singular_name'     => _x( 'Course', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Courses' ),
        'all_items'         => __( 'All Courses' ),
        'parent_item'       => __( 'Parent Course' ),
        'parent_item_colon' => __( 'Parent Course:' ),
        'edit_item'         => __( 'Edit Course' ),
        'update_item'       => __( 'Update Course' ),
        'add_new_item'      => __( 'Add New Course' ),
        'new_item_name'     => __( 'New Course Name' ),
        'menu_name'         => __( 'Course' ),
    );
    $args   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'course' ],
    );
    register_taxonomy( 'course', [ 'post','books' ], $args );
}
add_action( 'init', 'wporg_register_taxonomy_course' );

include_once plugin_dir_path(__FILE__).'add-user.php';
include_once plugin_dir_path(__FILE__).'github-info.php';
include_once plugin_dir_path(__FILE__).'rest-api.php';
