<?php

// Désactiver les commentaires sur tout le site
function disable_comments_everywhere()
{
    // Supprimer les supports des commentaires et rétroliens
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
}
add_action('admin_init', 'disable_comments_everywhere');

// Fermer les commentaires sur le front-end
function close_comments_frontend()
{
    return false;
}
add_filter('comments_open', 'close_comments_frontend', 20, 2);
add_filter('pings_open', 'close_comments_frontend', 20, 2);

// Cacher les commentaires existants
function hide_existing_comments($comments)
{
    return array();
}
add_filter('comments_array', 'hide_existing_comments', 10, 2);

// Retirer le menu "Commentaires" du tableau de bord
function remove_comment_admin_menu()
{
    remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'remove_comment_admin_menu');

// Rediriger si quelqu’un essaie d’accéder à la page des commentaires
function disable_comment_admin_redirect()
{
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
}
add_action('admin_init', 'disable_comment_admin_redirect');

// Supprimer le widget des commentaires du tableau de bord
function remove_dashboard_comment_widget()
{
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_dashboard_comment_widget');
