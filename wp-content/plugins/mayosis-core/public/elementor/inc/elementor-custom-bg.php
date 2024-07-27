<?php

if (!defined('ABSPATH')) exit;

use Elementor\Controls_Manager;

class Mayosis_custom_bg {

	public function __construct() {
		add_action('elementor/frontend/section/before_render', array($this, 'before_render'), 1);
		add_action('elementor/frontend/column/before_render', array($this, 'before_render'), 1);
		add_action('elementor/frontend/container/before_render', array($this, 'before_render'), 1);
		add_action('elementor/element/section/section_layout/after_section_end', array($this, 'register_controls'), 1);
		add_action('elementor/element/section/section_layout/after_section_end', array($this, 'register_controls'), 1);
		add_action('elementor/element/container/section_layout_container/after_section_end', array($this, 'register_controls'), 1);
		add_action('elementor/element/column/layout/after_section_end', array($this, 'register_controls'), 1);
		add_action('elementor/element/container/layout/after_section_end', array($this, 'register_controls'), 1);
		
		
		//add_action( 'elementor/section/print_template', array ($this, '_print_template'), 10,2);
		//add_action( 'elementor/column/print_template', array($this, '_print_template'), 10,2);
	}

	public function register_controls($element) {


			$element->start_controls_section(
				'mayosis_code_bg_section',
				[
					'label' => __( 'Mayosis :: Custom Options', 'mayosis-core' ),
					'tab'   => Controls_Manager::TAB_STYLE
				]
			);
			
				$element->add_control(
			'mayosis_darkmode_enabled',[
				'label' => esc_html__( 'Dark Mode Type', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'dark'  => esc_html__( 'Dark', 'plugin-name' ),
					'dark-alt' => esc_html__( 'Dark Alter Color', 'plugin-name' ),
					'dark-sec' => esc_html__( 'Dark Alter Color', 'plugin-name' ),
					'none' => esc_html__( 'None', 'plugin-name' ),
				],
		]
		);
		
				$element->add_control(
			'mayosis_darkmode_inner',[
				'label' => esc_html__( 'Dark Mode Inner Background', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'enable'  => esc_html__( 'Enable', 'plugin-name' ),
					'none' => esc_html__( 'None', 'plugin-name' ),
				],
		]
		);
		
			$element->add_control(
			'mayosis_custombg_enabled', [
				'label'        => __( 'Enable Code Background', 'mayosis-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'mayosis-core' ),
				'label_off'    => __( 'No', 'mayosis-core' ),
				'return_value' => 'yes',
			]
		);
		
			$element->add_control(
			'mayosis_thumbnail_enabled', [
				'label'        => __( 'Featured Image', 'mayosis-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'mayosis-core' ),
				'label_off'    => __( 'No', 'mayosis-core' ),
				'return_value' => 'yes',
			]
		);
        $element->add_control(
        			'custom_bg',
        			[
        				'label' => __( 'Custom HTML', 'plugin-domain' ),
        				'type' => \Elementor\Controls_Manager::CODE,
        				'language' => 'html',
        				'rows' => 20,
        				'condition'   => [
					'mayosis_custombg_enabled'     => 'yes',
				],
        			]
        		);
        		
        		
        			$element->add_control(
			'mayosis_animattion_enabled',[
				'label' => esc_html__( 'Mayosis Animation', 'plugin-name' ),
				'description' => esc_html__( 'Make sure its Enabled from Theme options advanced settings', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'no_anim',
				'options' => [
					'has_fade_anim'  => esc_html__( 'Fade Animation', 'plugin-name' ),
					'has_text_move_anim' => esc_html__( 'Text Move Animation', 'plugin-name' ),
					'img_anim_group_scale' => esc_html__( 'Image Group Scale', 'plugin-name' ),
						'no_anim' => esc_html__( 'None', 'plugin-name' ),
	
				],
		]
		);

		

			$element->end_controls_section();
	}

	public function before_render($element) {
		$settings = $element->get_settings();

		$custom_code_enable = $settings['mayosis_custombg_enabled'];
		$mayosis_thumbnail_enabled = $settings['mayosis_thumbnail_enabled'];
		$mayosis_darkmode_enabled = $settings['mayosis_darkmode_enabled'];
		$mayosis_animattion_enabled = $settings['mayosis_animattion_enabled'];
		$mayosis_darkmode_inner= $settings['mayosis_darkmode_inner'];
		global $post;
		 $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		
		if ($mayosis_darkmode_inner=="enable"){
		    $element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_elementor_inner_bg',
	]);
		}
		
		
		
		if ( $mayosis_darkmode_enabled == 'dark' ) {
		    		$element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_dark_bg',
	]);
		} elseif($mayosis_darkmode_enabled == 'dark-alt' ){
		    	$element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_dark_alt_bg',
	]);
		} elseif($mayosis_darkmode_enabled == 'dark-sec' ){
		    	$element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_dark_sec_bg',
	]);
		}
		
			    		$element->add_render_attribute( '_wrapper', [
		'class' => $mayosis_animattion_enabled,
	]);
		

		if ( $custom_code_enable == 'yes' ) {
		    	$custom_code = $settings['custom_bg'];
		$element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_custom_bg',
		'style' => $custom_code,
	] );
		} elseif ($mayosis_thumbnail_enabled =='yes'){
		    
		      global $post;
		    $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$custom_code = 'background:url('.$feat_image.');';
		$element->add_render_attribute( '_wrapper', [
		'class' => 'has_mayosis_custom_bg_thumbnail',
		'style' => $custom_code,
	] );
		    
		}

		
		
	
	}
	
	
		function _print_template( $template, $widget ) {
		if ( $widget->get_name() != 'section' && $widget->get_name() != 'column' ) {
			return $template;
		}

		$old_template = $template;
		ob_start();
		?>
		

<#
if ( settings.mayosis_custombg_enabled ) {
		var html = '<div class="mayosis-custom-bg-wrapper" style="' + settings.custom_bg + '">';

		

		html += '</div>';

		print( html );
		}
		#>
		
        
		<?php
		$custombg_content = ob_get_contents();
		ob_end_clean();
		$template = $custombg_content . $old_template;

		return $template;
	}
}
