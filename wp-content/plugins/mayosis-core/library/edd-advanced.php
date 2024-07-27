<?php
if(!is_admin()){
/*
 * Category selector in submission form
 */
 if (isset($_GET['task']) && $_GET['task'] === 'edit-product' ||isset($_GET['task']) && $_GET['task'] === 'new-product') {
  add_action('wp_enqueue_scripts', 'mayosis_selector_additional_script');  // Category dropdown
}
function mayosis_selector_additional_script()
{
  wp_enqueue_script('category_dropdown_js', plugin_dir_url( __FILE__ ) . '../public/js/category-dropdown.js', array('jquery'), '0.0.1', true);
//  wp_enqueue_script('jquery_ui_lib', 'https://code.jquery.com/ui/1.12.1/jquery-ui.min.js', array('jquery'), '0.0.1', true);
  // via select2
  wp_enqueue_style('select2_css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css');
  wp_enqueue_script('select2_js', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js', array(), '0.0.1', true);

}

add_action('category_dropdown_autocomplete', 'mayosis_mayosis_dropdown_autocomplete_field', 10, 3);

function mayosis_mayosis_dropdown_autocomplete_field($form, $save_id, $field)
{
  echo do_shortcode('[dropdown_autocomplete_input]');
}

add_shortcode('dropdown_autocomplete_input', 'mayosis_get_dropdown_autocomplete_input');

function mayosis_get_dropdown_autocomplete_input()
{
  $html = '';
//  $html .= '<div class="fes-el download_tag category_autocomplete">		<div class="fes-label">
//			    <label for="category_autocomplete">Products Category<span class="fes-required-indicator">*</span></label>
//				</div>
//				<div class="fes-fields">
//					<input class="textfield fes-required-field category_autocomplete" id="category_autocomplete" type="text" data-required="1" data-type="text" name="category_autocomplete" size="40" placeholder="Start typing...">
//				</div>
//		  </div>';
  return $html;
}


/*
 * Upload button for Cover Photo Url field in Dashboard > Profile
 */


function get_term_id_by_slug($item, $taxonomy = 'download_category')
{
  return get_term_by('slug', $item, $taxonomy)->term_id;
}


add_action('fes_save_submission_form_values_after_save', 'mayosis_fes_formsds', 10, 3);

function mayosis_fes_formsds($inst) {
    action_save_download_product($inst->save_id, get_post($inst->save_id), true);
}

/*
 *  Add parents categories
 */
function action_save_download_product($post_ID, $post, $update)
{
  $slug = 'download';

  if ($slug !== $post->post_type) {
    return;
  }

  $download_categories = get_the_terms($post_ID, 'download_category');

  if (!$download_categories) {
    return;
  }

  $categories = [];

  foreach ($download_categories as $download_category) {
    array_push($categories, $download_category->term_id);
  }


  foreach ($download_categories as $category) {
    if ($category->parent === 0) {
      continue;
    }

    $parents_categories_id = array_map('get_term_id_by_slug', array_filter(explode('/', get_term_parents_list($category->parent, 'download_category')), function ($value) {
      return $value !== '';
    }));

    if (count($parents_categories_id) === 0) {
      continue;
    }

    foreach ($parents_categories_id as $id) {
      array_push($categories, $id);
    }
  }

  wp_set_post_terms($post_ID, $categories, 'download_category');
}


}

function mayosis_download_vendor_dashboard_menu( $menu_items ) {
	$menu_items['purchase_history'] = array(
		"icon" => "",
		"task" => array( 'purchase_history' ),
		"name" => __( 'Purchases', 'mayosis-core' ), // the text that appears on the tab
	);
	
		if( class_exists( 'EDDC' ) ) {
	$menu_items['user_commisions'] = array(
		"icon" => "",
		"task" => array( 'user_commisions' ),
		"name" => __( 'Commisions', 'mayosis-core' ), // the text that appears on the tab
	);
	 }
	 
	$menu_items['following_items'] = array(
		"icon" => "",
		"task" => array( 'following_items' ),
		"name" => __( 'Follow Details', 'mayosis-core' ), // the text that appears on the tab
	);
	

	 
	 
	 if( class_exists( 'EDD_All_Access' ) ) {
	$menu_items['all_access'] = array(
		"icon" => "",
		"task" => array( 'all_access' ),
		"name" => __( 'All Access', 'mayosis-core' ), // the text that appears on the tab
	);
	 }
	  if( class_exists( 'EDD_Recurring' ) ) {
	$menu_items['edd_recurring'] = array(
		"icon" => "",
		"task" => array( 'edd_recurring' ),
		"name" => __( 'Subscription', 'mayosis-core' ), // the text that appears on the tab
	);
	 }
	return $menu_items;
}
add_filter( 'fes_vendor_dashboard_menu', 'mayosis_download_vendor_dashboard_menu' );

// make the new tab work
function mayosis_download_task_response( $custom, $task ) {
	if ( $task == 'purchase_history' ) {
		$custom = 'purchase_history';
	}
	if( class_exists( 'EDDC' ) ) {
		if ( $task == 'user_commisions' ) {
		$custom = 'user_commisions';
	}
	 }
	if ( $task == 'following_items' ) {
		$custom = 'following_items';
	}
	
	 
	 
	 
	 if( class_exists( 'EDD_All_Access' ) ) {
		if ( $task == 'all_access' ) {
		$custom = 'all_access';
	}
	 }
	 
	 	 if( class_exists( 'EDD_Recurring' ) ) {
		if ( $task == 'edd_recurring' ) {
		$custom = 'edd_recurring';
	}
	 }
	return $custom;
}
add_filter( 'fes_signal_custom_task', 'mayosis_download_task_response', 10, 2 );




// the content associated with your new tab
function mayosis_purchase_history_tab_content() {
    
     $layouts  = get_theme_mod( 'vendor_purchase_box_item', array( 'purchase','download') );
	?>
	<div class="vendor-dashboard-boxes">
	    <?php
	     if ($layouts): foreach ($layouts as $layout) {

                                switch($layout) {
                                    
                                      case 'purchase':
	    ?>
	    <div class="vendor-purchase-box-alt">
	    <h4><?php esc_html_e('Purchase History','mayosis-core');?></h4>
<?php echo do_shortcode('[purchase_history]');?>
</div>
<?php
   break;
                                    case 'download':
?>
 <div class="vendor-download-box-alt">

  <h4><?php esc_html_e('Download History','mayosis-core');?></h4>
 <?php echo do_shortcode('[download_history]');?>
</div>

<?php
 break;
                                }
	     }
	     endif;
?>
</div>

	<?php
}
add_action( 'fes_custom_task_purchase_history','mayosis_purchase_history_tab_content' );


 if( class_exists( 'EDDC' ) ) {
function mayosis_user_commisions_tab_content() {
	?>
	<div class="vendor-dashboard-boxes">
   <?php echo do_shortcode('[edd_commissions]'); ?>
    <?php echo do_shortcode('[edd_commissions_overview]'); ?>
     <?php echo do_shortcode('[edd_commissioned_products]'); ?>
   
    
     
</div>

	<?php
}
add_action( 'fes_custom_task_user_commisions','mayosis_user_commisions_tab_content' );

}


function mayosis_following_items_tab_content() {
	?>
	<div class="vendor-dashboard-boxes">
	    <h4><?php esc_html_e('Following Items','mayosis-core');?></h4>
 <?php echo do_shortcode('[following_posts]'); ?><br><br>
 
  <h4><?php esc_html_e('Followers','mayosis-core');?></h4>
 <?php echo do_shortcode('[get_follower]'); ?><br><br>
 
  <h4><?php esc_html_e('Following','mayosis-core');?></h4>
 <?php echo do_shortcode('[get_following]'); ?>
</div>

	<?php
}
add_action( 'fes_custom_task_following_items','mayosis_following_items_tab_content' );

 if( class_exists( 'EDD_All_Access' ) ) {
function mayosis_all_access_tab_content() {
	?>
	<div class="vendor-dashboard-boxes">
	    <h4><?php esc_html_e('All Access','mayosis-core');?></h4>
   <?php echo do_shortcode('[edd_aa_customer_passes]'); ?>
</div>

	<?php
}
add_action( 'fes_custom_task_all_access','mayosis_all_access_tab_content' );

}

 if( class_exists( 'EDD_Recurring' ) ) {
function mayosis_edd_recurring_tab_content() {
	?>
	<div class="vendor-dashboard-boxes">
	    <h4><?php esc_html_e('Subscription','mayosis-core');?></h4>
   <?php echo do_shortcode('[edd_subscriptions]'); ?>
</div>

	<?php
}
add_action( 'fes_custom_task_edd_recurring','mayosis_edd_recurring_tab_content' );

}

