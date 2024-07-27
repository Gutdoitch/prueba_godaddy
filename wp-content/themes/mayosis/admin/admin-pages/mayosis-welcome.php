<?php

$ssl_check = 'https' === substr(get_home_url(), 0, 5);
$green_mark = '<mark class="green"><span class="dashicons dashicons-yes"></span></mark>';

$mayosistheme = wp_get_theme();

$plugins_counts = (array)get_option('active_plugins', array());

if (is_multisite()) {
    $network_activated_plugins = array_keys(get_site_option('active_sitewide_plugins', array()));
    $plugins_counts = array_merge($plugins_counts, $network_activated_plugins);
}
?>

<div class="wrap about-wrap mayosis-wrap">
    <h1><?php _e('Welcome to Mayosis', 'mayosis'); ?></h1>

    <div class="about-text"><?php echo esc_html__('Mayosis theme is now installed and ready to use!', 'mayosis'); ?></div>
    <div class="mayosis-badge">
        <img src="<?php echo get_template_directory_uri(); ?>/images/icon.svg"
             alt="<?php esc_html_e('Mayosis Admin Logo', 'mayosis'); ?>">

        <p><?php echo esc_html($mayosistheme->get('Version')); ?></p>
    </div>
    <h2 class="nav-tab-wrapper">
        <?php
        printf('<a href="#" class="nav-tab nav-tab-active">%s</a>', __('Welcome', 'mayosis'));
        if (class_exists('Mayosis_Core')) {
        printf('<a href="admin.php?page=mayosis_options" class="nav-tab">%s</a>', __('Theme Options', 'mayosis'));
        }

        printf('<a href="%s" class="nav-tab">%s</a>', admin_url('admin.php?page=mayosis-wizard&step=content'), __('Demo Import', 'mayosis'));
        
         printf( '<a href="admin.php?page=teconce-themes" class="nav-tab">%s</a>', __( 'Other Themes', 'mayosis' ) );
        
        printf( '<a href="admin.php?page=mayosis-recommandation" class="nav-tab">%s</a>', __( 'Recommandations', 'mayosis' ) );
        ?>
    </h2>


    <div class="mayosis-section nav-tab-active" id="welcome">
        <p class="about-description">
            <?php printf(__('Before you get started, please be sure to always check out documentation Which Included In the theme folder or from <a href="https://teconce.ticksy.com/articles/100020472" target="_blank">Website</a>. We outline all kinds of good information and provide you with all the details you need to use mayosis.', 'mayosis')); ?>
        </p>
        <p class="about-description">
            <?php printf(__('If you are unable to find your answer in our documentation, please contact us via  <a href="https://teconce.ticksy.com/" target="_blank">submit a ticket</a> with your purchase code, site CPanel, and admin login info.', 'mayosis'), 'mailto:hello@teconce.com'); ?>
        </p>
        <p class="about-description">
            <?php printf(__('We are very happy to help you and you will get the reply from us  faster than you expected.', 'mayosis'), 'https://teconce.ticksy.com/articles/100020472'); ?>
        </p>

        <p class="about-description">
            <?php printf(__('Note: Please Install All Required Plugins Before Install Demo !', 'mayosis'), 'https://teconce.ticksy.com/articles/100020472'); ?>
        </p>
    </div>
    <div class="mayosis-thanks">
        <p class="description"><?php esc_html_e('Thank you for using', 'mayosis'); ?>
            <strong><?php esc_html_e('Mayosis', 'mayosis'); ?></strong> <?php esc_html_e('theme!', 'mayosis'); ?> <?php esc_html_e('Powered by', 'mayosis'); ?>
            <a href="<?php echo esc_url('https://teconce.com'); ?>"
               target="_blank"><?php esc_html_e('Teconce', 'mayosis'); ?></a></p>
    </div>
  

<div class="theme_inner_row">
    <div class="mayosis-system-stats mayosis-admin-50">
        <h3>System Status</h3>

        <table class="system-status-table">

			


				<tr>
					<td width="180"><?php esc_html_e( 'Install Location:', 'mayosis' ); ?></td>
					<td>
						<?php
						if ( get_template() === MAYOSIS_THEME_NAME ) {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code>', esc_html__( 'Standard', 'mayosis' ) ) );
						} else {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code>', __( 'Non-standard', 'mayosis' ) ) );
							echo mayosis__wp_kses( sprintf( __( 'Using %s Theme from non-standard install location or having a different directory name could lead to issues in receiving and installing updates. Please make sure that theme folder name is <strong>%s</strong>, without spaces.', 'mayosis' ), mayosis__get_props('theme_title'), MAYOSIS_THEME_NAME ) );
						}
						?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'File System Accessible:', 'mayosis' ); ?></td>
					<td>
						<?php
						global $wp_filesystem;

						if ( $wp_filesystem || WP_Filesystem() ) {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code>', esc_html__( 'Yes', 'mayosis' ) ) );
						} else {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code><p>%s</p>',
								__( 'No', 'mayosis' ),
								__( 'Theme has no direct access to the file system. Therefore plugins and pre-made websites installation is not possible to work properly.<br>Please try to insert the following code: <code>define( "FS_METHOD", "direct" );</code><br>before <code>/* That\'s all, stop editing! Happy blogging. */</code> in <code>wp-config.php</code>.', 'mayosis' ) )
							);
						}
						?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'Uploads Folder Writable:', 'mayosis' ); ?></td>
					<td>
					<?php
						$wp_uploads = wp_get_upload_dir();
						if ( wp_is_writable( trailingslashit( $wp_uploads['basedir'] ) ) ) {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code>', esc_html__( 'Yes', 'mayosis' ) ) );
						} else {
							echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code><p>%s</p>',
								__( 'No', 'mayosis' ),
								__( 'Uploads folder must be writable to allow WordPress function properly.<br>See <a href="https://codex.wordpress.org/Changing_File_Permissions" target="_blank">changing file permissions</a> or contact your hosting provider.', 'mayosis' ) )
							);
						}
					?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'ZipArchive Support:', 'mayosis' ); ?></td>
					<td>
					<?php
					if ( class_exists( 'ZipArchive' ) ) {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code>', esc_html__( 'Yes', 'mayosis' ) ) );
					} else {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code><p>%s</p>',
							__( 'No', 'mayosis' ),
							__( 'ZipArchive is required for plugins installation and pre-made websites import.<br>Please contact your hosting provider.', 'mayosis' ) )
						);
					}
					?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'PHP Version:', 'mayosis' ); ?></td>
					<td>
					<?php
					$php_version = PHP_VERSION;
					if ( version_compare( '7.3.0', $php_version, '>' ) ) {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--warning">%s</code> %s',
							$php_version,
							__( 'Current version is sufficient. However <strong>v.7.3.0</strong> or greater is recommended to improve the performance.', 'mayosis' ) )
						);
					} else {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s',
							$php_version,
							__( 'Current version is sufficient.', 'mayosis' ) )
						);
					}
					?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'PHP Max Input Vars:', 'mayosis' ); ?></td>
					<td>
					<?php
					$max_input_vars = ini_get( 'max_input_vars' );
					if ( $max_input_vars < 1000 ) {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code> %s',
							$max_input_vars,
							__( 'Minimum value is <strong>1000</strong>. <strong>2000</strong> is recommended. <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'mayosis' ) )
						);

					} elseif ( $max_input_vars < 2000 ) {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--warning">%s</code> %s',
							$max_input_vars,
							__( 'Current limit is sufficient for most tasks. <strong>2000</strong> is recommended. <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'mayosis' ) )
						);
					} elseif ( $max_input_vars < 3000 ) {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s',
							$max_input_vars,
							__( 'Current limit is sufficient. However, up to <strong>3000</strong> or more may be required if lots of plugins are in use and/or you have a large amount of menu items.', 'mayosis' ) )
						);
					} else {
						echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s',
							$max_input_vars,
							__( 'Current limit is sufficient.', 'mayosis' ) )
						);
					}
					?>
					</td>
				</tr>
				<tr>
					<td><?php esc_html_e( 'WP Memory Limit:', 'mayosis' ); ?></td>
					<td>
					<?php

					$memory = wp_convert_hr_to_bytes( @ini_get( 'memory_limit' ) );

					// translators: %1$s - wp codex article url.
					$tip = mayosis__wp_kses( sprintf(  __( '<br><small>See <a href="%1$s" target="_blank">increasing memory allocated to PHP</a> or contact your hosting provider.</small>', 'mayosis' ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ) );

					if ( $memory < 67108864 ) {
						echo mayosis__wp_kses(
							sprintf( '<code class="ssFlag ssFlag--danger">%s</code> %s %s',
								size_format( $memory ),
								__( 'Minimum value is <strong>64 MB</strong>. <strong>128 MB</strong> is recommended. <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the London Demo.', 'mayosis' ),
								$tip
							)
						);
					} elseif ( $memory < 134217728 ) {
						echo mayosis__wp_kses(
							sprintf( '<code class="ssFlag ssFlag--warning">%s</code> %s %s',
								size_format( $memory ),
								__( 'Current memory limit is sufficient for most tasks. However, recommended value is <strong>128 MB</strong>. <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the London Demo.', 'mayosis' ),
								$tip
							)
						);
					} elseif ( $memory < 268435456 ) {
						echo mayosis__wp_kses(
							sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s %s',
								size_format( $memory ),
								__( 'Current memory limit is sufficient. However, <strong>256 MB</strong> or more may be required if lots of plugins are in use and/or you want to install the London Demo.', 'mayosis' ),
								$tip
							)
						);
					} else {
						echo mayosis__wp_kses(
							sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s',
								size_format( $memory ),
								__( 'Current memory limit is sufficient.', 'mayosis' )
							)
						);
					}
					?>
					</td>
				</tr>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<tr>
						<td><?php esc_html_e( 'PHP Time Limit:', 'mayosis' ); ?></td>
						<td>
							<?php
							$time_limit = ini_get( 'max_execution_time' );

							// translators: %1$s - wp codex article url.
							$tip = mayosis__wp_kses( sprintf( __( '<br><small>See <a href="%1$s" target="_blank">increasing max PHP execution time</a> or contact your hosting provider.</small>', 'mayosis' ), 'http://codex.wordpress.org/Common_WordPress_Errors#Maximum_execution_time_exceeded' ) );

							if ( 300 > $time_limit && 0 != $time_limit ) {
								echo mayosis__wp_kses(
									sprintf( '<code class="ssFlag ssFlag--danger">%s</code> %s %s',
										$time_limit,
										__( 'Minimum value is <strong>300</strong>. <strong>600</strong> is recommended.', 'mayosis' ),
										$tip
									)
								);
							} elseif ( (600 > $time_limit && 300 <= $time_limit) && 0 != $time_limit ) {
								echo mayosis__wp_kses(
									sprintf( '<code class="ssFlag ssFlag--warning">%s</code> %s %s',
										$time_limit,
										__( 'Current time limit is sufficient, however <strong>600</strong> is recommended.', 'mayosis' ),
										$tip
									)
								);
							} elseif ( 600 <= $time_limit && 0 != $time_limit ) {
								echo mayosis__wp_kses(
									sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s %s',
										$time_limit,
										__( 'Current time limit should be sufficient.', 'mayosis' ),
										$tip
									)
								);
							} else {
								echo mayosis__wp_kses(
									sprintf( '<code class="ssFlag ssFlag--success">%s</code> %s',
										_x( 'unlimited', 'Time limit status.', 'mayosis' ),
										__( 'Current time limit is sufficient.', 'mayosis' )
									)
								);
							}
							?>
						</td>
					</tr>
				<?php endif; ?>
				<?php if ( function_exists( 'ini_get' ) ) : ?>
					<tr>
						<td><?php esc_html_e( 'Zlib Output Compression:', 'mayosis' ); ?></td>
						<td>
							<?php
							$zlib_output_compression = ini_get( 'zlib.output_compression' );

							if ( strtolower($zlib_output_compression) == 'on' ) {
								echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--danger">%s</code> %s',
									__( 'On', 'mayosis' ),
									sprintf(__( 'zlib.output_compression is problematic and throws errors most of the time in WordPress. Make sure to <a href="%s" target="_blank">disable it</a>.', 'mayosis' ), mayosis__support_url('kb/undefined-error-when-trying-to-install-plugins-or-import-demos/') ) )
								);
							} else {
								echo mayosis__wp_kses( sprintf( '<code class="ssFlag ssFlag--success">%s</code>', esc_html__( 'Off', 'mayosis' ) ) );
							}
							?>
						</td>
					</tr>
				<?php endif; ?>
			</table>
    </div>

    <div class="mayosis-system-stats mayosis-admin-50">
        <h3>Theme Information</h3>

        <table class="system-status-table">
            <tbody>
            <tr>
                <td><?php esc_html_e('Theme Name', 'mayosis'); ?></td>
                <td><?php echo wp_get_theme(); ?></td>
            </tr>

            <tr>
                <td><?php esc_html_e('Author Name', 'mayosis'); ?></td>
                <td><?php echo maybe_unserialize($mayosistheme->get('Author')); ?></td>
            </tr>

            <tr>
                <td><?php esc_html_e('Current Version', 'mayosis'); ?></td>
                <td><?php echo esc_html($mayosistheme->get('Version')); ?></td>
            </tr>

            <tr>
                <td><?php esc_html_e('Text Domain', 'mayosis'); ?></td>
                <td><?php echo esc_html($mayosistheme->get('TextDomain')); ?></td>
            </tr>

            <tr>
                <td><?php esc_html_e('Child Theme', 'mayosis'); ?></td>
                <td><?php echo is_child_theme() ? $green_mark : 'No'; ?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
    <div class="mayosis-system-stats">
        <h3>Active Plugins (<?php echo count($plugins_counts); ?>)</h3>
        <table class="system-status-table">
            <tbody>
            <?php
            foreach ($plugins_counts as $plugin) {

                $plugin_info = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                $dirname = dirname($plugin);
                $version_string = '';
                $network_string = '';

                if (!empty($plugin_info['Name'])) {

                    // Link the plugin name to the plugin url if available.
                    $plugin_name = esc_html($plugin_info['Name']);

                    if (!empty($plugin_info['PluginURI'])) {
                        $plugin_name = '<a href="' . esc_url($plugin_info['PluginURI']) . '" target="_blank">' . $plugin_name . '</a>';
                    }

                    ?>
                    <tr>
                        <?php
                        $allowed_html = [
                            'a' => [
                                'href' => [],
                                'title' => [],
                            ],
                            'br' => [],
                            'em' => [],
                            'strong' => [],
                        ];
                        ?>
                        <td class="ncs_plugin_name"><?php echo wp_kses($plugin_name, $allowed_html); ?></td>
                        <td><?php echo sprintf('by %s', $plugin_info['Author']) . ' &ndash; ' . esc_html($plugin_info['Version']) . $version_string . $network_string; ?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>

    </div>
    
     <div class="theme_hire_us_box">
        <img src="<?php echo get_template_directory_uri(); ?>/images/hire.svg"
             alt="<?php esc_html_e('hire us', 'mayosis'); ?>">
      
        <h5>Do you want to get <br>professional assistance?</h5>
        <p>start from $129</p>
        <a href="https://teconce.com/hire-us" class="take_service_button" target="_blank">More Details</a>
    </div>



</div>

 