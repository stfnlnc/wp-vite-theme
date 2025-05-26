<?php



use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

add_filter('wp_handle_upload', 'convert_image_to_webp');

function convert_image_to_webp($upload)
{
    $file_path = $upload['file'];
    $mime = mime_content_type($file_path);

    if (!in_array($mime, ['image/jpeg', 'image/png'])) {
        return $upload;
    }

    try {
        $manager = new ImageManager(new Driver());

        $image = $manager->read($file_path)->scale(1560)->toWebp(100);

        // Crée une version .webp à côté
        $webp_path = preg_replace('/\.(jpe?g|png)$/i', '.webp', $file_path);
        $image->save($webp_path);
    } catch (Exception $e) {
        error_log('Erreur WebP Intervention : ' . $e->getMessage());
    }

    return $upload;
}

add_action('delete_attachment', 'delete_image_webp');

function delete_image_webp($image)
{
    $file = get_attached_file($image);

    if (!$file) return;

    $webp_file = preg_replace('/\.(jpe?g|png)$/i', '.webp', $file);

    if (file_exists($webp_file)) {
        unlink($webp_file);
    }

    $meta = wp_get_attachment_metadata($image);
    if (!empty($meta['sizes'])) {
        $upload_dir = wp_upload_dir();
        foreach ($meta['sizes'] as $size) {
            $base = pathinfo($file, PATHINFO_FILENAME);
            $webp_size_path = $upload_dir['basedir'] . '/' . dirname($meta['file']) . '/' . $base . '-' . $size['width'] . 'x' . $size['height'] . '.webp';
            if (file_exists($webp_size_path)) {
                unlink($webp_size_path);
            }
        }
    }
}
