<?php
/* кнопки на стр товара*/
add_action('woocommerce_after_add_to_cart_quantity', 'tati_before_add_to_cart_button');
function tati_before_add_to_cart_button()
{
    echo '
    <div class="buttons">';
}
add_action('woocommerce_after_add_to_cart_button', 'tati_after_add_to_cart_button');
function tati_after_add_to_cart_button()
{
    echo '
    <div class="product-card__btn"><a class="button button_secondary" data-modal="buy-one-click" href="#">Заказать в 1 клик</a></div></div>
    
    ';
}
