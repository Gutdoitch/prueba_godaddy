<?php

if (!class_exists('WPBakeryShortCode')) return;
class WPBakeryShortCode_before_after_slider extends WPBakeryShortCode

	{
	protected
	function content($atts, $content = null)
		{

		// $custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;

		$css = '';
		extract(shortcode_atts(array(
			'before_text' => '',
			'before_image' => '',
			'after_image' =>'',
			'after_text' =>'',
			'css' => '',
		) , $atts));

		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ') , $this->settings['base'], $atts);
		/* ================  Render Shortcodes ================ */
		ob_start();
?>
        
        <?php

		// $img = wp_get_attachment_image_src($el_image, "large");
		// $imgSrc = $img[0];

?>

        <!-- Element Code start -->
    
                    <div id="mayosis-before-after" class="beer-slider" data-beer-label="<?php echo esc_html($before_text);?>">
                        <?php echo wp_get_attachment_image( $before_image,'full',["class" => "img-responsive"]); ?>
                        <div class="beer-reveal" data-beer-label="<?php echo esc_html($after_text);?>">
                         <?php echo wp_get_attachment_image( $after_image,'full',["class" => "img-responsive"]); ?>
                        </div>
                      </div>
               
			    <div class="clearfix"></div>
			    
			    
      
		
        
        <!-- Element Code / END -->

        <?php
		$output = ob_get_clean();
		/* ================  Render Shortcodes ================ */
		return $output;
		}
	}

vc_map(array(
	"base" => "before_after_slider",
	"name" => __('Mayosis Before After Slider', 'mayosis-core') ,
	"description" => __('Mayosis before after slider', 'mayosis-core') ,
	"class" => "",
	"icon" => get_template_directory_uri() . '/images/DM-Symbol-64px.png',
	"category" => __('Mayosis Elements', 'mayosis-core') ,
	"params" => array(
	    
	          array(
                        'type' => 'attach_image',
                        'heading' => __( 'Before Image', 'mayosis-core' ),
                        'param_name' => 'before_image',
                        'description' => __( 'Upload Before Image', 'mayosis-core' ),
                    ),
                    
                    
                    array(
                        'type' => 'attach_image',
                        'heading' => __( 'After Image', 'mayosis-core' ),
                        'param_name' => 'after_image',
                        'description' => __( 'Upload After Image', 'mayosis-core' ),
                    ),
                    
                    
		array(
			'type' => 'textfield',
			'heading' => __('Before Text', 'mayosis-core') ,
			'param_name' => 'before_text',

		) ,
		
			array(
			'type' => 'textfield',
			'heading' => __('After Text', 'mayosis-core') ,
			'param_name' => 'after_text',

		) ,
	
		array(
			'type' => 'css_editor',
			'heading' => __('Css', 'mayosis-core') ,
			'param_name' => 'css',
			'group' => __('Design options', 'mayosis-core') ,
		) ,
	)
));