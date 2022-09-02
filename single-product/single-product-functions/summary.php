<?php

/** 
 * Переносим заголовок
 * */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action('woocommerce_before_single_product', 'woocommerce_template_single_title', 1);
/** 
 * Переносим рейтинг
 * */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_before_single_product', 'woocommerce_template_single_rating', 2);
