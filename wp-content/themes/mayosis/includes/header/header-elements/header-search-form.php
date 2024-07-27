<?php
defined('ABSPATH') or die();
 $headersearchstyle= get_theme_mod( 'search_form_style','standard');
 $headerplaceholdertext= get_theme_mod( 'search_form_placeholder_cs','e.g. mockup');
 $searchhome= get_theme_mod( 'hide_searchbar_home','both');
  $categorydrop= get_theme_mod( 'header_search_category',true);
  $srcresulttype= get_theme_mod( 'search_result_type','edd');
  $srcformtype= get_theme_mod( 'search_form_type','normal');
  
  $categorydropcat="";
  if ($categorydrop== true && $srcformtype=="normal"){
        $categorydropcat="mayosis-category-available-search";
  }
?>
 <?php if ($headersearchstyle == "ghost"): ?>
  <div class="header-ghost-form header-search-form <?php echo esc_html($categorydropcat);?> <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      
      <?php elseif ($headersearchstyle == "minimal"): ?>
       <div class="header-minimal-form header-search-form <?php echo esc_html($categorydropcat);?> <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      <?php else : ?>
      
      <div class="product-search-form header-search-form <?php echo esc_html($categorydropcat);?> <?php if (is_front_page() && $searchhome=="sticky") { ?>search-hide-normal-state<?php }?>">
      <?php endif; ?>
      
      <?php if($srcformtype=="ajax"){?>
      
      <?php if ( class_exists( 'WooCommerce' ) ) { 
      
      mayosis_live_search();
      ?>
      
      <?php } else { ?>
            <form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
          
            <div class="mayosis-edd-ajax-search search-fields">
			<input type="text" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" name="s" class="mayosisajaxsearch" autocomplete="off" placeholder="<?php echo esc_html($headerplaceholdertext);?>" data-length="2"  data-not-found="Product Not Found" />
				
            <div class='mayosis-ajax-loader'></div>
            <button type="submit" value="Search" class="mayosis-ajax-search-btn">
                          <i class="zil zi-search"></i>
                          <input type="hidden" name="post_type" value="download">
                        </button>
            <div class="mayosis_edd_search_result has_mayosis_dark_sec_bg"></div>
		</div>
		</form>
		<?php } ?>
      <?php } else { ?>
      
      <?php if ( class_exists( 'WooCommerce' ) ) { 
       mayosis_live_search();
      ?>
      
      
      <?php  } else { ?>
		<form method="GET" action="<?php echo esc_url(home_url('/')); ?>">
		    
		    <?php if ($categorydrop== true){?>
	        <?php 
				$taxonomies = array('download_category');
				$args = array('orderby'=>'count','hide_empty'=>true,'parent'   => 0,);
				echo mayosis_vendor_cat_dropdown($taxonomies, $args);
			 ?>
			 
			 <?php } ?>
		
			
			 
			<div class="search-fields">
				<input name="s" value="<?php echo (isset($_GET['s']))?$_GET['s']: null; ?>" type="text" placeholder="<?php echo esc_html($headerplaceholdertext); ?>">
				<?php if ($srcresulttype=="edd"){ ?>
				<input type="hidden" name="post_type" value="download">
				<?php } ?>
			<span class="search-btn"><input value="" type="submit"></span>
			</div>
		</form>
		<?php } ?>
		<?php } ?>
	</div>