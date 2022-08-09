<?php

/**
 * добавление кастомных полей в форму заказа
 */
add_action('woocommerce_after_checkout_billing_form', 'tati_add_checkout_fields', 20);
function tati_add_checkout_fields($checkout)
{
    woocommerce_form_field('call_me_back', array(
        'type'          => 'checkbox',
        'class'         => array('form-row'),
        'label_class'   => array('woocommerce-form__label-for-checkbox'),
        'input_class'   => array('woocommerce-form__input-checkbox'),
        'required'      => false,
        'label'         => 'Перезвоните мне, остались вопросы',
    ), $checkout->get_value('call_me_back'));
    woocommerce_form_field('call_me_whatsapp', array(
        'type'          => 'checkbox',
        'class'         => array('form-row'),
        'label_class'   => array('woocommerce-form__label-for-checkbox'),
        'input_class'   => array('woocommerce-form__input-checkbox'),
        'required'      => false,
        'label'         => 'Напишите мне в WhatsApp, остались вопросы',
    ), $checkout->get_value('call_me_whatsapp'));
    woocommerce_form_field('dont_call_me_back', array(
        'type'          => 'checkbox',
        'class'         => array('form-row'),
        'label_class'   => array('woocommerce-form__label-for-checkbox'),
        'input_class'   => array('woocommerce-form__input-checkbox'),
        'required'      => false,
        'label'         => 'Не перезванивайте, вопросов по заказу нет',
    ), $checkout->get_value('dont_call_me_back'));
}
add_action('woocommerce_checkout_update_order_meta', 'tati_save_checkout_fields');
/**
 * сохраним поле
 */
function tati_save_checkout_fields($order_id)
{

    if (!empty($_POST['call_me_back']) && 1 == $_POST['call_me_back']) {
        update_post_meta($order_id, 'call_me_back', 'Перезвоните мне, остались вопросы');
    }
    if (!empty($_POST['call_me_whatsapp']) && 1 == $_POST['call_me_whatsapp']) {
        update_post_meta($order_id, 'call_me_whatsapp', 'Напишите мне в WhatsApp, остались вопросы');
    }
    if (!empty($_POST['dont_call_me_back']) && 1 == $_POST['dont_call_me_back']) {
        update_post_meta($order_id, 'dont_call_me_back', 'Не перезванивайте, вопросов по заказу нет');
    }
}

add_action('woocommerce_email_after_order_table', 'tati_email_after_order_table', 10, 4);
function tati_email_after_order_table($order, $sent_to_admin, $plain_text, $email)
{
    /**
     * если получатель = почта админа то прикрепляем примечание для него
     * если не почта админа, значит клиент, прикрепляем сообщение для клиента
     * если в админке в настройках емейл перечислены несколько почт через запятую, 
     * то это строка, ее так и надо проверять на совпадение 
     * var_dump($email->recipient);
     */
    $admin_email = 'mail@propitay.ru'; //почта админа
    if ($admin_email == $email->recipient) {
        $order_data = $order->get_data();
        $order_meta = $order_data['meta_data'];

        foreach ($order_meta as $meta) {
            if ('call_me_back' == $meta->key) {
                echo '<p style="color:red;"><b>Примечание: Перезвоните мне, остались вопросы</b></p>';
            } elseif ('call_me_whatsapp' == $meta->key) {
                echo '<p style="color:red;"><b>Примечание: Напишите мне в WhatsApp, остались вопросы</b></p>';
            } elseif ('dont_call_me_back' == $meta->key) {
                echo '<p style="color:red;"><b>Примечание: Не перезванивайте, вопросов по заказу нет</b></p>';
            }
        }
    }
}
