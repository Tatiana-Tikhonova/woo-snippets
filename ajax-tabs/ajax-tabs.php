<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
global $post, $product;

if (wp_doing_ajax()) {
    add_action('wp_ajax_tab_action', 'propitay_get_home_tabs_ajax_action');
    add_action('wp_ajax_nopriv_tab_action', 'propitay_get_home_tabs_ajax_action');
}
function propitay_get_home_tabs_ajax_action()
{
    if (!wp_verify_nonce($_POST['nonce'], 'tabs-nonce')) {
        wp_die('Данные отправлены с неверного адреса');
    }

    // if (!array_key_exists('hits', $_POST) || !array_key_exists('news', $_POST) || !array_key_exists('recommend', $_POST) || !array_key_exists('sale', $_POST)) {
    // 	wp_die('Ошибка запроса к серверу, попробуйте еще раз');
    // }

    $base = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 10,

    );

    if (isset($_POST['hits'])) {
        $arr = array(

            'orderby' => 'meta_value_num',
            'meta_query'     => array(
                array(
                    'key'           => 'total_sales',
                    'value'         => 100,
                    'compare'       => '>',
                    'type'          => 'numeric'
                ),
            ),
        );
        $args = array_merge($base, $arr);
    } elseif (isset($_POST['news'])) {
        $arr = array(

            'orderby'     => 'date',
            'order'       => 'DESC',
        );
        $args = array_merge($base, $arr);
    } elseif (isset($_POST['recommend'])) {
        $arr = array(

            'tax_query' => array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'name',
                    'terms'    => 'featured',
                ),
            ),
        );
        $args = array_merge($base, $arr);
    } elseif (isset($_POST['sale'])) {
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $arr = array(

            'post__in' => array_merge(array(0), $product_ids_on_sale),
        );
        $args = array_merge($base, $arr);
    } else {
        $args = $base;
        // wp_die('Ошибка запроса к серверу, попробуйте еще раз');
    }
    $wc_query = new WP_Query($args);
    $json_data['out'] = ob_start();

    if ($wc_query->have_posts()) {
        while ($wc_query->have_posts()) {
            $wc_query->the_post();
            wc_get_template_part('slider', 'product');
        }
        wp_reset_postdata();
    } else {
        echo "Ошибка запроса к серверу, попробуйте еще раз";
    }

    $json_data['out'] .= ob_get_clean();
    wp_send_json($json_data);
    wp_die();
}
