<?php

/**
 * Shipping tab
 * @version 2.0.0
 */

defined('ABSPATH') || exit;

global $post;
?>
<?php
/**
 * the_field - это при использовании плагина ACF
 * но можно и через метабоксы get_theme_mod или get_option
 */
the_field('dostavka', 308);
?>