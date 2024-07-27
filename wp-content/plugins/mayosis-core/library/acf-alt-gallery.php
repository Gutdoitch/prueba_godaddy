<?php
if (class_exists( 'EDD_Front_End_Submissions' ) ) {
if(!is_admin()){
function mayosis_gallery_alt( $form_id, $post_id, $form_settings) {
   
 if(isset($_GET['task']) && $_GET['task'] === 'new-product') {
    $new_post = array(
        // PUT IN YOUR OWN FIELD GROUP ID(s)
       
        'field_groups' => array('group_62ea7821db4eb'), // Create post field group ID(s)
        'form' => false,
         
        
    );
 } else {
     $new_post = array(
        // PUT IN YOUR OWN FIELD GROUP ID(s)
         'post_id' => $post_id,
        'field_groups' => array('group_62ea7821db4eb'), // Create post field group ID(s)
        'form' => false,
         
         
    );  
 }
    acf_form( $new_post );

 
}


add_action( 'mayosis_gallery_alt_hook', 'mayosis_gallery_alt', 10, 3 );
}


add_action( 'save_post', 'mayosis_fgallery_fe_submission' );

function mayosis_fgallery_fe_submission($post_id) {
  
   $field_key = "field_62ea7838d7d0f";
    $posted_flexible = $_POST["acf"][$field_key];
    if ( isset( $posted_flexible ) ) {
    $value =  (get_field($field_key) ? get_field($field_key) : array());
    foreach($posted_flexible as $layout){
        $value[] = $layout;
    }
    update_field( $field_key, $value, $post_id );
        
    }

}


 



add_action('wp', 'mayosis_allow_vendor_uploads');
function mayosis_allow_vendor_uploads() {
  $vendor = get_role('subscriber');
  $vendor->add_cap('edit_others_pages');
  $vendor->add_cap('edit_published_pages');
  $vendor->add_cap('edit_published_posts');
  $vendor->add_cap('edit_others_posts');
  $vendor->add_cap('upload_files');

  
  
}
   
}
