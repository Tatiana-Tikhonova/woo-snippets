<?php

/**
 * удалить ссылку с миниатюры
 */
add_filter('woocommerce_single_product_image_thumbnail_html', 'wc_remove_link_on_thumbnails');

function wc_remove_link_on_thumbnails($html)
{
    return strip_tags($html, '<div><img>');
}
/**
 * изменить размер и пропорции миниатюры
 */
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {

    // return $size;
    return array(
        'width' => 100,
        'height' => 75,
        'crop' => 1,
    );
});
