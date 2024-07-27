<?php
 global $post;
  $download_id=get_the_ID();
$productmastitle= get_theme_mod( 'product_masonry_title_hover','1' );
$titileboxstyle= get_theme_mod( 'product_masonry_hover_style','one' );
$masonrymetastate= get_theme_mod( 'product_masonry_meta_state','disable' );
$imageeffect= get_theme_mod( 'product_masonry_image_hover_style','disable' );
$load_more_text = get_theme_mod( 'load_more_text','More Products' );
if($imageeffect=='enable'){
                                $imgeftcls='masonry-hover-effect-enabled';
                            } else {
                                 $imgeftcls='';
                            }
?>

                <div <?php post_class(); ?>>
                <div class="product-masonry-item-content">
                    <?php if ( has_post_format( 'video' )) { ?>
                        <div class="item-thumbnail item-video-masonry">
                            <?php get_template_part( 'library/mayosis-video-box-thumb' ); ?>
                            <a href="<?php the_permalink();?>" class="video-masonry-link"></a>
                        </div>
                    <?php } else { ?>
                        <?php $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'large');?>
                        <div class="item-thumbnail">
                            <a href="<?php the_permalink();?>"><img src="<?php echo maybe_unserialize($thumbnail['0']); ?>" alt="<?php the_title();?>"></a>
                        </div>
                    <?php } ?>
                    <?php if ($productmastitle==1){?>

                        <?php if ($titileboxstyle== "one"){ ?>
                            <div class="product-masonry-description">

                                <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>
                            </div>

                        <?php } elseif ($titileboxstyle== "three"){ ?>

                            <div class="product-masonry-description masonry-style-three">
                                <div class="product_hover_details_button">
                                    <a href="<?php the_permalink();?>"  class="button-fill-color"><?php esc_html_e('View Details','mayosis');?></a>
                                </div>

                            </div>
                        <?php } else { ?>
                            <div class="product-masonry-description masonry-style-two">

                                <h5><a href="<?php the_permalink();?>" ><?php the_title()?></a></h5>

                                <div class="bottom-metaflex">
                                    <?php if ( function_exists( 'edd_favorites_load_link' ) ) {
                                        edd_favorites_load_link( $download_id );
                                    } ?> <span> <a href="<?php echo mayosis_fes_author_url( get_the_author_meta( 'ID',$author_id ) ) ?>">

								     <i class="zil zi-user"></i>
								 </a></span>
                                </div>
                            </div>
                        <?php } ?>

                    <?php } ?>
                    
                     <?php if ($masonrymetastate=="enable"){?>
                                <div class="product-meta">
                                <?php get_template_part( 'includes/product-meta' ); ?>
                            </div>
                            <?php } ?>
                </div>
            </div>
       