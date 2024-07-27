<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

 

function mayosis_preview_fix ($query) {
    if ( !is_page() ) {
        if( $query->is_main_query() && array_key_exists('preview_id', $_GET) ) {
            $post_types = array( 'download','post' );
            $query->set( 'post_type', $post_types );
        }
    }
}
add_filter( 'pre_get_posts', 'mayosis_preview_fix' );


// Menu Fallback
function mayosis_default_menu()
{
    get_template_part('includes/fallback-menu.php');
}


#-----------------------------------------------------------------#
# Ajax URL
#-----------------------------------------------------------------#
if( ! function_exists( 'mayosis_ajax' ) ){
    function mayosis_ajax() {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
        </script>
        <?php
    }
}
add_action('wp_head','mayosis_ajax');


#-----------------------------------------------------------------#
# ACF Dependency
#-----------------------------------------------------------------#/
function mayosis_disable_acf_on_frontend($plugins)
{
    if (is_admin())
        return $plugins;
    foreach ($plugins as $i => $plugin)
        if ('advanced-custom-fields-pro/acf.php' == $plugin)
            unset($plugins[$i]);
    return $plugins;
}
add_filter('option_active_plugins', 'mayosis_disable_acf_on_frontend');


#-----------------------------------------------------------------#
# Comment on EDD Download
#-----------------------------------------------------------------#/
function mayosis_edd_add_comments_support($supports)
{
    $supports[] = 'comments';
    return $supports;
}
add_filter('edd_download_supports', 'mayosis_edd_add_comments_support');

#-----------------------------------------------------------------#
# Mayosis Paginantion
#-----------------------------------------------------------------#/
if (!function_exists('mayosis_page_navs')): /**
 * Displays post pagination links
 *
 * @since mayosis 1.0
 */
    function mayosis_page_navs($query = false)
    {
        global $wp_query;
        if ($query) {
            $temp_query = $wp_query;
            $wp_query   = $query;
        }
        // Return early if there's only one page.
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return;
        }
        ?>
        <div class="common-paginav text-center">
            <div class="pagination">
                <?php
                $big = 999999999; // need an unlikely integer
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'prev_text' => 'Previous',
                    'next_text' => 'Next'
                ));
                ?>
            </div>
        </div>
        <?php
        if (isset($temp_query)) {
            $wp_query = $temp_query;
        }
    }
endif;



#-----------------------------------------------------------------#
# Download Dropdown Category
#-----------------------------------------------------------------#/
function mayosis_get_terms_dropdown($taxonomies, $args)
{
    $myterms = get_terms($taxonomies, $args);
    $output  = "<div class='download_cat_filter '><select name='download_cats'>";
    $output .= "<option value='all'>" . esc_html__("All", "mayosis") . "</option>";
    foreach ($myterms as $term) {
        $term_name = $term->name;
        $slug      = $term->slug;
        $output .= "<option value='" . $slug . "'>" . $term_name . "</option>";
    }
    $output .= "</select></div>";
    return $output;
}


function mayosis_vendor_cat_dropdown($taxonomies, $args)
{
    $myterms = get_terms($taxonomies, $args);
    $output  = "<div class='mayosis_vendor_cat'><select name='download_cats'>";
    $output .= "<option value='all'>" . esc_html__("All", "mayosis") . "</option>";
    foreach ($myterms as $term) {
        $term_name = $term->name;
        $slug      = $term->slug;
        $output .= "<option value='" . $slug . "'>" . $term_name . "</option>";
    }
    $output .= "</select></div>";
    return $output;
}



add_filter('edd_has_variable_price', 'special_nav_class', 10, 2);
function mayosis_excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}
function mayosis_content($limit)
{
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/[.+]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}
function mayosis_description($limit)
{
    $description = explode(' ', the_author_meta('description'), $limit);
    if (count($description) >= $limit) {
        array_pop($description);
        $description = implode(" ", $description) . '...';
    } else {
        $description = implode(" ", $description);
    }
    $description = preg_replace('`[[^]]*]`', '', $description);
    return $description;
}
#-----------------------------------------------------------------#
# Title Clipping
#-----------------------------------------------------------------#/
function mayosis_short_title($after, $length)
{
    $mytitle = explode(' ', get_the_title(), $length);
    if (count($mytitle) >= $length) {
        array_pop($mytitle);
        $mytitle = implode(" ", $mytitle) . $after;
    } else {
        $mytitle = implode(" ", $mytitle);
    }
    return $mytitle;
}

#-----------------------------------------------------------------#
# Compress CSS & Js
#-----------------------------------------------------------------#/
if ( ! function_exists( 'mayosis_compress_css_lines' ) ) {
  function mayosis_compress_css_lines( $css ) {
    $css  = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
    $css  = str_replace( ': ', ':', $css );
    $css  = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );
    return $css;
  }
}


if ( ! function_exists( 'mayosis_compress_js_lines' ) ) :

	function mayosis_compress_js_lines( $js ) {
		
		// Remove a tab
		$js = str_replace("\t", " ", $js);

		// Remove comments with "// "
		$js = preg_replace('/\n(\s+)?\/\/[^\n]*/', "", $js);	

		// Remove other comments
		$js = preg_replace("!/\*[^*]*\*+([^/][^*]*\*+)*/!", "", $js);
		$js = preg_replace("/\/\*[^\/]*\*\//", "", $js);
		$js = preg_replace("/\/\*\*((\r\n|\n) \*[^\n]*)+(\r\n|\n) \*\//", "", $js);		

		// Remove a carriage return
		$js = str_replace("\r", "", $js);

		// Remove whitespaces
		$js = preg_replace("/\s+\n/", "\n", $js);	
		$js = preg_replace("/\n\s+/", "\n ", $js);
		$js = preg_replace("/ +/", " ", $js);

		return $js;

	}

endif;
#-----------------------------------------------------------------#
# Inline Style
#-----------------------------------------------------------------#/
global $all_inline_styles;
$all_inline_styles = array();
if( ! function_exists( 'add_inline_style' ) ) {
  function add_inline_style( $style ) {
    global $all_inline_styles;
    array_push( $all_inline_styles, $style );
  }
}


#-----------------------------------------------------------------#
# HEX to RGB Converter
#-----------------------------------------------------------------#/

function mayosis_hexto_rgb($color, $opacity = false) {

    $default = 'rgb(0,0,0)';

    //Return default if no color provided
    if(empty($color))
        return $default;

    //Sanitize $color if "#" is provided
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }

    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map('hexdec', $hex);

    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }

    //Return rgb(a) color string
    return $output;
}


#-----------------------------------------------------------------#
# Easy social share
#-----------------------------------------------------------------#/

add_filter('essb_is_theme_integrated', 'mayosis_essb_is_in_theme');
function mayosis_essb_is_in_theme() {
    return true;
}

#-----------------------------------------------------------------#
# Mayosis Elementor CPT Support
#-----------------------------------------------------------------#/
function mayosis_ele_cpt_support() {

    //if exists, assign to $cpt_support var
    $cpt_support = get_option( 'elementor_cpt_support' );

    //check if option DOESN'T exist in db
    if( ! $cpt_support ) {
        $cpt_support = [ 'page', 'post', 'product_template','footer_builder','edd_archive_builder','mayosis_block']; //create array of our default supported post types
        update_option( 'elementor_cpt_support', $cpt_support ); //write it to the database
    }

    //if it DOES exist, but product_template is NOT defined
    else if( ! in_array( 'product_template', $cpt_support ) ) {
        $cpt_support[] = 'product_template'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    //if it DOES exist, but product_template is NOT defined
    else if( ! in_array( 'footer_builder', $cpt_support ) ) {
        $cpt_support[] = 'footer_builder'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    else if( ! in_array( 'edd_archive_builder', $cpt_support ) ) {
        $cpt_support[] = 'edd_archive_builder'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }
    
    else if( ! in_array( 'mayosis_block', $cpt_support ) ) {
        $cpt_support[] = 'mayosis_block'; //append to array
        update_option( 'elementor_cpt_support', $cpt_support ); //update database
    }

    //otherwise do nothing, product_template already exists in elementor_cpt_support option
}
add_action( 'after_switch_theme', 'mayosis_ele_cpt_support' );


/* Comment form validation on same page*/
function mayosis_comment_validation_init() {
    if(is_single()) { ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#commentform').validate({
                    rules: {
                        author: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        comment: {
                            required: true,
                            minlength: 20
                        }
                    },
                    messages: {
                        author: "Please enter your name",
                        email: "Please enter a valid email address.",
                        comment: {
                            required: "Please enter your comment",
                            minlength: "You comment must be at least 20 characters long",
                        }
                    },
                    errorElement: "div",
                    errorPlacement: function(error, element) {
                        element.after(error);
                    }
                });
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'mayosis_comment_validation_init');




#-----------------------------------------------------------------#
# Mayosis Function - Authorization init.
#-----------------------------------------------------------------#/

if( ! function_exists( 'mayosis_authorisation_init' ) ){
  function mayosis_authorisation_init(){
    if (function_exists('edd_get_option')) { 
      $loginRedirectPageID=edd_get_option( 'login_redirect_page', '' );
      $loginRedirect=get_permalink( $loginRedirectPageID ); 
    } else {
      $loginRedirect=home_url();
    }    
    wp_enqueue_script('mayosis-register-login', get_template_directory_uri().'/js/ajax-register-login.js', array('jquery'));
    wp_localize_script( 'mayosis-register-login', 'ajax_auth_object', array(
      'ajaxurl'     => admin_url( 'admin-ajax.php' ),
      'redirecturl'   => isset($loginRedirect) ? $loginRedirect : home_url(),
      'loadingmessage'  => esc_html__('Sending user info, please wait...','mayosis')
      ));
    add_action( 'wp_ajax_mayosis_ajaxlogin', 'mayosis_ajaxlogin' );
    add_action( 'wp_ajax_nopriv_mayosis_ajaxlogin', 'mayosis_ajaxlogin' );
    add_action( 'wp_ajax_nopriv_mayosis_ajaxregister','mayosis_ajax_register' );
    add_action( 'wp_ajax_mayosis_ajaxregister', 'mayosis_ajax_register' );
  }
}
add_action('init', 'mayosis_authorisation_init');

#-----------------------------------------------------------------#
# Mayosis Function - Ajax Login.
#-----------------------------------------------------------------#/

if( ! function_exists( 'mayosis_ajaxlogin' ) ){
  function mayosis_ajaxlogin(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    // Call auth_user_login
    mayosis_auth_user_login($_POST['username'], $_POST['password'], 'Login'); 
    
    die();
  }
}

#-----------------------------------------------------------------#
# Mayosis Function - Ajax Register.
#-----------------------------------------------------------------#/

if( ! function_exists( 'mayosis_ajax_register' ) ){
  function mayosis_ajax_register(){

   global $options; $options = get_option('mayosis_register_login');

    // First check the nonce, if it fails the function will break
   check_ajax_referer( 'ajax-register-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
   $info = array();
   $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = $info['user_login'] = sanitize_user($_POST['username']) ;
   $info['user_pass'] = sanitize_text_field($_POST['password']);
   $info['user_email'] = sanitize_email( $_POST['email']);

  // Register the user

   if(!is_email($info['user_email']) ){
    echo json_encode(array('loggedin'=>false, 'message'=>esc_html__("Please enter a valid email address","mayosis")));
    die();
  }
  if(sanitize_text_field($_POST['password2'])!=$info['user_pass']){
    echo json_encode(array('loggedin'=>false, 'message'=>esc_html__("Please enter same password in both fields","mayosis")));
    die();
  }
  if(!isset($info['user_pass'])|| !(strlen($info['user_pass']) >0 ) ){
    echo json_encode(array('loggedin'=>false, 'message'=>esc_html__("Password fields cannot be blank","mayosis")));
    die();
  }

  $user_register = wp_insert_user( $info );
  if ( is_wp_error($user_register) ){ 
    $error  = $user_register->get_error_codes() ;

    if(in_array('empty_user_login', $error))
      echo json_encode(array('loggedin'=>false, 'message'=>$user_register->get_error_message('empty_user_login')));
    elseif(in_array('existing_user_login',$error))
      echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('This username is already registered.','mayosis')));
    elseif(in_array('existing_user_email',$error))
      echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('This email address is already registered.','mayosis')));
  } else {

    mayosis_auth_user_login($info['nickname'], $info['user_pass'], 'Registration');       
  }

  die();
}
}

#-----------------------------------------------------------------#
# Mayosis Function - Auth User Login.
#-----------------------------------------------------------------#/

if( ! function_exists( 'mayosis_auth_user_login' ) ){
  function mayosis_auth_user_login($user_login, $password, $login)
  { 
    $info = array();
    $info['user_login'] = $user_login;
    $info['user_password'] = $password;
    $info['remember'] = true;
    
    add_action( 'set_logged_in_cookie', 'mayosis_loggedin_cookie' );
    function mayosis_loggedin_cookie( $logged_in_cookie ){
        $_COOKIE[LOGGED_IN_COOKIE] = $logged_in_cookie;
    }

    $user_signon = wp_signon( $info, is_ssl() ? true : false);
    if ( is_wp_error($user_signon) ){
      echo json_encode(array('loggedin'=>false, 'message'=>esc_html__('Wrong username or password.','mayosis')));
    } else {
      global $current_user;
      wp_set_current_user($user_signon->ID); 
      if($login=="Login"){
       echo json_encode(array('loggedin'=>true, 'message'=>esc_html__('Login successful, redirecting...','mayosis')));
     }
     else{
       echo json_encode(array('loggedin'=>true, 'message'=>esc_html__('Registration successful, redirecting...','mayosis')));
     }
     
   }
   
   die();
 }
}


if(!function_exists('mayosis__wp_kses')):
	/**
	 * Allow basic tags
	 *
	 * @since 1.0.0
	 **/
	function mayosis__wp_kses($string = '')
	{
		return wp_kses($string, [
			'a' => [
				'class' => [],
				'href' => [],
				'target' => []
			],
			'code' => [
				'class' => []
			],
			'strong' => [],
			'br' => [],
			'em' => [],
			'p' => [
				'class' => []
			],
			'span' => [
				'class' => []
			],
		]);
	}
endif;


if(!function_exists('mayosis__implode_html_attributes')):
	/**
	 * Implode and escape HTML attributes for output.
	 *
	 * @since 1.9.4
	 * @param array $raw_attributes Attribute name value pairs.
	 * @return string
	 */
	function mayosis__implode_html_attributes( $raw_attributes ) {

		$rendered_attributes = [];

		foreach ( $raw_attributes as $attribute_key => $attribute_values ) {
			if ( is_array( $attribute_values ) ) {
				$attribute_values = implode( ' ', $attribute_values );
			}

			$rendered_attributes[] = sprintf( '%1$s="%2$s"', $attribute_key, esc_attr( $attribute_values ) );
		}

		return implode( ' ', $rendered_attributes );
	}
endif;


if(!function_exists('mayosis__valid_url')):
	/**
	 * Checks for valid 200 response code
	 *
	 * @since 2.4.0
	 **/
	function mayosis__valid_url($url)
	{

		$response = wp_safe_remote_get( $url );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		return 200 === wp_remote_retrieve_response_code( $response );
	}
endif;
