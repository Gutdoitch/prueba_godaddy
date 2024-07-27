<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_digital_team_member extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
$css = '';
        extract(shortcode_atts(array(
			"team_name" => 'S.R Shemul',
			"team_desg" => 'Founder, CEO & Lead Designer',
			"member_image" => '',
			"title_align" => 'left',
			"title_color" => '#ffffff',
			"count_color" => '#c2c7cc',
			"content_color" => '#fff',
			"member_description" => '',
			"style_team" => '',
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
        <?php if($style_team=='one'){?>
	 
		<div class="team-member <?php echo esc_attr( $css_class ); ?>" >
                	<div class="col-md-4 no-padding-left" style="text-align:<?php echo esc_attr($title_align); ?>;">
                  <?php echo wp_get_attachment_image( $member_image,'full',["class" => "img-responsive"]); ?>
                    </div>
                    <div class="col-xs-8 no-padding team-details" style="text-align:<?php echo esc_attr($title_align); ?>;">
                    	<h2 style="color:<?php echo esc_attr($title_color); ?>;"><?php echo esc_attr($team_name ); ?></h2>
                        <small  style="color:<?php echo esc_attr($count_color ); ?>;"><?php echo esc_attr($team_desg ); ?></small>
                        <p style="color:<?php echo esc_attr($content_color); ?>;"><?php echo esc_html($content); ?></p>
                    </div>
                </div> <?php echo $this->endBlockComment('digital_team_member'); ?>
                
     <?php } else { ?>

            <div class="team-member team-style-two <?php echo esc_attr( $css_class ); ?>">
                <div class="team--photo--style2" style="text-align:<?php echo esc_attr($title_align); ?>;">
                    <?php echo wp_get_attachment_image( $member_image,'full',["class" => "img-responsive"]); ?>
                </div>
                <div class="no-padding team-details" style="text-align:<?php echo esc_attr($title_align); ?>;">
                    <h2 style="color:<?php echo esc_attr($title_color); ?>;"><?php echo esc_attr($team_name ); ?></h2>
                    <small  style="color:<?php echo esc_attr($count_color ); ?>;"><?php echo esc_attr($team_desg ); ?></small>
                    <p style="color:<?php echo esc_attr($content_color); ?>;"><?php echo esc_html($content); ?></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <?php } ?>
            <div class="clearfix"></div>
        <!-- Element Code / END -->

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "digital_team_member",
    "name"      => __("Mayosis Team Member", 'mayosis-core'),
    "description"      => __("Mayosis Team Member", 'mayosis-core'),
    "class"     => "",
    "icon"      => get_template_directory_uri().'/images/DM-Symbol-64px.png',
    "category"  => __("Mayosis Elements", 'mayosis-core'),
    "params"    => array(
	 array(
                        'type' => 'textfield',
                        'heading' => __( 'Team Member Name', 'mayosis-core' ),
                        'param_name' => 'team_name',
                        'value' => __( 'S.R Shemul', 'mayosis-core' ),
                        'description' => __( 'Name of team member', 'mayosis-core' ),
                    ), 
	
				array(
                        'type' => 'textfield',
                        'heading' => __( 'Team Member Designation', 'mayosis-core' ),
                        'param_name' => 'team_desg',
                        'value' => __( 'Founder, CEO & Lead Designer', 'mayosis-core' ),
                        'description' => __( 'Designation of team member', 'mayosis-core' ),
                    ), 

	 		array(
                        'type' => 'attach_image',
                        'heading' => __( 'Member Image', 'mayosis-core' ),
                        'param_name' => 'member_image',
                        'description' => __( 'Upload member Photo', 'mayosis-core' ),
                    ), 
	
	
	array(
                        'type' => 'textarea_html',
                        'heading' => __( 'Details About Member', 'mayosis-core' ),
                        'param_name' => 'content',
                        'value' => __( 'The laziest person of the team. But loves to travel. When he sees in nature, he starts photoshopping in his head. Lives & breathes in Pixelll', 'mayosis-core' ),
                        'description' => __( 'Member Short Details', 'mayosis-core' ),
                    ),

        array(
            "type" => "dropdown",
            "heading" => __("Team Style", 'mayosis-core'),
            "param_name" => "style_team",
            "description" => __("Choose style of team", 'mayosis-core'),
            "value"      => array( 'Style One' => 'one', 'Style Two' => 'two' ), //Add default value in $atts
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
            "heading" => __("Color Of title", 'mayosis-core'),
            "param_name" => "title_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
	
		array(
            "type" => "colorpicker",
            "heading" => __("Color Of Designation", 'mayosis-core'),
            "param_name" => "count_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
        
        array(
            "type" => "colorpicker",
            "heading" => __("Color Of Content", 'mayosis-core'),
            "param_name" => "content_color",
            //"description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),
			"value" => '#ffffff',
			"group" => 'Style',
        ),
	array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mayosis-core' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'mayosis-core' ),
        ),

    )

));