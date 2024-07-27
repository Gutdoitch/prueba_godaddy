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
    $following_count = teconce_get_following_count( get_the_author_meta( 'ID',$store_user) );
}
 if (class_exists('WeDevs_Dokan')) {
$store_user    = dokan()->vendor->get( get_query_var( 'author' ) );
                                $following_count = teconce_get_following_count( get_the_author_meta( 'ID',$store_user->get_id()) );
}

?>

 <div class="single--metabox--info col">
                            <h4>
                                <?php


                                echo esc_html($following_count);
                                ?>
                            </h4>
                            <p><?php esc_html_e('Following','mayosis')?></p>


                        </div>