<?php
$menu_position = get_theme_mod( 'menu_position','text-right');
$megaebl= get_theme_mod( 'mega_menu_ebl','disable' );
?>
<div class="main-navigation <?php echo esc_attr($menu_position); ?>">                     
<?php 
if ($megaebl== 'enable'){
    echo '<div class="navbar navbar-expand-lg">';
wp_nav_menu( 
	array( 
	'theme_location' => 'main-menu', 
    'container'         => 'div',
    'container_class'   => 'xoopic-m-menu',
    'menu_class'        => 'nav navbar-nav nav-style-megamenu',
    'fallback_cb'     => '',
    'walker'          => new WP_Bootstrap_Navwalker(),
	) 
); 
echo '</div>';
} else {
    
   wp_nav_menu( 
	array( 
	'theme_location' => 'main-menu', 
	'container_id' => 'mayosis-menu',
	'container_class' => 'msv-main-menu',
	'fallback_cb' => 'mayosis_menu_walker::fallback',
	'walker'  => new mayosis_menu_walker()
	) 
);  
}

?>
</div>