<?php

if(!class_exists('WPBakeryShortCode')) return;

class WPBakeryShortCode_digital_edd_login extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

        //$custom_css = $el_class = $title = $icon = $output = $s_content = $number = '' ;
$css = '';
        extract(shortcode_atts(array(
            'logo_upload_login' => '',
            'registration_url' => '',
            'redirect_url' => '',
            'login_title' => '',
			'css' => ''
        ), $atts));
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );



        /* ================  Render Shortcodes ================ */
	
	

        ob_start(); ?>
		
		<div class="mayosis-modern-login <?php echo esc_attr( $css_class ); ?>">
            <?php if ($logo_upload_login){ ?>
            <div class="login-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo wp_get_attachment_image( $logo_upload_login,'full',["class" => "img-responsive"]); ?></a></div>
            <?php } ?>
            
            <?php if (! is_user_logged_in() ) { ?>
            <?php if($login_title){ ?>
            <h3><?php echo esc_html($login_title);?></h3>
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
          </div><?php echo $this->endBlockComment('digital_edd_login'); ?>
           <div class="clearfix"></div>
      

        <?php

        $output = ob_get_clean();

        /* ================  Render Shortcodes ================ */

        return $output;

    }

}

vc_map( array(

    "base"      => "digital_edd_login",
    "name"      => __("Mayosis Login", 'mayosis-core'),
    "description"      => __("Mayosis Edd Login", 'mayosis-core'),
    "class"     => "",
    "icon"      => get_template_directory_uri().'/images/DM-Symbol-64px.png',
    "category"  => __("Mayosis Elements", 'mayosis-core'),
    "params"    => array(
	
		array(
                        'type' => 'attach_image',
                        'heading' => __( 'Login Logo', 'mayosis-core' ),
                        'param_name' => 'logo_upload_login',
                        'description' => __( 'Upload Login Logo', 'mayosis-core' ),
                    ), 
                    
                    array(
            'type' => 'textfield',
            'heading' => __('Login Title', 'mayosis-core') ,
            'param_name' => 'login_title',
            'value' => __('', 'mayosis-core') ,
            'description' => __('Input Login Title', 'mayosis-core') ,
        ) ,
        array(
            'type' => 'textfield',
            'heading' => __('After Login Redirect Url', 'mayosis-core') ,
            'param_name' => 'redirect_url',
            'value' => __('', 'mayosis-core') ,
            'description' => __('Input After Login Redirect Url', 'mayosis-core') ,
        ) ,
        array(
            'type' => 'textfield',
            'heading' => __('Registration Url', 'mayosis-core') ,
            'param_name' => 'registration_url',
            'value' => __('', 'mayosis-core') ,
            'description' => __('Input Registration Url', 'mayosis-core') ,
        ) ,
		array(
            'type' => 'css_editor',
            'heading' => __( 'Css', 'mayosis-core' ),
            'param_name' => 'css',
            'group' => __( 'Design options', 'mayosis-core' ),
        ),

    )

 

));