<?php

/**
 * @author Teconcetheme
 * @since   1.0
 * @version 1.0
 */


if (!defined('ABSPATH')) exit; // Exit if accessed directly

class mayosis_popular_client_block extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'mayosis_popular_client_block';
    }

    public function get_title()
    {
        return esc_html__('Mayosis Client Image block', 'mayosis-core');
    }

    public function get_icon()
    {
        return 'eicon-photo-library';
    }

    public function get_categories()
    {
        return ['mayosis-ele-widgets-cat'];
    }

    protected function register_controls()
    {

        
        $this->start_controls_section(
			'client_block',
			[
				'label' => esc_html__( 'Client Image', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title', [
				'label' => esc_html__( 'Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title' , 'plugin-name' ),
				'label_block' => true,
			]
		);
	$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Client Image', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$this->add_control(
			'list',
			[
				'label' => esc_html__( 'Repeater List', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ list_title }}}',
			]
		);
		
			$this->add_control(
			'mx-title', [
				'label' => esc_html__( 'Title Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Our Satisfied Customer' , 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'mx-counnt', [
				'label' => esc_html__( 'Count Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '64K +' , 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'extra-title', [
				'label' => esc_html__( 'Extra Text', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'See More Reviews' , 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		
		$this->add_control(
			'progress_title', [
				'label' => esc_html__( 'Progress Title', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Satisfication Rate' , 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'progress_number', [
				'label' => esc_html__( 'Progress Number', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '92' , 'plugin-name' ),
				'label_block' => true,
			]
		);
		
		$this->add_control(
			'more_review_url', [
				'label' => esc_html__( 'More Review URL', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'label_block' => true,
			]
		);
		
		
			$this->add_control(
			'extra-desc', [
				'label' => esc_html__( 'Desciption', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( '' , 'plugin-name' ),
				'label_block' => true,
			]
		);
	$this->end_controls_section();
	
	$this->start_controls_section(
			'client_block_style',
			[
				'label' => esc_html__( 'Style', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .mayosis-pp-client-style-one',
			]
		);
		
		$this->add_responsive_control(
			'wh_box_padding',
			[
				'label' => esc_html__( 'Whole Box Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-client-style-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
			$this->add_responsive_control(
			'wh_box_border_radius',
			[
				'label' => esc_html__( 'Whole Box Border Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-client-style-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Image Border Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-a' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'msd_title_color',
			[
				'label' => esc_html__( 'Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-cl-header-title' => 'color: {{VALUE}}',
				],
			]
		);
		
			$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'msd_title_typography',
				'label' => esc_html__( 'Title Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mayosis-pp-cl-header-title',
			]
		);
		
		$this->add_control(
			'msd_client_cl_number',
			[
				'label' => esc_html__( 'Client Number Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-cl-count' => 'color: {{VALUE}}',
				],
			]
		);
		
			$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'msd_client_cl_typo',
				'label' => esc_html__( 'Client Number Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mayosis-pp-cl-count',
			]
		);
		
		$this->add_control(
			'extra_text_color',
			[
				'label' => esc_html__( 'Extra text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-client-ext-text' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'extra_text_typography',
				'label' => esc_html__( 'Extra text Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mayosis-pp-client-ext-text',
			]
		);
		
		
		$this->add_control(
			'msd_progress_title',
			[
				'label' => esc_html__( 'Progress Title Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mps_client_satifaction_title p' => 'color: {{VALUE}}',
				],
			]
		);
		
			$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'msd_progress_title_typ',
				'label' => esc_html__( 'Progress Title Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mps_client_satifaction_title p',
			]
		);
		
			$this->add_control(
			'msd_progress_perchantage',
			[
				'label' => esc_html__( 'Progress Perchantage Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mps_client_satifaction_perchantage p' => 'color: {{VALUE}}',
				],
			]
		);
		
			$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'msd_progress_perchantage_typ',
				'label' => esc_html__( 'Progress Perchantage Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mps_client_satifaction_perchantage p',
			]
		);
		
			$this->add_control(
			'progress_bar_bg',
			[
				'label' => esc_html__( 'Progressbar Background Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress-wrap .progress-bar' => 'background-color: {{VALUE}}',
				],
			]
		);
		
			$this->add_control(
			'progress_bar_bg_active',
			[
				'label' => esc_html__( 'Progressbar Background Active Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .progress' => 'background-color: {{VALUE}}',
				],
			]
		);
		
			$this->add_control(
			'desc_text_color',
			[
				'label' => esc_html__( 'Description text Color', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-ex-description' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'desc_text_typography',
				'label' => esc_html__( 'Description Typography', 'plugin-name' ),
				'selector' => '{{WRAPPER}} .mayosis-pp-ex-description',
			]
		);
		$this->add_responsive_control(
			'margin',
			[
				'label' => esc_html__( 'Image Grid Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .section-a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
			$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__( 'Description Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-pp-ex-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'sect_border',
				'selector' => '{{WRAPPER}} .section-a',
			]
		);
$this->end_controls_section();

}
	protected function render() {
		$settings = $this->get_settings_for_display();
		$extratitle = $settings['extra-title'];
		$mxtitle = $settings['mx-title'];
		$mxcount = $settings['mx-counnt'];
		$progressttl = $settings['progress_title'];
		$progressnmb = $settings['progress_number'];
		$desc = $settings['extra-desc'];
	if ( ! empty( $settings['more_review_url']['url'] ) ) {
			$this->add_link_attributes( 'more_review_url', $settings['more_review_url'] );
		}
		?>
		
		<div class="mayosis-pp-client-style-one has_mayosis_dark_alt_bg">
		    <div class="mayosis-pp-client_hd_part">
		        <div class="row">
		            <div class="col-12 col-md-6 has_char_anim">
		                <?php if ($mxtitle){ ?>
		                <h4 class="mayosis-pp-cl-header-title"><?php echo $mxtitle;?></h4>
 <?php } ?>
		            </div>
		            <?php if ($mxcount){?>
		              <div class="col-12 col-md-6 has_fade_anim">
		               <h5 class="mayosis-pp-cl-count"><?php echo $mxcount;?></h5>
		            </div>
		            <?php } ?>
		        </div>
		    </div>
		    <div class="stylish-svg-shape-icon medi-anim_two has_fade_anim stylish-svg-shape-icon-client-pp">
                            <svg width="64" height="73" viewBox="0 0 64 73" fill="none"><path d="M63.0024 13.9868C62.3159 11.5102 60.4943 9.1907 59.0734 7.08852C57.5855 4.88665 56.0072 2.73616 54.2822 0.718254C53.8368 0.198008 52.9605 0.532882 52.8106 1.12618C52.7822 1.21286 52.7694 1.30837 52.7411 1.39506C52.612 1.49651 52.4965 1.64676 52.4432 1.83233C51.5991 4.22078 50.6963 6.58611 49.9576 9.02416C49.5404 10.401 49.0461 11.878 48.7356 13.3566C48.3648 14.0505 48.0217 14.7499 47.7064 15.4548C47.4403 16.054 48.0648 16.5115 48.535 16.2235C48.5918 16.2866 48.6695 16.3307 48.7438 16.3627C48.6243 16.8293 48.4893 17.2871 48.3698 17.7538C48.1632 18.5205 49.3195 18.8174 49.5571 18.0684C50.2283 15.8593 50.8838 13.6413 51.5516 11.4199C51.6833 11.1864 51.8272 10.9494 51.9589 10.7159L52.0325 10.6035C52.3271 13.0836 52.5838 15.5216 52.2864 18.0869C51.9985 20.5446 51.3484 22.9712 50.413 25.2667C49.8214 26.5342 49.1744 27.7908 48.4341 28.9945C46.4152 32.2472 43.8177 35.1611 40.789 37.5114C40.1526 38.0031 39.4885 38.4893 38.7811 38.9613C37.7488 39.5364 36.6772 40.0174 35.5718 40.3764C35.8976 37.9608 35.9287 35.5218 35.4335 33.2156C34.6981 29.8067 31.4507 24.8477 27.3083 26.771C23.6652 28.464 21.5421 33.9395 22.6114 37.7025C23.8213 41.9257 28.5234 43.7226 32.5331 43.163C32.875 43.1207 33.2155 43.0263 33.5628 42.9563C32.875 48.7434 29.412 54.3933 25.7066 58.5076C22.8647 61.6731 19.4921 64.3421 15.77 66.4116C11.7973 68.6164 7.63445 69.7571 3.24857 70.8021C3.10263 70.8425 3.04116 70.9515 2.99524 71.0694C2.38167 71.0293 1.7458 70.9559 1.13086 70.8636C0.488223 70.7659 0.222906 71.7459 0.868927 71.8558C10.885 73.5461 20.898 68.8 27.0661 60.9552C30.0391 57.1753 32.2131 52.8286 33.6864 48.2689C33.729 48.1388 33.7715 48.0088 33.8019 47.8822C34.1963 46.8007 34.5197 45.6995 34.7478 44.5853C34.926 43.9053 35.0731 43.2077 35.2081 42.5134C37.3966 41.7623 39.4687 40.5442 41.3361 39.107C43.6744 37.5261 45.72 35.6453 47.1542 33.921C49.4644 31.1523 51.28 27.9691 52.4678 24.5527C54.6713 19.2256 55.6024 13.3712 54.9894 7.61626C54.9393 7.10467 54.5074 6.86967 54.1033 6.87659C54.2668 6.56854 54.4336 6.27269 54.6052 6.04121C55.1224 6.96196 55.6274 7.88608 56.0959 8.82032C57.1458 10.9071 57.785 13.4493 59.1362 15.3475C59.5242 15.8968 60.6574 15.7797 60.5592 14.953C60.5389 14.8798 60.5342 14.8154 60.5261 14.7389C60.7822 15.0488 61.0472 15.3432 61.3506 15.5876C61.8609 16.011 62.5764 15.6156 62.4857 14.9576C62.8438 14.8321 63.1397 14.4348 63.0247 14.02L63.0024 13.9868ZM33.6508 40.8169C33.0657 40.9265 32.4859 41.0084 31.896 41.0537C27.9944 41.2944 22.1486 37.9227 24.6246 33.2953C25.6263 31.428 27.789 30.395 29.7246 31.5663C31.4979 32.6249 32.5384 34.8194 33.0903 36.7158C33.4778 38.0666 33.6484 39.4381 33.6508 40.8169ZM31.6247 28.9245C33.4651 30.5557 34.1435 33.1922 34.2705 35.5873C33.9797 34.7746 33.6248 33.9665 33.1725 33.1854C31.5413 30.419 28.4244 28.5767 25.5759 30.2071C27.1032 28.0628 29.3261 26.8686 31.6247 28.9245ZM7.57797 70.8763C14.4423 69.2757 20.9742 65.153 25.8388 60.1656C21.3021 65.8635 14.7269 69.9719 7.57797 70.8763ZM53.554 9.52491C53.4593 9.18332 53.3315 8.86404 53.2125 8.52919C53.2827 8.40462 53.353 8.28006 53.4266 8.16769C53.4354 8.15212 53.4617 8.1054 53.4793 8.07426C53.5226 8.56145 53.5383 9.04318 53.5661 9.52154L53.554 9.52491ZM53.6453 4.4681L53.677 4.39361L53.6872 4.43021C53.6872 4.43021 53.6696 4.46136 53.6487 4.4803L53.6453 4.4681Z" fill="#704FE6"></path></svg>		                </div>
		    
		    <?php 	if ( $settings['list'] ) { ?>
		    <div class="mayosis-pp-client-image-box has_fade_anim">
		        <?php foreach (  $settings['list'] as $item ) { ?>
		        <span class="section-a"><img src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['list_title'];?>"></span>
		        <?php } ?>
		        <a <?php echo $this->get_render_attribute_string( 'more_review_url' ); ?>><span class="section-a msvsection-pp-arrow">
		            <i class="zil zi-arrow-right"></i>
		        </span></a>
		        <?php if($extratitle){?>
		        <span class="mayosis-pp-client-ext-text has_fade_anim"><?php echo ($extratitle); ?></span>
		        <?php } ?>
		    </div>
		    <?php if ($desc){?>
		    <div class="mayosis-pp-ex-description has_fade_anim">
		        <?php echo $desc;?>
		    </div>
		    <?php } ?>
		    <?php } ?>
		    
		    
		    <div class="d-flex mps_client_satifaction_rate has_fade_anim">
		        <?php if ($progressttl){ ?>
		        <div class="mps_client_satifaction_title">
		            <p><?php echo $progressttl;?></p>
		        </div>
		        <?php } ?>
		        <?php if ($progressnmb){ ?>
		        <div class="mps_client_satifaction_perchantage">
		            <p><?php echo $progressnmb;?>%</p>
		        </div>
		        <?php } ?>
		    </div>
		    
		    <div class="progress-wrap progress" data-progress-percent="<?php echo $progressnmb;?>">
  <div class="progress-bar progress"></div>
</div>
		
		</div>
			
	<?php	}

}
\Elementor\Plugin::instance()->widgets_manager->register(new \mayosis_popular_client_block());