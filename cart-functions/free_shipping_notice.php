<?php
add_action('woocommerce_before_cart', 'tati_free_shipping_notice');

function tati_free_shipping_notice()
{
	$enabled = '';
	$min_amount = '';
	//получаем зоны доставки
	$zones = WC_Shipping_Zones::get_zones();
	// получаем суму заказа в корзине
	$current = WC()->cart->get_subtotal();
	// echo count($zones);
	//получаем методы доставки в каждой зоне
	$shipping_methods = array();
	foreach ($zones as $zone) {
		$shipping_methods[] = $zone['shipping_methods'];
	}
	//для каждого метода проверяем нужные ключи
	foreach ($shipping_methods as $method) {
		if ($method) {
			foreach ($method as $item) {
				$enabled = $item->enabled;
				$min_amount = $item->min_amount ?? 0;
				//если метод включен и имеет минимальную сумму заказа выводим сообщение
				if ($enabled == 'yes' && $min_amount && 0 != $min_amount) {
					if ($current < $min_amount) {
						echo '<div class="woocommerce-notices-wrapper free-shipping-message">';
						// если сумма заказа меньше минимальной, выводим сообщение
						wc_print_notice(
							sprintf(
								'%s<a href="%s" class="button wc-forward">%s</a> ',
								'<div><span>Закажите ещё на &nbsp;' . wc_price($min_amount - $current) . '&nbsp;</span> для бесплатной доставки!</div>',
								get_permalink(wc_get_page_id('shop')),
								'Выбрать другие товары',

							),
							'notice'
						);
						echo '</div>';
					}
				}
			}
		}
	}
}
