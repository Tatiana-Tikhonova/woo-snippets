<?php

/**
 * если товар вариативный - показывать его минимальную цену с префиксом "От" на страницах каталога
 */
add_filter('woocommerce_get_price_html', 'tati_get_price_html', 10, 2);
function tati_get_price_html($price, $that)
{
    if (!is_product() || !is_cart() || !is_checkout()) {
        if ($that->is_type('variable')) {
            $price = explode(' &ndash; ', $price);

            if (count($price) > 1) {
                $price = '<span>От </span>' . $price[0];
            } else {
                $price = $price[0];
            }
        }
    }
    return $price;
}
