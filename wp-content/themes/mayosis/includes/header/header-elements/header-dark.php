<?php
defined('ABSPATH') or die();
$nightmodedisable= get_theme_mod( 'sp_night_mode_ebl',  false);


?>
<?php if ($nightmodedisable == true){ ?>
 <div class="saasplate-dark-switcher-box">
           
            <div class="saasplate-dark-switcher-panel">
            <?php echo do_shortcode('[sp-night-mode-button]');?>
            </div>
             
        </div>
        <?php } else { ?>
        <p>Please Enable Dark Mode</p>
        
        <?php } ?>
					
		