<?php

/**Product tabs filter */
add_filter('woocommerce_product_tabs', 'tati_woocommerce_product_tabs_filter');

/**
 * Function for `woocommerce_product_tabs` filter-hook.
 * 
 * @param  $array 
 *
 * @return 
 */
function tati_woocommerce_product_tabs_filter($array)
{
    return $array;
}
// изменить текст заголовка таба и кнопки таба (там одно и то же)
add_filter('woocommerce_product_tabs', 'tati_product_tabs_filter');
function tati_product_tabs_filter($prod_tabs)
{
    $prod_tabs['additional_information']['title'] = 'Характеристики';
    return $prod_tabs;
}
