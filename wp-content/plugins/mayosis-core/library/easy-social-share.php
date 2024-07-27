<?php
/*
 * Easy Social Share Buttons for WordPress - Custom files for Mayosis
 */

add_action('init', 'mayosis_custom_methods_register', 99);

add_filter('essb4_button_positions', 'mayosis_display_mycustom_position');
add_filter('essb4_button_positions_mobile', 'mayosis_display_mycustom_position');
add_filter('essb4_custom_positions', 'mayosis_display_register_mycustom_position');
add_filter('essb4_custom_method_list', 'mayosis_register_mycustom_position');

function mayosis_register_mycustom_position($methods) {
	$methods['mayosis_sidebar'] = __('Mayosis Vertical Float', 'mayosis-core');
	$methods['mayosis_products'] = __('Mayosis Product Bredcrumb', 'mayosis-core');
	$methods['mayosis_pbottom'] = __('Mayosis Product Bottom', 'mayosis-core');
	$methods['mayosis_photo'] = __('Mayosis Photo Template', 'mayosis-core');
	$methods['mayosis_productoverlay'] = __('Mayosis Grid Overlay', 'mayosis-core');
	return $methods;
}


function mayosis_custom_methods_register() {
    if (is_admin()) {
        if (class_exists('ESSBOptionsStructureHelper')) {
            essb_prepare_location_advanced_customization('where', 'positions|mayosis_sidebar', 'mayosisfloatingposition');
            essb_prepare_location_advanced_customization('where', 'positions|mayosis_products', 'mayosisproductbreadcrumb');
            essb_prepare_location_advanced_customization('where', 'positions|mayosis_pbottom', 'mayosisproductbottom');
            essb_prepare_location_advanced_customization('where', 'positions|mayosis_photo', 'mayosisphoto');
            essb_prepare_location_advanced_customization('where', 'positions|mayosis_productoverlay', 'mayosisoverlay');
        }
    }
}

function mayosis_display_register_mycustom_position($positions) {
	$positions['mayosisfloatingposition'] = __('Mayosis Floating', 'mayosis-core');
	$positions['mayosisproductbreadcrumb'] = __('Mayosis Breadcrumb', 'mayosis-core');
	$positions['mayosisproductbottom'] = __('Mayosis Product Bottom', 'mayosis-core');
	$positions['mayosisphoto'] = __('Mayosis Photo Template', 'mayosis-core');
	
	$positions['mayosisoverlay'] = __('Mayosis Grid Overlay', 'mayosis-core');
}


function mayosis_display_mycustom_position($positions) {
	
	$positions['mayosisfloatingposition'] = array ("image" => "assets/images/display-positions-09.png", "label" => __("Mayosis FLoating Position", "essb") );
	$positions['mayosisproductbreadcrumb'] = array ("image" => "assets/images/display-positions-09.png", "label" => __("Mayosis Product Breadcrumb", "essb") );
	
		$positions['mayosisproductbottom'] = array ("image" => "assets/images/display-positions-09.png", "label" => __("Mayosis Product Bottom", "essb") );
	$positions['mayosisphoto'] = array ("image" => "assets/images/display-positions-09.png", "label" => __("Mayosis Photo Template", "essb") );
	
	$positions['mayosisoverlay'] = array ("image" => "assets/images/display-positions-09.png", "label" => __("Mayosis Grid Overlay", "essb") );
	
	return $positions;
}



if (!function_exists('mayosis_draw_custom_position')) {
	function mayosis_draw_custom_position($position) {
		if (function_exists('essb_core')) {
			$general_options = essb_core()->get_general_options();
			
			if (is_array($general_options)) {
				if (in_array($position, $general_options['button_position'])) {
					echo essb_core()->generate_share_buttons($position);
				}
			}
		}
	}
}

add_filter('essb4_templates', 'mayosis_social_template_initialze');

function mayosis_social_template_initialze($templates) {
	$templates['1002'] = 'Mayosis Sidebar Template';	
	return $templates;
}

add_filter('essb4_templates_class', 'mayosis_mytemplate_class', 10, 2);

function mayosis_mytemplate_class($class, $template_id) {
	if ($template_id == '1002') {
		$class = 'mayosis-essvb-template';
	}
	
	return $class;
}

 
// //////////////////////////////////////////////////////////////////////////////////////////
// ////////////////////  Product Slider Overlay /////////////////////////////////////////
// /////////////////////////////////////////////////////////////////////////////////////////

function mayosis_productsliderOverlay_social() {

    $dmsocialURL = urlencode(get_permalink());

    // Get current page title
    $dmsocialTitle = urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8'));


    // Construct sharing URL without using any script
    $twitterURL = 'https://twitter.com/share?url=' . $dmsocialURL . '&amp;text=' . $dmsocialTitle;
    $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$dmsocialURL;
    $googleURL = 'https://plus.google.com/share?url='.$dmsocialURL;
    $bufferURL = 'https://bufferapp.com/add?url='.$dmsocialURL.'&amp;text='.$dmsocialTitle;
    $whatsappURL = 'whatsapp://send?text='.$dmsocialTitle . ' ' . $dmsocialURL;
    $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$dmsocialURL.'&amp;title='.$dmsocialTitle;

    // Based on popular demand added Pinterest too
    $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$dmsocialURL.'&amp;description='.$dmsocialTitle;
    ?>
    <div class="overlay-social-button">
        <a href="<?php echo $facebookURL; ?>" onclick="window.open(this.href, 'facebookwindow','left=20,top=20,width=500,height=400,toolbar=0,resizable=1'); return false;" class="facebook"><i class="zil zi-facebook"></i> <span>Facebook</span></a>


        <a href="<?php echo $twitterURL; ?>"  onclick="window.open(this.href, 'twitterwindow','left=20,top=20,width=500,height=400,toolbar=0,resizable=1'); return false;" class="twitter"><i class="zil zi-twitter"></i> <span>Twitter</span></a>

        

        <a href="<?php echo $pinterestURL; ?>" onclick="window.open(this.href, 'pinterestwindow','left=20,top=20,width=500,height=400,toolbar=0,resizable=1'); return false;" class="pinterest"><i class="zil zi-pinterest"></i> <span>Pinterest</span></a>

    </div>


<?php }
