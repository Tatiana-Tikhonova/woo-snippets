<?php
add_filter('woocommerce_catalog_orderby', 'tati_catalog_orderby');
function tati_catalog_orderby($catalog)
{
    unset($catalog['popularity']);
    unset($catalog['rating']);
    //unset($catalog['date']);
    $catalog['date'] = 'По новинкам';
    $catalog['price'] = 'По возрастанию цены';
    $catalog['price-desc'] = 'По убыванию цены';
    return $catalog;
}
