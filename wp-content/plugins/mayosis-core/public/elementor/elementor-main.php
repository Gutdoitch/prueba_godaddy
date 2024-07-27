<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'MAYOSIS_ELEMENTOR_URL', plugins_url( '/', __FILE__ ) );
define( 'MAYOSIS_ELEMENTOR_PATH', plugin_dir_path( __FILE__ ) );
define( 'MAYOSIS_ELEMENTOR_ROOT_URL', plugins_url( __FILE__ ) );
define( 'MAYOSIS_ELEMENTOR_PL_ROOT_URL', plugin_dir_url(  __FILE__ ) );
define( 'MAYOSIS_PL_ASSETS', trailingslashit( MAYOSIS_ELEMENTOR_PL_ROOT_URL . 'assets' ) );
define( 'MAYOSIS_ADDONS_PL_ROOT', __FILE__ );
define( 'MAYOSIS_ADDONS_PL_PATH', plugin_dir_path( MAYOSIS_ADDONS_PL_ROOT ) );
define( 'MAYOSIS_TEMPLATES_FOR_ELEMENTOR_VERSION', '2.9' );
 define( 'XLTAB_ROOT_FILE__', __FILE__ );


require_once MAYOSIS_ELEMENTOR_PATH.'inc/elementor-assets.php';
require_once MAYOSIS_ELEMENTOR_PATH.'inc/elementor-cat.php';
require_once MAYOSIS_ELEMENTOR_PATH.'inc/elementor-custom-icon.php';
require_once MAYOSIS_ELEMENTOR_PATH.'inc/elementor-custom-bg.php';
require_once MAYOSIS_ELEMENTOR_PATH.'inc/elementor-custom-visibilty.php';
require_once MAYOSIS_ELEMENTOR_PATH.'library/index.php';


$ps = new Mayosis_custom_bg();

function Mayosis_Elementor_Elements(){

    // load elements
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/recent-post.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/icon-box.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/single-button.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/dual-button.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/client-logo.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/theme-hero.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/pricing-table.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/search.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/counter.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/team-member.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/contact-infobox.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/license.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/subscribe.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/object.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/search-terms.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/changelog.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/before-after.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-with-filter.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/animated-shape.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/marquee.php';
    require_once MAYOSIS_ELEMENTOR_PATH.'widgets/customer-block.php';
   
    
    //require_once MAYOSIS_ELEMENTOR_PATH.'widgets/divider.php';

    if(class_exists('ACF') ) {
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/theme-testimonial.php';
    }
    if (class_exists('Easy_Digital_Downloads')):
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-featured.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-recent.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-grid.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-hero.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-login.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-register.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-masonary.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-justified.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-category.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-popular.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-hero-block.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-list-item.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-product-slider.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-product-carousel.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-uneven-grid.php';
         require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-audio-product.php';
          require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-product-tabs.php';


        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/title.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/thumbnail.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/description.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/add-to-cart.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/breadcrumb.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/meta.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/price.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/custom-button.php';
         require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/pdf-preview.php';
       
       
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/tags.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/comment.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/demo-button.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/video.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/audio.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/gallery.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/exif.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/author.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/related-product.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/same-author.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/popular.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/ebook-meta.php';
        //require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/information-box.php';

        if ( class_exists( 'EDD_Reviews' ) ){
            require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/product-rating.php';
        }

        if (  class_exists( 'EDD_Wish_Lists' ) ){
            require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/wishlist.php';
        }
        
         if (  class_exists( 'EDD_Favorites' ) ){
            require_once MAYOSIS_ELEMENTOR_PATH.'widgets/product-item/favourite.php';
        }
        
        

        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/title.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/breadcrumb.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/description.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/regular-products.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/masonry-products.php';
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/archive-item/audio-product-category.php';
        

    endif;

    if ( class_exists( 'EDD_Front_End_Submissions' ) ){
        require_once MAYOSIS_ELEMENTOR_PATH.'widgets/edd-author.php';
    }
    
    
     if ( class_exists( 'woocommerce' ) ){
             require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-small-grid.php';
              require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-regular-grid.php';
              require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-masonry.php';
              require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-justified.php';
              
              require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-search.php';
              
              require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-hero.php';
              
               require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-uneven-grid.php';
               
               require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-category.php';
               
               require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-product-tabs.php';
               
               require_once MAYOSIS_ELEMENTOR_PATH.'widgets/woocommerce/woo-author.php';
            
             
            
             
         }


}
add_action('elementor/widgets/register','Mayosis_Elementor_Elements');