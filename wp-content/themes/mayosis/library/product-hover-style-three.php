<?php
/*
*product hover style three
*/
$author = get_user_by( 'id', get_query_var( 'author' ) );
$author_id=$post->post_author;
$download_cats = get_the_term_list( get_the_ID(), 'download_category', '', _x(' , ', '', 'mayosis' ), '' );
?>

<a href="<?php the_permalink();?>" class="overlay_anchor_absolute"></a>
<figcaption class="thumb-caption overlay-style-3">

    <div class="overlay-style">

        <h4 class="product-title"><a href="<?php the_permalink(); ?>">
                <?php
                the_title();
                ?>
            </a></h4>

        <p><span><?php esc_html_e('by','mayosis');?> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>"><?php the_author(); ?></a></span> <?php esc_html_e('in','mayosis');?> <span><?php echo '<span>' . $download_cats . '</span>'; ?></span></p>


    </div>
</figcaption>
<div class="overlay-btn overlay-btn-style-3">
    <div class="overlay-favourite-btn">
        <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
            edd_favorites_load_link( $download_id );
        } ?>
    </div>
    <div class="overlay-cart-btn">
        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>

    </div>
</div>