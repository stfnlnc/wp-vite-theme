<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
    Container::make('theme_options', __('Theme Options'))
        ->add_fields([
            Field::make('image', 'crb_image', __('Image'))
        ]);
}

add_action('carbon_fields_register_fields', 'crb_attach_theme_maintenance');
function crb_attach_theme_maintenance()
{
    Container::make('theme_options', __('Maintenance Mode'))
        ->add_fields([
            Field::make('checkbox', 'crb_maintenance_mode', 'Activer la maintenance'),
        ]);
}
