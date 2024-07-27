 <?php 
 
 ?>
<div class="container">
    
    <div class="row">
         <div class="to-flex-row th-flex-flex-middle">
             <div class="to-flex-col th-col-left d-none d-lg-block">
                 <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="default-logo"></a>
             </div>
             
             <div class="to-flex-col th-col-right d-none d-lg-block">
                 <?php get_template_part( 'includes/main-navigation' ); ?>
             </div>
         </div>
    </div>
</div>