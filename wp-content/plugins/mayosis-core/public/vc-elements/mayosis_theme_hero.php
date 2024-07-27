<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_digital_theme_hero extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
$css = '';
        extract(shortcode_atts(array(
			"edd_hero_title_prefix" => 'Sell Your Arts, Templates, ',
			"type_of_counter" => '1',
			"edd_custom_count" => '2580',
			"title_align" => 'left',
			"title_color" => '#ffffff',
			"count_color" => '#ffffff',
			"heading_type" => "",
			"title_font_size"=>"",
			"title_line_height" => "",
			"gap_title_desc" =>"",
			"countent_color" => '#ffffff',
			"edd_hero_title_suffix" => 'Ebooks, Courses or Any Digital Downloads',
				"custom_class" => '',
			'css' => ''
        ), $atts));
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


        /* ================  Render Shortcodes ================ */

        ob_start();
		
		
	 ?>
        
        <?php 
			//$img = wp_get_attachment_image_src($el_image, "large"); 
			//$imgSrc = $img[0];
		?>

        <!-- Element Code start -->
        
        <div class="col-md-12 col-xs-12 col-sm-12 <?php echo esc_attr( $css_class ); ?> <?php echo esc_attr( $custom_class ); ?>" style="text-align: <?php echo esc_attr($title_align); ?>;">
            
            
                    <<?php if($heading_type){ ?><?php echo esc_attr( $heading_type); ?><?php } else { ?>h2<?php } ?>
                     class="hero-title" style="color:<?php echo esc_attr($title_color); ?>;font-size:<?php echo esc_attr($title_font_size); ?>;line-height:<?php echo esc_attr($title_line_height); ?>;"><?php echo esc_attr($edd_hero_title_prefix); ?>
                    
                   <span style="color:<?php echo esc_attr($count_color); ?>">  <?php if($type_of_counter == "1"){ ?>
                          <?php
                        $result = count_users();
                        echo  $result['total_users'];
                        
                        ?>
                        <?php } elseif($type_of_counter == "2") { ?>
                      
                    <?php } else { ?>
                       <?php echo esc_attr($edd_custom_count); ?>
					   <?php } ?></span>
                        <?php echo esc_attr($edd_hero_title_suffix); ?></<?php if($heading_type){ ?><?php echo esc_attr( $heading_type); ?><?php } else { ?>h2<?php } ?>>
                   <div class="hero-description" style="color:<?php echo esc_attr($countent_color); ?> !important; margin-top:<?php echo esc_attr($gap_title_desc); ?>;"><?php echo $content; ?></div>
                   
			    </div><?php echo $this->endBlockComment('digital_theme_hero'); ?>
        <div class="clearfix"></div>
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "digital_theme_hero",
    "name"      => __("Mayosis Hero", 'mayosis-core'),
    "description"      => __("Mayosis Hero Section", 'mayosis-core'),
    "class"     => "",
    "icon"      => get_template_directory_uri().'/images/DM-Symbol-64px.png',
    "category"  => __("Mayosis Elements", 'mayosis-core'),
    "params"    => array(
	 array(
                        'type' => 'textfield',
                        'heading' => __( 'Section Title Prefix', 'mayosis-core' ),
                        'param_name' => 'edd_hero_title_prefix',
                        'value' => __( 'Sell Your Arts, Templates, Ebooks,', 'mayosis-core' ),
                        'description' => __( 'Title Prefix Of Count', 'mayosis-core' ),
                    ), 
	array(
            "type" => "dropdown",
            "heading" => __("Counter Type:", 'mayosis-core'),
            "param_name" => "type_of_counter",
            "description" => __("Type of Counter", 'mayosis-core'),
			"value"      => array( 'Total User' => '1', 'No Count' => '2', 'Custom Count' => '3' ), //Add default value in $atts
        ),
	 array(
                        'type' => 'textfield',
                        'heading' => __( 'Custom Count', 'mayosis-core' ),
                        'param_name' => 'edd_custom_count',
                        'value' => __( '2532', 'mayosis-core' ),
                        'description' => __( 'Input Integear Value', 'mayosis-core' ),
                    ), 
	
	 array(
                        'type' => 'textfield',
                        'heading' => __( 'Section Title Suffix', 'mayosis-core' ),
                        'param_name' => 'edd_hero_title_suffix',
                        'value' => __( 'Courses or Any Digital Downloads', 'mayosis-core' ),
                        'description' => __( 'Title Suffix Of Count', 'mayosis-core' ),
                    ), 
	
	 array(
                        'type' => 'textarea_html',
                        'heading' => __( 'Section Description', 'mayosis-core' ),
                        'param_name' => 'content',
                        'value' => __( 'Sell & manage your digital products with Beautiful, Feature Rich mayosis Theme.
Build and Earn with your online store with lots of cool and exclusive features bundled with mayosis!', 'mayosis-core' ),
                        'description' => __( 'Description of the Section', 'mayosis-core' ),
                    ), 
        array(
            "type" => "dropdown",
            "heading" => __("Heading Type", 'mayosis-core'),
            "param_name" => "heading_type",
            "description" => __("Choose Heading Type", 'mayosis-core'),
			"value"      => array( 'H1' => 'h1', 'H2' => 'h2', 'H3' => 'h3','H4' => 'h4','H5' => 'h5' ,'H6' => 'h6'), //Add default value in $atts
			"group" => 'Style',
        ),
        
        
                    
         array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading Font Size', 'mayosis-core' ),
                        'param_name' => 'title_font_size',
                        'description' => __( 'Add Heading Font Size ie(34px)', 'mayosis-core' ),
                        
                        	"group" => 'Style',
                    ),
		
		array(
                        'type' => 'textfield',
                        'heading' => __( 'Heading Line Height', 'mayosis-core' ),
                        'param_name' => 'title_line_height',
                        'description' => __( 'Add Heading Line Height ie(44px)', 'mayosis-core' ),
                        
                        	"group" => 'Style',
                    ),
                    
                                
         array(
                        'type' => 'textfield',
                        'heading' => __( 'Gap in Title & Description', 'mayosis-core' ),
                        'param_name' => 'gap_title_desc',
                        'description' => __( 'Add gap between title & description (i.e 22px)', 'mayosis-core' ),
                        
                        	"group" => 'Style',
                    ),
		
                    
		  array(
            "type" => "dropdown",
            "heading" => __("Alignment of Text", 'mayosis-core'),
            "param_name" => "title_align",
            "description" => __("Choose Alignement Of Text", 'mayosis-core'),
			"value"      => array( 'Left' => 'left', 'Center' => 'center', 'Right' => 'right' ), //Add default value in $atts
			"group" => 'Style',
        ),
	
		array(
            "type" => "colorpicker",
            "heading" => __("Color Of Prefix & Suffix", 'mayosis-core'),
            "param_name" => "title_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
	
		array(
            "type" => "colorpicker",
            "heading" => __("Color Of Count", 'mayosis-core'),
            "param_name" => "count_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
        array(
            "type" => "colorpicker",
            "heading" => __("Color Of Content", 'mayosis-core'),
            "param_name" => "countent_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
        	array(
            "type" => "textfield",
            "heading" => __("Custom Class", 'mayosis-core'),
            "param_name" => "custom_class",
            "description" => __("Add a custom Class.", 'mayosis-core'),
			"value" => '',
			"group" => 'Style'
        ),
	array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mayosis-core' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'mayosis-core' ),
        ),

    )

));