<?php
/**
 * @package mayosis
 */
if (!defined("ABSPATH")) {
    exit(); // Exit if accessed directly.
}
global $post;
$productmetaoptions = get_theme_mod("product_grid_options", "one");
$productmetadisplayop = get_theme_mod("product_meta_options", "vendorcat");
$productpricingoptions = get_theme_mod("product_pricing_options", "price");
$productfreeoptins = get_theme_mod("product_free_options", "custom");
$productcustomtext = get_theme_mod("free_text", "FREE");
$author = get_user_by("id", get_query_var("author"));
$author_id = $post->post_author;
$productvideoiconhide = get_theme_mod("title_play_button", "show");
$envato_item_id = get_post_meta($post->ID, "item_unique_id", true);
$pcattype = get_theme_mod("product_category_type_x", "default");
$msv_pd_price_bg = get_theme_mod("msv_pd_price_bg", "disable");

if ($envato_item_id) {
    $api_item_results_json = json_decode(mayosis_custom_envato_api(), true);
    $item_price = $api_item_results_json["price_cents"];
    $item_url = $api_item_results_json["url"];
    $item_number_of_sales = $api_item_results_json["number_of_sales"];
}
?>
<?php if ($productmetaoptions == "two"): ?>
    <div class="without-meta-box">

    </div>
<?php else: ?>

    <div class="product-tag">
        <?php
        global $edd_logs;
        $single_count = $edd_logs->get_log_count(66, "file_download");
        $total_count = $edd_logs->get_log_count("*", "file_download");
        $sales = edd_get_download_sales_stats(get_the_ID());
        $sales = $sales > 1 ? $sales . " sales" : $sales . " sale";
        $price = edd_get_download_price(get_the_ID());
        ?>

        <?php if (has_post_format("audio")) {
            get_template_part("includes/edd_title_audio");
        } ?>
        <?php if ($productvideoiconhide == "show") { ?>
            <?php if (has_post_format("video")) {
                get_template_part("includes/edd_title_video");
            } ?>
        <?php } ?>
        <h4 class="product-title"><a href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a></h4>
       
<div class="msv_p_meta_main">
        <?php if ($productmetadisplayop == "vendor"): ?>
            <span><a href="<?php echo esc_url(
                mayosis_fes_author_url(get_the_author_meta("ID", $author_id))
            ); ?>">
								     
								     <?php echo get_the_author_meta("display_name", $author_id); ?>
								 </a></span>
        <?php elseif ($productmetadisplayop == "category"):
            $download_cats = get_the_term_list(
                get_the_ID(),
                "download_category",
                "",
                _x(", ", "", "mayosis"),

                ""
            ); ?>
            
            
             <?php if ($pcattype == "parent") { ?>
                <span class="mayosis-parent-cats-z">
             <?php
             $categories = get_the_terms(get_the_ID(), "download_category");
             if ($categories) {
                 foreach ($categories as $key => $category) {
                     if ($category->parent == 0) {
                         $term_link = get_term_link($category);
                         echo "<a href='" .
                             $term_link .
                             "'>" .
                             $category->name .
                             "</a> ";
                     }
                 }
             }
             ?>
             </span>
           
              <?php } else { ?>
            <span><?php echo "<span>" . $download_cats . "</span>"; ?></span>
            <?php } ?>
            
            
            
        <?php
        elseif ($productmetadisplayop == "vendorcat"):
            $download_cats = get_the_term_list(
                get_the_ID(),
                "download_category",
                "",
                _x(", ", "", "mayosis"),
                ""
            ); ?>
            <span class="opacitydown75"><?php esc_html_e(
                "by",
                "mayosis"
            ); ?></span> <a href="<?php echo esc_url(
    mayosis_fes_author_url(get_the_author_meta("ID", $author_id))
); ?>" test>


                <?php echo get_the_author_meta("display_name", $author_id); ?>
            </a>
            <?php if ($download_cats): ?>
            
             <?php if ($pcattype == "parent") { ?>
              <span class="opacitydown75"><?php esc_html_e(
                  "in",
                  "mayosis"
              ); ?></span><span class="mayosis-parent-cats-z">
             <?php
             $categories = get_the_terms(get_the_ID(), "download_category");
             foreach ($categories as $key => $category) {
                 if ($category->parent == 0) {
                     $term_link = get_term_link($category);
                     echo "<a href='" .
                         $term_link .
                         "'>" .
                         $category->name .
                         "</a> ";
                 }
             }
             ?>
             </span>
             <?php } else { ?>
                <span class="opacitydown75"><?php esc_html_e(
                    "in",
                    "mayosis"
                ); ?></span> <span><?php echo "<span>" .
    $download_cats .
    "</span>"; ?></span>
                <?php } ?>
                
                
                
                
            <?php endif; ?>
            
          
        <?php
        elseif ($productmetadisplayop == "sales"): ?>
            <?php if ($price == "0.00") { ?>
                <p><span><?php
                $download = $edd_logs->get_log_count(
                    get_the_ID(),
                    "file_download"
                );
                echo is_null($download) ? "0" : $download;
                ?> <?php esc_html_e("Downloads", "mayosis"); ?></span></p>
            <?php } else { ?>
                <p><span><?php echo esc_html($sales); ?></span></p>
            <?php } ?>
        <?php else: ?>
        <?php endif; ?>
		</div>
        <?php if (class_exists("EDD_Reviews")) { ?>
        <div class="msuv-rating-box-p">

                               <?php echo mayosis_avarage_rating(); ?>

           </div>
                            <?php } ?>
 <?php if ($productpricingoptions == "bprice"): ?>

        <div class="msb-inner-meta-price">

            <?php if ($envato_item_id) { ?>
                <span><?php
                esc_html_e('$', "mayosis");
                echo number_format($item_price / 100, 2, ".", " ");
                ?></span>
            <?php } else { ?>
                <?php if ($price == "0.00") { ?>
                    <?php if ($productfreeoptins == "none"): ?>
                        <span><?php edd_price(get_the_ID()); ?></span>
                    <?php else: ?>
                        <span><?php echo esc_html($productcustomtext); ?></span>
                    <?php endif; ?>


                <?php } else { ?>
                    <div class="product-price promo_price"><?php edd_price(
                        get_the_ID()
                    ); ?></div>
                <?php } ?>
            <?php } ?>

        </div>
    <?php endif; ?>


    </div>
    <?php if ($productpricingoptions == "price"): ?>

        <div class="count-download msv_pc_bg_<?php echo esc_html(
            $msv_pd_price_bg
        ); ?> ">

            <?php if ($envato_item_id) { ?>
                <span><?php
                esc_html_e('$', "mayosis");
                echo number_format($item_price / 100, 2, ".", " ");
                ?></span>
            <?php } else { ?>
                <?php if ($price == "0.00") { ?>
                    <?php if ($productfreeoptins == "none"): ?>
                        <span><?php edd_price(get_the_ID()); ?></span>
                    <?php else: ?>
                        <span><?php echo esc_html($productcustomtext); ?></span>
                    <?php endif; ?>


                <?php } else { ?>
                    <div class="product-price promo_price"><?php edd_price(
                        get_the_ID()
                    ); ?></div>
                <?php } ?>
            <?php } ?>

        </div>
    <?php endif; ?>

    <div class="clearfix"></div>
<?php endif; ?>
