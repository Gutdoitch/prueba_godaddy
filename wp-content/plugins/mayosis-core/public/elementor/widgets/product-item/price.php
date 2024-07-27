<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_price extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-price';
   }

   public function get_title() {
      return __( 'Mayosis Product Price', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-product-price';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_price',
			[
				'label' => __( 'Product Price Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
            
              $this->add_responsive_control(
                'product_price_align',
                [
                    'label'        => __( 'Alignment', 'mayosis-core' ),
                    'type'         => Controls_Manager::CHOOSE,
                    'options'      => [
                        'left'   => [
                            'title' => __( 'Left', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => __( 'Right', 'mayosis-core' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'prefix_class' => 'elementor-align-%s',
                    'default'      => 'left',
                ]
            );
            
              $this->add_group_control(
                Group_Control_Typography::get_type(),
                array(
                    'name'      => 'product_title_typography',
                    'label'     => __( 'Typography', 'mayosis-core' ),
                    'selector'  => '{{WRAPPER}} .mayosis-single-pb-price,{{WRAPPER}} .mayosis-single-pb-price h4',
                )
            );
            
            
            $this->add_control(
                'product_price_color',
                [
                    'label'     => __( 'Price Color', 'mayosis-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-pb-price,{{WRAPPER}} .mayosis-single-pb-price h4' => 'color: {{VALUE}} !important;',
                    ],
                ]
            );
            
             $this->add_responsive_control(
                'product_price_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-pb-price h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
			
     $this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $download_id = get_the_ID();
       global $post;
       $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );		
																
                                               
                                    if ($envato_item_id){
                                                     $personal_token= envatoapi();
                                                    //set header for API
                                                    $personal_token   = 'Bearer ' .$personal_token;
                                                    $api_header   = array();
                                                    $api_header[] = 'Content-length: 0';
                                                    $api_header[] = 'Content-type: application/json; ch_themearset=utf-8';
                                                    $api_header[] = 'Authorization: ' . $personal_token;
                                                   
                                                    $item_id = $envato_item_id;
                                                    $api_url = 'https://api.envato.com/v3/market/catalog/item?id='.$item_id;
                                                    
                                                    //START GET DATA FROM API
                                                    $api_init_item = curl_init();
                                                    
                                                    curl_setopt($api_init_item, CURLOPT_URL, $api_url );
                                                    curl_setopt( $api_init_item, CURLOPT_HTTPHEADER, $api_header );
                                                    curl_setopt( $api_init_item, CURLOPT_SSL_VERIFYPEER, false );
                                                    curl_setopt($api_init_item, CURLOPT_RETURNTRANSFER, 1);
                                                    curl_setopt( $api_init_item, CURLOPT_CONNECTTIMEOUT, 5 );
                                                    curl_setopt( $api_init_item, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
                                                    
                                                    $api_item_results = curl_exec($api_init_item);
                                                    $api_item_results = json_decode($api_item_results, true);
                                                    $item_price = $api_item_results['price_cents'];
                                                     $item_url = $api_item_results['url'];
                                                     
                                    }
      ?>


<div class="mayosis-single-pb-price">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){ 
  $download_id_inner =  mayosis_get_last_product_id();

 ?>
           <h4>
               <?php
				if(edd_has_variable_prices($download_id_inner)){
					echo edd_price_range( $download_id_inner );
				}
				else{
					edd_price($download_id_inner);
				}
					?>
           </h4>
            
        <?php }else{ ?>
        
         <?php if ($envato_item_id) { ?>
			    <h4><?php esc_html_e('$','mayosis-core');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></h4>
			    <?php } else { ?>
           <h4>
               <?php
				if(edd_has_variable_prices($download_id)){
					echo edd_price_range( $download_id );
				}
				else{
					edd_price($download_id);
				}
					?>
           </h4>
        <?php }
 ?>
 
  <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_price);
?>