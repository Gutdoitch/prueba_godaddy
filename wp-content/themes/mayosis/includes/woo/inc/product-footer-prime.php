<?php
/**
 * Footer Product Widget
 */
  if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$loadsrelatedfrom = get_theme_mod( 'df_related_loads_from','product_cat' );
?>


       <div class="row">
       
           <div class="col-md-4 col-sm-4 col-12 bottom--post--block">
               <h4><?php esc_html_e('Related Products','mayosis'); ?></h4>
               <?php  
               
               
			   //Fetch data
		$exclude_post_id = $post->ID;
		$taxchoice = $loadsrelatedfrom;
		$custom_taxterms = wp_get_object_terms( $post->ID, $taxchoice, array('fields' => 'ids') );
			   
		$arguments = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'ignore_sticky_posts' => 1,
			'post__not_in' => array($post->ID),
			'ignore_sticky_posts'=>1,
			'tax_query' => array(
							array(
								'taxonomy' => $taxchoice,
								'field' => 'id',
								'terms' => $custom_taxterms
							)
						),
		);
	
		$post_query = new WP_Query($arguments); ?>
               <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
               <div class="bottom-widget-product">
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-thumbnail paading-left-0"> 
                        
                         <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in"> 
                              <?php
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								 ?>
                                   	<figcaption>
                                   	    <div class="overlay_content_center">               
                              <a href="<?php
	the_permalink(); ?>"><i class="zil zi-plus"></i></a>
	</div>
	</figcaption>
	     </figure>
	      </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-details paading-left-0">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                         <?php get_template_part( 'includes/woo/inc/product-additional-meta'); ?>
                            
                        </div>
                        <div class="clearfix"></div>
                </div>
                   	 <?php endwhile; else: ?>
                   	 <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                    </div>
                <?php endif; ?>
                    <!--Sidebar Product-->
<?php wp_reset_postdata(); ?>
           </div>
             

           
           <div class="col-md-4 col-sm-4 col-12 bottom--post--block">
               <h4><?php esc_html_e('Same Contributor','mayosis'); ?> </h4>
                 
                  <?php  
               
               
			   //Fetch data
	    $author= get_the_author_meta( 'ID' );
			   
		$arguments = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'orderby' => 'rand', 
			'ignore_sticky_posts' => 1,
			'post__not_in' => array($post->ID),
			'ignore_sticky_posts'=>1,
			'author'=> $author,
		);
	
		$post_query = new WP_Query($arguments); ?>
               <?php if ( $post_query->have_posts() ) : while ( $post_query->have_posts() ) : $post_query->the_post(); ?>
               <div class="bottom-widget-product">
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-thumbnail paading-left-0"> 
                        
                         <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in"> 
                              <?php
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								 ?>
                                   	<figcaption>
                                   	    <div class="overlay_content_center">               
                              <a href="<?php
	the_permalink(); ?>"><i class="zil zi-plus"></i></a>
	</div>
	</figcaption>
	     </figure>
	      </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-details paading-left-0">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                         <?php get_template_part( 'includes/woo/inc/product-additional-meta'); ?>
                            
                        </div>
                        <div class="clearfix"></div>
                </div>
                   	 <?php endwhile; else: ?>
                   	 <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                    </div>
                <?php endif; ?>
                    <!--Sidebar Product-->
<?php wp_reset_postdata(); ?>	
           </div>
           
           
           <div class="col-md-4 col-sm-4 col-12 bottom--post--block">
               <h4><?php esc_html_e('Featured Products ','mayosis'); ?> </h4>
               <?php   	//Fetch data
		$arguments = array(
			'post_type' => 'product',
			'post_status' => 'publish',
			'posts_per_page' => 3,
			'order' => 'DESC',
			'ignore_sticky_posts' => 1,
			
			
			'tax_query' => array(
    array(
        'taxonomy' => 'product_visibility',
         'field' => 'name',
        'terms' => 'featured',
        'operator' => 'IN',
    )
),

		);
	
		$post_query = new WP_Query($arguments);?>
              <?php $featured_products = new WP_Query( $arguments );

if( $featured_products->have_posts() ) : ?>
              <?php while( $featured_products->have_posts() ) : $featured_products->the_post(); ?>
        
               <div class="bottom-widget-product ">
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-thumbnail paading-left-0"> 
                        	 <div class="product-thumb grid_dm">
                        <figure class="mayosis-fade-in"> 
                              <?php
									the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) );
								 ?>
                                   	<figcaption>
                                   	    <div class="overlay_content_center">               
                              <a href="<?php
                            	the_permalink(); ?>"><i class="zil zi-plus"></i></a>
                            	</div>
                            	</figcaption>
                            	     </figure>    
                            	      </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6 sidebar-details paading-left-0">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                           <?php get_template_part( 'includes/woo/inc/product-additional-meta'); ?>
                            
                        </div>
                        <div class="clearfix"></div>
                </div>
                   	 <?php endwhile; else: ?>
                   	 <div class="col-lg-12 pm-column-spacing">
                     <p><?php esc_html_e('No posts were found.', 'mayosis'); ?></p>
                    </div>
                <?php endif; ?>
                    <!--Sidebar Product-->
<?php wp_reset_postdata(); ?>
           </div>
       </div>