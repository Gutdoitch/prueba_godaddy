<?php

if ( ! function_exists( 'mayosis_category_list' ) ) :
    function mayosis_category_list()
    {
        $categories_list = get_the_category_list(__(', ', 'mayosis'));
        if ($categories_list) {
            echo maybe_unserialize($categories_list);
        }
    }
endif;


#-----------------------------------------------------------------#
# Mayosis Footer Builder
#-----------------------------------------------------------------#/

if (!function_exists('mayosis_footer_builder') ) {
function mayosis_footer_builder() {
   
        $footer = get_theme_mod( 'select_footer_blocks','');  
        
        if ( function_exists('icl_object_id') ) {
        $footer =  icl_object_id($footer, 'footer_builder', false,ICL_LANGUAGE_CODE); 
        }


         if (!empty($footer)) {
             echo  '<div  class="mayosis-footer-builder w-full"><div class="footer-content-holder">'. \Elementor\Plugin::$instance->frontend->get_builder_content( intval($footer) ). '</div></div>';
         }
	

}

}


add_action( 'wp_enqueue_scripts', function() {
	if ( ! class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
		return;
	}
     
    $footer = get_theme_mod( 'select_footer_blocks',''); 
      if ( function_exists('icl_object_id') ) {
        $footer =  icl_object_id($footer, 'footer_builder', false,ICL_LANGUAGE_CODE); 
    }  
	$template_id = $footer;

	$css_file = new \Elementor\Core\Files\CSS\Post( $template_id );
	$css_file->enqueue();
}, 500 );