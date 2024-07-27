<?php

/*
Individual Store Page
* @version 1.1.7

This template file can be edited and overwritten with your own custom template. To do this, simply copy this file under your theme (or child theme) folder, in a folder named 'marketking', and then edit it there. 

For example, if your theme is storefront, you can copy this file under wp-content/themes/storefront/marketking/ and then edit it with your own custom content and changes.

*/


$contentlayouts  = get_theme_mod( 'vendor_layout_control', array( 'products','sales','page','follower','following' ) );
?>


<?php
$store_style = intval(get_option( 'marketking_store_style_setting', 1 ));

// if page is set to elementor for example, set back to 1 - if we reached here it should be 1, 2, or 3
if (!in_array($store_style, array(1, 2, 3))){
	$store_style = 3;
}

if ($store_style === 1){ ?>
    
     <!-- Begin Page Headings Layout -->
     
            
	<div class="mayosis-marketking-vendor-page-banner">
	    <?php
		$img = marketking()->get_store_banner_image_link($vendor_id);
		if (empty($img)){
			$img = MARKETKINGCORE_URL.'includes/assets/images/store-banner.png';
		} else {
			$img = marketking()->get_resized_image($img, 'large');
		}
		?>
		<div id="marketking_vendor_store_page_banner" style="background-image: url('<?php echo esc_url($img);?>');">
		</div>
	    
	</div>
    <div class="single--author--content has_mayosis_dark_alt_bg container-fluid">
        <div class="container">
            <div class="single--author--flex row">
                <div class="single--author--part col-12 col-lg-4">
                    <div class="author--name--image">
                       <div class="profile-img">
                            	<?php
				$img = marketking()->get_store_profile_image_link($vendor_id);
				if (empty($img)){
					// show default image
					$img = MARKETKINGCORE_URL.'includes/assets/images/store-profile.png';
				} else {
					$img = marketking()->get_resized_image($img, 'thumbnail');
				}
				?>
				<img class="marketking_vendor_store_page_profile_image" src="<?php echo esc_url($img);?>">
                        </div>
                        <div class="author--identity--box author--identity--box-marketking">
                        
                        
                           <h5 class="author--single--title"><?php echo marketking()->get_store_name_display($vendor_id); ?></h5>
                      
                        
                         <?php
			// display badges if applicable
			if (defined('MARKETKINGPRO_DIR')){
				if (intval(get_option('marketking_enable_badges_setting', 1)) === 1){
					?>
					<div id="marketking_vendor_page_badges_container">
					<?php
					marketkingpro()->display_vendor_badges($vendor_id, 4, 20);
					?>
					</div>
					<?php
				}
			}
			?>
                      
                      
                     
                      
                       
                       
                        </div>
                    </div>
                    <div class="author--box--btn">
                         <div class="follow--au--btn">
                             <?php
                             if ( is_user_logged_in() ) { ?>
                            <?php
                            $teconcefollow = teconce_get_follow_unfollow_links( $vendor_id );
                            
                            echo maybe_unserialize($teconcefollow);
                            ?>
                            <?php } else  { ?>
                            
                             <a href="#vendorlogin" data-lity class="tec-follow-link"><?php esc_html_e('Follow','mayosis');?></a>
                            <?php } ?>
                        </div>
                        <div class="contact--au--btn">
                            <a href="#vendorcontact" data-lity class="btn ghost-fes-author-btn fes--author--btn"><?php esc_html_e('Contact','mayosis'); ?></a>
                        </div>
                    </div>
                </div>

                <div class="single--meta--part col-12 col-lg-8">
                    <div class="single--meta--top--part row row-cols-2  row-cols-md-5 ">
                       <?php if ($contentlayouts): foreach ($contentlayouts as $layout) {
 
                            switch($layout) {
                         
                         
                                case 'products': get_template_part( 'content/content-items/vendor-product-count-woo' );
                                break;
                                
                                 case 'sales': get_template_part( 'content/content-items/vendor-product-sales-woo' );
                                break;
                                
                                
                                 case 'page': get_template_part( 'content/content-items/vendor-product-page-view-woo' );
                                break;
                                
                                
                                 case 'follower': get_template_part( 'content/content-items/vendor-product-follower-woo' );
                                break;
                         
                               
                                case 'following': get_template_part( 'content/content-items/vendor-product-following-woo' );
                               break;
                         
                            }
                         
                        }
                         
                        endif; ?>
                      
                    </div> <!-- top part-->

                    <div class="single--meta--bottom--part row ">
                      
                        
                        <div class="bottom--meta--desc col-6 col-lg-5">
                          <div class="dokan-store-rating">
                               
                               
                            </div>
                        </div>
                        
                        
                          <div class="bottom--meta--social col-6 col-lg-7">
                           
                        </div>
                        
                          
                        
                           
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    
  
 <!-- Modal Login Form -->
           <div id="vendorlogin" style="background:#fff" class="lity-hide">
                   
                    <h4 class="modal-title">Login</h4>
                
                  <div class="modal-body">
                       <?php echo do_shortcode('[mayosis_woo_login]');?>
                  </div>
                </div>

<!-- Modal -->
           <div id="vendorcontact" style="background:#fff" class="lity-hide">
              
            <div class="modal-body">
             
                <?php
				  	marketkingpro()->get_vendor_inquiries_tab($vendor_id);
				  	
					?>
            </div>
        
</div>

	<?php
}

if ($store_style === 2){
	?>
	<div id="marketking_vendor_store_page_header" class="marketking_store_style_2">
		<div id="marketking_vendor_store_page_profile" class="marketking_store_style_2">
			<div id="marketking_vendor_store_page_profile_pic" class="marketking_store_style_2">
				<?php
				$img = marketking()->get_store_profile_image_link($vendor_id);
				if (empty($img)){
					// show default image
					$img = MARKETKINGCORE_URL. 'includes/assets/images/store-profile.png';
				} else {
					$img = marketking()->get_resized_image($img, 'thumbnail');
				}
				?>
				<img class="marketking_vendor_store_page_profile_image" src="<?php echo esc_url($img);?>">
		
			</div>
			<div id="marketking_vendor_store_page_profile_name" class="marketking_store_style_2">
				<?php echo marketking()->get_store_name_display($vendor_id); ?>
			</div>
		</div>			
		<?php
		$img = marketking()->get_store_banner_image_link($vendor_id);
		if (empty($img)){
			$img = MARKETKINGCORE_URL. 'includes/assets/images/store-banner.png';
		} else {
			$img = marketking()->get_resized_image($img, 'large');
		}
		?>
		<div id="marketking_vendor_store_page_banner" class="marketking_store_style_2" style="background-image: url('<?php echo esc_url($img);?>');">
		</div>
	</div>
	<?php
}

if ($store_style === 3){
	?>
	<div id="marketking_vendor_store_page_header" class="marketking_store_style_3">
		<div id="marketking_vendor_store_page_profile" class="marketking_store_style_3">
			<div id="marketking_vendor_store_page_profile_pic" class="marketking_store_style_3">
				<?php
				$img = marketking()->get_store_profile_image_link($vendor_id);
				if (empty($img)){
					// show default image
					$img = MARKETKINGCORE_URL.'includes/assets/images/store-profile.png';
				} else {
					$img = marketking()->get_resized_image($img, 'thumbnail');
				}
				?>
				<img class="marketking_vendor_store_page_profile_image" src="<?php echo esc_url($img);?>">
		
			</div>
			<div id="marketking_vendor_store_page_profile_name" class="marketking_store_style_3">
				<?php echo marketking()->get_store_name_display($vendor_id); ?>
			</div>
		</div>			
		<?php
		$img = marketking()->get_store_banner_image_link($vendor_id);
		if (empty($img)){
			$img = MARKETKINGCORE_URL.'includes/assets/images/store-banner.png';
		} else {
			$img = marketking()->get_resized_image($img, 'large');
		}
		?>
		<div id="marketking_vendor_store_page_banner" class="marketking_store_style_3" style="background-image: url('<?php echo esc_url($img);?>');">
		</div>
	</div>
	<?php
}
?>

<!-- TABS -->
<div class="marketking_tabclass container">
	<div class="marketking_tabclass_left">
	  <button class="marketking_tablinks" value="marketking_vendor_tab_products" type="button"><?php esc_html_e('Products','mayosis');?></button>
	  <?php
	  if (apply_filters('marketking_show_vendor_details_tab_product_page', true)){
	  	?>
		<button class="marketking_tablinks" value="marketking_vendor_tab_info" type="button"><?php esc_html_e('Vendor Details','mayosis');?></button>
	  	<?php
	  }
	  if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_reviews_setting', 1)) === 1){
  			?>
  			<button class="marketking_tablinks" value="marketking_vendor_tab_reviews" type="button"><?php echo apply_filters('marketking_feedback_tab_name',esc_html__('Feedback','mayosis'));?></button>
  			<?php
	  	}
	  }
	  if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_storepolicy_setting', 1)) === 1){
	  		// get current vendor
			$policy_enabled = get_user_meta($vendor_id,'marketking_policy_enabled', true);
			if ($policy_enabled === 'yes'){
				$policy_message = get_user_meta($vendor_id,'marketking_policy_message', true);
				// show policies tab
				?>
				<button class="marketking_tablinks" value="marketking_vendor_tab_policies" type="button"><?php echo apply_filters('marketking_policies_tab_name',esc_html__('Policies','mayosis'));?></button>

				<?php
			}
  			?>
  			<?php
	  	}
	  }
	  if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_inquiries_setting', 1)) === 1){
	  		if (intval(get_option('marketking_enable_vendor_page_inquiries_setting', 1)) === 1){
	  			?>
	  			<button class="marketking_tablinks" value="marketking_vendor_tab_inquiries" type="button"><?php echo apply_filters('marketking_contact_tab_name',esc_html__('Contact','mayosis'));?></button>
	  			<?php
	  		}
	  	}
	  }
	  ?>
	</div>
  <div class="marketking_tabclass_right">
  	<?php
	  	if (defined('MARKETKINGPRO_DIR')){
		  	if (intval(get_option('marketking_enable_favorite_setting', 1)) === 1){
		  		// cannot follow self
		  		$user_id = get_current_user_id();
		  		if ($vendor_id !== $user_id && is_user_logged_in()){
		  			$follows = get_user_meta($user_id,'marketking_follows_vendor_'.$vendor_id, true);

		  			?>
		  			<button class="marketking_follow_button" value="<?php echo esc_attr($vendor_id);?>"><?php
		  				if ($follows !== 'yes'){
		  					esc_html_e('Follow','mayosis');
		  				} else if ($follows === 'yes'){
		  					esc_html_e('Following','mayosis');
		  				}
		  				
		  			?></button>
		  			<?php
		  		}
		  	}

		  	do_action('marketking_store_page_tabright', $vendor_id);
		}
  	?>
  </div>
</div>
<div class="container">
<!-- Tab content -->
<div id="marketking_vendor_tab_products" class="marketking_tab <?php echo marketking()->marketking_tab_active('products');?>">
  <?php
  	// Store Notice
  	if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_storenotice_setting', 1)) === 1){
			// get current vendor
			$notice_enabled = get_user_meta($vendor_id,'marketking_notice_enabled', true);
			if ($notice_enabled === 'yes'){
				$notice_message = get_user_meta($vendor_id,'marketking_notice_message', true);
				if (!empty($notice_message)){
					wc_print_notice($notice_message,'notice');
				}
			}
		}
  	}
   	
  	echo do_shortcode('[products limit="'.apply_filters('marketking_default_products_number',12).'" paginate="true" visibility="visible"]');	


  ?>
</div>

<div id="marketking_vendor_tab_policies" class="marketking_tab <?php echo marketking()->marketking_tab_active('policies');?>">
  <?php
  	// Store Policies
  	if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_storepolicy_setting', 1)) === 1){
			// get current vendor
			$policy_enabled = get_user_meta($vendor_id,'marketking_policy_enabled', true);
			if ($policy_enabled === 'yes'){
				$policy_message = get_user_meta($vendor_id,'marketking_policy_message', true);
				if (!empty($policy_message)){
					$policy_message = nl2br(esc_html($policy_message));
					$allowed = array('***h3***','***h4***','***i***','***strong***','***/h3***','***/h4***','***/i***','***/strong***');
					$replaced = array('<h3>','<h4>','<i>','<strong>','</h3>','</h4>','</i>','</strong>');

					$policy_message = str_replace($allowed, $replaced, $policy_message);
					echo esc-html($policy_message);
				}
			}
		}
  	}
  ?>
</div>

<div id="marketking_vendor_tab_reviews" class="marketking_tab <?php echo marketking()->marketking_tab_active('reviews');?>">
  <?php
  	// Reviews
  	if (defined('MARKETKINGPRO_DIR')){
	  	if (intval(get_option('marketking_enable_reviews_setting', 1)) === 1){
	  		$items_per_page = apply_filters('marketking_vendor_reviews_per_page', 5);

	  		$pagenr = get_query_var('pagenr2');
	  		if (empty($pagenr)){
	  			$pagenr = 1;
	  		}
			// last 10 reviews here
			$args = array ('post_type' => 'product', 'post_author' => $vendor_id, 'number' => $items_per_page, 'paged' => $pagenr,'type' => 'review');
		    $comments = get_comments( $args );

		    if (empty($comments)){
		    	esc_html_e('There are no reviews yet...','mayosis');
		    } else {
		    	// show review average
		    	$rating = marketking()->get_vendor_rating($vendor_id);
		    	// if there's any rating
		    	if (intval($rating['count'])!==0){
		    		?>
		    		<div class="marketking_rating_header">
			    		<?php
			    		// show rating
			    		if (intval($rating['count']) === 1){
			    			$review = esc_html__('review','mayosis');
			    		} else {
			    			$review = esc_html__('reviews','mayosis');
			    		}
			    		echo '<strong>'.esc_html__('Rating:','mayosis').'</strong> '.esc_html($rating['rating']).' '.esc_html__('rating from','mayosis').' '.esc_html($rating['count']).' '.esc_html($review);
			    		echo '<br>';
			    	?>
			   		</div>
			    	<?php
		    	}
		    }
		    wp_list_comments( array( 'callback' => 'woocommerce_comments' ), $comments);

		    // display pagination

		    // get total nr
		    $args = array ('post_type' => 'product', 'post_author' => $vendor_id, 'fields' => 'ids','type' => 'review');
		    $comments = get_comments( $args );
		    $totalnr = count($comments); //total nr of reviews
		    $nrofpages = ceil($totalnr/$items_per_page);
		    $store_link = marketking()->get_store_link($vendor_id);


		    $i = 1;
		    while($i <= $nrofpages){
		    	$pagelink = $store_link.'/reviews/'.$i;
		    	$active = '';
		    	if ($i === intval($pagenr)){
		    		$active = 'marketking_review_active_page';
		    	}
		    	// display page
		    	?>
		    	<a href="<?php echo esc_attr($pagelink);?>" class="marketking_review_pagination_page <?php echo esc_html($active);?>"><?php echo esc_html($i); ?></a>
		    	<?php
		    	$i++;
		    }


			?>
			<?php
		}
  	}
  
  ?>
</div>

<div id="marketking_vendor_tab_info" class="marketking_tab <?php echo marketking()->marketking_tab_active('info');?>">
  <?php
  	// if email or phone, show contact info
  	$showphone = get_user_meta($vendor_id,'marketking_show_store_phone', true);
  	$showemail = get_user_meta($vendor_id,'marketking_show_store_email', true);
  	$company = get_user_meta($vendor_id,'billing_company', true);

  	$phone = get_user_meta($vendor_id,'billing_phone', true);
  	$email = get_userdata($vendor_id)->user_email;
  	?>
  	<h3><?php esc_html_e('Vendor Information', 'mayosis'); ?></h3>

  	<?php

  	echo '<strong>'.esc_html__('Vendor: ','mayosis').'</strong>';
  	$store_name = marketking()->get_store_name_display($vendor_id);
  	echo esc_html($store_name).'<br>';

  	// display badges if applicable
  	if (defined('MARKETKINGPRO_DIR')){
  		if (intval(get_option('marketking_enable_badges_setting', 1)) === 1){
  			marketkingpro()->display_vendor_badges($vendor_id);
  		}
  	}

  	marketking()->display_about_us($vendor_id);

  	  	
  	?>
  	<?php
  	// rating
  	$rating = marketking()->get_vendor_rating($vendor_id);
  	// if there's any rating
  	if (intval($rating['count'])!==0){
  		// show rating
  		if (intval($rating['count']) === 1){
  			$review = esc_html__('review','mayosis');
  		} else {
  			$review = esc_html__('reviews','mayosis');
  		}
  		echo '<strong>'.esc_html__('Rating:','mayosis').'</strong> '.esc_html($rating['rating']).' '.esc_html__('rating from','mayosis').' '.esc_html($rating['count']).' '.esc_html($review);
  		echo '<br>';
  	}
  	
  	?>
  	<?php
  	if (!empty($company)){
  		echo '<br><strong>'.esc_html__('Company:','mayosis').'</strong> '.esc_html($company).'<br>';
  	}

  	$customer = new WC_Customer($vendor_id);
  	if (apply_filters('marketking_allow_vendor_address_frontend', true)){
		  	if (is_a($customer,'WC_Customer')){
		  		$address = $customer->get_billing();

		  		if (is_array($address)){
			  		if (!empty($address['address_1']) || !empty($address['address_2'])){
			  			echo '<strong>'.esc_html__('Address:','mayosis').'</strong> '.esc_html($address['address_1']).' '.esc_html($address['address_2']).', '.esc_html($address['city']).', '.esc_html($address['postcode']);

			  			if (!empty($address['country'])){
			  				if (isset($address['state']) && isset($address['country'])){
			  					$countrystates = WC()->countries->get_states( $address['country'] );
			  					$countrycountry = WC()->countries->countries;
			  					if (isset($countrystates[$address['state']]) && isset($countrycountry[ $address['country'] ])){
			  						echo ', '.$countrystates[$address['state']].', '.$countrycountry[ $address['country'] ].'<br>';
			  					}
			  				}
			  			}
			  		}
			  	}
		  	}
  	}
  	


  	// Store Cat
  	if (defined('MARKETKINGPRO_DIR')){

	  	if (intval(get_option('marketking_enable_storecategories_setting', 1)) === 1){
	  		$selectedarr = get_user_meta($vendor_id,'marketking_store_categories', true);

	  		if (!empty($selectedarr)){
	  			if (count($selectedarr) == 1){
	  				$text = esc_html__('Store Category','mayosis');
	  			} else {
	  				$text = esc_html__('Store Categories','mayosis');
	  			}

	  			foreach ($selectedarr as $index => $catid){
	  				$catname = get_term($catid)->name;
	  				$selectedarr[$index] = $catname;
	  			}

	  			$cats = implode(', ',$selectedarr);
	  			echo '<br><strong>'.$text.':</strong> '.$cats.'<br>';
	  		}
	  		

	  	}
	  }


  
		if ($showphone === 'yes'){
			echo '<strong>'.esc_html__('Phone:','mayosis').'</strong> '.esc_html($phone).'<br>';
		}
		if ($showemail === 'yes'){
			echo '<strong>'.esc_html__('Email:','mayosis').'</strong> '.esc_html($email).'<br>';
		}

		do_action('marketking_vendor_details_store_page', $vendor_id);

  	
  	echo '<br>';

  	
	?>
</div>
<?php

// Inquiry tab
if (defined('MARKETKINGPRO_DIR')){
	if (intval(get_option('marketking_enable_inquiries_setting', 1)) === 1){
		if (intval(get_option('marketking_enable_vendor_page_inquiries_setting', 1)) === 1){
			?>
				<div id="marketking_vendor_tab_inquiries" class="marketking_tab <?php echo marketking()->marketking_tab_active('inquiries');?>">
				  <?php
				  	marketkingpro()->get_vendor_inquiries_tab($vendor_id);
				  	
					?>
				</div>
				<?php
		}
	}
} ?>

</div>