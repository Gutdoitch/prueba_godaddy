<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class mayosis_edd_login_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-edd-login';
   }

   public function get_title() {
      return __( 'Mayosis Login', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-elementor';
   }

   protected function register_controls() {

      $this->add_control(
         'section_edd_login',
         [
            'label' => __( 'mayosis EDD Login', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      $this->add_control(
        'image',
        [
           'label' => __( 'Login Logo', 'mayosis-core' ),
           'type' => Controls_Manager::MEDIA,
           'section' => 'section_edd_login',
        ]
     );
     
     $this->add_control(
         'login-title',
         [
            'label' => __( 'Login Title', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter After Login Title', 'mayosis-core' ),
            'section' => 'section_edd_login',
         ]
      );
      $this->add_control(
         'url',
         [
            'label' => __( 'After Login Redirect Url', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'title' => __( 'Enter After Login Redirect Url', 'mayosis-core' ),
            'section' => 'section_edd_login',
         ]
      );

      $this->add_control(
        'reg_url',
        [
           'label' => __( 'Registration Url', 'mayosis-core' ),
           'type' => Controls_Manager::TEXT,
           'default' => '',
           'title' => __( 'Enter After Registration Url', 'mayosis-core' ),
           'section' => 'section_edd_login',
        ]
     );
       
      //start login style
          $this->start_controls_section(
			'login_style',
			[
				'label' => __( 'Login Style', 'mayosis-core' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_control(
			'login_bg_color',
			[
				'label' => __( 'Login Background Color', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'deafult' =>'#ffffff',
				'selectors' => [
					'{{WRAPPER}} .mayosis-modern-login' => 'background: {{VALUE}}',
				],
			]
		);
		
		$this->add_control(
			'login_padding',
			[
				'label' => __( 'Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mayosis-modern-login' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->end_controls_section();

   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $image = $this->get_settings( 'image' );
       $redirect_url= $this->get_settings( 'url' );
       $registration_url= $this->get_settings( 'reg_url' );
       $logintitle= $this->get_settings( 'login-title' );
      ?>


<div class="mayosis-modern-login">
            <?php if ($image['url']){ ?>
            <div class="login-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo $image['url']; ?>" class="img-responsive center-block" alt="login-img"></a></div>
            <?php } ?>
            
            <?php if (! is_user_logged_in() ) { ?>
            <?php if($logintitle){ ?>
            <h3><?php echo esc_html($logintitle);?></h3>
            <?php } ?>
                <?php } ?>
            <?php if ($redirect_url){ ?>
                <?php echo do_shortcode(' [edd_login redirect="'.$redirect_url.'"]'); ?>
            <?php } else { ?>
                <?php echo do_shortcode(' [edd_login]'); ?>
            <?php } ?>
            <?php if ( is_user_logged_in() ) { ?>
            <?php } else {?>
                <?php if ($registration_url){ ?>
            <a class="sigining-up" href="<?php echo esc_attr($registration_url); ?>"><?php esc_html_e('New here? Create an account!','mayosis-core'); ?></a>
           <?php } ?>

            <?php } ?>
          </div>



      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new mayosis_edd_login_Elementor_Thing );
?>