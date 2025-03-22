<?php
 
// Define the custom cron interval (e.g., every 50 seconds)
add_filter('cron_schedules', 'custom_interval');
function custom_interval($schedule) {
    $schedule['five_seconds'] = array(
        'interval' => 50, // Interval in seconds (50 seconds)
        'display'  => esc_html__('Every 50 Seconds') // Correct description
    );
    return $schedule;
}

// Cron function to execute
function cron_fn_testing() {
    error_log('Cron job executed successfully!'); // Log a message
}


add_action('bisnu_corn_hook_testing', 'cron_fn_testing');


// if (!wp_next_scheduled('bisnu_corn_hook_testing')) {
//     wp_schedule_event(time(), 'five_seconds', 'bisnu_corn_hook_testing');
// }

wp_unschedule_hook('bisnu_corn_hook_testing');

// debug(_get_cron_array());



