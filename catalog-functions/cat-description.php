<?php

/**
 * перенести описание категории\таксономии товаров в нижнюю часть страницы каталога
 */
remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);
remove_action('woocommerce_archive_description', 'woocommerce_product_archive_description', 10);
add_action('woocommerce_after_main_content', 'tati_taxonomy_archive_description', 20);
add_action('woocommerce_after_main_content', 'tati_product_archive_description', 20);

if (!function_exists('tati_taxonomy_archive_description')) {

    /**
     * показывать описание на стр таксономий
     */
    function tati_taxonomy_archive_description()
    {
        if (is_product_taxonomy() && 0 === absint(get_query_var('paged'))) {
            $term = get_queried_object();

            if ($term && !empty($term->description)) {
                echo '<div class="seo-description">
					<div class="container">
					<div class="term-description">
				' . wc_format_content(wp_kses_post($term->description)) .
                    '</div>
				</div>
				</div>';
            }
        }
    }
}

if (!function_exists('tati_product_archive_description')) {

    /**
     * показывать описание на стр архивов
     */
    function tati_product_archive_description()
    {
        // не показывать описание на стр результатов поиска
        if (is_search()) {
            return;
        }

        if (is_post_type_archive('product') && in_array(absint(get_query_var('paged')), array(0, 1), true)) {
            $shop_page = get_post(wc_get_page_id('shop'));
            if ($shop_page) {
                $description = wc_format_content(wp_kses_post($shop_page->post_content));
                if ($description) {
                    echo '
					<div class="seo-description">
					<div class="container">
					<div class="page-description">
					' . $description .
                        ' </div>
						</div>
						</div>';
                }
            }
        }
    }
}
