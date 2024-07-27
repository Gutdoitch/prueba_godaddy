<?php

/**
 * @author Teconcetheme
 * @since   1.0
 * @version 1.0
 */

use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class mayosis_text_slider extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'mayosis_text_slider';
    }

    public function get_title()
    {
        return esc_html__('Mayosis Marquee Slider', 'Mayosis-core');
    }

    public function get_icon()
    {
        return 'teconce-custom-icon';
    }

    public function get_categories()
    {
        return ['mayosis-ele-widgets-cat'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'Mayosis-Logo-Content',
            [
                'label' => esc_html__('Mayosis Marquee Slider', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        
        	$this->add_control(
			'marquee_type',
			[
				'label' => esc_html__( 'Marquee Type', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					
					'image' => esc_html__( 'Image', 'textdomain' ),
					'text'  => esc_html__( 'Text', 'textdomain' ),
				
				],

			]
		);
		
		
			$this->add_control(
			'data_speed',
			[
				'label' => esc_html__( 'Marquee Speed', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => [
					
					'slow' => esc_html__( 'Slow', 'textdomain' ),
					'extraslow' => esc_html__( 'Extra Slow', 'textdomain' ),
					'slower' => esc_html__( 'Slower', 'textdomain' ),
					'medium'  => esc_html__( 'Medium', 'textdomain' ),
					'fast'  => esc_html__( 'Fast', 'textdomain' ),
					'faster'  => esc_html__( 'Faster', 'textdomain' ),
				
				],

			]
		);
		
		
		$this->add_control(
			'text_marquee_direction',
			[
				'label' => esc_html__( 'Marquee Direction', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					
					'left' => esc_html__( 'Left', 'textdomain' ),
					'right'  => esc_html__( 'Right', 'textdomain' ),
				
				],
				     'condition' => [
			'marquee_type' => 'text',
		],

			]
		);
		
		$this->add_control(
			'image_marquee_direction',
			[
				'label' => esc_html__( 'Marquee Direction', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [
					
					'top' => esc_html__( 'Top', 'textdomain' ),
					'bottom'  => esc_html__( 'Bottom', 'textdomain' ),
						
					
				
				],
				     'condition' => [
			'marquee_type' => 'image',
		],

			]
		);
		
	
		
		$repeater = new \Elementor\Repeater();
        

    $repeater->add_control(
			'rpt_image',
			[
				'label' => esc_html__( 'Choose Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
       
        $this->add_control(
            'image_list',
            [
                'label' => esc_html__('Image List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
			'marquee_type' => 'image',
		],
                'default' => [
                    [
                    ],
                    [
                    ],
                    [
                    ],
                ],
            ]
        );
		
		//Text Repeater

        $repeater = new \Elementor\Repeater();
        
         $repeater->add_control(
            'slide_text',
            [
                'label' => esc_html__('Slide Text', 'textdomain'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'label_block' => 'true',
                'default' => esc_html__('Professional Image', 'textdomain'),
                'placeholder' => esc_html__('Type your title here', 'textdomain'),
            ]
        );

        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Slide Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);
       
        $this->add_control(
            'list',
            [
                'label' => esc_html__('Repeater List', 'textdomain'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => [
			'marquee_type' => 'text',
		],
                'default' => [
                    [
                    ],
                    [
                    ],
                    [
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'Mayosis_Logo_Content',
            [
                'label' => esc_html__('Text Slide Style', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
       
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Title Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mayosis_text_slider ul li,
                    {{WRAPPER}} .mayosis_text_slider ul li span' => 'color: {{VALUE}}',
                ],
                	     'condition' => [
			'marquee_type' => 'text',
		],
            ]
        );
        
        $this->add_control(
            'text_color_bg',
            [
                'label' => esc_html__('Title Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mayosis_text_slider ul li' => 'background: {{VALUE}}',
                ],
                	     'condition' => [
			'marquee_type' => 'text',
		],
            ]
        );
        
        $this->add_responsive_control(
			'txt_p_padding',
			[
				'label' => esc_html__( 'Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],

				'selectors' => [
					'{{WRAPPER}} .mayosis_text_slider ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
					     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
		
		 $this->add_responsive_control(
			'txt_p_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],

				'selectors' => [
					'{{WRAPPER}} .mayosis_text_slider ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
					     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'txt_p_box_shadow',
				'selector' => '{{WRAPPER}} .mayosis_text_slider ul li',
					 'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
		
        
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .mayosis_text_slider ul li span',
					     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__('Title typography', 'textdomain'),
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .mayosis_text_slider ul li',
                
                	     'condition' => [
			'marquee_type' => 'text',
		],
            ]
        );
        
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mayosis_text_slider ul li i' => 'color: {{VALUE}}',
                    
                     '{{WRAPPER}} .mayosis_text_slider ul li svg,
                     {{WRAPPER}} .mayosis_text_slider ul li svg path' => 'stroke: {{VALUE}}',
                ],
                
                	     'condition' => [
			'marquee_type' => 'text',
		],
            ]
        );
        
        
        		$this->add_responsive_control(
			'gap_slide',
			[
				'label' => esc_html__( 'Gap Slider', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .scroller-x__list' => 'gap: {{SIZE}}{{UNIT}};',
				],
				
					     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
    
		$this->add_responsive_control(
			'gap_txt_icon',
			[
				'label' => esc_html__( 'Gap Between Text & Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis_text_slider ul li' => 'gap: {{SIZE}}{{UNIT}};',
				],
				
					     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
		$this->add_control(
			'icon_position_df',
			[
				'label' => esc_html__( 'List Icon Position', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					
					'row-reverse' => esc_html__( 'Left', 'textdomain' ),
					'right'  => esc_html__( 'Right', 'textdomain' ),
				
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis_text_slider ul li' => 'flex-direction: {{VALUE}};',
				],
				
							     'condition' => [
			'marquee_type' => 'text',
		],
			]
		);
		
		$this->add_control(
			'fade_anim_enable',
			[
				'label' => esc_html__( 'Scroll Animation', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'has_fade_anim',
				'options' => [
					
					'has_fade_anim' => esc_html__( 'Fade Anim', 'textdomain' ),
					'none_anim'  => esc_html__( 'None', 'textdomain' ),
				
				],
				
				
			]
		);
		
			$this->add_responsive_control(
			'img_slider_heigt',
			[
				'label' => esc_html__( 'Image Marquee Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					
				],
				'default' => [
					'unit' => 'px',
					'size' => 800,
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis-scroller-y' => 'height: {{SIZE}}{{UNIT}};',
				],
				
					     'condition' => [
			'marquee_type' => 'image',
		],
			]
		);
		$this->add_control(
            'img_slider_bgs',
            [
                'label' => esc_html__('Image Slider Background', 'textdomain'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mayosis-scroller-y' => 'background: {{VALUE}}',
                ],
                	     'condition' => [
			'marquee_type' => 'image',
		],
            ]
        );
        $this->add_responsive_control(
			'img_slider_padding',
			[
				'label' => esc_html__( 'Image Slider Padding', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis-scroller-y' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
					     'condition' => [
			'marquee_type' => 'image',
		],
			]
		);
		
		   $this->add_responsive_control(
			'img_slider_img_margin',
			[
				'label' => esc_html__( 'Image Slider Image Margin', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis-scroller-y img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
					     'condition' => [
			'marquee_type' => 'image',
		],
			]
		);
		
		$this->add_responsive_control(
			'img_slider_img_border_radius',
			[
				'label' => esc_html__( 'Image Slider Border radius', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'default' => [
					'top' => 0,
					'right' => 0,
					'bottom' => 0,
					'left' => 0,
					'unit' => 'em',
					'isLinked' => false,
				],
				'selectors' => [
					'{{WRAPPER}} .mayosis-scroller-y img,
					{{WRAPPER}} .mayosis-scroller-y' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				
					     'condition' => [
			'marquee_type' => 'image',
		],
			]
		);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $marquee_type = $settings['marquee_type'];
        $direction = $settings['image_marquee_direction'];
        $directiontext = $settings['text_marquee_direction'];
        $speed = $settings['data_speed'];
        $fade_anim = $settings['fade_anim_enable'];
        $count = 1;
        ?>
        
        <?php if ($marquee_type=="image"){ ?>
         <?php if ( $settings['image_list'] ) {?>
         
         
         <div class="scroller-y mayosis-scroller-y <?php echo $fade_anim; ?>" data-direction="<?php echo $direction;?>" data-speed="<?php echo $speed;?>" data-animated="true">
            <ul class="list list-row gap-4 scroller-y__list">
                  <?php foreach (  $settings['image_list'] as $item ) { ?>
        	 <li><img src="<?php echo $item['rpt_image']['url'];?>" alt="marquee_image"></li>
        	 <?php } ?>
            </ul>
        </div>
  

    
<?php } ?>

<?php } else { ?>

        <section class="st1-text_slider <?php echo $fade_anim; ?>">
            <!-- Text slider start  -->
            <?php if ( $settings['list'] ) {?>
          <div class="mayosis--textslider-area">
            <div class="mayosis--textslider-wrap">
             <div class="mayosis_text_slider scroller-x mayosis-scroller-x" data-speed="<?php echo $speed;?>" data-animated="true" data-direction="<?php echo $directiontext;?>">
                <ul class="scroller-x__list">
                    <?php foreach (  $settings['list'] as $item ) { ?>
                    <li><span><?php echo $item['slide_text'];?></span> <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?></li>
                    <?php } ?>
                    
                </ul>
              </div>
            </div>
          </div>
          <?php } ?>
          <!-- Text slider end -->
        </section>
        
        <?php } ?>
        <?php
    }

}

\Elementor\Plugin::instance()->widgets_manager->register(new \mayosis_text_slider());

