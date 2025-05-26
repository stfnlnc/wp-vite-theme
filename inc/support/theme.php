<?php

function vite_theme_supports()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    add_image_size('post-thumbnail', 1440, 900, true);
}

add_action('after_setup_theme', 'vite_theme_supports');
