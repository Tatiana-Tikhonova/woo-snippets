<?php

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('tati_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function tati_woocommerce_wrapper_before()
    {
        if (is_product()) {
?>
            <main id="primary" class="product-main">
            <?php
        } else {
            ?>
                <main id="primary" class="cat-main">
                <?php
            }
        }
    }
    add_action('woocommerce_before_main_content', 'tati_woocommerce_wrapper_before');

    if (!function_exists('tati_woocommerce_wrapper_after')) {
        /**
         * After Content.
         *
         * Closes the wrapping divs.
         *
         * @return void
         */
        function tati_woocommerce_wrapper_after()
        {
                ?>
                </main><!-- #main -->
        <?php
        }
    }
    add_action('woocommerce_after_main_content', 'tati_woocommerce_wrapper_after');
