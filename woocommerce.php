<?php

/**
 * ГЛОБАЛЬНЫЕ ФУНКЦИИ
 */

/**
 * удалить счетчик товаров
 */
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

/**
 * изменить обозначение валюты
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
/*if it is a wp pages and posts
* add hook do_action('dev2b_open_site_wrapper'); after get_header();
* add hook do_action('dev2b_close_site_wrapper'); before get_footer();
*
*/
if (!function_exists('tati_site_wrapper_start')) {
    function tati_site_wrapper_start()
    {
        echo '<div class="site-wrapper">';
    }
}
add_action('tati_open_site_wrapper', 'tati_site_wrapper_end', 10);
if (!function_exists('tati_site_wrapper_end')) {
    function tati_site_wrapper_end()
    {
        echo '</div>';
    }
}

add_action('tati_close_site_wrapper', 'tati_site_wrapper_end', 10);
/**
 * если это не конкретный шаблон страницы то вывести хлебные крошки woocommerce
 * в шаблонах после get_header(); вывести do_action('tati_open_site_wrapper');
 */
// 
if (!is_page_template('page-home.php')) {
    add_action('tati_open_site_wrapper', 'woocommerce_breadcrumb', 20);
}

/**
 * СТРАНИЦА ТОВАРА
 */

/**
 * функции табов в карточке товара
 */
require get_template_directory() . '/single-product-functions/single-product-tabs.php';
/**
 * зум в карточке товара
 */
require get_template_directory() . '/single-product-functions/image-zoom.php';
/**
 * кнопки в карточке товара
 */
require get_template_directory() . '/single-product-functions/buttons.php';


/**
 * СТРАНИЦЫ КАТАЛОГА (С ЦИКЛОМ)
 */
/**
 * сортировка товаров в каталоге
 */
require get_template_directory() . '/catalog-functions/cat-orderby.php';
/**
 * названия товаров в каталоге
 */
require get_template_directory() . '/catalog-functions/loop-product-title.php';
/**
 * кнопки товаров в каталоге
 */
require get_template_directory() . '/catalog-functions/loop-prodict-buttons.php';

/**
 * СТРАНИЦА КОРЗИНЫ
 */
/**
 * сообщение о сумме до бесплатной доставки на стр корзины
 */
require get_template_directory() . '/cart-functions/free_shipping_notice.php';
/**
 * функции кросс-селлов
 */
require get_template_directory() . '/cart-functions/cross-sells.php';

/**
 * СТРАНИЦА ОФОРМЛЕНИЯ ЗАКАЗА
 */
/**
 * обертка блока ордер-ревью (правая колонка)
 */
require get_template_directory() . '/checkout-functions/order-review-wrapper.php';
/**
 * изменение полей формы оформления заказа
 */
require get_template_directory() . '/checkout-functions/form-fields.php';
