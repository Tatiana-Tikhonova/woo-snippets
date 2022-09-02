<?php
add_filter('woocommerce_upsell_display_args', 'tati_woocommerce_upsell_display_args_filter');

/**
 * Function for `woocommerce_upsell_display_args` filter-hook.
 * выводим столько товаров сколько задано колонок
 * @param  $array 
 *
 * @return 
 */
function tati_woocommerce_upsell_display_args_filter($array)
{
    $array['posts_per_page'] = $array['columns'];
    return $array;
}
