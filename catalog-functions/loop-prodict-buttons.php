<?php

/**
 * кнопки товара в каталоге
 * */
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action('woocommerce_after_shop_loop_item', 'tati_template_loop_product_link', 10);
if (!function_exists('tati_template_loop_product_link')) {
    function tati_template_loop_product_link()
    {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        echo '<div class="product-card__btns">
            <a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link button">
            Посмотреть товар</a>
            <a class="button button_secondary" data-modal="buy-one-click" href="#">Заказать в 1 клик</a>
            </div>
            ';
    }
}
