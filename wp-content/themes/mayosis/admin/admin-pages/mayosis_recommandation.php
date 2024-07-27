<?php
function mayosis_let_to_num( $size ) {
  $l   = substr( $size, -1 );
  $ret = substr( $size, 0, -1 );
  switch ( strtoupper( $l ) ) {
    case 'P':
      $ret *= 1024;
    case 'T':
      $ret *= 1024;
    case 'G':
      $ret *= 1024;
    case 'M':
      $ret *= 1024;
    case 'K':
      $ret *= 1024;
  }
  return $ret;
}
$ssl_check = 'https' === substr( get_home_url(), 0, 5 );
$green_mark = '<mark class="green"><span class="dashicons dashicons-yes"></span></mark>';

$mayosistheme = wp_get_theme();

$plugins_counts = (array) get_option( 'active_plugins', array() );

if ( is_multisite() ) {
	$network_activated_plugins = array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
	$plugins_counts            = array_merge( $plugins_counts, $network_activated_plugins );
}
?>

<div class="wrap about-wrap mayosis-wrap">
    <h1><?php _e( 'Welcome to Mayosis', 'mayosis' ); ?></h1>

    <div class="about-text"><?php echo esc_html__( 'mayosis theme is now installed and ready to use!', 'mayosis' ); ?></div>
<div class="mayosis-badge">
    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyZpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMTQ1IDc5LjE2MzQ5OSwgMjAxOC8wOC8xMy0xNjo0MDoyMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTkgKFdpbmRvd3MpIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjNCRjg0ODQ5MEYzMTExRTk5NTVBQTQyN0QwQkY2NzU0IiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjNCRjg0ODRBMEYzMTExRTk5NTVBQTQyN0QwQkY2NzU0Ij4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6M0JGODQ4NDcwRjMxMTFFOTk1NUFBNDI3RDBCRjY3NTQiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6M0JGODQ4NDgwRjMxMTFFOTk1NUFBNDI3RDBCRjY3NTQiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6vOdMRAAACHUlEQVR42uyazSsEYRzHZ1jadXBwkpycSDnKSVxcpGhTXkopDv4ERydxkIMktEWKoi1RlJML5cDJRdIqrRyUvLPp8X3q2dqmedt9Zmdnnv396tO2M/M8z3z2mef3PPO0OmNMK6eo0MosSFj1iJgcU21Q6/RIkzAJq520HAd+gINRD5MwCZMwCZNwmQnHwCy4A5/gFHR4UG8DWATn4BgMe7Ie4DseBsxCs+HQ5Ppv0OtQzo428GhS74JDOcd7lxVuZtbxA/oKkG0HzxZ1/oFGGWHZR7rJ5lw12AMDedTXCU5Anc0QbC3lGHYaU1x6B8Rd1NUDjkCtR+v/kmXprPSgzTX94ADUqDIt8V7ZBkMm50bArvhhlJqHK8EWGDXIbso+pkFeeHDpDTAmvp+BB9VXWlw6AcZBCnSJT6WXllx6HUwI2W5DT1+FUfjNRdurOdJxsUWTBJNhFObJ6d7FPL4MWsAFmBNr5t8wCrsdn1U5mXu6mLJ+jOHs+HSSrlcpabmRvlEtS9tJ34rkpdy0lBIbAyvgGlyCeXHsxa+biGj+xhOYoj0tEibhUAh/lahsUYWt5tZ3F8tKu+BlX/Ns0xdhPr3smxxfAhmJejNijW2MpGiz8PBgXzoKZkAafIAEiEnsSWfhdayJOtOijajsvrRu8tdDZvFWE4ZwvHfK0iRMwiRMwiQcoHD7Psyoh0mYhEk4qElLpx4mYRIOTfwLMAC52ad+ryhA1wAAAABJRU5ErkJggg==" alt="mayosis admin logo">
    
    <p><?php echo esc_html($mayosistheme->get( 'Version' )); ?></p>
</div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf( '<a href="admin.php?page=mayosis-admin-menu" class="nav-tab">%s</a>', __( 'Welcome', 'mayosis' ) );
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'customize.php' ), __( 'Theme Options', 'mayosis' ) );
         printf( '<a href="admin.php?page=mayosis_license" class="nav-tab">%s</a>', __( 'License', 'mayosis' ) );
       
        printf( '<a href="%s" class="nav-tab">%s</a>', admin_url( 'admin.php?page=mayosis-wizard&step=content' ), __( 'Demo Import', 'mayosis' ) );
        printf( '<a href="admin.php?page=teconce-themes" class="nav-tab">%s</a>', __( 'Other Themes', 'mayosis' ) );
        
        printf( '<a href="admin.php?page=mayosis-recommandation" class="nav-tab nav-tab-active">%s</a>', __( 'Recommandations', 'mayosis' ) );
        ?>
    </h2>
    
   
    <div class="mayosis-section nav-tab-active" id="recommadation-main">
        <div class="recommandation-item-box">
            <div class="recommandation-item">
                <h4>Frontend Submissions</h4>
                <p>Frontend Submissions provides a full-featured package to turn your Easy Digital Downloads powered website into a complete multi-vendor marketplace.</p>
                <a href="https://easydigitaldownloads.com/downloads/frontend-submissions/?ref=4812&campaign=mayosis" target="_blank">Buy Now</a>
            </div>
            
             <div class="recommandation-item">
                <h4>All Access</h4>
                <p>This makes for an amazingly smooth user experience when looking for a specific product from your store. In seconds, they can search, find, and download without needing to pay anything additional.</p>
                <a href="https://easydigitaldownloads.com/downloads/all-access/?ref=4812&campaign=mayosis" target="_blank">Buy Now</a>
            </div>
            
             <div class="recommandation-item">
                <h4>Elite Licenser</h4>
                <p>Elite Licenser is a WordPress software license manager plugin for any type of product licensing. It helps to manage product updates, license code auto generation, built in Envato licensing verification system.</p>
                <a href="https://hasthemes.sjv.io/Qk0No" target="_blank">Buy Now</a>
            </div>
            
            
            <div class="recommandation-item">
                <h4>Stripe Payment Gateway</h4>
                <p>The Stripe Payment Gateway extension for Easy Digital Downloads allows store owners to accept credit card payments on their sites.</p>
                <a href="https://easydigitaldownloads.com/downloads/stripe-gateway/?ref=4812&campaign=mayosis" target="_blank">Buy Now</a>
            </div>
            
             <div class="recommandation-item">
                <h4>EDD Wish Lists - Easy Digital Downloads</h4>
                <p>Give your customers the ability to save and share their favorite products on your site with the EDD Wish Lists add-on.</p>
                <a href="https://easydigitaldownloads.com/downloads/edd-wish-lists/?ref=4812&campaign=mayosis" target="_blank">Buy Now</a>
            </div>
            
           
            
             <div class="recommandation-item">
                <h4>Easy Digital Downloads - Social Login</h4>
                <p>Easy Digital Download Social Login extension allows users to log in and checkout with social networks such as Facebook, Twitter, Google, Yahoo, LinkedIn, Foursquare, Windows Live, VK.com, Instagram, Amazon and Paypal.</p>
                <a href="https://1.envato.market/W1rq3" target="_blank">Buy Now</a>
            </div>
        </div>
    </div>
  
    
    

        
       
	
        
</div>

