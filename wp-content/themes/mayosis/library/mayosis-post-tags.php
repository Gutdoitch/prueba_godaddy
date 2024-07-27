<?php

if ( ! function_exists( 'mayosis_category_list' ) ) :
    function mayosis_category_list()
    {
        $categories_list = get_the_category_list(__(', ','mayosis'));
        if ($categories_list) {
            echo maybe_unserialize($categories_list);
        }
    }
endif;