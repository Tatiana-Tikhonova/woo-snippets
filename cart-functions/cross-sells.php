<?php
add_filter('woocommerce_cross_sells_columns', 'tati_cross_sells_columns');
function tati_cross_sells_columns($columns)
{
    $columns = 5;

    return $columns;
}
