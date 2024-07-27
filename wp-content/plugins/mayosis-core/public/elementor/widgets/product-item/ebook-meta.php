<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_ebook_meta extends Widget_Base {

   public function get_name() {
      return 'mayosis-ebook-meta';
   }

   public function get_title() {
      return __( 'Mayosis eBook Meta', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-meta';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_ebook_meta',
			[
				'label' => __( 'Product eBook Meta Options', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
			
			
	$this->add_control(
			'select_meta',
			[
				'label' => __( 'Select Meta Items', 'mayosis-core' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [
					'asin' => __( 'ASIN', 'mayosis-core' ),
					'isbn' => __( 'ISBN', 'mayosis-core' ),
					'publisher'  => __( 'Publisher', 'mayosis-core' ),
					'date'  => __( 'Publication Date', 'mayosis-core' ),
					'size'  => __( 'File Size', 'mayosis-core' ),
					'language'  => __( 'Language', 'mayosis-core' ),
					'pleangth'  => __( 'Print length', 'mayosis-core' ),
				],
				'default' => [ 'date', 'asin' ],
			]
		);
		
		$this->add_control(
			'msv_style',
			[
				'label' => __( 'Style', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'plugin-domain' ),
					'block' => __( 'Block', 'plugin-domain' ),
				],
			]
		);

		$this->add_responsive_control(
                'product_meta_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'fa fa-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-p-meta' => 'text-align: {{VALUE}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_meta_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mvs-ebook-meta li',
                )
            );
            
               $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_meta_ttl_typo',
                    'label'     => __( 'Title Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mvs-ebook-meta li .msv-e-ttl-b',
                )
            );
            
             $this->add_control(
                'product_meta_color',
                [
                    'label'     => __( 'Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mvs-ebook-meta li' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
             $this->add_control(
                'product_span_color',
                [
                    'label'     => __( 'Dot Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mvs-ebook-meta li .msv-meta-dot' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'product_metahvr_color',
                [
                    'label'     => __( 'Links Hover Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mvs-ebook-meta li:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.
       global $post;
       $settings = $this->get_settings();
       $metas = $settings['select_meta'];
       $mvs_id_inner =  mayosis_get_last_product_id();
       $msvstyle = $settings['msv_style'];
       if ($msvstyle=="block"){
           $mesclass= 'block-style-e-book-box';
       } else {
           $mesclass= '';
       }
      ?>


<div class="mayosis-single-eBook-meta <?php echo esc_html($mesclass);?>">
    <?php  if( Plugin::instance()->editor->is_edit_mode() ){ ?>
    
    <ul class="mvs-ebook-meta">
    <?php
    foreach ( $metas as $meta ) {
		  switch($meta) {
		      case 'asin':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">ASIN</span> <span class="msv-meta-dot">:</span> B082HT291W</li>';
            break;
            
            case 'isbn':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">ISBN</span> <span class="msv-meta-dot">:</span>978-3-16-148410-0</li>';
            break;
            
            
            case 'publisher':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Publisher</span><span class="msv-meta-dot">:</span>John Doe</li>';
            break;
            
            case 'date':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Publication Date</span> <span class="msv-meta-dot">:</span>John Doe</li>';
            break;
            
            case 'size':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">File Size</span> <span class="msv-meta-dot">:</span>356KB</li>';
            break;
            
            case 'language':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Language</span> <span class="msv-meta-dot">:</span>English</li>';
            break;
            
             case 'pleangth':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Print Length</span> <span class="msv-meta-dot">:</span> 332 pages</li>';
            break;
        
		  }
		}
		
		?>
    </ul>
    <?php } else { ?>
    <?php
       $asin = get_post_meta($post->ID, 'm_asin', true);
       $isbn = get_post_meta($post->ID, 'm_isbn', true);
       $pbls = get_post_meta($post->ID, 'm_publisher', true);
       $pbdte = get_post_meta($post->ID, 'm_pbdate', true);
       $pblng = get_post_meta($post->ID, 'm_language', true);
       $pblength = get_post_meta($post->ID, 'm_pleanth', true);
       $pbsize = get_post_meta($post->ID, 'file_size', true);
       
    ?>
   <ul class="mvs-ebook-meta">
    <?php
    foreach ( $metas as $meta ) {
		  switch($meta) {
		      case 'asin':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">ASIN</span> <span class="msv-meta-dot">:</span>'. $asin . '</li>';
            break;
            
            
            case 'isbn':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">ISBN</span> <span class="msv-meta-dot">:</span>'. $isbn . '</li>';
            break;
            
            
            case 'publisher':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Publisher</span> <span class="msv-meta-dot">:</span>'. $pbls . '</li>';
            break;
            
             
            case 'date':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Publication Date</span> <span class="msv-meta-dot">:</span>'. $pbdte . '</li>';
            break;
            
            case 'size':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">File Size</span> <span class="msv-meta-dot">:</span>'. $pbsize . '</li>';
            break;
            
             
            case 'language':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Language</span> <span class="msv-meta-dot">:</span>'. $pblng . '</li>';
            break;
            
             
            case 'pleangth':echo '<li class="mvs-li-item-ebook"><span class="msv-e-ttl-b">Print Length</span> <span class="msv-meta-dot">:</span>'. $pblength . '</li>';
            break;
            
        
		  }
		}
		
		?>
    </ul>
<?php }?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_ebook_meta);
?>