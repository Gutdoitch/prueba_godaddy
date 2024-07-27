<?php

if (!defined('ABSPATH'))
	{
	exit; // Exit if accessed directly.
	}

 $headertypestcked = get_theme_mod( 'header_transparency','normal');
?>
<?php if ($headertypestcked == 'transparent'): ?>
        <header id="main-header" class="main-header header-stacked mayosis-sidenav-extra-header">
      <?php else: ?>
        <header id="main-header" class="main-header mayosis-sidenav-extra-header">
       <?php endif; ?>

                <div class="d-none d-lg-block">
                 
                     
                  
                   	<?php
		get_template_part('includes/header/header', 'container');
	?>
                </div>
                
                </header>