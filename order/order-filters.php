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
/**
 * добавляем инфу на стр заказ принят и в раздел заказа в личном кабинете
 */
add_action('woocommerce_order_details_after_order_table', 'tati_display_order_meta_data');
function tati_display_order_meta_data($order)
{
    $order_data = $order->get_data();
    $order_meta = $order_data['meta_data'];
    foreach ($order_meta as $meta) {
        if ('propitay_pvz_field' == $meta->key) {
            echo '<p><b>Выбрана доставка до ПВЗ: ' . $meta->value . '</b></p>';
        }
    }
}
