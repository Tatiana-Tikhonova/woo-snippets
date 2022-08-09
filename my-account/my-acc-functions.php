<?php

/**
 * удалить ненужную колонку в разделе заказы личного кабинета
 */
add_filter('woocommerce_my_account_my_orders_columns', 'tati_my_account_my_orders_columns');
function tati_my_account_my_orders_columns($columns)
{

    unset($columns['order-status']);
    return $columns;
}
