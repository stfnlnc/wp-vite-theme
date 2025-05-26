<?php

add_action('get_header', 'maintenance_mode');
function maintenance_mode()
{
    if (!function_exists('carbon_get_theme_option')) {
        return;
    }
    if (carbon_get_theme_option('crb_maintenance_mode') && !is_user_logged_in()) {
        wp_die(__('Maintenance mode is enabled. Please come back later.'));
    }
}
