 <?php  
        wp_nav_menu(array(  
          	'theme_location' => 'main-menu',
          'container_id' => 'mayosis-sidemenu', 
          'fallback_cb'    => '',
          'walker' => new mayosis_accordion_navwalker()
        )); 
        ?>