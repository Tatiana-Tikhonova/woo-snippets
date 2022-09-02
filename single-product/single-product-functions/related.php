<?php

/**
 * фильтруем похожие товары
 */

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function tati_woocommerce_related_products_args($args)
{
    $defaults = array(
        'posts_per_page' => 4,
        'columns'        => 4,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'tati_woocommerce_related_products_args');
