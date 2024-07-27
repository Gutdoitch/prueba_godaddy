<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_changelog extends Widget_Base {

   public function get_name() {
      return 'mayosis-changelog';
   }

   public function get_title() {
      return __( 'Mayosis Changelog', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-radio';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_changelog',
			[
				'label' => __( 'Changelog Date', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			$this->add_control(
			'changelog_version',
			[
				'label' => __( 'Release Version', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'V2.3', 'mayosis-core' ),
			]
		);
		
		$this->add_control(
			'changelog_date',
			[
				'label' => __( 'Release Date', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '10/12/2020', 'mayosis-core' ),
			]
		);

$this->end_controls_section();
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Changelog Content', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
     $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'changelog_title', [
				'label' => __( 'Changelog Title', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Changelog Title' , 'mayosis-core' ),
				'label_block' => true,
			]
		);
		
		$repeater->add_control(
			'changelog_badge', [
				'label' => __( 'Changelog Badge', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Changelog Badge' , 'mayosis-core' ),
				'label_block' => true,
			]
		);

        $repeater->add_control(
			'change_log_style',
			[
				'label' => __( 'Badge Style', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'new',
				'options' => [
					'new'  => __( 'New', 'plugin-domain' ),
					'update' => __( 'Update', 'plugin-domain' ),
					'added' => __( 'Added', 'plugin-domain' ),
					'fixed' => __( 'Fixed', 'plugin-domain' ),
					'custom' => __( 'Custom', 'plugin-domain' ),
				],
			]
		);
		$repeater->add_control(
			'changelog_color',
			[
				'label' => __( 'Label Background Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .mayosis-changelog-badge' => 'background: {{VALUE}}'
				],
				
				
            'condition' => [
                    'change_log_style' => array('custom'),
                ],
			]
		);
		
		$repeater->add_control(
			'changelog_text_color',
			[
				'label' => __( 'Label Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .mayosis-changelog-badge' => 'color: {{VALUE}}'
				],
				
				 'condition' => [
                    'change_log_style' => array('custom'),
                ],
			]
		);

		$this->add_control(
			'changelog',
			[
				'label' => __( 'Repeater changelog', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'changelog_title' => __( 'Add a new feature', 'mayosis-core' ),
						'changelog_badge' => __( 'New', 'mayosis-core' ),
				
					],
					[
						'changelog_title' => __( 'New software version Available', 'mayosis-core' ),
						'changelog_badge' => __( 'Updated', 'mayosis-core' ),
					],
				],
				'title_field' => '{{{ changelog_title }}}',
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
          'style_section',
            	[
            		'label' => __( 'Style Section', 'mayosis-core' ),
            		'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            	]
            );
            
            
		
            $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'changelog_background',
				'label' => __( 'Background', 'mayosis-core' ),
				'types' => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .mayosis-changelog-item',
			]
		);
            $this->add_responsive_control(
            			'changelog_padding',
            			[
            				'label' => __( 'Changelog Padding', 'mayosis-core' ),
            				'type' => Controls_Manager::DIMENSIONS,
            				'size_units' => [ 'px', '%', 'em' ],
            				'selectors' => [
            					'{{WRAPPER}} .mayosis-changelog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            				],
            			]
            		);
            		
            		$this->add_responsive_control(
            			'changelog_margin',
            			[
            				'label' => __( 'Changelog Margin', 'mayosis-core' ),
            				'type' => Controls_Manager::DIMENSIONS,
            				'size_units' => [ 'px', '%', 'em' ],
            				'selectors' => [
            					'{{WRAPPER}} .mayosis-changelog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            				],
            			]
            		);
            		
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'changelog_border',
				'label' => __( 'Changelog Border', 'mayosis-core' ),
				'selector' => '{{WRAPPER}} .mayosis-changelog-item',
			]
		);
		
		$this->add_responsive_control(
            			'changelog_border_radius',
            			[
            				'label' => __( 'Changelog Border Radius', 'mayosis-core' ),
            				'type' => Controls_Manager::DIMENSIONS,
            				'size_units' => [ 'px', '%' ],
            				'selectors' => [
            					'{{WRAPPER}} .mayosis-changelog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            				],
            			]
            		);
            		
        $repeater->add_control(
			'changelog_list_color',
			[
				'label' => __( 'List Text Color', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#28375a',
				'selectors' => [
					'{{WRAPPER}} .mayosis-changelog-item li' => 'color: {{VALUE}}'
				],
			]
		);
		
		$this->add_control(
			'changelog_style',
			[
				'label' => __( 'Changelog Box Style', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'mayosis-core' ),
					'fixed' => __( 'Fixed', 'mayosis-core' ),
				],
			]
		);
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
      ?>


<div class="mayosis-changelog">
    <h5 class="mayosis-changelog-title"><span class="mayosis-changelog-version"><?php echo $settings['changelog_version']; ?></span>- <?php echo $settings['changelog_date']; ?></h5>
   <?php if ( $settings['changelog'] ) {
			echo '<ul class="mayosis-changelog-item mayosis-changelog-'. $settings['changelog_style'] . '">';
			foreach (  $settings['changelog'] as $item ) {
				echo '<li class="elementor-repeater-item-' . $item['_id'] . '">' . $item['changelog_title'] . '<span class="mayosis-changelog-badge '.$item['change_log_style'].'">'; if($item['changelog_badge']){echo  $item['changelog_badge'];} else { echo $item['change_log_style'];}
				 '</span></li>';
			}
			echo '</ul>';
		}
		?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_changelog);
?>