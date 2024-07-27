<?php
 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
 $searchbehviour= get_theme_mod( 'search_behaviour','dropdown');
$searchresults = get_search_query();
$srcresulttype= get_theme_mod( 'search_result_type','edd');
?>

	<?php

if ($searchbehviour== 'collapse'): ?>
 <li class="search-one">
  <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="maxcollapse">
                <input type="search" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" name="s" id="s" class="maxcollapse-input"  value="<?php echo esc_html($searchresults); ?>" onkeyup="buttonUp();" required>
                  <?php if ($srcresulttype=="edd"){ ?>
                  
                  <?php if (class_exists('woocommerce')){ ?>
                  	<input type="submit" class="maxcollapse-submit" value="product">
                  <?php } else { ?>
                  	<input type="submit" class="maxcollapse-submit" value="download">
                  <?php } ?>
                      
                      
			
				<?php } else { ?>
                <input type="submit" class="maxcollapse-submit">
                <?php } ?>
                <span class="maxcollapse-icon"><i class="zil zi-search"></i></span>
            </form>
						
						</li>
<?php elseif ($searchbehviour == 'dropdown'): ?>
<li class="dropdown search-dropdown-main">
            <a href="#" class="" data-bs-toggle="dropdown"  aria-expanded="false" id="dropdownMenuLink"><i class="zil zi-search" aria-hidden="true"></i></a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                <form role="search" method="get" class="search-form-none search-form-collapsed" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php $searchresults = get_search_query(); ?>
                    <input  value="<?php echo esc_html($searchresults); ?>" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" type="search" name="s" id="s" class="dm_search"   >
                        <button type="submit" value="Search">
                            <i class="zil zi-search" aria-hidden="true"></i>
                            <?php if ($srcresulttype=="edd"){ ?>
                            
                             <?php if (class_exists('woocommerce')){ ?>
                  		<input type="hidden" name="post_type" value="product">
                  <?php } else { ?>
                  		<input type="hidden" name="post_type" value="download">
                  <?php } ?>
                  
			
				<?php } ?>
                        </button>  
                        
                </form>
                </li>
              </ul>
          </li>
          
          <?php elseif ($searchbehviour == 'offcanvas'): ?>

<li class="d-none d-md-block"><button class="mayosis-offcanvas-button searchoverlay-button" type="button" data-bs-toggle="offcanvas" data-bs-target="#searchoffcanvas" aria-controls="searchoffcanvas"><i class="zil zi-search"></i></button></li>


<div class="offcanvas offcanvas-top" tabindex="-1" id="searchoffcanvas" aria-labelledby="searchoffcanvaslabel" data-bs-scroll="true">
 
  <div class="offcanvas-body searchoffcanvas-body">
      <div class="mayosis-offcanvas-body">
          <div class="d-flex justify-content-between align-items-center mayosis-off-canvas-header">
              <h4>WHAT ARE YOU LOOKING FOR?</h4>
               <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="mayosis-offcanvas-box">
     <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php $searchresults = get_search_query(); ?>
        <?php $taxonomies = array('download_category');
				$args = array('orderby'=>'count','hide_empty'=>true, 'parent'   => 0,);
				echo mayosis_get_terms_dropdown($taxonomies, $args); ?>
        <div class="search">
        
          <input value="<?php echo esc_html($searchresults); ?>" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" type="search" name="s" id="s" class="full-screen-search" />
        
              <button type="submit" value="Search" class="mayosis-ajax-search-btn">
                          <i class="zil zi-search"></i>
                          <input type="hidden" name="post_type" value="download">
                        </button>
             
        </div>
    </form>
    </div>
    </div>
  </div>
</div>

<?php else: ?>
<li class="d-none d-md-block"><a href="#searchoverlay" class="searchoverlay-button" data-lity><i class="zil zi-search"></i></li>

<li class="overlay_button_search d-block d-md-none"><a href="#searchoverlay" class="searchoverlay-button" data-lity><i class="zil zi-search"></i></a></li>
 <div id="searchoverlay" class="main_searchoverlay lity-hide" >
    
    <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php $searchresults = get_search_query(); ?>
        <div class="search">
          <i class="zil zi-search"></i>
          <input value="<?php echo esc_html($searchresults); ?>" placeholder="<?php esc_html_e( 'Type and Hit Enter', 'mayosis' ); ?>" type="search" name="s" id="s" class="full-screen-search" />
        
            <?php if ($srcresulttype=="edd"){ ?>
				<input type="hidden" name="post_type" value="download">
				<?php } ?>
             
        </div>
    </form>
</div>
<?php endif; ?>