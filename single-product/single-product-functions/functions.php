<?php

/**
 * изменить отображаемые на стр товара атрибуты
 */
add_filter('woocommerce_display_product_attributes', 'tati_unset_attrs', 10, 2);
function tati_unset_attrs($product_attributes, $product)
{
    unset($product_attributes['weight']);
    unset($product_attributes['dimensions']);
    return $product_attributes;
}
// вывести атрибуты в summary
add_action('woocommerce_single_product_summary', 'tati_summary_output_attributes', 25);
function tati_summary_output_attributes($product)
{
    wc_get_template('single-product/tabs/additional-information.php');
    echo '<a href="#tab-title-additional_information" class="tab-detailes-trigger">Все характеристики</a>';
}
// перенести апселлы
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
add_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 20);
// перенести похожие товары
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 30);

// вывести кросселлы на стр товара
add_action('woocommerce_after_single_product_summary', 'tati_single_output_cross_sells', 15);
function tati_single_output_cross_sells($product)
{
    wc_get_template('single-product/single-cross-sells.php');
}

// Изменить заголовок кросселлов
add_filter('woocommerce_product_cross_sells_products_heading', 'tati_cross_sells_products_heading');
function tati_cross_sells_products_heading($cross_sells_heading)
{
    $cross_sells_heading = 'С этим товаром покупают:';
    return $cross_sells_heading;
}
