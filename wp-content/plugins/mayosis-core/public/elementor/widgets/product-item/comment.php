<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_product_comment extends Widget_Base {

   public function get_name() {
      return 'mayosis-product-comment';
   }

   public function get_title() {
      return __( 'Mayosis Comment', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-product-elements' ];
	}
   public function get_icon() { 
        return 'eicon-comments';
   }

   protected function register_controls() {
        $this->start_controls_section(
			'mayosis_product_comment',
			[
				'label' => __( 'Product Comment Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
              
             $this->add_responsive_control(
                'product_comment_margin',
                [
                    'label' => __( 'Margin', 'mayosis-core' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .mayosis-single-pb-comment' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    ],
                    'separator' => 'before',
                ]
            );
			
     $this->end_controls_section();
     
     
     $this->start_controls_section(
			'other_style',
			[
				'label' => __( 'Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'tab_text_color',
			[
				'label' => __( 'Tab Text Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tabbable-line > .nav-tabs > li > a' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tab_text_hvr_color',
			[
				'label' => __( 'Tab Text Hover & Active Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tabbable-line > .nav-tabs > li > a.active,
					{{WRAPPER}} .tabbable-line > .nav-tabs > li > a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tab_nm_border',
			[
				'label' => __( 'Tab Border Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tabbable-line > .nav-tabs' => 'border-color: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'tab_nm_border_hvr',
			[
				'label' => __( 'Tab Border Hover Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nav-tabs .nav-link:hover' => 'border-color: {{VALUE}} !important',
				],
			]
		);
		
			$this->add_control(
			'tab_nm_border_active',
			[
				'label' => __( 'Tab Border Active Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tabbable-line > .nav-tabs > li > a.active' => 'border-color: {{VALUE}} !important',
				],
			]
		);
		
		
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'tab_typo',
				'label' => __( 'Tab Title Typography', 'plugin-domain' ),
				'selector' => '{{WRAPPER}} .tabbable-line > .nav-tabs > li > a',
			]
		);
		
		$this->end_controls_section();
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       
      ?>


<div class="mayosis-single-pb-comment">
 <?php
 if( Plugin::instance()->editor->is_edit_mode() ){
            ?>
              <h2 class="comment-appear-notification"><?php esc_html_e('Comment section will appear here','mayosis-core');?></h2>
        <?php }else{ ?>
              	
			
		  <div id="comment_box">
                  <?php if ( class_exists( 'EDD_Reviews' ) ) { ?>
                <div class="mayosis-review-tabs">
			      <div class="tabbable-line">
            
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item"><a href="#commentmain" class="nav-link active" role="tab" data-bs-toggle="tab">Comments</a></li>
                    <li class="nav-item"><a href="#mayosisreview" class="nav-link" role="tab" data-bs-toggle="tab">Customer Reviews</a></li>
                  </ul>
                    </div>
                  
                   <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="commentmain">
                        	<?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                    <?php comments_template(); ?>
                <?php } ?>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane" id="mayosisreview">
                        
                         <?php if ( class_exists( 'EDD_Reviews' ) ) {
								global $post;
								$user = wp_get_current_user();
								$user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );

								if ( ! edd_reviews()->is_review_status( 'disabled' ) ) {
								?>
								<div class="mayosis-review-section reviews-section">
									<div class="comments">
										<div class="comments-wrap">
										<?php
											edd_get_template_part( 'reviews' );
											if ( get_option( 'thread_comments' ) ) {
												edd_get_template_part( 'reviews-reply' );
											}
										?>
										</div>
									</div>
								</div>
							<?php } }?>
                    </div>
                   
                  </div>
                </div>
              
                
                <?php } else { ?>
                 
                 
                 <?php if ( comments_open() || '0' != get_comments_number() ) { ?>
                    <?php comments_template(); ?>
                <?php } ?>
							
							
			<?php } ?>
            </div>				
			
       <?php }
 ?>
</div>
	


      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_product_comment);
?>