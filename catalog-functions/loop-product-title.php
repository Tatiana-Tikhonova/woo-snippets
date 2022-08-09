<?php
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'tati_product_title', 10);
if (!function_exists('woocommerce_template_loop_product_title')) {

    function tati_product_title()
    {
        echo '<h4 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h4>';
    }
}
