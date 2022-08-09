<?php

/**
 * Убираем зум картинки
 */

add_filter('woocommerce_single_product_zoom_options', 'custom_single_product_zoom_options', 10, 3);
function custom_single_product_zoom_options($zoom_options)
{
    // Disable zoom magnify:
    $zoom_options['magnify'] = 0;

    return $zoom_options;
}
