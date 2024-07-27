<?php $active_tab = affwp_get_active_affiliate_area_tab(); ?>

<div id="affwp-affiliate-dashboard" class="user-extended-dasboard">

	<?php if ( 'pending' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account is pending approval', 'mayosis' ); ?></p>

	<?php elseif ( 'inactive' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account is not active', 'mayosis' ); ?></p>

	<?php elseif ( 'rejected' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<p class="affwp-notice"><?php _e( 'Your affiliate account request has been rejected', 'mayosis' ); ?></p>

	<?php endif; ?>

	<?php if ( 'active' == affwp_get_affiliate_status( affwp_get_affiliate_id() ) ) : ?>

		<?php
		/**
		 * Fires at the top of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_top', affwp_get_affiliate_id(), $active_tab );
		?>

		<?php if ( ! empty( $_GET['affwp_notice'] ) && 'profile-updated' == $_GET['affwp_notice'] ) : ?>

			<p class="affwp-notice"><?php _e( 'Your affiliate profile has been updated', 'mayosis' ); ?></p>

		<?php endif; ?>

		<?php
		/**
		 * Fires inside the affiliate dashboard above the tabbed interface.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_notices', affwp_get_affiliate_id(), $active_tab );
		global $post;
  global $current_user;
  $user_id  = empty( $user_id ) ? get_current_user_id() : $user_id;
		 $logininnerlogo= get_theme_mod( 'dash_inner_logo', get_template_directory_uri().'/images/logo.png' );;
		?>
<div class="mayosis-affliate-tabs extended-dasboard-tab">
     <div class="logo-dashboard d-none d-md-block">
        
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                  <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
    </div>

		
			<ul id="affwp-affiliate-dashboard-tabs" class="d-none d-md-block">
			<?php if ( affwp_affiliate_area_show_tab( 'urls' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize( $active_tab == 'urls' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'urls' ) ); ?>"><?php _e( 'Affiliate URLs', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'stats' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'stats' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'stats' ) ); ?>"><?php _e( 'Statistics', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'graphs' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'graphs' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'graphs' ) ); ?>"><?php _e( 'Graphs', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'referrals' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'referrals' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'referrals' ) ); ?>"><?php _e( 'Referrals', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'payouts' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'payouts' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'payouts' ) ); ?>"><?php _e( 'Payouts', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'visits' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'visits' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'visits' ) ); ?>"><?php _e( 'Visits', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'creatives' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'creatives' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'creatives' ) ); ?>"><?php _e( 'Creatives', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php if ( affwp_affiliate_area_show_tab( 'settings' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab<?php echo maybe_serialize($active_tab == 'settings' ? ' active' : ''); ?>">
				<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( 'settings' ) ); ?>"><?php _e( 'Settings', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

			<?php
			/**
			 * Fires immediately after core Affiliate Area tabs are output,
			 * but before the 'Log Out' tab is output (if enabled).
			 *
			 * @since 0.2
			 *
			 * @param int    $affiliate_id ID of the current affiliate.
			 * @param string $active_tab   Slug of the active tab.
			 */
			do_action( 'affwp_affiliate_dashboard_tabs', affwp_get_affiliate_id(), $active_tab );
			?>

			<?php if ( affiliate_wp()->settings->get( 'logout_link' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab">
				<a href="<?php echo esc_url( affwp_get_logout_url() ); ?>"><?php _e( 'Log out', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

		</ul>
		
		  <div class="user-information-ex-dashboard">
     <a href="#" data-toggle="dropdown"> <?php echo get_avatar( $user_id,40 ) ?> <?php echo esc_html($current_user->display_name ); ?></a>
     <a href="<?php echo wp_logout_url(home_url('/')) ?>" class="acc-logout-btn"><i class="zil zi-sign-out"></i></a>
</div>
	
	<div class="d-block d-md-none mayosis-mobile-user-menu affiliate-mobile-dashboard-menu">
	    <div class="logo-dashboard">
        
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo_box">
                 <img src="<?php echo esc_url($logininnerlogo);  ?>" class="img-responsive" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"/>
                  </a>
    </div>
    
    <nav  class="mobile--nav-menu mayosis-dashboard-menu-main">
        	<ul id="affwp-affiliate-dashboard-tabs">
			<?php

			$tabs = affwp_get_active_affiliate_area_tab();

			if ( $tabs ) {
				foreach ( $tabs as $tab_slug => $tab_title ) : ?>
					<?php if ( affwp_affiliate_area_show_tab( $tab_slug ) ) : ?>
					<li class="affwp-affiliate-dashboard-tab<?php echo esc_html($active_tab == $tab_slug ? ' active' : ''); ?> af-dasboard-menu-icon-<?php echo esc_html($tab_title); ?>">
						<a href="<?php echo esc_url( affwp_get_affiliate_area_page_url( $tab_slug ) ); ?>"><?php echo esc_html($tab_title); ?></a>
					</li>
					<?php endif; ?>
				<?php endforeach;
			}

			/**
			 * Fires immediately after core Affiliate Area tabs are output,
			 * but before the 'Log Out' tab is output (if enabled).
			 *
			 * @since 1.0
			 *
			 * @param int    $affiliate_id ID of the current affiliate.
			 * @param string $active_tab   Slug of the active tab.
			 */
			do_action( 'affwp_affiliate_dashboard_tabs', affwp_get_affiliate_id(), $active_tab );
			?>

			<?php if ( affiliate_wp()->settings->get( 'logout_link' ) ) : ?>
			<li class="affwp-affiliate-dashboard-tab">
				<a href="<?php echo esc_url( affwp_get_logout_url() ); ?>"><?php _e( 'Log out', 'mayosis' ); ?></a>
			</li>
			<?php endif; ?>

        </nav>
        
        <div class="overlaymobile"></div>
    
    		<div class="mobile_user">
				 <ul  class="dashboard-mobile-menu">
				        <li class="burger"><span></span></li>
				     </ul>
				     </div>
	    </div>
</div>

    <div class="mayosis-mayosis-content extended-tab-content">
		<?php
		if ( ! empty( $active_tab ) && affwp_affiliate_area_show_tab( $active_tab ) ) :
			affiliate_wp()->templates->get_template_part( 'dashboard-tab', $active_tab );
		endif;
		?>
		</div>

		<?php
		/**
		 * Fires at the bottom of the affiliate dashboard.
		 *
		 * @since 0.2
		 * @since 1.8.2 Added the `$active_tab` parameter.
		 *
		 * @param int|false $affiliate_id ID for the current affiliate.
		 * @param string    $active_tab   Slug for the currently-active tab.
		 */
		do_action( 'affwp_affiliate_dashboard_bottom', affwp_get_affiliate_id(), $active_tab );
		?>

	<?php endif; ?>

</div>
