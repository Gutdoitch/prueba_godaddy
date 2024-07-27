<?php wp_nav_menu( 
	array( 
	'theme_location' => 'bottom-menu', 
	'container_id' => 'mayosis-menu',
	'container_class' => 'mayosis-bottom-menu',
	'fallback_cb' => 'mayosis_menu_walker::fallback',
	'walker'  => new mayosis_menu_walker()
	) 
); ?>