<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Member_Elementor_Thing extends Widget_Base {

   public function get_name() {
      return 'mayosis-member';
   }

   public function get_title() {
      return __( 'Mayosis Team Member', 'mayosis-core' );
   }
public function get_categories() {
		return [ 'mayosis-ele-cat' ];
	}
   public function get_icon() { 
        return 'eicon-nerd-chuckle';
   }

   protected function register_controls() {

      $this->add_control(
         'member_settings',
         [
            'label' => __( 'Team Member Settings', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

       $this->add_control(
         'title',
         [
            'label' => __( 'Team Member Name', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'S.R Shemul',
            'section' => 'member_settings',
         ]
      );
       
       $this->add_control(
         'designation',
         [
            'label' => __( 'Team Member Designation', 'mayosis-core' ),
            'type' => Controls_Manager::TEXT,
            'default' => 'Founder & CEO',
            'section' => 'member_settings',
         ]
      );
       
       $this->add_control(
         'image',
         [
            'label' => __( 'Team Member Photo', 'mayosis-core' ),
            'type' => Controls_Manager::MEDIA,
            'section' => 'member_settings',
         ]
      );
       $this->add_control(
         'details',
         [
            'label' => __( 'Details About Member', 'mayosis-core' ),
            'type' => Controls_Manager::TEXTAREA,
            'section' => 'member_settings',
         ]
      );
       
       $this->add_control(
         'member_style',
         [
            'label' => __( 'Style', 'mayosis-core' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
       $this->add_control(
         'align_text',
         [
            'label' => __( 'Text Alignment', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'title' => __( 'Select Text Alignment', 'mayosis-core' ),
            'section' => 'member_style',
             'options' => [
                    'left'  => __( 'Left', 'mayosis-core' ),
                    'center' => __( 'Center', 'mayosis-core' ),
                    'right' => __( 'Right', 'mayosis-core' ),
                 ],
         ]
      );
       
       $this->add_control(
         'style_team',
         [
            'label' => __( 'Team Style', 'mayosis-core' ),
            'type' => Controls_Manager::SELECT,
            'default' => 'one',
            'title' => __( 'Select Team Style', 'mayosis-core' ),
            'section' => 'member_style',
             'options' => [
                    'one'  => __( 'Style One', 'mayosis-core' ),
                    'two' => __( 'Style Two', 'mayosis-core' ),
                 ],
         ]
      );
      
       $this->add_control(
         'title_color',
         [
            'label' => __( 'Color of Title', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Title Color', 'mayosis-core' ),
            'section' => 'member_style',
         ]
      );
       
       $this->add_control(
         'desig_color',
         [
            'label' => __( 'Color of Designation', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Designation Color', 'mayosis-core' ),
            'section' => 'member_style',
         ]
      );
       $this->add_control(
         'content_color',
         [
            'label' => __( 'Color of Content', 'mayosis-core' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#ffffff',
            'title' => __( 'Select Content Color', 'mayosis-core' ),
            'section' => 'member_style',
         ]
      );
   }

   protected function render( $instance = [] ) {

      // get our input from the widget settings.

       $settings = $this->get_settings();
       $image = $this->get_settings( 'image' );
       $teamstyle = $this->get_settings( 'style_team' );
       
      ?>

        <!-- Element Code start -->
        <?php if($teamstyle=='one'){?>
       <div class="team-member">
           <div class="row align-items-center">
                	<div class="col-md-4" style="text-align:<?php echo $settings['align_text']; ?>;">
                  <img src="<?php echo $image['url']; ?>" class="img-responsive" alt="member-img">
                    </div>
                    <div class="col-md-8 team-details" style="text-align:<?php echo $settings['align_text']; ?>;">
                    	<h2 style="color:<?php echo $settings['title_color']; ?>;"><?php echo $settings['title']; ?></h2>
                        <small  style="color:<?php echo $settings['desig_color']; ?>;"><?php echo $settings['designation']; ?></small>
                        <p style="color:<?php echo $settings['content_color']; ?>;"><?php echo $settings['details']; ?></p>
                    </div>
                    <div class="clearfix"></div>
                    </div>
                </div> 
                <?php } else { ?>
                
                     <div class="team-member team-style-two">
                	<div class="team--photo--style2" style="text-align:<?php echo $settings['align_text']; ?>;">
                  <img src="<?php echo $image['url']; ?>" class="img-responsive" alt="member-img">
                    </div>
                    <div class="no-padding team-details" style="text-align:<?php echo $settings['align_text']; ?>;">
                    	<h2 style="color:<?php echo $settings['title_color']; ?>;"><?php echo $settings['title']; ?></h2>
                        <small  style="color:<?php echo $settings['desig_color']; ?>;"><?php echo $settings['designation']; ?></small>
                        <p style="color:<?php echo $settings['content_color']; ?>;"><?php echo $settings['details']; ?></p>
                    </div>
                    <div class="clearfix"></div>
                </div> 
                <?php } ?>
      <?php

   }

   protected function content_template() {}

   public function render_plain_content( $instance = [] ) {}

}
Plugin::instance()->widgets_manager->register( new Member_Elementor_Thing );
?>