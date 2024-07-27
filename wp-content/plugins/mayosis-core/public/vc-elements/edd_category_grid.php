<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_category_grid_edd extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
$css = '';
        extract(shortcode_atts(array(
			"recent_section_title" => 'Categories',
			'css' => ''
        ), $atts));
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );



        /* ================  Render Shortcodes ================ */
	
	

        ob_start();
		

        ?>
        <h2 class="section-title"><?php echo esc_attr($recent_section_title); ?> </h2>
        <?php echo mayosis_edd_grid_terms(); ?>
         

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "category_grid_edd",
    "name"      => __("Mayosis Download Category", 'mayosis-core'),
    "description"      => __("Mayosis Easy Digital Download Category Grid", 'mayosis-core'),
    "class"     => "",
    "icon"      => get_template_directory_uri().'/images/DM-Symbol-64px.png',
    "category"  => __("Mayosis Elements", 'mayosis-core'),
    "params"    => array(
	 array(
                        'type' => 'textfield',
                        'heading' => __( 'Section Title', 'mayosis-core' ),
                        'param_name' => 'recent_section_title',
                        'value' => __( 'Recent Edd', 'mayosis-core' ),
                        'description' => __( 'Title for Recent Section', 'mayosis-core' ),
                    ), 
		
		array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mayosis-core' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'mayosis-core' ),
        ),

    )

));