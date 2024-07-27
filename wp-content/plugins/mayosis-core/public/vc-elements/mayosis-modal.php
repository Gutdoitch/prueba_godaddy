<?php

if (!class_exists('WPBakeryShortCode')) return;
class WPBakeryShortCode_mayosis_modal extends WPBakeryShortCode

	{
	protected
	function content($atts, $content = null)
		{

		// $custom_css = $el_class = $title = $btn_a_icon = $output = $s_content = $number = '' ;

		$css = '';
		extract(shortcode_atts(array(
			"modal_content" => '',
			"modal_title" => '',
			'modal_id'=>'',
			'background' => '',
			'css' => ''
		) , $atts));
		$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class($css, ' ') , $this->settings['base'], $atts);
		/* ================  Render Shortcodes ================ */
		ob_start();
?>
     
        

        <!-- Element Code start -->
       
       
        <!-- Element Code / END -->
        <!-- Modal -->
  <div id="<?php echo esc_attr($modal_id); ?>" class="mayosis-overlay">
	<div class="mayosis-popup" style="background:<?php echo esc_attr($background); ?>">
		<h2><?php echo esc_attr($modal_title); ?></h2>
		<a class="close" href="#">&times;</a>
		<div class="popup-content">
		 <?php echo $content; ?>
		</div>
	</div>
</div>
         <?php
		echo $this->endBlockComment('mayosis_modal'); ?>

        <?php
		$output = ob_get_clean();
		/* ================  Render Shortcodes ================ */
		return $output;
		}
	}

vc_map(array(
	"base" => "mayosis_modal",
	"name" => __("Mayosis Modal", 'mayosis-core') ,
	"description" => __("Modal for popup", 'mayosis-core') ,
	"class" => "",
	"icon" => get_template_directory_uri() . '/images/DM-Symbol-64px.png',
	"category" => __("Mayosis Elements", 'mayosis-core') ,
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __("Modal Id", 'mayosis-core') ,
			"param_name" => "modal_id",

			// "description" => __("Enter a CSS class if required.", 'mayosis-core'),

			"value" => 'modal',
			"group" => 'General',
			),
			
			array(
			"type" => "textfield",
			"heading" => __("Modal Title", 'mayosis-core') ,
			"param_name" => "modal_title",

			// "description" => __("Enter a CSS class if required.", 'mayosis-core'),

			"value" => 'modal',
			"group" => 'General',
			),
	
	
	array(
			"type" => "textarea_html",
			"heading" => __("Modal Content", 'mayosis-core') ,
			"param_name" => "content",

			// "description" => __("Enter a CSS class if required.", 'mayosis-core'),

			"group" => 'General',
			),
	
		array(
			"type" => "colorpicker",
			"heading" => __("Background Color", 'mayosis-core') ,
			"param_name" => "background",

			// "description" => __("Accepts a FontAwesome value. (Ex. fa fa-thumbs-o-up)", 'mayosis-core'),

			"value" => '#ffffff',
			'group' => __('Style', 'mayosis-core') ,
		) ,
		array(
			'type' => 'css_editor',
			'heading' => __('Css', 'mayosis-core') ,
			'param_name' => 'css',
			'group' => __('Design options', 'mayosis-core') ,
		) ,
	)
));