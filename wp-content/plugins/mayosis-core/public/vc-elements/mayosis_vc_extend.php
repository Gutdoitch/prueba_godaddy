<?php
/*** Removing shortcodes ***/
vc_remove_element("vc_wp_search");
vc_remove_element("vc_wp_meta");
vc_remove_element("vc_wp_recentcomments");
vc_remove_element("vc_wp_calendar");
vc_remove_element("vc_wp_pages");
vc_remove_element("vc_wp_tagcloud");
vc_remove_element("vc_wp_custommenu");
vc_remove_element("vc_wp_text");
vc_remove_element("vc_wp_posts");
vc_remove_element("vc_wp_links");
vc_remove_element("vc_wp_categories");
vc_remove_element("vc_wp_archives");
vc_remove_element("vc_wp_rss");
vc_remove_element("vc_teaser_grid");
vc_remove_element("vc_button");
vc_remove_element("vc_cta_button");
vc_remove_element("vc_cta_button2");
vc_remove_element("vc_message");
vc_remove_element("vc_tour");
vc_remove_element("vc_accordion");
vc_remove_element("vc_tabs");
vc_remove_element("vc_progress_bar");
vc_remove_element("vc_pie");
vc_remove_element("vc_posts_slider");
vc_remove_element("vc_toggle");
vc_remove_element("vc_images_carousel");
vc_remove_element("vc_posts_grid");
vc_remove_element("vc_carousel");
vc_remove_element("vc_cta");
vc_remove_element("vc_round_chart");
vc_remove_element("vc_line_chart");
vc_remove_element("vc_tta_tour");


/*** Remove unused parameters ***/

vc_remove_param("vc_row", "font_color");
vc_remove_param("vc_row", "bg_image");
vc_remove_param("vc_row", "full_width");
vc_remove_param("vc_row", "equal_height");
vc_remove_param("vc_row", "parallax");
vc_remove_param("vc_row", "parallax_image");
vc_remove_param("vc_row", "parallax_speed_bg");
vc_remove_param("vc_row", "parallax_speed_video");
vc_remove_param("vc_row", "video_bg_parallax");
vc_remove_param("vc_row", "video_bg_url");
vc_remove_param("vc_row", "video_bg");
vc_remove_param('vc_row', 'columns_placement');
vc_remove_param('vc_row_inner', 'content_placement');


/*** Row ***/
/* VC settings */
/*-----------------------------------------------------------------------------------*/
/*	Add news params to vc_Row
/*-----------------------------------------------------------------------------------*/
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Top",
	"value" => "80",
	"param_name" => "padding_top",
	"description" => "Add Integer Value Without Px. If add value in Design options this will be Overwritten",
	
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Padding Bottom",
	"value" => "80",
	"param_name" => "padding_bottom",
	"description" => "Add Integer Value Without Px. If add value in Design options this will be Overwritten",
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Section Layout", 'mayosis-core'),
	"param_name" => "to_section_layout",
	"value" => array(
		__("Boxed", 'mayosis-core') => "boxed",
		__("Full width", 'mayosis-core') => "full-width",
		__("Post/Product Grid", 'mayosis-core') => "product-grid",
		),
	"description" => __("Choose the type of layout. In most of case you should use boxed layout.",'mayosis-core'),
	"dependency" => array("element" => "to_para_bg", "value" => array("no_bg","image","youtube","gradient-bg","single-color"))
));

vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	"heading" => __("Equal height columns", 'mayosis-core'),
	"param_name" => "to_equal_column",
	"value" => array("Equal Height"=>__("Equal Height", 'mayosis-core')),
	"description" => __("Check this option if you want to have all children columns at the same height", 'mayosis-core'),
));


vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Text alignment", 'mayosis-core'),
	"param_name" => "txt_section_align",
	"value" => array(
		__("Choose Alignment", 'mayosis-core') => "",
		__("Left", 'mayosis-core') => "text-left",
		__("Center", 'mayosis-core') => "text-center",
		__("Right", 'mayosis-core') => "text-right"
		),
	"description" => __("Choose the text alignment",'mayosis-core'),
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Top Section Decoration", 'mayosis-core'),
	"param_name" => "top_section_deco",
	"value" => array(
		"" => "",
		__("Slope Left", 'mayosis-core') => "slope-left",
		__("Slope Right", 'mayosis-core') => "slope-right",
		__("Rounded Outer", 'mayosis-core') => "rounded-outer",
		__("Rounded Inner", 'mayosis-core') => "rounded-inner",
		__("Triangle Outer", 'mayosis-core') => "triangle-outer",
		__("Triangle Inner", 'mayosis-core') => "triangle-inner",
		__("Arrow", 'mayosis-core') => "arrow",
		__("Circle", 'mayosis-core') => "circle",
		__("Clouds", 'mayosis-core') => "clouds",
		__("circle", 'mayosis-core') => "repeat-triangle",
		__("Triangle Pattern", 'mayosis-core') => "repeat-triangle",
		__("Half Circle Pattern", 'mayosis-core') => "repeat-circle",
		),
	"description" => __("If you want to style the section separator instead of a straight line, choose a decoration for the top section.",'mayosis-core'),
	"dependency" => array("element" => "to_para_bg", "value" => array("single-color"))
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Bottom Section Decoration", 'mayosis-core'),
	"param_name" => "bot_section_deco",
	"value" => array(
		"" => "",
		__("Slope Left", 'mayosis-core') => "slope-left",
		__("Slope Right", 'mayosis-core') => "slope-right",
		__("Rounded Outer", 'mayosis-core') => "rounded-outer",
		__("Rounded Inner", 'mayosis-core') => "rounded-inner",
		__("Triangle Outer", 'mayosis-core') => "triangle-outer",
		__("Triangle Inner", 'mayosis-core') => "triangle-inner",
		__("Arrow", 'mayosis-core') => "arrow",
		__("Circle", 'mayosis-core') => "circle",
		__("Clouds", 'mayosis-core') => "clouds",
		__("circle", 'mayosis-core') => "repeat-triangle",
		__("Triangle Pattern", 'mayosis-core') => "repeat-triangle",
		__("Half Circle Pattern", 'mayosis-core') => "repeat-circle",
		),
	"description" => __("If you want to style the section separator instead of a straight line, choose a decoration for the bottom section.",'mayosis-core'),
	"dependency" => array("element" => "to_para_bg", "value" => array("single-color"))
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Background Style", 'mayosis-core'),
	"param_name" => "to_para_bg",
	"value" => array(
		__("None", 'mayosis-core') => "no_bg",
		__("Single Color", 'mayosis-core') => "single-color",
		__("Gradient", 'mayosis-core') => "gradient-bg",
		__("Image", 'mayosis-core') => "image",
		__("Side Image", 'mayosis-core') => "side-image",
		__("YouTube Video", 'mayosis-core') => "youtube",
		__("Self hosted Video", 'mayosis-core') => "self",
		),
	"description" => __("Select what kind of background would you like to set for this row.", 'mayosis-core')
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video Link",
	"value" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"param_name" => "self_video_url",
	"description" => "Add Video Url",
	"dependency" => Array("element" => "to_para_bg", "value" => array("self")),
	
));
vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Video section height",
	"value" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"param_name" => "self_video_height",
	"description" => "Add Height(i.e 600)",
	"dependency" => Array("element" => "to_para_bg", "value" => array("self")),
	
));
vc_add_param('vc_row',array(
	"type" => "colorpicker",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Single background Color", 'mayosis-core'),
	"param_name" => "single_color_bg",
	"value" => "",
	"description" => __("Select Single Color.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("single-color")),
));
vc_add_param('vc_row',array(
	"type" => "colorpicker",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Gradient background Color A", 'mayosis-core'),
	"param_name" => "gradient_color_a",
	"value" => "",
	"description" => __("Select Gradient Color A.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("gradient-bg")),
));

vc_add_param('vc_row',array(
	"type" => "colorpicker",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Gradient background Color B", 'mayosis-core'),
	"param_name" => "gradient_color_b",
	"value" => "",
	"description" => __("Select Gradient Color B.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("gradient-bg")),
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => "Gradient Angle",
	"value" => "80",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"param_name" => "gradient_angle",
	"description" => "Add Integer Value Without Deg",
	"dependency" => Array("element" => "to_para_bg", "value" => array("gradient-bg")),
	
));

vc_add_param("vc_row", array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Parallax", 'mayosis-core'),
	"param_name" => "to_parallax",
	"value" => array(__("parallax", 'mayosis-core') => "parallax"),
	"description" => __("Check this box ",'mayosis-core'),
	"dependency" => array("element" => "to_para_bg", "value" => array("image")),
));	
vc_add_param('vc_row',array(
	"type" => "attach_image",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Background Image", 'mayosis-core'),
	"param_name" => "to_para_img",
	"description" => __("Upload or select background image from media gallery.", 'mayosis-core'),
	"dependency" => array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __('Layout options', 'mayosis-core'),
	"heading" => __("Side Image Position", 'mayosis-core'),
	"param_name" => "to_side_img_position",
	"value" => array(
			__("Left", 'mayosis-core') => "left",
			__("Right", 'mayosis-core') => "right",
		),
	"description" => __("Choose the image position in the row (left or right position)",'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image")),
));
vc_add_param('vc_row',array(
	"type" => "dropdown",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Background Image Repeat", 'mayosis-core'),
	"param_name" => "to_para_img_repeat",
	"value" => array(
			__("No Repeat", 'mayosis-core') => "no-repeat",
			__("Repeat", 'mayosis-core') => "repeat",
		),
	"description" => __("Options to control repeatation of the background image.",'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Background Blur", 'mayosis-core'),
	"param_name" => "to_para_blur",
	"value" => array("blur"=>__("blur", 'mayosis-core')),
	"description" => __("Check this option if you want to apply a blur effect on your image.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("side-image","image")),
));
vc_add_param('vc_row',array(
	"type" => "attach_image",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Placehoder Image for the video", 'mayosis-core'),
	"param_name" => "to_para_poster",
	"value" => "",
	"description" => __("Select the placehoder image that will be display while video is loading.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("self","youtube")),
));

vc_add_param('vc_row',array(
	"type" => "textfield",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Youtube URL", 'mayosis-core'),
	"param_name" => "to_para_youtube_url",
	"value" => "",
	"description" => __("Enter YouTube url. Example - YouTube (https://www.youtube.com/watch?v=LjCzPp-MK48) ", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("youtube")),
));

vc_add_param('vc_row',array(
	"type" => "checkbox",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Background Overlay", 'mayosis-core'),
	"param_name" => "to_para_over_set",
	"value" => array("overlay"=>__("overlay", 'mayosis-core')),
	"description" => __("Hide or Show overlay on background images.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_bg", "value" => array("image","self","youtube")),
));
vc_add_param('vc_row',array(
	"type" => "attach_image",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Overlay Background Pattern", 'mayosis-core'),
	"param_name" => "to_para_over_img",
	"value" => "",
	"description" => __("Upload or select background pattern overlay from media gallery.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));
vc_add_param('vc_row',array(
	"type" => "colorpicker",
	"class" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Overlay Color", 'mayosis-core'),
	"param_name" => "to_para_over_color",
	"value" => "",
	"description" => __("Select color for background overlay.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));
vc_add_param('vc_row',array(
	"type" => "textfield",
	"class" => "",
	"value" => "0.8",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Overlay Opacity", 'mayosis-core'),
	"param_name" => "to_para_over_opacity",
	"description" => __("Set an opacity to the background overlay.", 'mayosis-core'),
	"dependency" => Array("element" => "to_para_over_set", "value" => array("overlay")),
));

vc_add_param('vc_row',array(
	"type" => "textfield",
	"class" => "",
	"value" => "",
	'group' => __( 'Mayosis Options', 'mayosis-core'),
	"heading" => __("Z Index", 'mayosis-core'),
	"param_name" => "z_index_custom",
	"description" => __("Set a z index value.", 'mayosis-core'),
));
