<?php
/**
 * mayosis Product Details Widget
 *
 */

if ( class_exists( 'Easy_Digital_Downloads' ) ) :

    add_action('widgets_init', 'digital_download_details_widget');

    function digital_download_details_widget()
    {
        register_widget('digital_download_details_widget');
    }
    class digital_download_details_widget extends WP_Widget {
        /** Constructor */
        public function __construct() {
            parent::__construct(
                'digital_download_details_widget',
                sprintf( esc_html__( 'Mayosis %s Details', 'mayosis-core' ), edd_get_label_singular() ),
                array(
                    'description' => sprintf( esc_html__( 'Display the details of a specific %s', 'mayosis-core' ), edd_get_label_singular() ),
                )
            );
        }

        /** @see WP_Widget::widget */
        public function widget( $args, $instance ) {
            $args['id'] = ( isset( $args['id'] ) ) ? $args['id'] : 'edd_download_details_widget';
            if ( ! isset( $instance['download_id'] ) || ( 'current' == $instance['download_id'] && ! is_singular( 'download' ) ) ) {
                return;
            }
            // set correct download ID
            if ( 'current' == $instance['download_id'] && is_singular( 'download' ) ) {
                $download_id = get_the_ID();
            } else {
                $download_id = absint( $instance['download_id'] );
            }
            // Variables from widget settings
            $title = apply_filters( 'widget_title', $instance[ 'title' ] );
            $purchase_button 	= $instance['purchase_button'] ? apply_filters( 'edd_product_details_widget_purchase_button', edd_get_purchase_link( array( 'download_id' => $download_id ) ), $download_id ) : '';
            $purchase_button_free 	= $instance['purchase_button_free'] ? apply_filters( 'edd_product_details_widget_purchase_button', edd_get_purchase_link( array( 'download_id' => $download_id ) ), $download_id ) : '';

            $freetext = apply_filters( 'freetext', $instance[ 'freetext' ] );

            $show_favorite_button = empty($instance['show_favorite_button']) ? '' : $instance['show_favorite_button'];





            // Used by themes. Opens the widget
            echo $args['before_widget']; ?>
            <?php
            global $edd_logs;
            global $post;
            $single_count = $edd_logs->get_log_count(66, 'file_download');
            $total_count  = $edd_logs->get_log_count('*', 'file_download');
            $price = edd_get_download_price(get_the_ID());
            $envato_item_id = get_post_meta( $post->ID,'item_unique_id',true );


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
            $custom_purchase_text= get_post_meta( $post->ID, 'custom_product_text', true );
            $custom_purchase_btn= get_post_meta( $post->ID, 'custom_product_url', true );				?>


            <div class="sidebar-theme">
                <div class="single-product-widget">
                    <h4 class="widget-title" style="margin-bottom:0px;"><i class="zil zi-cart"></i> <?php echo esc_html($title); ?></h4>
                    <div class="cart-box row product-purchase-box">
                        <div class="col-md-12 paading-left-0 product-price">
                            <?php if ($envato_item_id) { ?>
                                <h3><?php esc_html_e('$','mayosis-core');?><?php echo number_format(($item_price /100), 2, '.', ' ');?></h3>
                            <?php } else { ?>
                                <?php if( $price == "0.00"  ){ ?>
                                    <?php
                                    if(edd_has_variable_prices($download_id)){ ?>
                                        <h3><?php echo edd_price_range( $download_id ); ?></h3>
                                    <?php } else { ?>
                                        <?php if ( $freetext ){ ?>
                                            <h3><?php echo esc_html($freetext); ?></h3>
                                        <?php } else { ?>
                                            <h3><?php edd_price($download_id); ?></h3>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } else { ?>
                                    <h3><?php
                                        if(edd_has_variable_prices($download_id)){
                                            echo edd_price_range( $download_id );
                                        }
                                        else{
                                            edd_price($download_id);
                                        }
                                        ?></h3>
                                <?php } ?>

                            <?php } ?>
                        </div>

                        <div class="clearfix"></div>
                        <div class="product_widget_inside">
                            <?php if ($envato_item_id) { ?>

                                <?php if ($custom_purchase_btn){ ?>
                                    <a href="<?php echo esc_url($custom_purchase_btn);?>" class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                        <?php echo esc_html($custom_purchase_text);?>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo esc_url($item_url);?>" class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                        <?php esc_html_e('Purchase','mayosis-core');?>
                                    </a>

                                <?php } ?>

                            <?php } else {?>


                                <?php if ($custom_purchase_btn){ ?>

                                    <a href="<?php echo esc_url($custom_purchase_btn);?>" class="edd-add-to-cart button blue edd-submit edd-has-js custom-envato-btn">
                                        <?php echo esc_html($custom_purchase_text);?>
                                    </a>

                                <?php } else { ?>
                                    <?php if( $price == "0.00"  ){ ?>

                                        <?php if(edd_has_variable_prices($download_id)){ ?>
                                            <?php
                                            do_action( 'edd_product_details_widget_before_title' , $instance , $download_id );
                                            do_action( 'edd_product_details_widget_before_purchase_button' , $instance , $download_id );
                                            // purchase button
                                            echo ($purchase_button); ?>
                                        <?php } else { ?>
                                            <?php
                                            do_action( 'edd_product_details_widget_before_title' , $instance , $download_id );
                                            do_action( 'edd_product_details_widget_before_purchase_button' , $instance , $download_id );
                                            echo ($purchase_button_free); ?>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <?php
                                        do_action( 'edd_product_details_widget_before_title' , $instance , $download_id );
                                        do_action( 'edd_product_details_widget_before_purchase_button' , $instance , $download_id );
                                        // purchase button
                                        echo ($purchase_button); ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>


                            <?php
                            $mayosis_demo = get_post_meta( get_the_ID(), 'demo_link',true);
                            $livepreviewtext= get_theme_mod( 'live_preview_text','Live Preview' );
                            ?>
                            <?php if ( $mayosis_demo){ ?>
                                <a href="<?php echo $mayosis_demo; ?>" class="ghost_button" target="_blank"><?php echo esc_html($livepreviewtext); ?></a>
                            <?php } ?>

                            <?php if($show_favorite_button){?>
                                <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                    edd_favorites_load_link( $download_id );
                                } ?>
                            <?php }?>
                            <?php if ( class_exists( 'EDD_Reviews' ) && is_singular( 'download' ) ) {

                                echo mayosis_avarage_rating();


                            } ?>



                            <div class="mayosis-product-widget-counter">
                                <?php do_action('mayosis-product-widget-time-countdown');?>
                            </div>






                        </div>
                    </div>
                </div>
            </div>

            <?php // Used by themes. Closes the widget
            echo $args['after_widget'];
        }

        /** @see WP_Widget::form */
        public function form( $instance ) {
            // Set up some default widget settings.
            $defaults = array(
                'title' 			=> sprintf( esc_html__( '%s Details', 'mayosis-core' ), edd_get_label_singular() ),
                'download_id' 		=> 'current',
                'download_title' 	=> 'on',
                'purchase_button' 	=> 'on',
                'purchase_button_free' 	=> 'on',
                'buy_button' => 'on',
                'freetext' => '',
                'show_favorite_button' => '',
            );
            $instance = wp_parse_args( (array) $instance, $defaults ); ?>
            <!-- Title -->
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'mayosis-core' ) ?></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
            </p>
            <!-- Download -->
            <?php
            $args = array(
                'post_type'      => 'download',
                'posts_per_page' => -1,
                'post_status'    => 'publish',
            );
            $downloads = get_posts( $args );
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'download_id' ) ); ?>"><?php printf( esc_html__( '%s', 'mayosis-core' ), edd_get_label_singular() ); ?></label>
                <select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'download_id' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'download_id' ) ); ?>">
                    <option value="current"><?php esc_html_e( 'Use current', 'mayosis-core' ); ?></option>
                    <?php foreach ( $downloads as $download ) { ?>
                        <option <?php selected( absint( $instance['download_id'] ), $download->ID ); ?> value="<?php echo esc_attr( $download->ID ); ?>"><?php echo esc_html($download->post_title); ?></option>
                    <?php } ?>
                </select>
            </p>

            <!-- Show purchase button -->
            <p>
                <input <?php checked( $instance['purchase_button'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'purchase_button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'purchase_button' ) ); ?>" type="checkbox" />
                <label for="<?php echo esc_attr( $this->get_field_id( 'purchase_button' ) ); ?>"><?php esc_html_e( 'Show Add to Cart Button', 'mayosis-core' ); ?></label>
            </p>

            <p>
                <input <?php checked( $instance['purchase_button_free'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'purchase_button_free' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'purchase_button_free' ) ); ?>" type="checkbox" />
                <label for="<?php echo esc_attr( $this->get_field_id( 'purchase_button_free' ) ); ?>"><?php esc_html_e( 'Show Cart Button on Free Products', 'mayosis-core' ); ?></label>
            </p>

            <p>  <label for="<?php echo $this->get_field_id( 'freetext' ); ?>"><?php _e('Add Custom Text (when the price is 0) (leave blank to show 0 price) :', 'mayosis-core'); ?></label></p>
            <p>
            <p>
                <input <?php checked( $instance['show_favorite_button'], 'on' ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_favorite_button' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_favorite_button' ) ); ?>" type="checkbox" />
                <label for="<?php echo esc_attr( $this->get_field_id( 'show_favorite_button' ) ); ?>"><?php esc_html_e( 'Show Favorite Link (Must be Installed EDD Wishlist & Favorite)', 'mayosis-core' ); ?></label>
            </p>

            <input class="widefat" type="text" value="<?php echo esc_attr($instance['freetext']); ?>"  id="<?php echo $this->get_field_id( 'freetext' ); ?>" name="<?php echo $this->get_field_name( 'freetext' ); ?>" />

            </p>


            <?php do_action( 'edd_product_details_widget_form' , $instance ); ?>
        <?php }
        /** @see WP_Widget::update */
        public function update( $new_instance, $old_instance ) {
            $instance = $old_instance;
            $instance['title'] = sanitize_text_field( $new_instance['title'] );
            $instance['download_id']     = strip_tags( $new_instance['download_id'] );
            $instance['purchase_button'] = isset( $new_instance['purchase_button'] ) ? $new_instance['purchase_button'] : '';
            $instance['purchase_button_free'] = isset( $new_instance['purchase_button_free'] ) ? $new_instance['purchase_button_free'] : '';
            $instance['freetext'] = sanitize_text_field( $new_instance['freetext'] );

            $instance['show_favorite_button'] = isset( $new_instance['show_favorite_button'] ) ? $new_instance['show_favorite_button'] : '';



            do_action( 'edd_product_details_widget_update', $instance );
            return $instance;
        }
    }
endif;