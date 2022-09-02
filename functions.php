<?php

/**
 * подключение функций табов с хитами-новинками-рекомендуемыми-расподажными товарами
 */
require get_template_directory() . '/inc/ajax-tabs.php';

/**
 * изменить символ валюты
 */

add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol($currency_symbol, $currency)
{
    switch ($currency) {
        case 'RUB':
            $currency_symbol = ' руб.';
            break;
    }
    return $currency_symbol;
}
