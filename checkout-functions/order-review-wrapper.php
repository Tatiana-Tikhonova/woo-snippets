<?php

/**
 * обертка блока ордер-ревью (правая колонка)
 */
add_action('woocommerce_checkout_before_order_review_heading', 'tati_checkout_before_order_review_heading');
function tati_checkout_before_order_review_heading()
{
    echo '<div class="woocommerce-checkout__order-col">';
}
add_action('woocommerce_checkout_after_order_review', 'tati_checkout_after_order_review');
function tati_checkout_after_order_review()
{
    echo '</div>';
}
