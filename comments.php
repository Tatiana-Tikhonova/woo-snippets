<?php

/**
 *Change comment excerpt length
 */
add_filter('comment_excerpt_length', 'tati_comment_excerpt_length');
function tati_comment_excerpt_length($comment_excerpt_length)
{
    $comment_excerpt_length = 50;
    return $comment_excerpt_length;
}
