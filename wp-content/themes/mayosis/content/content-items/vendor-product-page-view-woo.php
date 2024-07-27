 <?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;

if (class_exists('Marketkingcore_Public')) {
    
    $store_url = get_query_var('vendorid');
    $users = get_users(array(
			'meta_key'     => 'marketking_store_url',
			'meta_value'   => $store_url,
			'meta_compare' => '=',
		));
		
    $store_user    = $users[0]->ID;
     $author_id =get_the_author_meta( 'ID',$store_user);
}
 if (class_exists('WeDevs_Dokan')) {
$store_user    = dokan()->vendor->get( get_query_var( 'author' ) );
  $author_id = get_the_author_meta( 'ID',$store_user->get_id() );
}




$disablehit= get_theme_mod( 'disable_hit_count','show' );

?>

<?php if ($disablehit == 'show'){ ?>
  <div class="single--metabox--info col">
                            <h4>

                                <?php
                                global $wp_query;

                               
                                
                                $author_posts = get_posts( array('post_type'=>'product' ,'author' => $author_id,'numberposts' => -1) );
                                
                                $counter = 0; // needed to collect the total sum of views
                                
                                foreach ( $author_posts as $post ) {
                                
                                    $views =  get_post_meta( $post->ID, 'hits', true);
                                
                                    $counter += ((int)$views);
                                }
                                echo esc_html($counter);
                                

                                ?>
                            </h4>
                            <p><?php esc_html_e('Page Views','mayosis')?></p>
                        </div>
                        <?php } ?>