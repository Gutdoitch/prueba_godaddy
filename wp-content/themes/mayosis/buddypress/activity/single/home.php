<div id="buddypress">
     <div id="item-header-wrap">
		<div class="item-scroll-header">
	    	<div id="item-header" role="complementary">

				<?php
				/**
				 * If the cover image feature is enabled, use a specific header
				 */
				if ( version_compare( BP_VERSION, '2.4', '>=' ) && bp_displayed_user_use_cover_image_header() ) :
					bp_get_template_part( 'members/single/cover-image-header' );
				else :
					bp_get_template_part( 'members/single/member-header' );
				endif;
				?>

			</div><!-- #item-header -->

			<div id="item-nav">
				<div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
					<ul>
						<?php bp_get_displayed_user_nav(); ?>

						<?php

						/**
						 * Fires after the display of member options navigation.
						 *
						 * @since 1.2.4
						 */
						do_action( 'bp_member_options_nav' ); ?>

						<li class="more"><span> </span></li>
					</ul>
				</div>
			</div><!-- #item-nav -->
		</div><!-- .item-scroll-header -->
    </div><!-- #item-header-wrap -->
    <div id="item-body" class="mayosis-bp-group">
        <div class="bp-header-image-box">
	    <div id="header-cover-image"></div>
	    <div class="header-cover-image-overlay"></div>
	    </div>
	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
	do_action( 'template_notices' ); ?>

	<div class="activity no-ajax">
		<?php if ( bp_has_activities( 'display_comments=threaded&show_hidden=true&include=' . bp_current_action() ) ) : ?>

			<ul id="activity-stream" class="activity-list item-list">
			<?php while ( bp_activities() ) : bp_the_activity(); ?>

				<?php bp_get_template_part( 'activity/entry' ); ?>

			<?php endwhile; ?>
			</ul>

		<?php endif; ?>
	</div>
	</div>
</div>
