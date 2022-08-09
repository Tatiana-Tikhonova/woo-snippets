<?php
// удаляем вывод табов по дефолту
remove_filter('woocommerce_product_tabs', 'woocommerce_default_product_tabs');
// добавляем свой вывод табов
add_filter('woocommerce_product_tabs', 'tati_wc_product_tabs');

/**
 * вешаем на подходящий хук в шаблоне content-single-product.php
 * или вешаем табы на свой хук и выводим его в нужном месте в шаблоне content-single-product.php
 */

add_action('tati_output_product_tabs', 'woocommerce_output_product_data_tabs', 10);
if (!function_exists('tati_wc_product_tabs')) {

    function tati_wc_product_tabs($tabs = array())
    {
        global $product, $post;
        if ($post->post_content) {
            $tabs['description'] = array(
                'title' => 'Описание',
                'priority' => 10,
                'callback' => 'woocommerce_product_description_tab',
            );
        }
        // Additional information tab - shows attributes.
        if ($product && ($product->has_attributes() || apply_filters('wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions()))) {
            $tabs['additional_information'] = array(
                'title'    => __('Additional information', 'woocommerce'),
                'priority' => 20,
                'callback' => 'woocommerce_product_additional_information_tab',
            );
        }
        /**
         * get_field - это при использовании плагина ACF
         * но можно и через метабоксы get_theme_mod или get_option
         */
        if (get_field('dostavka', 308)) {
            $tabs['shipping'] = [
                'title' => 'Доставка',
                'priority' => 30,
                'callback' => 'tati_add_shipping_tab',
            ];
        }
        if (get_field('oplata', 308)) {
            $tabs['payment'] = [
                'title' => 'Оплата',
                'priority' => 40,
                'callback' => 'tati_add_payment_tab',
            ];
        }
        if (comments_open()) {
            $tabs['reviews'] = array(
                /* translators: %s: reviews count */
                'title'    => sprintf(__('Reviews (%d)', 'woocommerce'), $product->get_review_count()),
                'priority' => 50,
                'callback' => 'comments_template',
            );
        }

        return $tabs;
    }
}
