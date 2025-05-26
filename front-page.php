<?php get_header() ?>

<div class="container mx-auto flex flex-col items-center justify-center h-screen">
    <h1 class="title text-7xl">Hello world</h1>
    <img src="<?= preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', wp_get_attachment_url(carbon_get_theme_option('crb_image'))) ?>" alt="">
</div>

<?php get_footer() ?>