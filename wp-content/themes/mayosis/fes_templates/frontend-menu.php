<?php
$task       = ! empty( $_GET['task'] ) ? $_GET['task'] : 'dashboard';
$icon_css   = apply_filters( "fes_vendor_dashboard_menu_icon_css", "icon-black" ); //else icon-black/dark
$menu_items = EDD_FES()->dashboard->get_vendor_dashboard_menu();
 $logininnerlogo= get_theme_mod( 'dash_inner_logo', get_template_directory_uri().'/images/logo.png' );
  global $current_user;
  $user_id  = empty( $user_id ) ? get_current_user_id() : $user_id;
?>
<div class="fes_dashboard_menu">
    <div class="logo-dashboard d-none d-lg-block">
        
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                 <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
    </div>
<nav class="fes-vendor-menu mayosis-frontend-menus d-none d-lg-block">
	<ul>
		<?php foreach ( $menu_items as $item => $values ) : $values["task"] = isset( $values["task"] ) ? $values["task"] : ''; ?>
			<li class="fes-vendor-menu-tab <?php echo 'fes-vendor-' . esc_attr( $values["task"] ) . '-tab'; if ( $task === $values["task"] ) { echo ' active'; } ?>">
				<a href='<?php echo add_query_arg( 'task', $values["task"], get_permalink() ); ?>'>
					<i class="icon icon-<?php echo esc_attr( $values["icon"] ); ?> <?php echo esc_attr( $icon_css ); ?>"></i> <span class="hidden-phone hidden-tablet"><?php echo isset( $values["name"] ) ? $values["name"] : $item; ?></span>
				</a>
				
			</li>
		<?php endforeach; ?>
		
	
	</ul>
</nav>
<div class="d-block d-lg-none mobile-dashboard-menu">
    <div class="row align-items-center justify-content-between px-2">
      <div class="logo-dashboard col-6">
        
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                 <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
    </div>
  <nav  class="fes-vendor-menu mayosis-frontend-menus mobile--nav-menu mayosis-dashboard-menu-main">
       
            	<ul>
		<?php foreach ( $menu_items as $item => $values ) : $values["task"] = isset( $values["task"] ) ? $values["task"] : ''; ?>
			<li class="fes-vendor-menu-tab <?php echo 'fes-vendor-' . esc_attr( $values["task"] ) . '-tab'; if ( $task === $values["task"] ) { echo ' active'; } ?>">
				<a href='<?php echo add_query_arg( 'task', $values["task"], get_permalink() ); ?>'>
					<i class="icon icon-<?php echo esc_attr( $values["icon"] ); ?> <?php echo esc_attr( $icon_css ); ?>"></i> <span class="hidden-phone hidden-tablet"><?php echo isset( $values["name"] ) ? $values["name"] : $item; ?></span>
				</a>
				
			</li>
		<?php endforeach; ?>
		
	
	</ul>
       
    </nav>
    <div class="overlaymobile"></div>
    
    		<div class="mobile_user col-6">
				 <ul  class="dashboard-mobile-menu float-end">
				        <li class="burger"><span></span></li>
				     </ul>
				     </div>
				     </div>
    </div>
    
	        <div class="user-information-ex-dashboard">
     <a href="#" data-toggle="dropdown"> <?php echo get_avatar( $user_id,40 ) ?> <?php echo esc_html($current_user->display_name ); ?></a>
     <a href="<?php echo wp_logout_url(home_url('/')) ?>" class="acc-logout-btn"><i class="zil zi-sign-out"></i></a>
</div>
</div>
<div class="clearfix"></div>