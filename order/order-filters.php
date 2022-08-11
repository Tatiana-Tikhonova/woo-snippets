<?php
add_filter('woocommerce_get_order_item_totals', 'tati_wc_get_order_item_totals_filter', 10, 3);

/**
 * изменяем инфу о заказе на стрзаказ принят и в письме 
 */
function tati_wc_get_order_item_totals_filter($total_rows, $that, $tax_display)
{
    return $total_rows;
}

add_filter('woocommerce_order_shipping_to_display_shipped_via', 'tati_wc_order_shipping_to_display_shipped_via_filter', 10, 2);

/**
 * изменяем текст о способе доставки на стр заказ принят и в емайле
 */
function tati_wc_order_shipping_to_display_shipped_via_filter($html, $that)
{
    $html = str_replace('через ', '', $html);
    return $html;
}
