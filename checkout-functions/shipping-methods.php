<?php

/**
 * Вывести что-то после конкретного метода доставки
 * 
 * @param  $method 
 * @param  $index  
 *
 * @return void
 */
function tati_woocommerce_after_shipping_rate_action($method, $index)
{
    if ('local_pickup:17' == $method->id) {
        echo '<div class="pvzlink" style="padding: 2px 24px 0px;"><a style="text-decoration: underline dotted currentColor; font-size:90%;" href="https://yandex.ru/maps/?rtext=~55.944520,%2037.851116&rtt=auto" target="_blank">Проложить маршрут</a></div>';
    }
    if ('flat_rate:33' == $method->id) {
        echo '<div class="pvzlink" style="padding: 2px 24px 0px;"><a style="text-decoration: underline dotted currentColor; font-size:90%;" href="#forpvz">Выбрать ПВЗ</a></div>';
    }
}
add_action('woocommerce_after_shipping_rate', 'tati_woocommerce_after_shipping_rate_action', 10, 2);
