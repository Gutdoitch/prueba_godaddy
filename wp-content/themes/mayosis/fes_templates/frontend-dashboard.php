<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
global $post;
$user_id  = get_current_user_id();
$author = fes_get_vendor();
$vendor =new FES_Vendor( $user_id ,true );
$currentID = get_the_ID();
if( class_exists( 'EDDC' ) ) {
    $aucol= 'row-cols-md-5';
} else {
    $aucol= 'row-cols-md-4';
}
?>
 <div class="vendor-page-title">
       <h3 class="fes-headers" id="mayofes-orders-page-title">Overview</h3>
   </div>
<div class="mayosis-vendor-boxes row row-cols-1 row-cols-sm-2 <?php echo esc_html($aucol);?>">
    <div class="col">
        <div class="mayosis-v-box mayosis-vendor-earning ">
            <span><?php esc_html_e('Earnings','mayosis');?></span>
            <h4><?php echo edd_currency_filter( edd_format_amount( $vendor->sales_value ) ); ?></h4>
            <i class="zil zi-cube"></i>
                                    
        </div>
    </div>
     <?php if( class_exists( 'EDDC' ) ) { ?>
    <div class="col">
        <div class="mayosis-v-box mayosis-vendor-paid-earning ">
            <span><?php esc_html_e('Paid Commisions','mayosis');?></span>
            
            <h4><?php echo edd_currency_filter( edd_format_amount( eddc_get_paid_totals( $user_id ) ) ); ?></h4>
            
            <i class="zil zi-info-ii"></i>
                                    
        </div>
    </div>
    <?php } ?>
     <div class="col">
         <div class="mayosis-v-box mayosis-vendor-sales ">
              <span><?php esc_html_e('Sales','mayosis');?></span>
            <h4> <?php printf( _n( '%d', '%d', $vendor->sales_count, 'mayosis' ), $vendor->sales_count ); ?></h4>
             <i class="zil zi-tag"></i>
           
        </div>
    </div>
    
     <div class="col">
        <div class="mayosis-v-box mayosis-vendor-pageview ">
               <span><?php esc_html_e('Page Views','mayosis');?></span>
            <h4> 
            <?php 
    
                                    $author_id = get_the_author_meta( 'ID',$user_id );
                                    
                                    $author_posts = get_posts( array('post_type'=>'download' ,'post_status'    => array( 'publish'), 'author' => $author_id,'numberposts' => -1) );
                                    
                                    $counter = 0; // needed to collect the total sum of views
                                    foreach ( $author_posts as $post ) {
                                    
                                        $views =  get_post_meta( $post->ID, 'hits', true);
                                    
                                        $counter += ((int)$views);
                                        
                                    }
                                    
                                     echo esc_html($counter);
                                   
                                    
    
                                    ?></h4>
                                       <i class="zil zi-eye"></i>
        </div>
    </div>
    
    
     <div class="col">
            <div class="mayosis-v-box mayosis-vendor-conversion">
                     <span><?php esc_html_e('Conversion Rate','mayosis');?></span>
                <h4> <?php 
                $oldFigure= $vendor->sales_value;
                $newFigure = $vendor->sales_count;
                $percentChange = ( $oldFigure > 0 && $newFigure > 0 ) ? ceil($oldFigure/ $newFigure) : 0;
                
                if(is_nan($percentChange)){
                    echo 0;
                } else {
        echo number_format($percentChange, 2); } esc_html_e('%','mayosis');
         ?></h4>
                  <i class="zil zi-cart"></i>
            </div>
        </div>
</div>

<div class="clearfix"></div>
<?php
$vendor_announcement = EDD_FES()->helper->get_option( 'fes-dashboard-notification', '' );
if ( $vendor_announcement ) {
	?>
	<div id="fes-vendor-announcements">
	    <h4><?php esc_html_e('Latest Announcement','mayosis');?></h4>
		<?php echo apply_filters( 'fes_dashboard_content', do_shortcode( $vendor_announcement ) ); ?>
	</div>
	<?php
}
?>
<div id="fes-vendor-store-link">
	<?php echo EDD_FES()->vendors->get_vendor_store_url_dashboard(); ?>
</div>

<div class="fes-comments-wrap">
	<table id="fes-comments-table">
		<tr class="heading_tr">
			<th class="col-author"><?php  esc_html_e( 'Author', 'mayosis' ); ?></th>
			<th class="col-content"><?php  esc_html_e( 'Comment', 'mayosis' ); ?></th>
		</tr>
		<?php echo EDD_FES()->dashboard->render_comments_table( 10 ); ?>
	</table>
</div>