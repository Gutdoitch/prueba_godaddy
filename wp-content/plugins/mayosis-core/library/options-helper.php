<?php
function mayosis_get_posts( $args ) {
		if ( is_string( $args ) ) {
			$args = add_query_arg(
				array(
					'suppress_filters' => false,
				)
			);
		} elseif ( is_array( $args ) && ! isset( $args['suppress_filters'] ) ) {
			$args['suppress_filters'] = false;
		}

		// Get the posts.
		// TODO: WordPress.VIP.RestrictedFunctions.get_posts_get_posts.
		$posts = get_posts( $args );

		// Properly format the array.
		$items = array();
		$items['0']       = 'Select an Option';
		foreach ( $posts as $post ) {
			$items[ $post->ID ] = $post->post_title;
		}
		wp_reset_postdata();

		return $items;
	}
	
	function mayosis_global_edd_price() {
	     
            global $edd_logs;
            global $post;
            $download_id = get_the_ID();
            $single_count = $edd_logs->get_log_count(66, 'file_download');
            $total_count  = $edd_logs->get_log_count('*', 'file_download');
            $price = edd_get_download_price(get_the_ID());
            $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );
            $freetext= get_theme_mod( 'free_text','FREE' );

            if ($envato_item_id){
                $personal_token= envatoapi();
                //set header for API
                $personal_token   = 'Bearer ' .$personal_token;
                $api_header   = array();
                $api_header[] = 'Content-length: 0';
                $api_header[] = 'Content-type: application/json; ch_themearset=utf-8';
                $api_header[] = 'Authorization: ' . $personal_token;

                $item_id = $envato_item_id;
                $api_url = 'https://api.envato.com/v3/market/catalog/item?id='.$item_id;

                //START GET DATA FROM API
                $api_init_item = curl_init();

                curl_setopt($api_init_item, CURLOPT_URL, $api_url );
                curl_setopt( $api_init_item, CURLOPT_HTTPHEADER, $api_header );
                curl_setopt( $api_init_item, CURLOPT_SSL_VERIFYPEER, false );
                curl_setopt($api_init_item, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt( $api_init_item, CURLOPT_CONNECTTIMEOUT, 5 );
                curl_setopt( $api_init_item, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

                $api_item_results = curl_exec($api_init_item);
                $api_item_results = json_decode($api_item_results, true);
                $item_price = $api_item_results['price_cents'];
                $item_url = $api_item_results['url'];

            }
         
  if ($envato_item_id) { ?>
                                <span class="global-price-msc"><?php esc_html_e('$','mayosis-core');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></span class="global-price-msc">
                            <?php } else { ?>
                                <?php if( $price == "0.00"  ){ ?>
                                    <?php
                                    if(edd_has_variable_prices($download_id)){ ?>
                                        <span class="global-price-msc"><?php echo edd_price_range( $download_id ); ?></span class="global-price-msc">
                                    <?php } else { ?>
                                        <?php if ( $freetext ){ ?>
                                            <span class="global-price-msc"><?php echo esc_html($freetext); ?></span class="global-price-msc">
                                        <?php } else { ?>
                                            <span class="global-price-msc"><?php edd_price($download_id); ?></span class="global-price-msc">
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <span class="global-price-msc"><?php
                                        if(edd_has_variable_prices($download_id)){
                                            echo edd_price_range( $download_id );
                                        }
                                        else{
                                            edd_price($download_id);
                                        }
                                        ?></span class="global-price-msc">
                                <?php } ?>

                            <?php } 
                            
                            
                            
	}
                            
                            
                            