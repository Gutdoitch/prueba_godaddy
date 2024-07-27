<?php

if ( ! class_exists( 'EDD_Amazon_S3' ) ) :

	/**
	 * EDD_Amazon_S3 Class.
	 */
	final class EDD_Amazon_S3 {

		/**
		 * Holds the instance
		 *
		 * Ensures that only one instance of EDD Reviews exists in memory at any one
		 * time and it also prevents needing to define globals all over the place.
		 *
		 * TL;DR This is a static property property that holds the singleton instance.
		 *
		 * @var object
		 * @static
		 * @since 1.0
		 */
		private static $instance;

		/**
		 * Access Key ID.
		 *
		 * @var string
		 */
		private $access_id;

		/**
		 * Secret Key.
		 *
		 * @var string
		 */
		private $secret_key;

		/**
		 * S3 Bucket.
		 *
		 * @var string
		 */
		private $bucket;

		/**
		 * Link Expiry Time.
		 *
		 * @var int
		 */
		private $default_expiry;

		/**
		 * Instance of the S3Client.
		 *
		 * @var \Aws\S3\S3Client
		 */
		private $s3;

		/**
		 * Get active object instance
		 *
		 * @since  1.0
		 *
		 * @access public
		 * @static
		 * @return object
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof EDD_Amazon_S3 ) ) {
				self::$instance = new EDD_Amazon_S3();
			}

			return self::$instance;
		}

		/**
		 * Class constructor. Includes constants, includes and init method.
		 *
		 * @since  1.0
		 * @access private
		 */
		private function __construct() {
			global $edd_options;

			$this->access_id      = isset( $edd_options['edd_amazon_s3_id'] ) ? trim( $edd_options['edd_amazon_s3_id'] ) : '';
			$this->secret_key     = isset( $edd_options['edd_amazon_s3_key'] ) ? trim( $edd_options['edd_amazon_s3_key'] ) : '';
			$this->bucket         = isset( $edd_options['edd_amazon_s3_bucket'] ) ? trim( $edd_options['edd_amazon_s3_bucket'] ) : '';
			$this->default_expiry = isset( $edd_options['edd_amazon_s3_default_expiry'] ) ? trim( $edd_options['edd_amazon_s3_default_expiry'] ) : '5';

			$this->load_textdomain();
			$this->init();

			require_once __DIR__ . '/includes/class-amazon-s3-endpoint.php';

			if ( class_exists( '\\EDDAmazon\\Vendor\\Aws\\S3\\S3MultiRegionClient' ) ) {
				$this->s3 = new EDDAmazon\Vendor\Aws\S3\S3MultiRegionClient(
					array(
						'version'           => 'latest',
						'credentials'       => array(
							'key'    => $this->access_id,
							'secret' => $this->secret_key,
						),
						'endpoint'          => $this->get_host(),
						'signature_version' => 'v4',
						'scheme'            => is_ssl() ? 'https' : 'http',
					)
				);
			} else {
				$this->s3 = EDDAmazon\Vendor\Aws\S3\S3Client::factory(
					array(
						'credentials' => array(
							'key'    => $this->access_id,
							'secret' => $this->secret_key,
						),
						'endpoint'    => $this->get_host(),
					)
				);
			}
		}

		/**
		 * Check if API keys have been entered
		 *
		 * @access public
		 * @since  2.3.10
		 *
		 * @return bool
		 */
		public function has_api_keys() {
			return ! empty( $this->access_id ) && ! empty( $this->secret_key );
		}

		/**
		 * Internationalization
		 *
		 * @access public
		 * @since  2.1.9
		 *
		 * @return void
		 */
		public function load_textdomain() {
			// Set filter for language directory.
			$lang_dir = EDD_AS3_FILE_PATH . '/languages/';
			$lang_dir = apply_filters( 'edd_amazon_s3_languages_directory', $lang_dir );

			// Traditional WordPress plugin locale filter.
			$locale = apply_filters( 'plugin_locale', get_locale(), 'edd-amazon-s3' );
			$mofile = sprintf( '%1$s-%2$s.mo', 'edd-amazon-s3', $locale );

			// Setup paths to current locale file.
			$mofile_local  = $lang_dir . $mofile;
			$mofile_global = WP_LANG_DIR . '/edd-amazon-s3/' . $mofile;

			if ( file_exists( $mofile_global ) ) {
				// Look in global /wp-content/languages/edd-amazon-s3/ folder.
				load_textdomain( 'edd_s3', $mofile_global );
			} elseif ( file_exists( $mofile_local ) ) {
				// Look in local /wp-content/plugins/edd-amazon-s3/languages/ folder.
				load_textdomain( 'edd_s3', $mofile_local );
			} else {
				// Load the default language files.
				load_plugin_textdomain( 'edd_s3', false, $lang_dir );
			}
		}

		/**
		 * Run action and filter hooks.
		 *
		 * @access private
		 * @since  1.0
		 *
		 * @return void
		 */
		private function init() {

			add_action(
				'edd_extension_license_init',
				function ( \EDD\Extensions\ExtensionRegistry $registry ) {
					$registry->addExtension( EDD_AS3_PLUGIN_FILE, EDD_AS3_SL_PRODUCT_NAME, 2726, EDD_AS3_VERSION );
				}
			);

			add_action( 'admin_head', array( $this, 'admin_js' ) );
			add_action( 'admin_notices', array( $this, 'show_admin_notices' ), 10 );

			// Adds Media Tab.
			add_filter( 'media_upload_tabs', array( $this, 's3_tabs' ) );
			add_action( 'media_upload_s3', array( $this, 's3_upload_iframe' ) );
			add_action( 'media_upload_s3_library', array( $this, 's3_library_iframe' ) );

			add_filter( 'edd_settings_sections_extensions', array( $this, 'settings_section' ) );
			add_filter( 'edd_settings_extensions', array( $this, 'add_settings' ) );
			add_filter( 'edd_s3_upload', array( $this, 'upload_handler' ), 10, 2 );
			add_action( 'edd_edd_amazon_s3_bucket', array( $this, 's3_bucket_field' ) );
			add_action( 'edd_refresh_s3_buckets', array( $this, 'refresh_s3_buckets' ) );

			// Modify the file name on download.
			add_filter( 'edd_requested_file_name', array( $this, 'requested_file_name' ) );

			// Intercept the file download and generate an expiring link.
			add_filter( 'edd_requested_file', array( $this, 'generate_url' ), 10, 3 );
			add_action( 'edd_process_verified_download', array( $this, 'add_set_download_method' ), 10, 4 );

			// FES Integration.
			add_action( 'fes_load_fields_require', array( $this, 'include_fes_field' ) );
			add_filter( 'fes_validate_multiple_pricing_field_files', array( $this, 'valid_url' ), 10, 2 );
			add_filter( 'fes_pre_files_save', array( $this, 'send_fes_files_to_s3' ), 10, 2 );
			add_filter( 'fes_load_fields_array', array( $this, 'add_fes_field' ), 10, 1 );

			// CFM Integration.
			add_filter( 'cfm_validate_filter_url_file_upload_field', array( $this, 'valid_url' ), 10, 2 );
			add_filter(
				'cfm_save_field_admin_file_upload_field_attachment_id',
				array(
					$this,
					'send_cfm_files_to_s3',
				),
				10,
				2
			);
			add_filter(
				'cfm_save_field_frontend_file_upload_field_attachment_id',
				array(
					$this,
					'send_cfm_files_to_s3',
				),
				10,
				2
			);
			add_filter( 'cfm_file_download_url', array( $this, 'file_download_url' ), 10, 1 );
		}

		public function show_admin_notices() {
			if ( empty( $this->access_id ) || empty( $this->secret_key ) ) {
				$url = admin_url( 'edit.php?post_type=download&page=edd-settings&tab=extensions&section=amazon_s3' );
				echo '<div class="update error"><p>' . sprintf( __( 'Please enter your <a href="%s">Amazon S3 Access Key ID and Secret Key</a>', 'edd_s3' ), $url ) . '</p></div>';
			}
		}

		public function s3_tabs( $tabs ) {
			if ( ! wp_script_is( 'fes_form', 'enqueued' ) && ! wp_script_is( 'cfm_form', 'enqueued' ) ) {
				$tabs['s3']         = __( 'Upload to Amazon S3', 'edd_s3' );
				$tabs['s3_library'] = __( 'Amazon S3 Library', 'edd_s3' );
			}

			return $tabs;
		}

		/**
		 * Display iframe for S3 Upload.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return string $return Media upload form handler.
		 */
		public function s3_upload_iframe() {
			if ( ! empty( $_POST ) ) {
				$return = media_upload_form_handler();

				if ( is_string( $return ) ) {
					return $return;
				}
			}

			wp_iframe( array( $this, 's3_upload_download_tab' ) );
		}

		/**
		 * Render S3 Upload Tab.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return void
		 */
		public function s3_upload_download_tab( $type = 'file', $errors = null, $id = null ) {
			wp_enqueue_style( 'media' );

			$form_action_url = esc_url( add_query_arg( array( 'edd_action' => 's3_upload' ), admin_url() ) );
			?>
			<style>
				.edd_errors { border-radius: 2px; border: 1px solid #e6db55; margin: 2em 0; background: #ffffe0; color: #333; }
				.edd_errors p { margin: 10px 15px; padding: 0 10px; }
				.edd-s3-upload { padding: 1em; }
				.edd-form-group { margin-bottom: 1em; }
				.edd-form-group__label { display: block; font-weight: 600; margin-bottom: .5em; }
			</style>
			<script>
				jQuery( document ).ready( function( $ ) {
					$( '.edd-s3-insert' ).click( function() {
						var file = $(this).data( 's3-file' );
						var bucket = $(this).data( 's3-bucket' );

						$( parent.window.edd_filename ).val( file );
						$( parent.window.edd_fileurl ).val( bucket + '/' + file );
						parent.window.tb_remove();
					} );
				} );
			</script>
			<div class="wrap">
				<?php if ( ! $this->api_keys_entered() ) : ?>
					<div class="error">
						<p><?php printf( __( 'Please enter your <a href="%s" target="_blank">Amazon S3 API keys</a>.', 'edd_s3' ), admin_url( 'edit.php?post_type=download&page=edd-settings&tab=extensions&section=amazon_s3' ) ); ?></p>
					</div>
					<?php
					return;
				endif;

				$buckets = $this->get_s3_buckets();
				if ( empty( $buckets ) ) {
					$errors = edd_get_errors();
					if ( array_key_exists( 'edd-amazon-s3', $errors ) ) {
						if ( current_user_can( 'manage_options' ) ) {
							$message = $errors['edd-amazon-s3'];
						} else {
							$message = __( 'Error retrieving file. Please contact the site administrator.', 'edd_s3' );
						}

						echo '<div class="update error"><p>' . $message . '</p></div>';
						exit;
					}
				}
				?>
				<form enctype="multipart/form-data" method="post" action="<?php echo esc_attr( $form_action_url ); ?>" class="edd-s3-upload">
					<div class="edd-form-group">
						<label for="edd_s3_bucket" class="edd-form-group__label"><?php esc_html_e( 'Select a bucket:', 'edd_s3' ); ?></label>
						<div class="edd-form-group__control">
							<select name="edd_s3_bucket" id="edd_s3_bucket" class="edd-form-group__input">
								<?php foreach ( $buckets['buckets'] as $key => $bucket ) { ?>
									<option value="<?php echo esc_attr( $bucket['name'] ); ?>" <?php selected( $this->bucket, $bucket['name'] ); ?>><?php echo esc_html( $bucket['name'] ); ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="edd-form-group">
						<label for="edd_s3_file" class="edd-form-group__label"><?php esc_html_e( 'Select file:', 'edd_s3' ); ?></label>
						<div class="edd-form-group__control">
							<input type="file" name="edd_s3_file" id="edd_s3_file" />
						</div>
					</div>
					<div class="edd-form-submit">
						<input type="submit" class="button-secondary" value="<?php esc_attr_e( 'Upload to S3', 'edd_s3' ); ?>" />
					</div>
					<?php
					if ( ! empty( $_GET['s3_success'] ) && '1' == $_GET['s3_success'] ) {
						$s3_file   = sanitize_text_field( $_GET['s3_file'] );
						$s3_bucket = sanitize_text_field( $_GET['s3_bucket'] );
						?>
						<div class="edd_errors">
							<p class="edd_success">
								<?php
								printf(
									wp_kses_post(
										/* translators: %1$s: opening anchor tag, %2$s: singular download label, %3$s: closing anchor tag */
										__( 'Success! %1$sInsert uploaded file into %2$s%3$s.', 'edd_s3' )
									),
									'<a href="" class="edd-s3-insert" data-s3-file="' . esc_attr( $s3_file ) . '" data-s3-bucket="' . esc_attr( $s3_bucket ) . '">',
									esc_html( edd_get_label_singular() ),
									'</a>'
								);
								?>
							</p>
						</div>
						<?php
					}
					?>
				</form>
			</div>
			<?php
		}

		/**
		 * Display iframe for S3 Library tab.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return string $return Media upload form handler.
		 */
		public function s3_library_iframe() {
			if ( ! empty( $_POST ) ) {
				$return = media_upload_form_handler();

				if ( is_string( $return ) ) {
					return $return;
				}
			}

			wp_iframe( array( $this, 's3_library_tab' ) );
		}

		/**
		 * Render S3 Library Tab.
		 *
		 * @access public
		 * @since  1.0
		 */
		public function s3_library_tab( $type = 'file', $errors = null, $id = null ) {
			wp_enqueue_style( 'media' );

			if ( ! $this->api_keys_entered() ) {
				?>
				<div class="error">
					<p><?php printf( __( 'Please enter your <a href="%s" target="blank">Amazon S3 API keys</a>.', 'edd_s3' ), admin_url( 'edit.php?post_type=download&page=edd-settings&tab=extensions&section=amazon_s3' ) ); ?></p>
				</div>
				<?php
				return;
			}

			$page     = isset( $_GET['p'] ) ? $_GET['p'] : 1;
			$per_page = 30;
			$offset   = $per_page * ( $page - 1 );
			$offset   = $offset < 1 ? 30 : $offset;
			$start    = isset( $_GET['start'] ) ? rawurldecode( $_GET['start'] ) : '';
			$bucket   = isset( $_GET['bucket'] ) ? rawurldecode( $_GET['bucket'] ) : false;

			if ( ! $bucket ) {
				$buckets = $this->get_s3_buckets();
				if ( false === $buckets ) {
					$errors = edd_get_errors();
					if ( array_key_exists( 'edd-amazon-s3', $errors ) ) {
						if ( current_user_can( 'manage_options' ) ) {
							$message = $errors['edd-amazon-s3'];
						} else {
							$message = __( 'Error retrieving file. Please contact the site administrator.', 'edd_s3' );
						}

						echo '<div class="update error"><p>' . $message . '</p></div>';
						exit;
					}
				}
			} else {
				$this->bucket = $bucket;
				$files        = $this->get_s3_files( $start, $offset );

				if ( false === $files ) {
					$errors = edd_get_errors();
					if ( array_key_exists( 'edd-amazon-s3', $errors ) ) {
						if ( current_user_can( 'manage_options' ) ) {
							$message = $errors['edd-amazon-s3'];
						} else {
							$message = __( 'Error retrieving file. Please contact the site administrator.', 'edd_s3' );
						}

						echo '<div class="update error"><p>' . $message . '</p></div>';
						exit;
					}
				}
			}
			?>
			<script type="text/javascript">
				//<![CDATA[
				jQuery( function( $ ) {
					$( '.insert-s3' ).on( 'click', function() {
						var file = $( this ).data( 's3' );
						$( parent.window.edd_filename ).val( file );
						$( parent.window.edd_fileurl ).val( "<?php echo $this->bucket; ?>/" + file );
						parent.window.tb_remove();
					} );
				} );
				//]]>
			</script>
			<div style="margin: 20px 1em 1em; padding-right:20px;" id="media-items">
			<?php

			if ( ! $bucket ) {
				?>
				<h3 class="media-title"><?php _e( 'Select a Bucket', 'edd_s3' ); ?></h3>
				<?php
				if ( is_array( $buckets ) ) {
					echo '<table class="wp-list-table widefat fixed striped" style="max-height: 500px;overflow-y:scroll;">';
						echo '<thead>';
							echo '<tr>';
							echo '<th>' . __( 'Bucket Name', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Owner', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Actions', 'edd_s3' ) . '</th>';
							echo '</tr>';
						echo '</thead>';

					if ( count( $buckets['buckets'] ) > 0 ) {
						echo '<tbody>';
						foreach ( $buckets['buckets'] as $key => $bucket ) {
							echo '<tr>';
							echo '<td>' . $bucket['name'] . '</td>';
							echo '<td>' . $buckets['owner']['name'] . '</td>';
							echo '<td><a href="' . esc_url( add_query_arg( 'bucket', $bucket['name'] ) ) . '">' . __( 'Browse', 'edd_s3' ) . '</a></td>';
							echo '</tr>';
						}
						echo '</tbody>';
					}
						echo '</table>';
				}
			} else {
				if ( is_array( $files ) ) {
					$i           = 0;
					$total_items = count( $files );

					echo '<p><button class="button-secondary" onclick="history.back();">' . __( 'Go Back', 'edd_s3' ) . '</button></p>';

					echo '<table class="wp-list-table widefat fixed striped" style="max-height: 500px;overflow-y:scroll;">';
					echo '<thead>';
						echo '<tr>';
							echo '<th>' . __( 'File Name', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Size', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Last Modified', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Owner', 'edd_s3' ) . '</th>';
							echo '<th>' . __( 'Actions', 'edd_s3' ) . '</th>';
						echo '</tr>';
					echo '</thead>';

					if ( $total_items > 0 ) {
						echo '<tbody>';

						foreach ( $files as $key => $file ) {

							if ( ! isset( $file['name'] ) ) {
								continue;
							}

							if ( '/' === $file['name'][ strlen( $file['name'] ) - 1 ] || 'NextMarker' === $key ) {
								continue; // Don't show folders.
							}

							echo '<tr>';
							if ( $i == 0 ) {
								$first_file = $key;
							}

							if ( $i == 29 ) {
								$last_file = $key;
							}

							if ( $file['name'][ strlen( $file['name'] ) - 1 ] === '/' ) {
								continue; // Don't show folders
							}

							$sizes     = array( 'bytes', 'KB', 'MB', 'GB' );
							$factor    = floor( strlen( $file['size'] - 1 ) / 3 );
							$file_size = sprintf( '%.2f', $file['size'] / pow( 1024, $factor ) ) . ' ' . $sizes[ $factor ];

							echo '<td>' . $file['name'] . '</td>';
							echo '<td>' . $file_size . '</td>';
							echo '<td>' . date( 'j M Y H:i:s', $file['time'] ) . '</td>';
							echo '<td>' . $file['owner'] . '</td>';
							echo '<td><a class="insert-s3 button-secondary" href="#" data-s3="' . esc_attr( $file['name'] ) . '">' . __( 'Use File', 'edd_s3' ) . '</a></td>';
							echo '</tr>';
							++$i;
						}
						echo '</tbody>';
					}

					echo '</table>';
				} else {
					echo '<div class="error">';
						echo '<p>' . __( 'No files have been uploaded to Amazon S3 yet. Upload one now!', 'edd_s3' ) . '</p>';
					echo '</div>';
					exit;
				}

				$base = add_query_arg(
					array(
						'post_id' => isset( $_GET['post_id'] ) ? absint( $_GET['post_id'] ) : 0,
						'tab'     => 's3_library',
						'bucket'  => urlencode( $bucket ),
					),
					'media-upload.php'
				);

				echo '<div class="s3-pagination tablenav">';
					echo '<div class="alignleft">';
				if ( isset( $_GET['p'] ) && $_GET['p'] > 1 ) {
					echo '<a class="button-secondary prev" href="' . esc_url( remove_query_arg( 'p', $base ) ) . '">' . __( 'Start Over', 'edd_s3' ) . '</a>';
				}

				if ( isset( $files['NextMarker'] ) ) {
					$last_file = $files['NextMarker'];
				}

				if ( $i >= 29 || isset( $files['NextMarker'] ) ) {
					echo '<a class="button-secondary next" href="' . esc_url(
						add_query_arg(
							array(
								'p'     => $page + 1,
								'start' => $last_file,
							),
							$base
						)
					) . '">' . __( 'View More', 'edd_s3' ) . '</a>';
				}
						echo '</div>';
						echo '</div>';
			}
			?>
			</div>
			<?php
		}

		/**
		 * Retrieve a list of S3 buckets.
		 *
		 * @access public
		 * @since  2.3
		 *
		 * @return array $results Array of S3 buckets.
		 */
		public function get_s3_buckets( $marker = null, $max = null ) {

			$temp_buckets = get_transient( 'edd_s3_buckets' );
			if ( false !== $temp_buckets ) {
				return $temp_buckets;
			}
			$buckets = null;

			try {
				$buckets = $this->s3->listBuckets();
			} catch ( EDDAmazon\Vendor\Aws\S3\Exception\S3Exception $e ) {
				$this->generate_error( $e );
				return array();
			}

			$results = array();

			if ( isset( $buckets['Owner'], $buckets['Owner']['ID'], $buckets['Owner']['DisplayName'] ) ) {
				$results['owner'] = array(
					'id'   => $buckets['Owner']['ID'],
					'name' => $buckets['Owner']['DisplayName'],
				);
			}

			$results['buckets'] = array();

			foreach ( $buckets['Buckets'] as $bucket ) {
				$results['buckets'][] = array(
					'name' => $bucket['Name'],
					'time' => strtotime( (string) $bucket['CreationDate'] ),
				);
			}
			set_transient( 'edd_s3_buckets', $results, 12 * HOUR_IN_SECONDS );

			return $results;
		}

		/**
		 * Retrieve the files in a S3 bucket.
		 *
		 * @access public
		 * @since  2.3
		 *
		 * @param  string $marker Last files.
		 * @param  int    $max    Maximum files to retrieve.
		 *
		 * @return array $files S3 Files.
		 */
		public function get_s3_files( $marker = null, $max = null ) {
			$results = null;

			try {
				$files = $this->s3->listObjects(
					array(
						'Bucket'  => $this->bucket,
						'Marker'  => $marker,
						'MaxKeys' => $max,
					)
				);

				if ( isset( $files['Contents'] ) ) {
					foreach ( $files['Contents'] as $file ) {
						$results[ $file['Key'] ] = array(
							'name'  => $file['Key'],
							'time'  => strtotime( $file['LastModified'] ),
							'size'  => $file['Size'],
							'hash'  => substr( $file['ETag'], 1, -1 ),
							'owner' => isset( $file['Owner']['DisplayName'] ) ? $file['Owner']['DisplayName'] : __( 'N/A', 'edd_s3' ),
						);
					}
				}

				if ( isset( $files['IsTruncated'] ) && false == $files['IsTruncated'] ) {
					return $results;
				} elseif ( isset( $files['IsTruncated'] ) && true == $files['IsTruncated'] ) {
					$last_file             = end( $files['Contents'] );
					$results['NextMarker'] = $last_file['Key'];
				}

				return $results;
			} catch ( EDDAmazon\Vendor\Aws\S3\Exception\S3Exception $e ) {
				$this->generate_error( $e );
				return array();
			}
		}

		/**
		 * Generate an authenticated S3 URL for a specified filename.
		 *
		 * @access public
		 * @since  2.3 - Updated to use AWS SDK.
		 *
		 * @param  string $filename File name.
		 * @param  int    $expires  Link expiry time.
		 *
		 * @return string $url Generated URL.
		 */
		public function get_s3_url( $filename, $expires = 5 ) {
			$filename = $this->cleanup_filename( $filename );

			if ( false !== strpos( $filename, '/' ) ) {
				$parts   = explode( '/', $filename );
				$bucket  = $parts[0];
				$buckets = $this->get_s3_buckets();

				if ( empty( $buckets ) ) {
					$errors = edd_get_errors();
					if ( array_key_exists( 'edd-amazon-s3', $errors ) ) {
						if ( current_user_can( 'manage_options' ) ) {
							wp_die( $errors['edd-amazon-s3'] );
						} else {
							wp_die( __( 'Error retrieving file. Please contact the site administrator.', 'edd_s3' ) );
						}
					}
				}

				if ( in_array( $bucket, wp_list_pluck( $buckets['buckets'], 'name' ) ) ) {
					$filename = preg_replace( '#^' . $parts[0] . '/#', '', $filename, 1 );
				} else {
					$bucket = $this->bucket;
				}
			} else {
				$bucket = $this->bucket;
			}

			$filename = str_replace( '+', ' ', $filename );

			if ( class_exists( '\\EDDAmazon\\Vendor\\Aws\\S3\\S3MultiRegionClient' ) ) {
				$object_command = $this->s3->getCommand(
					'GetObject',
					array(
						'Bucket' => $bucket,
						'Key'    => $filename,
					)
				);

				$request = $this->s3->createPresignedRequest( $object_command, '+' . $expires . ' minutes' );

				$url = (string) $request->getUri();

				return $url;
			} else {
				return $this->s3->getObjectUrl( $bucket, $filename, '+10 minutes' );
			}
		}

		/**
		 * Triggers when uploading a file.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return void
		 */
		public function upload_handler() {
			if ( ! is_admin() ) {
				return;
			}

			$s3_upload_cap = apply_filters( 'edd_s3_upload_cap', 'edit_products' );

			if ( ! current_user_can( $s3_upload_cap ) ) {
				wp_die( __( 'You do not have permission to upload files to S3', 'edd_s3' ) );
			}

			if ( empty( $_FILES['edd_s3_file'] ) || empty( $_FILES['edd_s3_file']['name'] ) ) {
				wp_die( __( 'Please select a file to upload', 'edd_s3' ), __( 'Error', 'edd_s3' ), array( 'back_link' => true ) );
			}

			$file = array(
				'bucket' => $_POST['edd_s3_bucket'],
				'name'   => $_FILES['edd_s3_file']['name'],
				'file'   => $_FILES['edd_s3_file']['tmp_name'],
				'type'   => $_FILES['edd_s3_file']['type'],
			);

			if ( $this->upload_file( $file ) ) {
				wp_safe_redirect(
					add_query_arg(
						array(
							's3_success' => '1',
							's3_file'    => $file['name'],
							's3_bucket'  => $file['bucket'],
						),
						$_SERVER['HTTP_REFERER']
					)
				);
				exit;
			} else {
				wp_die( __( 'Something went wrong during the upload process', 'edd_s3' ), __( 'Error', 'edd_s3' ), array( 'back_link' => true ) );
			}
		}

		/**
		 * Upload file to S3 Bucket.
		 *
		 * @access public
		 * @since  2.3 - Updated to use AWS SDK.
		 *
		 * @param  array $file File info.
		 *
		 * @return bool Whether the upload was successful or not.
		 */
		public function upload_file( $file = array() ) {
			if ( empty( $file ) ) {
				return false;
			}

			$bucket = empty( $file['bucket'] ) ? $this->bucket : $file['bucket'];

			try {
				$this->s3->putObject(
					array(
						'Bucket'     => $bucket,
						'Key'        => $file['name'],
						'SourceFile' => $file['file'],
					)
				);

				return true;
			} catch ( EDDAmazon\Vendor\Aws\S3\Exception\S3Exception $e ) {
				$this->generate_error( $e );
				return false;
			}
		}

		/**
		 * Returns the file name from a full file path.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @param  string $file_name Full file path.
		 *
		 * @return string $file_name File name.
		 */
		public function requested_file_name( $file_name ) {
			if ( false !== ( $s3 = strpos( $file_name, 'AWSAccessKeyId' ) ) ) {
				$s3_part   = substr( $file_name, $s3, strlen( $file_name ) );
				$file_name = str_replace( $s3_part, '', $file_name );
				$file_name = substr( $file_name, 0, -1 );
			}

			return $file_name;
		}

		/**
		 * Retrieve the S3 Endpoint as defined in the EDD Settings.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return string S3 Host.
		 */
		public function get_host() {
			$host = trim( edd_get_option( 'edd_amazon_s3_host', 'https://s3.amazonaws.com' ) );

			return EDD_Amazon_S3_Endpoint::build( $host );
		}

		/**
		 * Print JavaScript in WP Admin.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @return void
		 */
		public function admin_js() {
			?>
			<script type="text/javascript">
				//<![CDATA[
				jQuery( function( $ ) {
					$( 'body' ).on( 'click', '.edd_upload_file_button', function( e ) {
						window.edd_fileurl = $( this ).parent().prev().find( 'input' );
						window.edd_filename = $( this ).parent().parent().parent().prev().find( 'input' );
					} );
				} );
				//]]>
			</script>
			<?php
		}

		/**
		 * Generate URL.
		 *
		 * @access public
		 * @since  1.0
		 */
		public function generate_url( $file, $download_files, $file_key ) {

			if ( ! $this->has_api_keys() ) {
				return $file;
			}

			$file_data = $download_files[ $file_key ];
			$file_name = $file_data['file'];

			// Check whether this is an Amazon S3 file or not.
			if ( $this->is_s3_file( $file_name ) ) {
				$expires = $this->default_expiry;

				if ( false !== ( strpos( $file_name, 'AWSAccessKeyId' ) ) ) {
					// We are dealing with a URL prior to Amazon S3 extension 1.4
					$file_name = $this->cleanup_filename( $file_name );

					// If we still get back the old format then there is something wrong here and just return the old filename
					if ( false !== ( strpos( $file_name, 'AWSAccessKeyId' ) ) ) {
						return $file_name;
					}
				}

				return set_url_scheme( $this->get_s3_url( $file_name, $expires ), 'https' );
			}

			return $file;
		}

		/**
		 * Hijack download method.
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @param int         $download Download ID.
		 * @param string      $email    Email address.
		 * @param EDD_Payment $payment  EDD_Payment object.
		 * @param array       $args     Arguments.
		 */
		public function add_set_download_method( $download, $email, $payment, $args = array() ) {
			if ( empty( $args ) ) {
				return;
			}

			if ( $this->is_s3_download( $download, $args['file_key'] ) ) {
				add_filter( 'edd_file_download_method', array( $this, 'set_download_method' ) );
			}
		}

		/**
		 * Change download method to "redirect".
		 *
		 * @access public
		 * @since  1.0
		 *
		 * @param string $method Download method.
		 */
		public function set_download_method( $method ) {
			return 'redirect';
		}

		/**
		 * Check if the download is an S3 download.
		 *
		 * @access private
		 * @since  1.0
		 *
		 * @param  int $download_id Download ID.
		 * @param  int $file_id     File ID.
		 *
		 * @return boolean $ret Whether the file is an S3 download or not.
		 */
		private function is_s3_download( $download_id = 0, $file_id = 0 ) {
			$ret   = false;
			$files = edd_get_download_files( $download_id );

			if ( isset( $files[ $file_id ] ) ) {
				$file_name = $files[ $file_id ]['file'];

				// Check whether this is an Amazon S3 file or not
				if ( $this->is_s3_file( $file_name ) ) {
					$ret = true;
				}
			}

			return $ret;
		}

		/**
		 * Determine if the file provided matches the S3 pattern
		 *
		 * @since  2.2.3
		 *
		 * @param  string $file_name The Filename to verify
		 *
		 * @return boolean            If the file passed is an S3 file or a local/url
		 */
		public function is_s3_file( $file_name ) {

			if ( empty( $file_name ) ) {
				return false;
			}

			// Check for a legacy URL.
			if ( false !== ( strpos( $file_name, 'AWSAccessKeyId' ) ) ) {
				return true;
			}

			$parsed_url = wp_parse_url( $file_name );

			// Using the media uploader, there will be no host or scheme.
			if ( ! isset( $parsed_url['host'] ) && ! isset( $parsed_url['scheme'] ) && '/' !== $file_name[0] ) {
				return true;
			}
			// If the host is S3, then we know it's an S3 file.
			if ( 's3' === $parsed_url['scheme'] ) {
				return true;
			}

			$host = $this->get_host();
			$host = str_replace( 'https://', '', $host );

			// If the S3 host is in the file name, then we know it's an S3 file.
			if ( false !== strpos( $file_name, $host ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Strip Amazon Host from Filename.
		 *
		 * @access public
		 * @since  1.4
		 *
		 * @param string $old_file_name File name with Amazon host.
		 *
		 * @return string Cleaned up file name.
		 */
		public function cleanup_filename( $old_file_name ) {
			$parsed_url = wp_parse_url( $old_file_name );
			if ( ! empty( $parsed_url['path'] ) && $parsed_url['path'] !== $old_file_name ) {
				return ltrim( $parsed_url['path'], '/' );
			}

			return $old_file_name;
		}

		/**
		 * Registers the subsection for EDD Settings
		 *
		 * @access public
		 * @since  2.2.4
		 *
		 * @param  array $sections Settings Sections.
		 *
		 * @return array Sections with S3 added.
		 */
		public function settings_section( $sections ) {
			$sections['amazon_s3'] = __( 'Amazon S3', 'edd_s3' );

			return $sections;
		}

		/**
		 * Register Settings.
		 *
		 * @access public
		 *
		 * @param array $settings Existing settings.
		 *
		 * @return array $settings Updated settings.
		 */
		public function add_settings( $settings ) {

			$s3_settings = array(
				array(
					'id'   => 'edd_amazon_s3_id',
					'name' => __( 'Amazon S3 Access Key ID', 'edd_s3' ),
					'desc' => __( 'Enter your IAM user&#39;s Access Key ID. See our <a href="http://docs.easydigitaldownloads.com/article/393-amazon-s3-documentation">documentation for assistance</a>.', 'edd_s3' ),
					'type' => 'text',
					'size' => 'regular',
				),
				array(
					'id'   => 'edd_amazon_s3_key',
					'name' => __( 'Amazon S3 Secret Key', 'edd_s3' ),
					'desc' => __( 'Enter your IAM user&#39;s Secret Key. See our <a href="http://docs.easydigitaldownloads.com/article/393-amazon-s3-documentation">documentation for assistance</a>.', 'edd_s3' ),
					'type' => 'password',
					'size' => 'regular',
				),
				array(
					'id'   => 'edd_amazon_s3_bucket',
					'name' => __( 'Amazon S3 Default Bucket', 'edd_s3' ),
					'type' => 'hook',
				),
				array(
					'id'   => 'edd_amazon_s3_host',
					'name' => __( 'Amazon S3 Endpoint', 'edd_s3' ),
					'desc' => sprintf(
						/* Translators: %1$s - region name in <code> tags; %2$s - fully formed endpoint URL in <code> tags */
						__( 'Set the endpoint you wish to use. For example, if you want to use the %1$s region, you would enter: %2$s Leave blank if you do not know what this is for.', 'edd_s3' ),
						'<code>us-east-2</code>',
						'<code>https://s3.us-east-2.amazonaws.com</code><br>'
					),
					'type' => 'text',
					'std'  => 'https://s3.amazonaws.com',
				),
				array(
					'id'   => 'edd_amazon_s3_default_expiry',
					'name' => __( 'Link Validity Time', 'edd_s3' ),
					'desc' => __( 'Amazon S3 links will expire after the entered number of minutes.', 'edd_s3' ),
					'std'  => '5',
					'type' => 'number',
				),
			);

			if ( class_exists( 'EDD_Front_End_Submissions' ) ) {
				$s3_settings[] = array(
					'id'      => 'edd_amazon_s3_fes_folder_name',
					'name'    => __( 'Folder Name', 'edd_s3' ),
					'desc'    => __( 'Folder name used when uploading to S3 from FES.', 'edd_s3' ),
					'type'    => 'select',
					'options' => array(
						'user_nicename' => 'Username',
						'user_ID'       => 'User ID',
					),
				);
			}

			return array_merge( $settings, array( 'amazon_s3' => $s3_settings ) );
		}

		/**
		 * Renders the S3 default bucket field.
		 *
		 * @since  2.4.0
		 * @return void
		 */
		public function s3_bucket_field() {
			$args = array(
				'id'               => 'edd_settings[edd_amazon_s3_bucket]',
				'name'             => 'edd_settings[edd_amazon_s3_bucket]',
				'options'          => $this->get_bucket_options(),
				'selected'         => esc_attr( edd_get_option( 'edd_amazon_s3_bucket' ) ),
				'class'            => 'regular-text',
				'show_option_all'  => false,
				'show_option_none' => false,
			);
			if ( ! $this->has_api_keys() ) {
				$args['disabled'] = true;
			}
			?>
			<div style="display:flex;gap:4px;">
				<?php
				echo EDD()->html->select( $args );
				if ( current_user_can( 'manage_options' ) && get_transient( 'edd_s3_buckets' ) ) {
					printf(
						'<a class="button button-secondary" href="%s">%s</a>',
						esc_url( wp_nonce_url( add_query_arg( array( 'edd-action' => 'refresh_s3_buckets' ) ), 'edd-refresh-s3-buckets' ) ),
						esc_html__( 'Refresh buckets', 'edd_s3' )
					);
				}
				?>
			</div>
			<p class="description">
				<?php
				printf(
					wp_kses_post(
						/* translators: 1. opening anchor tag; do not translate; 2. closing anchor tag; do not translate */
						__( 'To create new buckets, go to your %1$sS3 Console%2$s (you must be logged in to access the console).  Your buckets will be listed on the left.', 'edd_s3' )
					),
					'<a href="' . esc_url( 'https://console.aws.amazon.com/s3/home' ) . '" target="_blank" rel="noreferrer noopener">',
					'</a>'
				);
				?>
			</p>
			<?php
		}

		/**
		 * Deletes the S3 bucket transient when the link is clicked.
		 *
		 * @since 2.4.0
		 * @param array $data
		 * @return void
		 */
		public function refresh_s3_buckets( $data ) {
			if ( ! current_user_can( 'manage_options' ) ) {
				wp_die( esc_html__( 'You do not have permission to perform this action.', 'edd_s3' ) );
			}

			if ( empty( $data['_wpnonce'] ) || ! wp_verify_nonce( $data['_wpnonce'], 'edd-refresh-s3-buckets' ) ) {
				wp_die( esc_html__( 'Nonce verification failed.', 'edd_s3' ) );
			}

			delete_transient( 'edd_s3_buckets' );
			wp_safe_redirect( remove_query_arg( array( 'edd-action', '_wpnonce' ) ) );
			exit;
		}

		/**
		 * Conditional to check if API keys have been entered.
		 *
		 * @return bool
		 */
		public function api_keys_entered() {
			$id  = edd_get_option( 'edd_amazon_s3_id' );
			$key = edd_get_option( 'edd_amazon_s3_key' );

			if ( empty( $id ) || empty( $key ) ) {
				return false;
			}

			return true;
		}

		/**
		 * Tells FES/CFM that Amazon S3 URLs are valid.
		 *
		 * @since  2.2.2
		 *
		 * @access public
		 * @return bool
		 */
		public function valid_url( $valid, $value = '' ) {
			if ( ! $valid && is_string( $value ) ) {
				$ext   = edd_get_file_extension( $value );
				$valid = ! empty( $ext );
			}

			return $valid;
		}

		/**
		 * Uploads files to Amazon S3 during FES form submissions
		 *
		 * Only runs if Frontend Submissions is active
		 *
		 * @since  2.1
		 *
		 * @access public
		 * @return array
		 */
		public function send_fes_files_to_s3( $files = array(), $post_id = 0 ) {
			if ( ! function_exists( 'fes_get_attachment_id_from_url' ) ) {
				return $files;
			}

			if ( ! $this->has_api_keys() ) {
				return $files;
			}

			if ( ! empty( $files ) && is_array( $files ) ) {
				foreach ( $files as $key => $file ) {
					$attachment_id = fes_get_attachment_id_from_url( $file['file'], get_current_user_id() );

					if ( ! $attachment_id ) {
						continue;
					}

					$user               = get_userdata( get_current_user_id() );
					$folder_name_option = edd_get_option( 'edd_amazon_s3_fes_folder_name', 'user_nicename' );
					$folder             = ( 'user_nicename' == $folder_name_option ) ? trailingslashit( $user->user_nicename ) : trailingslashit( $user->ID );

					$args = array(
						'file' => get_attached_file( $attachment_id, false ),
						'name' => $folder . basename( $file['name'] ),
						'type' => get_post_mime_type( $attachment_id ),
					);

					$this->upload_file( $args );

					$files[ $key ]['file'] = edd_get_option( 'edd_amazon_s3_bucket' ) . '/' . $folder . basename( $file['file'] );

					wp_delete_attachment( $attachment_id, true );
				}
			}

			return $files;
		}

		/**
		 * Uploads files to Amazon S3 during CFM form submissions
		 *
		 * Only runs if Checkout Fields Manager is active
		 *
		 * @since  2.2.3
		 *
		 * @access public
		 * @return array
		 */
		public function send_cfm_files_to_s3( $attachment_id = 0, $url = '' ) {

			if ( ! $this->has_api_keys() ) {
				return $attachment_id;
			}

			$folder = trailingslashit( 'cfm' );
			$args   = array(
				'file' => get_attached_file( $attachment_id, false ),
				'name' => $folder . basename( get_attached_file( $attachment_id ) ),
				'type' => get_post_mime_type( $attachment_id ),
			);

			$this->upload_file( $args );

			$new_url = edd_get_option( 'edd_amazon_s3_bucket' ) . '/' . $folder . basename( $url );
			wp_delete_attachment( $attachment_id, true );

			return $new_url;
		}

		/**
		 * Given a URL for CFM, we need to determine if it's an S3 URL or a normal url
		 *
		 * @since  2.2.3
		 *
		 * @param  string $url The URL to the file
		 *
		 * @return string      If it's an S3 URL, the full URL to S3, otherwise it passes the provided value
		 */
		public function file_download_url( $url ) {
			if ( $this->is_s3_file( $url ) ) {
				$url = $this->get_s3_url( $url );
			}

			return $url;
		}

		/**
		 * Generate an error to display to the user.
		 *
		 * @access private
		 * @since  2.3
		 *
		 * @param EDDAmazon\Vendor\Aws\S3\Exception\S3Exception $e S3Exception.
		 *
		 * @return void
		 */
		private function generate_error( $e ) {
			printf(
				'<div class="notice notice-error"><p><strong>%s</strong> %s</p></div>',
				esc_html__( 'AWS Error:', 'edd_s3' ),
				wp_kses_post( $e->getMessage() )
			);
		}

		/**
		 * Load the FES field class
		 *
		 * @access public
		 * @since  2.6.5
		 * @static
		 *
		 * @return void.
		 */
		public static function include_fes_field() {
			include_once EDD_AS3_DIR . 'includes/class-fes-field.php';
		}

		/**
		 * Register Frontend Submissions Field.
		 *
		 * @access public
		 * @since  2.3
		 * @static
		 *
		 * @param  array $fields FES fFields.
		 *
		 * @return array $fields FES fields with S3 field registered.
		 */
		public static function add_fes_field( $fields ) {
			$fields['edd_s3'] = 'EDD_Amazon_S3_FES_Field';

			return $fields;
		}

		/**
		 * Gets the bucket options for the settings screen.
		 *
		 * @since 2.4.0
		 * @return array
		 */
		private function get_bucket_options() {
			if ( ! $this->has_api_keys() ) {
				return array(
					'' => __( 'Not connected to S3', 'edd_s3' ),
				);
			}
			$options = array(
				'' => __( 'No default bucket', 'edd_s3' ),
			);
			$buckets = false;
			if ( function_exists( 'edd_is_admin_page' ) && edd_is_admin_page( 'settings', 'extensions' ) ) {
				$buckets = $this->get_s3_buckets();
			}
			if ( $buckets ) {
				foreach ( $buckets['buckets'] as $bucket ) {
					$options[ $bucket['name'] ] = $bucket['name'];
				}
			}

			return $options;
		}
	}

endif;
