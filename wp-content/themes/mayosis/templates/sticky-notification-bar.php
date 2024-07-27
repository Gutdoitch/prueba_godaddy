<?php
defined('ABSPATH') or die();
 $ntbgtype = get_theme_mod( 'notification_bar_background_type','standard');
 $notification_text = get_theme_mod( 'notification_text','Get Big Discount For a Limited time');
  $notification_btn_text = get_theme_mod( 'notification_btn_text','Get the discount');
  $notification_btn_url = get_theme_mod( 'notification_btn_url','#');
  $notification_btn_target = get_theme_mod( 'noty_button_target','self');
  $counterdate = get_theme_mod( 'notification_btn_ddate' );
  $allowed_html = [
                            'a'      => [
                                'href'  => [],
                                'title' => [],
                            ],
                            'br'     => [],
                            'em'     => [],
                            'strong' => [],
                            'img' => [],
                            'i' => [],
                             'p' => [],
                        ];
?>

 <div id="mayosis-sticky-bar" class="mayosis-<?php echo esc_html($ntbgtype);?>-bar">
        <div class="container">
                <div class="mayosis-sticky-text"><?php echo wp_kses($notification_text, $allowed_html);?></div>
                <?php if($counterdate){?>
                <div class="mayosis-sticky-notification-timer"><?php echo esc_html($counterdate);?></div>
                <?php } ?>
                <?php if ($notification_btn_url){?>
                <a href="<?php echo esc_url($notification_btn_url);?>" target="_<?php echo esc_html($notification_btn_target);?>" class="btn mayosis-sticky-bar-btn"><?php echo esc_html($notification_btn_text);?></a>
                <?php } ?>
                </div>
		</div>