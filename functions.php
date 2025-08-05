<?php
require 'vendor/autoload.php';

// Theme Setup
require 'assets/style.php';

// Theme Support
require 'inc/support/theme.php';
require 'inc/support/webp.php';

// Carbon Fields
require 'inc/content/theme_options.php';

add_action('after_setup_theme', 'crb_load');
function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}

// Support Features
require 'inc/support/maintenance.php';
require 'inc/support/remove_editor.php';
require 'inc/support/remove_comments.php';
