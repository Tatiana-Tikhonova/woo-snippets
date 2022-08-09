<?php
defined('ABSPATH') || exit;
/**
 * получаем из базы комменты с высшей оценкой
 */
function tati_get_average_rating_comments_id()
{
    global $wpdb;
    $ids = $wpdb->get_col($wpdb->prepare(
        "
				SELECT comment_id 
				FROM $wpdb->commentmeta 
				WHERE meta_key = 'rating' AND meta_value = %d
				ORDER BY comment_id DESC
				",
        5
    ));
    return $ids;
}
/**
 * коллбэк - проверка для массива комментов в tati_get_comments_by_ids
 */

function is_true($var)
{
    return (bool)$var;
}

/**
 * получаем массив комментов по айдишникам
 */
function tati_get_comments_by_ids()
{
    $id_arr = tati_get_average_rating_comments_id();
    $comments = [];

    if ($id_arr) {
        foreach ($id_arr as $id_one) {
            $comments[] = get_comments(array(
                'comment__in' => $id_one,
                'status' => 'approve',
                'orderby' => 'comment_date',
                'order' => 'ASC',
            ));
        }
        /**
         * если коммент не одобрен, то в массив $comments по ключу $id_one попадает пустой массив
         * поэтому фильтруем массив комментов удаляя пустые значения чтобы не было ошибки в tati_sort_arrays
         */
        $comments = array_filter($comments, 'is_true');
    }

    return $comments;
}
/**
 * получаем айди постов по айди комментов
 */

function tati_get_posts_ids()
{
    $post_ids = [];
    $comments = tati_get_comments_by_ids();

    if ($comments) {

        foreach ($comments as $comment) {
            $post_ids[] = $comment[0]->comment_post_ID;
        }
    }
    return $post_ids;
}
function tati_sort_arrays()
{
    /**
     * функция выдает ошибку array_flip если коммент не одобрен
     * $ids = tati_get_average_rating_comments_id();
     * поэтому получаем айди одобренных комментов отфильтрованных в tati_get_comments_by_ids
     */
    $ids = [];
    $comments = tati_get_comments_by_ids();
    foreach ($comments as $comment) {
        $ids[]     = $comment[0]->comment_ID;
    }
    /**
     * получаем айди постов
     */
    $post_ids = tati_get_posts_ids();
    /**
     * сливаем айди комментов и айди постов в один массив, где ключ - айди коммента, значение-айди поста
     * удаляем пары с повторяющимся айди поста, чтобы на каждый пост остался один лучший коммент
     * и меняем местами ключ и значение (айди коммента и айди поста)
     */
    $new_arr = array_flip(array_unique(array_combine($ids, $post_ids)));
    /**
     * если коммент не одобрен, здесь возникает ошибка array_flip
     */
    return $new_arr;
}
/**
 * получаем посты и относящиеся к ним комменты
 *  и выводим в верстку
 */

function tati_get_posts_and_comments()
{
    $arr = tati_sort_arrays();
    $post_ids = array_keys($arr);
    if ($post_ids) {

        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => 5,
            'post__in' => $post_ids,
        );
        $wc_query = new WP_Query($args);
        if ($wc_query->have_posts()) { ?>
            <section class="best-reviews">
                <h2 class="best-reviews__title">Выбор покупателей</h2>
                <div class="best-reviews__row products">
                    <?php
                    while ($wc_query->have_posts()) {
                        $wc_query->the_post();
                        $comment = get_comment($arr[get_the_ID()]);
                        global $product;

                        // Ensure visibility.
                        if (empty($product) || !$product->is_visible()) {
                            return;
                        }
                    ?>
                        <div class="best-reviews__item">
                            <?php
                            /**
                             * Hook: woocommerce_before_shop_loop_item.
                             *
                             * @hooked woocommerce_template_loop_product_link_open - 10
                             */
                            // do_action('woocommerce_before_shop_loop_item'); 
                            ?>

                            <div class="best-reviews__product">
                                <?php
                                /**
                                 * Hook: woocommerce_before_shop_loop_item_title.
                                 *
                                 * @hooked woocommerce_show_product_loop_sale_flash - 10
                                 * @hooked woocommerce_template_loop_product_thumbnail - 10
                                 */
                                do_action('woocommerce_before_shop_loop_item_title');

                                /**
                                 * Hook: woocommerce_shop_loop_item_title.
                                 *
                                 * @hooked woocommerce_template_loop_product_title - 10
                                 */
                                do_action('woocommerce_shop_loop_item_title');

                                /**
                                 * Hook: woocommerce_after_shop_loop_item_title.
                                 *
                                 * @hooked woocommerce_template_loop_rating - 5
                                 * @hooked woocommerce_template_loop_price - 10
                                 */
                                do_action('woocommerce_after_shop_loop_item_title');
                                ?>
                            </div>
                            <div class="best-reviews__comment">
                                <h6 class="best-reviews__author"><?php echo $comment->comment_author; ?></h6>
                                <div class="best-reviews__rating">
                                    <?php
                                    $rating = intval(get_comment_meta($comment->comment_ID, 'rating', true));

                                    if ($rating && wc_review_ratings_enabled()) {
                                        echo wc_get_rating_html($rating); // WPCS: XSS ok.
                                    }
                                    ?>

                                </div>
                                <p class="best-reviews__text">
                                    <?php
                                    echo get_comment_excerpt($comment->comment_ID);
                                    // echo $comment->comment_content;
                                    ?></p>

                                <a href="<?php
                                            $prod_url = explode("/#", get_comment_link($comment->comment_ID));
                                            echo $prod_url[0];
                                            //echo get_comment_link($comment->comment_ID);
                                            // echo get_comments_link();
                                            ?>" class="best-reviews__review-link button button_primary">Посмотреть товар</a>
                            </div>
                            <?php

                            ?>

                        </div>
                    <?php

                    }
                    wp_reset_postdata();
                    ?>
                </div>
            </section>
<?php
        } else {
            echo "Ошибка запроса к серверу, попробуйте еще раз";
        }
    }
}
add_action('tati_get_best_reviews', 'tati_get_posts_and_comments');
