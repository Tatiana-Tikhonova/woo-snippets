<?php

/**
 * фильтры хлебных  крошек
 */
add_filter('woocommerce_get_breadcrumb', 'tati_woocommerce_get_breadcrumb_filter', 10, 2);

function tati_woocommerce_get_breadcrumb_filter($crumbs, $that)
{

    return $crumbs;
}
/**
 * добавить обертку и контейнер для хлебных  крошек
 */
add_filter('woocommerce_breadcrumb_defaults', 'tati_breadcrumb_wrapper');
function tati_breadcrumb_wrapper($array)
{
    $array['wrap_before'] = '<nav class="woocommerce-breadcrumb"><div class="container">';
    $array['wrap_after'] = '</div></nav>';
    return $array;
}

/**
 * если это не конкретный шаблон страницы 
 * то вывести хлебные крошки на кастомном хуке 
 * (можно  внутри контейнера тогда функции выше не нужны)
 */

if (!is_page_template('page-home.php')) {
    add_action('tati_open_content_wrapper', 'woocommerce_breadcrumb', 20);
}
