<?php

/**
 * изменение полей формы оформления заказа
 */
add_filter('woocommerce_checkout_fields', 'tati_change_checkout_fields');
function tati_change_checkout_fields($fields)
{

    unset($fields['billing']['billing_phone']['class'][0]);
    unset($fields['billing']['billing_email']['class'][0]);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_postcode']);
    $fields['billing']['billing_email']['required'] = false;
    $fields['order']['order_comments']['class'][] = 'form-row-wide';
    return $fields;
}
add_filter('woocommerce_default_address_fields', 'tati_change_address_fields');
function tati_change_address_fields($fields)
{


    // $fields['postcode']['priority'] = 45;
    // $fields['state']['priority'] = 50;
    // $fields['city']['priority'] = 55;
    // $fields['address_1']['priority'] = 60;
    unset($fields['address_2']);
    unset($fields['postcode']);
    unset($fields['state']);
    unset($fields['city']);
    $fields['address_1']['placeholder'] = "Введите почтовый адрес";
    $fields['address_1']['required'] = false;
    return $fields;
}
