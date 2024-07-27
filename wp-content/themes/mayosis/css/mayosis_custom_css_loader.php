<?php
/**
 *  Add Dynamic css to header
 * @version    1.0
 * @author        Teconce
 * @URI        http://teconce.com
 */


function mayosis_dynamic_css()
{
  ob_start();
  $seccolor=get_theme_mod( 'mayosis_secondary_color','#e9edf7');
  $primarycolor=get_theme_mod( 'accent_color','#5a00f0');
  $primarytextcolor=get_theme_mod( 'accent_color_text','#ffffff');
  $secactcolor=get_theme_mod( 'secondary_accent_color','#1e0050');
  $globalborderthik = get_theme_mod( 'global_border_thikness','2px');
  $producthover = get_theme_mod( 'product_thumb_hover','rgba(40,40,55,.8)');
  $productbgtype = get_theme_mod( 'thumbnail_bg_type','rgba(40,40,55,.8)');
  $maintextcolor =  get_theme_mod( 'regular_text_color','#28375a');
  $producthovertxt = get_theme_mod( 'product_thumb_hover_text','#ffffff');
  $producthovergrad = get_theme_mod( 'product_thumbnail_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $headerbgtype = get_theme_mod( 'header_bg_type');
  $hgradient = get_theme_mod( 'header_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $hgradientangle = get_theme_mod( 'header_gradient_angle','90deg');
  $hbgimage = get_theme_mod( 'header_bg_image');
  $hbgcolor = get_theme_mod( 'header_background','#ffffff');
  $headerformtype = get_theme_mod( 'header_form_type');
  $headerformbgcolor = get_theme_mod( 'header_form_field_bg','rgba(255,255,255,0)');
  $headerformbgborder = get_theme_mod( 'header_form_border','#1e0050');
  $headerformborderthik = get_theme_mod( 'header_border_thikness','2px');
  $mainheaderpadding = get_theme_mod( 'main_header_padding',array('padding-top'=>'0','padding-bottom'=>'0','padding-right'=>'0','padding-left'=>'0',));
  $stickylogo= get_theme_mod( 'sticky_logo');
  $transparentheader= get_theme_mod( 'header_transparent_background','rgba(255,255,255,0)');
  $headertransparentmain= get_theme_mod( 'header_transparency','transparent' );
  $smartsticky= get_theme_mod( 'smart_sticky');
  $mainnavcolor= get_theme_mod( '$mainsubbg','#28375a');
  $mainsubbg= get_theme_mod( 'sub_nav_bg','#5000ce');
  $defproductpadding= get_theme_mod( 'product_dif_padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
  $defproducttxt= get_theme_mod( 'product_bdtxt_color','#ffffff');
  $primetxt= get_theme_mod( 'prime_bdtxt_color','#ffffff');
  $primeproductpadding= get_theme_mod( 'product_prime_padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
  $primeproalign= get_theme_mod( 'product_prime_content_position','left');
  $primetemplate= get_theme_mod( 'background_prime', 'color');
  $primebgdefault= get_theme_mod( 'prime_bg_default', '#edf0f7');
  $primegradientdefault= get_theme_mod( 'prime_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
  $primeanglegradient= get_theme_mod( 'gradient_angle_prime','135');
  $primemainbg= get_theme_mod( 'prime-main-bg');
  $primemainoverlay= get_theme_mod( 'prime_overlay_image_product');
  $primeovarlaymain= get_theme_mod( 'prime_ovarlay_main','rgb(30,0,70,.85)');
  $primeblurbg= get_theme_mod( 'main_prime_blur','5px');
  $primebgparallax= get_theme_mod( 'parallax_prime_image','no');
  $stickycartgradient = get_theme_mod( 'sticky_cart_bar_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));


  $footerpadding= get_theme_mod( 'main_footerr_padding',array('padding-top'=>'120px','padding-bottom'=>'80px','padding-right'=>'0','padding-left'=>'0',));
  $footerbgtype= get_theme_mod( 'footer_bg_type','color');
  $footerbgcolor= get_theme_mod( 'footer_background','#1e0050');
  $footerbggradient= get_theme_mod( 'footer_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $footerbgimage= get_theme_mod( 'footer_bg_image');
  $footerheadingcolor= get_theme_mod( 'footer_heading_color','#ffffff');
  $footertext= get_theme_mod( 'footer_text','#ffffff');
  $copyrightbg= get_theme_mod( 'copyright_backgroud','#16003c');
  $copyrighttext= get_theme_mod( 'copyright_text_color','#ffffff');
  $footerfieldtype= get_theme_mod( 'footer_field_type');
  $footerfieldbg= get_theme_mod( 'footer_field_color','#1e0046');
  $footerfieldborder= get_theme_mod( 'footer_border_color','#1e0046');
  $footerborderthik= get_theme_mod( 'footer_border_thikness','2px');
  $widgetbgtype= get_theme_mod( 'wd_bg_type');
  $widgetbggradient= get_theme_mod( 'wd_title_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $widgetbgcolor= get_theme_mod( 'wd_title_bg','#1e0046');
  $widgettitlecolor= get_theme_mod( 'wd_title_text','#ffffff');
  $widgetfieldtype= get_theme_mod( 'wd_field_type');
  $widgetfieldbg= get_theme_mod( 'wd_field_color');
  $widgetfieldborder= get_theme_mod( 'wd_border_color','#3c465a');
  $widgetborderthik= get_theme_mod( 'wd_border_thikness','2px');
  $widgetfieldtext= get_theme_mod( 'wd_field_text','#28375a');
  $producttemplate= get_theme_mod( 'background_product', 'color');
  $productbgdark= get_theme_mod( 'product_bg_alt_dark', '');
  $productbgdefault= get_theme_mod( 'product_bg_default', '#000046');
  $productgradientdefault= get_theme_mod( 'product_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
  $productanglegradient= get_theme_mod( 'gradient_angle_product','135');
  $productmainbg= get_theme_mod( 'product-main-bg');
  $productovarlaymain= get_theme_mod( 'product_ovarlay_main','rgb(30,0,70,.85)');
  $productmainoverlay= get_theme_mod( 'default_overlay_image_product');
  $productblurbg= get_theme_mod( 'main_product_blur','5px');
  $productbgparallax= get_theme_mod( 'parallax_featured_image','no');
  $productcontentposition= get_theme_mod( 'product_header_content_position','left');

  $pagetemplate= get_theme_mod( 'background_page', 'color');
  $pagebgdefault= get_theme_mod( 'page_bg_default', '#000046');
  $pagegradientdefault= get_theme_mod( 'page_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
  $pageanglegradient= get_theme_mod( 'gradient_angle_page','135');
  $pagemainbg= get_theme_mod( 'page-main-bg');
  $pagecustom= get_theme_mod( 'page_custom_css');
  $blogbgtype= get_theme_mod( 'blog_bg_type', 'gradient');
  $blogbgcolor= get_theme_mod( 'blog_background','#000046');
  $blogoverlaymain= get_theme_mod( 'blog_ovarlay_main');
  $blogblurbg= get_theme_mod( 'main_blog_blur','5px');
  $blogbgparallax= get_theme_mod( 'parallax_featured_image_blog','no');
  $blogbggradient= get_theme_mod( 'blog_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $blogbgimage= get_theme_mod( 'blog_bg_image');
  $blogcontentposition= get_theme_mod( 'blog_header_content_position','left');
  $blogbgimagerepeat= get_theme_mod( 'blog_bg_image_repeat');
  $productbdtextcolor= get_theme_mod( 'product_breadcrumb_text','#ffffff');
  $productlabel= get_theme_mod( 'product_label','#e6174b');
  $productlebeledge= get_theme_mod( 'product_label_edge','#b7133d');
  $blogpaddingmain= get_theme_mod( 'blog_padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
  $pagepadding= get_theme_mod( 'page_padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
  $photovideopadding= get_theme_mod( 'photo-video-template-padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
  $singlebuttonbg= get_theme_mod( 'single_button_bg','#3c465a');
  $dualbuttona= get_theme_mod( 'dual_button_a','#3c465a');
  $dualbuttonb= get_theme_mod( 'dual_button_b','#3c465a');
  $stickyhideshow= get_theme_mod( 'sticky_hide');
  $testimonialbg= get_theme_mod( 'testimonial_grid_bg','#5a00f0');
  $footer_overlay_image=get_theme_mod( 'footer_overlay_image');
  $blog_overlay_image=get_theme_mod( 'blog_overlay_image');
  $loader_gradient = get_theme_mod( 'loader_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $menuhovertype = get_theme_mod( 'menu_hover_type','opacity');
  $btmmenuhovertype = get_theme_mod( 'btmmenu_hover_type','opacity');
  $mainnavtexthover= get_theme_mod( 'main_nav_text_hover','#5a00f0');
  $colorborder = get_theme_mod( 'regular_text_color', '#28375a' );
  $searchmaincolor = get_theme_mod( 'search_main_color', '#5a00f0' );
  $searchaccenttxtcolor = get_theme_mod( 'search_accent_text_color', '#ffffff' );
  $searchmainbgcolor = get_theme_mod( 'search_main_bg_color', '#ffffff' );
  $searchmainbordercolor = get_theme_mod( 'search_main_border_color', '#5a00f0' );
  $phototemplatebg = get_theme_mod( 'photo_template_bg', '#e9ebf7' );
  $phototemplateview = get_theme_mod( 'photo_template_view', 'fixed' );
  $productgridsystem= get_theme_mod( 'product_grid_system','one' );
  $pagebreadposition= get_theme_mod( 'page_bredcrumb_content_position','center' );
  $pageoverlayimage= get_theme_mod( 'page_overlay_image' );
  $productarchivetype = get_theme_mod( 'archive_bg_type','gradient' );
  $productarchivebg = get_theme_mod( 'parchive_background','#1e0047' );
  $productarchivebgdark = get_theme_mod( 'parchive_background_dark_alt','' );
  $productgradientarcive= get_theme_mod( 'parchive_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  $productarchiveimage= get_theme_mod( 'parchive_image' );
  $productarchiverepeat= get_theme_mod( 'parchive_bg_image_repeat','repeat' );
  $pbreadoverlaymain= get_theme_mod( 'pbread_ovarlay_main');
  $pbreadblurbg= get_theme_mod( 'pbread_blog_blur','5px');
  $pbreadbgparallax= get_theme_mod( 'parallax_prbred_image','no');
  $pbreadtxtcolor= get_theme_mod( 'pbread_txt_color','#ffffff');
  $pbreadtxtalign= get_theme_mod( 'pbread_txt_align','center');
  $prodgridbgcolor= get_theme_mod( 'product_grid_bg_color','rgba(255,255,255,0)');
  $prodgridtxtcolor= get_theme_mod( 'product_grid_txt_color','#28375a');
  $prodgridpadding = get_theme_mod( 'prod_grid_padding',array('padding-top'=>'0','padding-bottom'=>'0','padding-right'=>'0','padding-left'=>'0',));
  $prodpaddingon= get_theme_mod( 'padding_type_grid','meta');
  $prodborderradius= get_theme_mod( 'grid_border_radius','3');
  $prodboxshdaow= get_theme_mod( 'product_box_shadow','none');
  $prodboxshdaowcolor= get_theme_mod( 'product_shadow_color','rgba(40, 55,90, .15)');
  $backtotopbg= get_theme_mod( 'back_to_top_bg','#ffffff');
  $backtotopico= get_theme_mod( 'back_to_icon_color','#1e0050');
  
  $header_menu_arrow = get_theme_mod( 'header_menu_arrow','show');
  $remove_elementor_default = get_theme_mod( 'remove_elementor_default','one');
  $containerwidthbig = get_theme_mod( 'container_width_desktop_big','1170px');
  $containerwidthexbig = get_theme_mod( 'container_width_desktop_xtrabig','1170px');
  $footerwidthcontainer = get_theme_mod( 'footer_container_width','1170px');
  $pvideopromotype = get_theme_mod( 'photo_promobar_type','color' );
  $pgradienta = get_theme_mod( 'photo_template_g1','#1e0046' );
  $pgradientb = get_theme_mod( 'photo_template_g2','#1e0064' );
  $pvbgimage = get_theme_mod( 'background_image_photo_promo','' );
  $pvbgoverlaycolor = get_theme_mod( 'photov_overlay_color','' );
  $pvbgoverlaycolorv = get_theme_mod( 'photov_overlay_color_video','' );
  $photogap= get_theme_mod( 'photo_template_box_gap','disable' );
  $photobgremove= get_theme_mod( 'photo_template_backgrund_remove','enable' );
  $photobgshadow= get_theme_mod( 'photo_template_shadow','disable' );
  $photobothequal= get_theme_mod( 'photo_equal_height','disable' );
  $thumbvideocontrl= get_theme_mod( 'thumb_video_control','minimal' );
  $mediapbg= get_theme_mod( 'media_player_background','#ffffff' );
  $mediaptxt= get_theme_mod( 'media_player_icon_color','#1e3c78' );
  $tag_bg_type= get_theme_mod( 'tag_bg_type','gradient' );
  $tag_gradient =get_theme_mod( 'tag_gradient',array('color1' => '#1e0046','color2' => '#1e0064',) );


  $darkbg = get_theme_mod( 'site_bg_color_dark','#222' );
  $darktxt = get_theme_mod( 'site_txt_color_dark','#fff' );
  $darkheader= get_theme_mod( 'header_bg_color_dark','#222' );
  $darkheadertxt= get_theme_mod( 'header_txt_color_dark','#fff' );
  $darkpbgcolor= get_theme_mod( 'dark_primary_color','#222' );
  $darkptxtcolor= get_theme_mod( 'dark_primary_text_color','#fff' );
  $darkalbgcolor= get_theme_mod( 'dark_alter_color','#666' );
  $darkaltxtcolor= get_theme_mod( 'dark_alter_text_color','#fff' );
  $darksecbgcolor= get_theme_mod( 'dark_secondary_color','#282C35' );
  $darksectxtcolor= get_theme_mod( 'dark_secondary_text_color','#fff' );
  $darkinputbgcolor= get_theme_mod( 'dark_input_color','#ccc' );
  $darkinputbordercolor= get_theme_mod( 'dark_input_border_color','#ccc' );
  $darkinputtxtcolor= get_theme_mod( 'dark_input_text_color','#fff' );
  $darkfooter= get_theme_mod( 'dark_footer_bg_color','#000' );
  $darkfootertxt= get_theme_mod( 'dark_footer_text_color','#fff' );
  
  $widgetbtnbgcolor = get_theme_mod( 'wd_button_color_m','#1e0046' );
  $widgetbtnbordercolor = get_theme_mod( 'wd_button_color_b','#1e0046' );
  $widgetbtntextcolor = get_theme_mod( 'wd_button_color_tx','#ffffff' );
  $widgetbtnbgtwfive = mayosis_hexto_rgb($widgetbtnbgcolor, 0.25);


  $golbalbgopacity = mayosis_hexto_rgb($maintextcolor, 0.1);
  $tagboorderrgb = mayosis_hexto_rgb($colorborder, 0.25);
  $headerbuttonborder = mayosis_hexto_rgb($mainnavcolor, 0.25);
  $globalborderopacity = mayosis_hexto_rgb($maintextcolor, 0.25);
  $headermainsearchopacity = mayosis_hexto_rgb($maintextcolor, 0.65);
  $primarycoloropacity = mayosis_hexto_rgb($primarycolor, 0.25);
  $secondarycoloropacity = mayosis_hexto_rgb($secactcolor, 0.25);
  $secondarycolorfifty = mayosis_hexto_rgb($secactcolor, 0.5);
  $secondarycolorsixty = mayosis_hexto_rgb($secactcolor, 0.65);
  $widgetbgtwfive = mayosis_hexto_rgb($widgetbgcolor, 0.25);
  $primarycoloropacityvid = mayosis_hexto_rgb($mediapbg, 0.25);
  $primarycoloropacityvid2 = mayosis_hexto_rgb($mediapbg, 0.13);

  $buttontype = get_theme_mod('button_style_type', 'default');
  $buttongradienta = get_theme_mod('btn_gradient_color_a', '#3c28b4');
  $buttongradientb = get_theme_mod('btn_gradient_color_b', '#643cdc');
  $buttonghosttype = get_theme_mod('gost_button_style_type', 'default');
  $ghostgradienta = get_theme_mod('ghost_gradient_color_a', '#3c28b4');
  $ghostgradientb = get_theme_mod('ghost_gradient_color_b', '#643cdc');
  $anchorstyle = get_theme_mod('anchor_style_type', 'default');
  $stickybargradient = get_theme_mod( 'sticky_bar_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
  if ( function_exists( 'bp_is_active' ) ) {
    $bbpress_bg = get_theme_mod('bbpress_bg', 'color');
    $bbpress_color = get_theme_mod('bbpress_bg_color', '#460082');
    $bbpress_gradient = get_theme_mod( 'bbpress_gradient_color', array('color1' => '#1e0046','color2' => '#1e0064',));
    $bbpress_bg_img = get_theme_mod('bbpress_bg_img');
  }
  $mheaderheight=get_theme_mod( 'main_header_height','80px');

  $audiotemplate= get_theme_mod( 'background_audio_hero', 'color');
  $audiobgdefault= get_theme_mod( 'audio_bg_default', '#000046');
  $audiogradientdefault= get_theme_mod( 'audio_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
  $audioanglegradient= get_theme_mod( 'gradient_angle_audio','135');
  $audiomainbg= get_theme_mod( 'audio-main-bg');
  $audioovarlaymain= get_theme_mod( 'audio_ovarlay_main','rgb(30,0,70,.85)');
  $audiomainoverlay= get_theme_mod( 'default_overlay_image_audio');
  $audioblurbg= get_theme_mod( 'main_audio_blur','5px');
  $audiobgparallax= get_theme_mod( 'audio_parallax_featured_image','no');
  $msvshebl= get_theme_mod( 'msv_shadow_ebl','disable');
  $msvhhoriz= get_theme_mod( 'msv-shadow-h-horizontal','5');
  $msvhvert= get_theme_mod( 'msv-shadow-h-vertical','3');
  $msvhblur= get_theme_mod( 'msv-shadow-h-blur','0');
  $msvhsped= get_theme_mod( 'msv-shadow-h-spread','0');
  $msvhcolor= get_theme_mod( 'msv-shadow-h-color','#0088CC');

  $column_one_width= get_theme_mod('column_one_width','26');
  $column_two_width= get_theme_mod('column_two_width','16');
  $column_three_width= get_theme_mod('column_three_width','16');
  $column_four_width= get_theme_mod('column_four_width','16');
  $column_five_width= get_theme_mod('column_five_width','26');
  $column_six_width= get_theme_mod('column_six_width','16');
  
  $csd_bg_style_df = get_theme_mod('csd_bg_style_df','hide');
  $csd_bg_style_clr1 = get_theme_mod('csbg_color_one_stl1','#27ab81');
  $csd_bg_style_clr2 = get_theme_mod('csbg_color_two_stl1','#2600fc');
  $body_custom_css = get_theme_mod('body_custom_css','');
  
  
  
  
  
   $woodefproductpadding= get_theme_mod( 'product_woosingle_padding',array('padding-top'=>'80px','padding-bottom'=>'80px','padding-right'=>'0px','padding-left'=>'0px',));
     $wooproducttemplate= get_theme_mod( 'woos_background_product', 'color');
       $woosdefcolor= get_theme_mod( 'woo_product_bg_default','#460082');
       $wooproductgradientdefault= get_theme_mod( 'woo_product_gradient_default', array('color1' => '#1e0046','color2' => '#1e0064',));
  $wooproductanglegradient= get_theme_mod( 'woo_gradient_angle_product','135');
  $wooproductmainbg= get_theme_mod( 'woo_product-main-bg');
  $wooproductovarlaymain= get_theme_mod( 'woo_product_ovarlay_main','rgb(30,0,70,.85)');
  $wooproductmainoverlay= get_theme_mod( 'woo_default_overlay_image_product');
  $wooproductblurbg= get_theme_mod( 'woo_main_product_blur','5px');
  $wooproductbgparallax= get_theme_mod( 'woo_parallax_featured_image','no');
  $woodefproducttxt= get_theme_mod( 'woo_product_bdtxt_color','#ffffff');
  
  $wooarchivebgtype =  get_theme_mod( 'woo_archive_bg_type', 'color');
   $wooarchivegradientdefault= get_theme_mod( 'woo_parchive_gradient', array('color1' => '#1e0046','color2' => '#1e0064',));
    $wooarchivebgparallax= get_theme_mod( 'woo_parallax_prbred_image','no');
  $wooarchiveovarlaymain= get_theme_mod( 'woo_pbread_ovarlay_main','rgb(30,0,70,.85)');
  ?>

  /**Dynamic Style**/
  <?php if ( function_exists( 'bp_is_active' ) ) { ?>

  <?php if ($bbpress_bg == 'color'):?>
    #header-cover-image-custom {
    background-color: <?php echo esc_html($bbpress_color);?>;
    }

  <?php  elseif ($bbpress_bg== 'gradient') :?>
    #header-cover-image-custom {
    background: linear-gradient(-135deg,<?php echo esc_html($bbpress_gradient['color1']); ?> ,<?php echo esc_html($bbpress_gradient['color2']); ?> );
    }

  <?php  elseif ($bbpress_bg== 'image'): ?>
    #header-cover-image-custom {
    background: url(<?php echo esc_html($bbpress_bg_img);?>);
    }

  <?php endif; ?>
<?php } ?>

  <?php if ($maintextcolor): ?>

  .tag_widget_single ul li a, .sidebar-blog-categories ul li, .title--box--btn.transparent {
  border-color: <?php echo  esc_html($tagboorderrgb); ?> !important;
  }


<?php endif; ?>

  ::selection {
  background: <?php echo  esc_html($maintextcolor); ?>;
  }

  ::-moz-selection {
  background: <?php echo  esc_html($maintextcolor); ?>;
  }


  /** Primary color**/

  .mayosel-select .option:hover,
  .mayosel-select .option.focus {
  background-color: <?php echo  esc_html($globalborderopacity); ?>;
  }




  /** Form Field color**/
  .plyr--audio .plyr__control.plyr__tab-focus, .plyr--audio .plyr__control:hover, .plyr--audio .plyr__control[aria-expanded=true] {
  background: <?php echo  esc_html($primarycolor); ?>;
  }

  .plyr--audio .plyr__control.plyr__tab-focus {
  box-shadow: 0 0 0 16px<?php echo  esc_html($primarycoloropacity);?>;
  }



  input[type="range"]::-moz-range-track,
  input[type="range"]::-moz-range-progress,
  input[type="range"]::-webkit-slider-runnable-track {
  background-color: <?php echo  esc_html($headermainsearchopacity);?>;
  }

  input[type="range"]::-webkit-slider-runnable-track,
  input[type="range"]:focus::-webkit-slider-runnable-track {
  background-color: <?php echo  esc_html($headermainsearchopacity);?>;
  }

  input[type='range']::-moz-range-thumb {
  border-color: <?php echo  esc_html($maintextcolor); ?>;
  }

  input[type='range']::-webkit-slider-thumb {
  border-color: <?php echo  esc_html($maintextcolor); ?>;
  }

  .mejs-controls .mejs-time-rail .mejs-time-current {
  background: <?php echo  esc_html($primarycolor); ?> !important;
  }

  .plyr--video .plyr__control.plyr__tab-focus, .plyr--video .plyr__control:hover, .plyr--video .plyr__control[aria-expanded=true], .plyr__control--overlaid {
  background: <?php echo  esc_html($mediapbg); ?>;
  color: <?php echo esc_html($mediaptxt);?>;
  }

  .plyr--video .plyr__control.plyr__tab-focus, .plyr__control--overlaid:hover {
  box-shadow: 0 0 0 16px <?php echo  esc_html($primarycoloropacityvid); ?>, 0 0 0 32px<?php echo  esc_html($primarycoloropacityvid2); ?>;
  }

  .plyr--full-ui input[type=range] {
  color: <?php echo  esc_html($primarycolor); ?>;
  }

  .favorited .glyphicon-add {
  color: <?php echo  esc_html($primarycolor); ?> !important;
  }




  p.comment-form-comment textarea, #edd_login_form .edd-input, #edd_register_form .edd-input, #edd_checkout_form_wrap input.edd-input, #edd_checkout_form_wrap textarea.edd-input, #edd_checkout_form_wrap select.edd-select,
  #edd_download_pagination a.page-numbers, #edd_download_pagination span.page-numbers, #edd_profile_editor_form input:not([type="submit"]), #edd_profile_editor_form select, #contact textarea,
  .wpcf7-form-control-wrap textarea, input[type="text"], input[type="email"], input[type="password"], .solid-input input, .common-paginav a.next,
  .common-paginav a.prev, #edd_download_pagination a.next, #edd_download_pagination a.prev, .fes-pagination a.page-numbers, .fes-pagination span.page-numbers, .fes-product-list-pagination-container a.page-numbers, .fes-product-list-pagination-container
  span.page-numbers, .fes-fields input[type=email], .fes-fields input[type=password], .fes-fields textarea, .fes-fields input[type=url], .fes-fields input[type=text], .fes-vendor-comment-respond-form textarea, .fes-fields select, textarea,
  .vendor--search--box input[type="text"], .download_category .select2-container--default .select2-selection--single,
  .fes-fields .mayosel-select, #edd_profile_editor_form .mayosel-select, div.fes-form .fes-el .fes-fields input[type=text], .download_category .select2-container, div.fes-form .fes-el .fes-fields input[type=password], div.fes-form .fes-el .fes-fields input[type=email], div.fes-form .fes-el .fes-fields input[type=url], div.fes-form .fes-el .fes-fields input[type=number], div.fes-form .fes-el .fes-fields textarea {
  border-width: <?php echo  esc_html($globalborderthik); ?>;
  }



  #fes-product-list tbody tr, #fes-order-list tbody tr,
  #edd_user_paid_commissions_table tbody tr,
  #edd_user_revoked_commissions_table tbody tr,
  #edd_user_unpaid_commissions_table tbody tr {
  border-color: <?php echo  esc_html($golbalbgopacity); ?>;
  }

  .fes-ignore.button {
  border: solid<?php echo  esc_html($globalborderopacity); ?>;
  border-width: <?php echo  esc_html($globalborderthik); ?>;
  color: <?php echo esc_html($maintextcolor); ?>;
  }

  .fes-ignore.button:hover {
  background: <?php echo esc_html($maintextcolor); ?>;
  }


  <?php if ($productbgtype=='gradient'): ?>

  .hover_effect_single, .hover_effect, figure.effect-dm2 figcaption {
  background: linear-gradient(<?php echo esc_html($producthovergrad['color1']); ?>, <?php echo esc_html($producthovergrad['color2']); ?>);
  color: <?php echo  esc_html($producthovertxt); ?>

  }

  figure.mayosis-fade-in figcaption {
  background: linear-gradient(<?php echo esc_html($producthovergrad['color1']); ?>, <?php echo esc_html($producthovergrad['color2']); ?>);
  color: <?php echo  esc_html($producthovertxt); ?>;
  }

  .button-fill-color {
  background: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthover); ?>;
  }

  .download-count-hover, .product-hover-social-share .social-button a, .product-hover-social-share .social-button a i, .recent_image_block .overlay_content_center a, .fes--author--image--block .overlay_content_center a, .overlay-style .product-title a, .overlay-style a {
  color: <?php echo  esc_html($producthovertxt); ?> !important;
  }

  .overlay_content_center .live_demo_onh {
  border-color: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthovertxt); ?>;
  }

  .overlay_content_center .live_demo_onh:hover {
  background-color: <?php echo  esc_html($producthovertxt); ?>;
  border-color: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthover); ?> !important;
  }

<?php else : ?>
  .hover_effect_single, .hover_effect, figure.effect-dm2 figcaption {
  background-color: <?php echo  esc_html($producthover); ?>;
  color: <?php echo  esc_html($producthovertxt); ?>

  }

  figure.mayosis-fade-in figcaption {
  background-color: <?php echo  esc_html($producthover); ?>;
  color: <?php echo  esc_html($producthovertxt); ?>;
  }

  .button-fill-color {
  background-color: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthover); ?>;
  }

  .download-count-hover, .product-hover-social-share .social-button a, .product-hover-social-share .social-button a i, .recent_image_block .overlay_content_center a, .fes--author--image--block .overlay_content_center a {
  color: <?php echo  esc_html($producthovertxt); ?> !important;
  }

  .overlay_content_center .live_demo_onh {
  border-color: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthovertxt); ?>;
  }

  .overlay_content_center .live_demo_onh:hover {
  background-color: <?php echo  esc_html($producthovertxt); ?>;
  border-color: <?php echo  esc_html($producthovertxt); ?>;
  color: <?php echo  esc_html($producthover); ?> !important;
  }

<?php endif; ?>
  /**End Common Style**/
  /**Header Style**/
  <?php if ($headerbgtype=='gradient'): ?>
  .header-master, #mobileheader {
  background: -webkit-linear-gradient(<?php echo esc_html($hgradientangle);?>, <?php echo esc_html($hgradient['color1']); ?>, <?php echo esc_html($hgradient['color2']); ?>);
  background: -ms-linear-gradient(<?php echo esc_html($hgradientangle);?>, <?php echo esc_html($hgradient['color1']); ?>, <?php echo esc_html($hgradient['color2']); ?>);
  background: -moz-linear-gradient(<?php echo esc_html($hgradientangle);?>, <?php echo esc_html($hgradient['color1']); ?>, <?php echo esc_html($hgradient['color2']); ?>);
  }

<?php elseif ($headerbgtype=='image'): ?>
  .header-master, #mobileheader {
  background: url(<?php echo esc_html($hbgimage); ?>);
  }

<?php else: ?>
  .header-master, #mobileheader {
  background: <?php echo  esc_html($hbgcolor); ?>;
  }

<?php endif; ?>


  /**Header Form **/
  <?php if ($headerformtype=="solid"): ?>
  .fill .form-control, .stylish-input-group input, .search-field, .maxcollapse-open .maxcollapse-input {
  background-color: <?php echo  esc_html($headerformbgcolor); ?>;
  border-color: <?php echo  esc_html($headerformbgcolor); ?>;
  }

<?php else: ?>
  .fill .form-control, .stylish-input-group input, .search-field, .maxcollapse-open .maxcollapse-input {
  background: transparent;
  border-color: <?php echo  esc_html($headerformbgborder); ?>;
  border-width: <?php echo  esc_html($headerformborderthik); ?>;
  }

<?php endif; ?>


  <?php if ($headertransparentmain=="transparent"): ?>
  .main-header.header-transparent .header-content-wrap, .mobile-header.header-transparent, #mobileheader {
  background: <?php echo  esc_html($transparentheader); ?>;
  }

<?php endif; ?>

  <?php if ($smartsticky== 'on'): ?>
  .headroom {
  position: fixed;
  left: 0;
  right: 0;
  z-index: 9999;
  top: 0;
  }

  .headroom--unpinned, #mobileheader.headroom--unpinned {
  -moz-transform: translateY(-150%);
  -ms-transform: translateY(-150%);
  -webkit-transform: translateY(-150%);
  transform: translateY(-150%)
  }

  header.fixedheader {
  top: 0;
  }

  .admin-bar header.fixedheader, .admin-bar .headroom {
  top: 32px;
  }

<?php endif; ?>
  <?php if ($stickylogo): ?>
  header.fixedheader .site-logo img.main-logo, header.fixedheader .center-logo img.main-logo, header.fixedheader#mobileheader .mobile-logo {
  opacity: 0;
  display: none !important;
  }

  .fixedheader.main-header .site-logo .sticky-logo, .fixedheader.main-header .center-logo .sticky-logo, #mobileheader.fixedheader .sticky-logo {
  display: inline-block;
  opacity: 1;
  }

<?php endif; ?>

  /**End Header Style**/
  /**Menu Style**/


  <?php if ($menuhovertype=='opacity'): ?>
  #mayosis-menu.msv-main-menu > ul > li > a:hover, .my-account-menu a:hover,.mayosis-option-menu > li > a:hover,.dropdown.cart_widget > a:hover,
  .nav-style-megamenu>li.nav-item .nav-link:hover{
  opacity: .5;
  }

<?php elseif ($menuhovertype=='underline'): ?>

  #mayosis-menu.msv-main-menu > ul > li > a:before,
  .nav-style-megamenu>li.nav-item .nav-link:before{
  position: absolute;
  top: 80%;
  left: 0;
  width: 100%;
  height: 1px;
  background: <?php echo esc_html($mainnavcolor); ?>;
  content: '';
  opacity: 0;
  -webkit-transition: height 0.3s, opacity 0.3s, -webkit-transform 0.3s;
  -moz-transition: height 0.3s, opacity 0.3s, -moz-transform 0.3s;
  transition: height 0.3s, opacity 0.3s, transform 0.3s;
  -webkit-transform: translateY(-5px);
  -moz-transform: translateY(-5px);
  transform: translateY(-5px);
  }
  #mayosis-menu.msv-main-menu > ul > li:hover > a:before,
  .nav-style-megamenu>li.nav-item:hover .nav-link:before{
  background:<?php echo esc_html($mainnavtexthover);?>;
  opacity:1;
  }
  .menu-item-has-children.has-sub > a :before, .menu-item-has-children.has-sub > a:hover::before {
  display: none;

  }

  #mayosis-menu.msv-main-menu > ul > li > a:hover::before,
  #mayosis-menu.msv-main-menu > ul > li > a:focus::before {
  height: 3px;
  opacity: 1;
  -webkit-transform: translateY(0px);
  -moz-transform: translateY(0px);
  transform: translateY(0px);
  }

  #mayosis-menu.msv-main-menu ul li a i {
  padding-right: 0;
  }

<?php elseif ($menuhovertype=='dotted'): ?>

  #mayosis-menu.msv-main-menu > ul > li > a, .my-account-menu a:hover,
  .nav-style-megamenu>li.nav-item .nav-link:hover{
  -webkit-transition: color 0.3s;
  -moz-transition: color 0.3s;
  transition: color 0.3s;
  }

  #mayosis-menu.msv-main-menu > ul > li > a::before, .my-account-menu a:before,
  .nav-style-megamenu>li.nav-item .nav-link:before{
  position: absolute;
  top: 30%;
  left: 50%;
  color: transparent;
  content: '•';
  text-shadow: 0 0 transparent;
  font-size: 16px;
  -webkit-transition: text-shadow 0.3s, color 0.3s;
  -moz-transition: text-shadow 0.3s, color 0.3s;
  transition: text-shadow 0.3s, color 0.3s;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  transform: translateX(-50%);
  pointer-events: none;
  }

  #mayosis-menu.msv-main-menu > ul > li > a:hover::before,
  #mayosis-menu.msv-main-menu > ul > li > a:focus::before ,
  .nav-style-megamenu>li.nav-item .nav-link:hover::before,
  .nav-style-megamenu>li.nav-item .nav-link:focus::before{
  color: <?php echo esc_html($mainnavtexthover); ?>;
  text-shadow: 10px 0 <?php echo esc_html($mainnavtexthover); ?>, -10px 0<?php echo esc_html($mainnavtexthover); ?>;
  }

  #mayosis-menu.msv-main-menu .menu-item-has-children.has-sub > a :before, #mayosis-menu.msv-main-menu .menu-item-has-children.has-sub > a:hover::before {
  display: none;

  }

  #mayosis-menu.msv-main-menu ul li a i,
  .nav-style-megamenu>li.nav-item .nav-link a i{
  padding-right: 0;
  }

<?php endif; ?>


  <?php if ($btmmenuhovertype=='opacity'): ?>
  #mayosis-menu.mayosis-bottom-menu > ul > li > a:hover {
  opacity: .5;
  }

<?php elseif ($btmmenuhovertype=='underline'): ?>

  #mayosis-menu.mayosis-bottom-menu > ul > li > a:before {
  position: absolute;
  top: 80%;
  left: 0;
  width: 100%;
  height: 1px;
  background: <?php echo esc_html($mainnavcolor); ?>;
  content: '';
  opacity: 0;
  -webkit-transition: height 0.3s, opacity 0.3s, -webkit-transform 0.3s;
  -moz-transition: height 0.3s, opacity 0.3s, -moz-transform 0.3s;
  transition: height 0.3s, opacity 0.3s, transform 0.3s;
  -webkit-transform: translateY(-5px);
  -moz-transform: translateY(-5px);
  transform: translateY(-5px);
  }
  #mayosis-menu.mayosis-bottom-menu  > ul > li:hover > a:before{
  background:<?php echo esc_html($mainnavtexthover);?>;
  }
  .menu-item-has-children.has-sub > a :before, .menu-item-has-children.has-sub > a:hover::before {
  display: none;

  }

  #mayosis-menu.mayosis-bottom-menu  > ul > li > a:hover::before,
  #mayosis-menu.mayosis-bottom-menu  > ul > li > a:focus::before {
  height: 3px;
  opacity: 1;
  -webkit-transform: translateY(0px);
  -moz-transform: translateY(0px);
  transform: translateY(0px);
  }

  #mayosis-menu.mayosis-bottom-menu ul li a i {
  padding-right: 0;
  }

<?php elseif ($btmmenuhovertype=='dotted'): ?>

  #mayosis-menu.mayosis-bottom-menu  > ul > li > a{
  -webkit-transition: color 0.3s;
  -moz-transition: color 0.3s;
  transition: color 0.3s;
  }

  #mayosis-menu.mayosis-bottom-menu > ul > li > a::before, .my-account-menu a:before {
  position: absolute;
  top: 30%;
  left: 50%;
  color: transparent;
  content: '•';
  text-shadow: 0 0 transparent;
  font-size: 16px;
  -webkit-transition: text-shadow 0.3s, color 0.3s;
  -moz-transition: text-shadow 0.3s, color 0.3s;
  transition: text-shadow 0.3s, color 0.3s;
  -webkit-transform: translateX(-50%);
  -moz-transform: translateX(-50%);
  transform: translateX(-50%);
  pointer-events: none;
  }

  #mayosis-menu.mayosis-bottom-menu  > ul > li > a:hover::before,
  #mayosis-menu.mayosis-bottom-menu  > ul > li > a:focus::before {
  color: <?php echo esc_html($mainnavtexthover); ?>;
  text-shadow: 10px 0 <?php echo esc_html($mainnavtexthover); ?>, -10px 0<?php echo esc_html($mainnavtexthover); ?>;
  }

  #mayosis-menu.mayosis-bottom-menu .menu-item-has-children.has-sub > a :before,#mayosis-menu.mayosis-bottom-menu .menu-item-has-children.has-sub > a:hover::before {
  display: none;

  }

  #mayosis-menu.mayosis-bottom-menu ul li a i {
  padding-right: 0;
  }

<?php endif; ?>





  .searchoverlay-button {
  color: <?php echo esc_html($mainnavcolor); ?>;
  }


  /**End Menu Style**/
  /**Footer Style**/
  .main-footer {
  padding-top: <?php echo  esc_html($footerpadding['padding-top']); ?>;
  padding-right: <?php echo  esc_html($footerpadding['padding-right']); ?>;
  padding-bottom: <?php echo  esc_html($footerpadding['padding-bottom']); ?>;
  padding-left: <?php echo  esc_html($footerpadding['padding-left']); ?>;
  }

  <?php if ($footerbgtype=='gradient'): ?>
  footer.main-footer {
  background: linear-gradient(190deg, <?php echo esc_html($footerbggradient['color1']); ?>, <?php echo esc_html($footerbggradient['color2']); ?>);
  }

<?php elseif ($footerbgtype=='custom'): ?>
  footer.main-footer {
  <?php echo get_theme_mod( 'footer_custom_css' ); ?>
  }

<?php elseif ($footerbgtype=='image'): ?>
  footer.main-footer {
  background: url(<?php echo esc_html($footerbgimage); ?>);
  }

<?php else: ?>
  footer.main-footer {
  background: <?php echo  esc_html($footerbgcolor); ?>;
  }

<?php endif; ?>

  footer.main-footer:after {
  background: url(<?php echo  esc_html($footer_overlay_image); ?>) 100% 100% no-repeat;
  }

  <?php if ($blog_overlay_image): ?>
  .main-blog-promo:after {
  background: url(<?php echo  esc_html($blog_overlay_image); ?>) 100% 100% no-repeat;
  }

<?php endif; ?>
  <?php if ($productmainoverlay): ?>
  .default-product-template.product-main-header:after {
  background: url(<?php echo  esc_html($productmainoverlay); ?>) 100% 100% no-repeat;
  }

<?php endif; ?>
  footer.main-footer, .footer-text, .footer-sidebar ul li a, .without-bg-social a, .mx-widget-counter h2, .main-footer a, .main-footer ul li a {
  color: <?php echo  esc_html($footertext); ?>;
  }

  .footer-widget-title, .footer-sidebar .widget-title {
  color: <?php echo  esc_html($footerheadingcolor); ?>;
  }

  .main-footer .sidebar-blog-categories ul li a, .main-footer .recent_post_widget a,
  .main-footer .recent_post_widget p, .main-footer .widget-products a, .main-footer .widget-products p, .main-footer .sidebar-blog-categories ul li {
  color: <?php echo  esc_html($footertext); ?> !important;
  }

  .additional-footer, div.wpcf7-validation-errors, div.wpcf7-acceptance-missing {
  border-color: <?php echo  esc_html($footertext); ?>;
  }

  .back-to-top {
  background-color: <?php echo  esc_html($backtotopbg); ?>;
  border-color: <?php echo  esc_html($backtotopbg); ?>;
  color: <?php echo  esc_html($backtotopico); ?>;
  }

  footer .social-profile a {
  background: <?php echo  esc_html($copyrightbg); ?>;
  }

  .copyright-footer {
  background: <?php echo  esc_html($copyrightbg); ?>;
  color: <?php echo  esc_html($copyrighttext); ?>;
  }

  .copyright-text, .copyright-footer a {
  color: <?php echo  esc_html($copyrighttext); ?>;
  }

  .footer-widget .sidebar-theme .single-news-letter .nl__item--submit {
  background-color: <?php echo  esc_html($footertext); ?>;
  border-color: <?php echo  esc_html($footertext); ?>;
  color: <?php echo  esc_html($footerbgcolor); ?>;
  }

  .footer-widget input[type="text"], .footer-widget input[type="email"], .footer-widget input[type="password"], .footer-widget input[type="text"]::placeholder, .footer-widget input[type="email"]::placeholder, .footer-widget input[type="password"]::placeholder {
  color: <?php echo  esc_html($footertext); ?> !important;
  }

  <?php if ($footerfieldtype=='solid'): ?>
  .footer-widget input[type="text"], .footer-widget input[type="email"], .footer-widget input[type="password"] {
  background: <?php echo  esc_html($footerfieldbg); ?> !important;
  border-color: <?php echo  esc_html($footerfieldbg); ?> !important;
  }

<?php else : ?>
  .footer-widget input[type="text"], .footer-widget input[type="email"], .footer-widget input[type="password"] {
  background: transparent !important;
  border-color: <?php echo  esc_html($footerfieldborder); ?> !important;
  border-width: <?php echo  esc_html($footerborderthik); ?>;
  }

<?php endif; ?>
  /**End Footer Style**/
  /**Widget Style**/
  .theme--sidebar--widget .widget-title {
  color: <?php echo  esc_html($widgettitlecolor); ?>;
  }

  .theme--sidebar--widget .input-group.sidebar-search, .theme--sidebar--widget .search-field {
  margin: 20px 0;
  }

  .sidebar-theme .search-form input[type=search], .sidebar-theme input[type=text], .sidebar-theme input[type=email], .sidebar-theme input[type=password], .sidebar--search--blog .search-form input[type=search], .theme--sidebar--widget select, .theme--sidebar--widget .search-field {
  border-color: <?php echo  esc_html($maintextcolor); ?>;
  }

  .theme--sidebar--widget .menu-item a {
  color: <?php echo  esc_html($maintextcolor); ?>;
  }

  .theme--sidebar--widget .single-news-letter .nl__item--submit {
  background-color: <?php echo  esc_html($maintextcolor); ?> !important;
  border-color: <?php echo  esc_html($maintextcolor); ?> !important;
  }

  .product_widget_inside, .sidebar-theme ul {
  padding: 0;
  }

  .sidebar-blog-categories {
  padding: 0;
  margin-bottom: 30px;
  }

  .release-info {
  padding: 0 !important;
  }


  <?php if ($widgetbgtype=='gradient'): ?>
  .widget-title, .post-tabs .nav-pills > li.active > a, .post-tabs .nav-pills > li.active > a:focus, .post-tabs .nav-pills > li.active > a:hover, .sidebar-search #icon-addon,.theme--sidebar--widget .widget-title,.widget_block .wp-block-group__inner-container h2 {
  background: linear-gradient(45deg, <?php echo esc_html($widgetbggradient['color1']); ?>, <?php echo esc_html($widgetbggradient['color2']); ?>);
  }

<?php else : ?>
  .widget-title, .post-tabs .nav-pills > li.active > a, .post-tabs .nav-pills > li.active > a:focus, .post-tabs .nav-pills > li.active > a:hover, .sidebar-search #icon-addon,.theme--sidebar--widget .widget-title,.widget_block .wp-block-group__inner-container h2 {
  background: <?php echo  esc_html($widgetbgcolor); ?>;
  }

<?php endif; ?>
  .sidebar-search #icon-addon {
  color: <?php echo esc_html($widgettitlecolor);?>;
  }

  .solid--buttons-fx a {
  background: <?php echo  esc_html($widgetbtnbgcolor); ?> !important;
  border-color: <?php echo  esc_html($widgetbtnbordercolor); ?> !important;
  color: <?php echo esc_html($widgetbtntextcolor);?> !important;
  }

  .ghost--buttons-fx a {
  border-color: <?php echo  esc_html($widgetbtnbgtwfive); ?> !important;
  color: <?php echo  esc_html($widgetbtnbgcolor); ?> !important;
  }

  .ghost--buttons-fx a:hover {
  background: <?php echo  esc_html($widgetbtnbgcolor); ?> !important;
  border-color: <?php echo  esc_html($widgetbtnbgcolor); ?> !important;
  color: <?php echo esc_html($widgetbtntextcolor);?> !important;
  }

  <?php if ($widgetfieldtype=='solid'): ?>
  .sidebar-theme .search-form input[type=search], .sidebar-theme input[type=text], .sidebar-theme input[type=email], .sidebar-theme input[type=password], .sidebar--search--blog .search-form input[type=search] {
  background: <?php echo  esc_html($widgetfieldbg); ?>;
  border-color: <?php echo  esc_html($widgetfieldbg); ?>;
  color: <?php echo  esc_html($widgetfieldtext); ?>;
  }

<?php else: ?>
  .sidebar-theme .search-form input[type=search], .sidebar-theme input[type=text], .sidebar-theme input[type=email], .sidebar-theme input[type=password], .sidebar--search--blog .search-form input[type=search], .theme--sidebar--widget select {
  background-color: transparent;
  border-color: <?php echo  esc_html($widgetfieldborder); ?>;
  border-width: <?php echo  esc_html( $widgetborderthik); ?>;
  color: <?php echo  esc_html($widgetfieldtext); ?>;
  }

<?php endif; ?>

  .sidebar-theme .single-news-letter .nl__item--submit {
  background: <?php echo  esc_html($widgetfieldborder); ?>;
  border-color: <?php echo  esc_html($widgetfieldborder); ?>;
  color: <?php echo  esc_html($widgettitlecolor); ?>;
  }

  /**End Widget Style**/
  /**Start Product Style**/
  <?php if ($prodboxshdaow=='box'): ?>
  .product-box, .product-masonry-item .product-masonry-item-content {
  box-shadow: 0 2px 2px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 4px 4px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 8px 8px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 16px 16px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 32px 32px <?php echo  esc_html($prodboxshdaowcolor); ?>;
  }

<?php elseif ($prodboxshdaow=='hover'): ?>
  .product-box, .masonary-tile img, .product-masonry-item .product-masonry-item-content {
  transition: all .2s;
  }

  .product-box:hover, .masonary-tile img:hover, .product-masonry-item .product-masonry-item-content:hover {
  box-shadow: 0 2px 2px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 4px 4px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 8px 8px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 16px 16px <?php echo  esc_html($prodboxshdaowcolor); ?>,
  0 32px 32px<?php echo  esc_html($prodboxshdaowcolor); ?>;
  }

<?php endif; ?>
  .product-box, .grid_dm figure, .product-masonry-item .product-masonry-item-content, .grid-product-box .product-thumb img, .product-thumb {
  border-radius: <?php echo  esc_html($prodborderradius); ?>px;
  }

  <?php if ($prodpaddingon=='full'): ?>
  .product-box, .dm-default-wrapper .edd_download_inner, .product-masonry-item .product-masonry-item-content {
  background: <?php echo  esc_html($prodgridbgcolor); ?>;
  padding-top: <?php echo  esc_html($prodgridpadding['padding-top']); ?>;
  padding-right: <?php echo  esc_html($prodgridpadding['padding-right']); ?>;
  padding-bottom: <?php echo  esc_html($prodgridpadding['padding-bottom']); ?>;
  padding-left: <?php echo  esc_html($prodgridpadding['padding-left']); ?>;
  }

<?php else : ?>
  .product-box, .dm-default-wrapper .edd_download_inner, .product-masonry-item .product-masonry-item-content {
  background: <?php echo  esc_html($prodgridbgcolor); ?>;
  }

  .product-meta {

  padding-top: <?php echo  esc_html($prodgridpadding['padding-top']); ?>;
  padding-right: <?php echo  esc_html($prodgridpadding['padding-right']); ?>;
  padding-bottom: <?php echo  esc_html($prodgridpadding['padding-bottom']); ?>;
  padding-left: <?php echo  esc_html($prodgridpadding['padding-left']); ?>;
  }

<?php endif; ?>
  .product-box .product-meta a, .product-box .product-meta, .product-box .count-download, .product-box .count-download .promo_price, .count-download span {
  color: <?php echo  esc_html($prodgridtxtcolor); ?>;
  }

  <?php if ($producttemplate=='gradient'): ?>
  .default-product-template.product-main-header {
  background: linear-gradient(<?php echo  esc_html($productanglegradient); ?>deg, <?php echo esc_html($productgradientdefault['color1']); ?>, <?php echo esc_html($productgradientdefault['color2']); ?>) !important;
  }

<?php elseif ($producttemplate=='image'): ?>

  .default-product-template.product-main-header {
  background: url(<?php echo  esc_html($productmainbg); ?>) no-repeat !important;
  background-size: cover !important;
  }

<?php elseif ($producttemplate=='featured'): ?>
  .default-product-template.product-main-header:before {
  background: <?php echo  esc_html($productovarlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }

<?php elseif ($producttemplate=='color'): ?>

  .default-product-template.product-main-header {
  background: <?php echo  esc_html($productbgdefault); ?> !important;
  }

<?php elseif ($producttemplate=='custom'): ?>
  .default-product-template.product-main-header {
  <?php echo get_theme_mod( 'product_custom_css' ); ?>
  }

<?php endif; ?>

  <?php if ($productblurbg): ?>
  .default-product-template.product-main-header .featuredimagebg {
  filter: blur(<?php echo  esc_html($productblurbg); ?>);
  transform: scale(1.1);
  }

<?php endif; ?>

  <?php if ($productbgparallax=="yes"): ?>
  .default-product-template.product-main-header .featuredimagebg {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

<?php endif; ?>
  <?php if ($productcontentposition=='center'): ?>
  .default-product-template.product-main-header .single_main_header_products, .default-product-template.product-main-header .breadcrumb {
  text-align: center;
  }

  .default-product-template.product-main-header .product-top-button-flex {
  justify-content: center;
  }

<?php elseif ($productcontentposition=='right'): ?>
  .default-product-template.product-main-header .single_main_header_products, .default-product-template.product-main-header .breadcrumb {
  text-align: right;
  }

  .default-product-template.product-main-header .product-top-button-flex {
  float: right;
  width: 100%;
  justify-content: flex-end;
  }

<?php endif; ?>

  /** prime Template **/

  <?php if ($primeproalign=='center'): ?>
  .prime-product-template.product-main-header .single_main_header_products, .prime-product-template.product-main-header .breadcrumb {
  text-align: center;
  }

  .prime-product-template.product-main-header .product-top-button-flex {
  justify-content: center;
  }

<?php elseif ($primeproalign=='right'): ?>
  .prime-product-template.product-main-header .single_main_header_products, .prime-product-template.product-main-header .breadcrumb {
  text-align: right;
  }

  .prime-product-template.product-main-header .product-top-button-flex {
  float: right;
  width: 100%;
  justify-content: flex-end;
  }

<?php endif; ?>


  <?php if ($primetemplate=='gradient'): ?>
  .prime-product-template.product-main-header {
  background: linear-gradient(<?php echo  esc_html($primeanglegradient); ?>deg,
  <?php echo esc_html($primegradientdefault['color1']); ?>,
  <?php echo esc_html($primegradientdefault['color2']); ?>) !important;
  }

<?php elseif ($primetemplate=='image'): ?>

  .prime-product-template.product-main-header {
  background: url(<?php echo  esc_html($primemainbg); ?>) no-repeat !important;
  background-size: cover !important;
  }

<?php elseif ($primetemplate=='featured'): ?>
  .prime-product-template.product-main-header:before {
  background: <?php echo  esc_html($primeovarlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }

<?php elseif ($primetemplate=='color'): ?>

  .prime-product-template.product-main-header {
  background: <?php echo  esc_html($primebgdefault); ?> !important;
  }

<?php elseif ($primetemplate=='custom'): ?>
  .prime-product-template.product-main-header {
  <?php echo get_theme_mod( 'prime_custom_css' ); ?>
  }

<?php endif; ?>


  <?php if ($primemainoverlay): ?>
  .prime-product-template.product-main-header:after {
  background: url(<?php echo  esc_html($primemainoverlay); ?>) 100% 100% no-repeat;
  }

<?php endif; ?>

  <?php if ($primeblurbg): ?>
  .prime-product-template.product-main-header .featuredimagebg {
  filter: blur(<?php echo  esc_html($primeblurbg); ?>);
  transform: scale(1.1);
  }

<?php endif; ?>

  <?php if ($primebgparallax=="yes"): ?>
  .prime-product-template.product-main-header .featuredimagebg {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

<?php endif; ?>

  .prime-product-template.product-main-header,
  .prime-product-template.product-main-header .single_main_header_products,
  .prime-product-template.product-main-header .single_main_header_products h1,
  .prime-product-template.product-main-header .single_main_header_products span,
  .prime-product-template.product-main-header .single_main_header_products span a,
  .prime-product-template.product-main-header .single_main_header_products a,
  .prime-product-template.product-main-header .breadcrumb {
  color: <?php echo  esc_html($primetxt); ?>
  }

  /** product Archive **/
  .product-archive-breadcrumb, .product-archive-breadcrumb .parchive-page-title,
  .product-archive-breadcrumb .breadcrumb{
  color: <?php echo  esc_html($pbreadtxtcolor); ?>;
  text-align: <?php echo  esc_html($pbreadtxtalign); ?>;
  }

  <?php if ($productarchivetype=='color'): ?>
  .product-archive-breadcrumb {
  background: <?php echo  esc_html($productarchivebg); ?>;
  }

<?php elseif ($productarchivetype=='custom'): ?>
  .product-archive-breadcrumb {
  <?php echo get_theme_mod( 'archive_custom_css' ); ?>
  }

<?php elseif ($productarchivetype=='gradient'): ?>
  .product-archive-breadcrumb {
  background: linear-gradient(-135deg, <?php echo esc_html($productgradientarcive['color1']); ?>, <?php echo esc_html($productgradientarcive['color2']); ?>);
  }

<?php elseif ($productarchivetype=='image'): ?>
  .product-archive-breadcrumb {
  background: url(<?php echo esc_html($productarchiveimage); ?>);
  }

  <?php if ($productarchiverepeat=='cover'): ?>
    .product-archive-breadcrumb {
    background-repeat: no-repeat;
    background-size: cover;
    }

  <?php endif; ?>
<?php elseif ($productarchivetype=='featured'): ?>

  .product-archive-breadcrumb {
  position: relative;

  }

  .featuredimageparchive {
  background-repeat: no-repeat !important;
  background-size: cover !important;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: -1;
  }

  .product-archive-breadcrumb::after {
  content:"";
  background: <?php echo  esc_html($pbreadoverlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 3;
  position: absolute;
  display: inline-block !important;
  }

<?php else: ?>
  .product-archive-breadcrumb {
  background-color: #282837;
  }

<?php endif; ?>


  <?php if ($pbreadblurbg): ?>
  .featuredimageparchive {
  filter: blur(<?php echo  esc_html($pbreadblurbg); ?>);
  transform: scale(1.1);
  }
  .product-archive-breadcrumb:before {
  content:"";
  transform: translateX(1px) scale(1.1);
  }
<?php endif; ?>

  <?php if ($pbreadbgparallax=="yes"): ?>
  .featuredimageparchive {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

  .product-archive-breadcrumb:before {
  transform: translateX(1px) scale(1.1);
  }

<?php endif; ?>

  /**Start Photo/Video Template Style**/
  <?php if ($pvideopromotype=='color'): ?>
  .photo-video-template {
  background: <?php echo esc_html($phototemplatebg); ?>;
  }

<?php elseif ($pvideopromotype=='gradient'): ?>
  .photo-video-template {
  background: linear-gradient(-135deg, <?php echo esc_html($pgradienta); ?>, <?php echo esc_html($pgradientb); ?>);
  }

<?php elseif ($pvideopromotype=='image'): ?>
  .photo-video-template {
  background: url(<?php echo esc_html($pvbgimage);?>);
  background-size: cover;
  background-repeat: no-repeat;
  }

<?php elseif ($pvideopromotype=='featured'): ?>
  .photo-video-template:after {
  background: <?php echo esc_html($pvbgoverlaycolor); ?>;
  }

<?php elseif ($pvideopromotype=='video'): ?>
  .photo-video-template:after {
  background: <?php echo esc_html($pvbgoverlaycolorv); ?>;
  }

<?php endif;?>

  /**Start Blog Style**/
  <?php if ($blogbgtype=='color'): ?>
  .main-post-promo.main-blog-promo, .single_author_box, .archive_bredcrumb_header {
  background: <?php echo  esc_html($blogbgcolor); ?>;
  }

<?php elseif ($blogbgtype=='gradient'): ?>
  .main-post-promo, .single_author_box, .archive_bredcrumb_header {
  background: linear-gradient(-135deg, <?php echo esc_html($blogbggradient['color1']); ?>, <?php echo esc_html($blogbggradient['color2']); ?>);
  }

<?php elseif ($blogbgtype=='custom'): ?>
  .main-post-promo, .single_author_box, .archive_bredcrumb_header {
  <?php echo get_theme_mod( 'blog_custom_css' ); ?>
  }

<?php elseif ($blogbgtype=='image'): ?>
  .main-post-promo, .single_author_box, .archive_bredcrumb_header {
  background: url(<?php echo esc_html($blogbgimage); ?>);
  }

  <?php if ($blogbgimagerepeat=='cover'): ?>
    .main-post-promo, .single_author_box, .archive_bredcrumb_header {
    background-repeat: no-repeat;
    background-size: cover;

    }

  <?php endif; ?>

<?php elseif ($blogbgtype=='featured'): ?>
  .archive_bredcrumb_header {
  background: <?php echo  esc_html($secactcolor); ?>;
  }

  .main-blog-promo:before {
  background: <?php echo  esc_html($blogoverlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }

<?php else : ?>
  .main-post-promo {
  background-color: #282837;
  }

<?php endif; ?>

  <?php if ($blogblurbg): ?>
  .featuredimagebgblog {
  filter: blur(<?php echo  esc_html($blogblurbg); ?>);
  transform: scale(1.1);
  }

<?php endif; ?>

  <?php if ($blogbgparallax=="yes"): ?>
  .featuredimagebgblog {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

<?php endif; ?>

  <?php if ($blogcontentposition=='center'): ?>
  .single--post--header--content .breadcrumb, .single--post--header--content {
  text-align: center;
  }

<?php elseif ($blogcontentposition=='right'): ?>
  .single--post--header--content .breadcrumb, .single--post--header--content {
  text-align: right;
  }

<?php endif; ?>
   .single--post--content, .product-style-one-meta, .product-style-one-meta a,  .single-post-excerpt, .main-post-promo .single-social-button, .main-post-promo .single-social-button a i, .single-post-breadcrumbs .breadcrumb > .active{
  color: <?php echo  esc_html($productbdtextcolor); ?> !important;
  }

  .breadcrumb > .active {
  color: <?php echo  esc_html($productbdtextcolor); ?>;
  }

  .comment-button a.btn, .social-button {
  color: <?php echo  esc_html($productbdtextcolor); ?>;
  }

  .comment-button a.btn:hover {
  background-color: <?php echo  esc_html($productbdtextcolor); ?> !important;
  border-color: <?php echo  esc_html($productbdtextcolor); ?> !important;
  color: <?php echo  esc_html($blogbgcolor); ?> !important;
  }

  .ie8 .lblue, .lblue > span, .lblue.left-corner > span::before, .lblue.left-corner > span::after, .lblue.right-corner > span, .lblue.right-corner > span::before, .lblue.right-corner > span::after {
  background-color: <?php echo  esc_html($productlabel); ?>;
  background-image: -webkit-gradient(linear, left top, left bottom, from(<?php echo  esc_html($productlabel); ?>), to(<?php echo  esc_html($productlabel); ?>)) !important;
  background-image: -webkit-linear-gradient(top, <?php echo  esc_html($productlabel); ?>,<?php echo  esc_html($productlabel); ?>) !important;
  background-image: -moz-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
  background-image: -ms-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
  background-image: -o-linear-gradient(top, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
  background-image: linear-gradient(to bottom, <?php echo  esc_html($productlabel); ?>, <?php echo  esc_html($productlabel); ?>) !important;
  }

  .lblue.left-edge::before {
  border-left-color: <?php echo  esc_html($productlebeledge); ?> !important;
  border-top-color: <?php echo  esc_html($productlebeledge); ?> !important;
  }

  .page_breadcrumb, .single_author_box, .archive_bredcrumb_header {
  padding-top: <?php echo esc_html($pagepadding['padding-top']);?>;
  padding-bottom: <?php echo esc_html($pagepadding['padding-bottom']);?>;
  padding-right: <?php echo esc_html($pagepadding['padding-right']);?>;
  padding-left: <?php echo esc_html($pagepadding['padding-left']);?>;
  }

  .main-post-promo, .product-archive-breadcrumb, .tag_breadcrumb_color {
  padding-top: <?php echo esc_html($blogpaddingmain['padding-top']);?>;
  padding-bottom: <?php echo esc_html($blogpaddingmain['padding-bottom']);?>;
  padding-right: <?php echo esc_html($blogpaddingmain['padding-right']);?>;
  padding-left: <?php echo esc_html($blogpaddingmain['padding-left']);?>;
  }

  .photo-video-template {
  padding-top: <?php echo esc_html($photovideopadding['padding-top']);?>;
  padding-bottom: <?php echo esc_html($photovideopadding['padding-bottom']);?>;
  padding-right: <?php echo esc_html($photovideopadding['padding-right']);?>;
  padding-left: <?php echo esc_html($photovideopadding['padding-left']);?>;
  }

  .default-product-template.product-main-header {
  padding-top: <?php echo esc_html($defproductpadding['padding-top']);?>;
  padding-bottom: <?php echo esc_html($defproductpadding['padding-bottom']);?>;
  padding-right: <?php echo esc_html($defproductpadding['padding-right']);?>;
  padding-left: <?php echo esc_html($defproductpadding['padding-left']);?>;
  }

  .prime-product-template.product-main-header {
  padding-top: <?php echo esc_html($primeproductpadding['padding-top']);?>;
  padding-bottom: <?php echo esc_html($primeproductpadding['padding-bottom']);?>;
  padding-right: <?php echo esc_html($primeproductpadding['padding-right']);?>;
  padding-left: <?php echo esc_html($primeproductpadding['padding-left']);?>;
  }

  .default-product-template.product-main-header,
  .default-product-template.product-main-header .single_main_header_products,
  .default-product-template.product-main-header .single_main_header_products h1,
  .default-product-template.product-main-header .single_main_header_products span a, .default-product-template.product-main-header .single_main_header_products span,
  .default-product-template.product-main-header .single_main_header_products a, .default-product-template.product-main-header .single_main_header_products .social-button span {
  color: <?php echo  esc_html($defproducttxt); ?>
  }

  .custombuttonmain.btn {
  background: <?php echo  esc_html($singlebuttonbg); ?> !important;
  border-color: <?php echo  esc_html($singlebuttonbg); ?> !important;
  }


  <?php if ($testimonialbg) { ?>
  .grid-testimonal-promo .testimonial_details {

  background: <?php echo  esc_html($testimonialbg); ?>;
  }

  .arrow-down {
  border-top-color: <?php echo esc_html($testimonialbg); ?>;
  }

<?php } ?>

  .load-mayosis {
  background: linear-gradient(135deg, <?php echo esc_html($loader_gradient['color1'])  ?>, <?php echo esc_html($loader_gradient['color2'])  ?>);
  }

  .loading.reversed li {
  background-color: <?php echo esc_html($loader_gradient['color1'])  ?>;
  }

  /**End Product Style**/
  .bottom_meta p a, .bottom_meta a {
  border-color: <?php echo  esc_html($tagboorderrgb); ?>;
  color: <?php echo esc_html($maintextcolor); ?>;
  }

  .bottom_meta p a:hover, .bottom_meta a:hover {
  background-color: <?php echo esc_html($maintextcolor); ?>;
  }

  .download_cat_filter, .search-btn::after, .download_cat_filter select option {
  background-color: <?php echo esc_html($searchmaincolor); ?>;
  color: <?php echo esc_html($searchaccenttxtcolor); ?>;
  }

  .download_cat_filter:after {
  color: <?php echo esc_html($searchaccenttxtcolor); ?>;
  }

  .product-search-form select {
  color: <?php echo esc_html($searchaccenttxtcolor); ?>;
  }

  .product-search-form .search-fields {
  background-color: <?php echo esc_html($searchmainbgcolor); ?>;
  }

  .product-search-form.style2 input[type="text"] {
  border-color: <?php echo esc_html($searchmainbgcolor); ?>
  }

  .product-search-form input[type="text"] {
  border-color: <?php echo esc_html($searchmainbordercolor); ?>;
  }

  <?php if ($phototemplateview=="fixed"): ?>
  @media (min-width:768px){
  .photo-template-author, .photo--section--image img {
  max-height: 750px;
  }

  .photo--section--image {
  height: 750px;
  }
  }
  @media (max-width: 767px) {
  .photo--section--image{
  height:auto !important;
  }
  .photo-credential{
  margin: 0 -5px;
  }
  .photo-credential {
  min-height: 550px !important;
  }


  }

  @media (min-width:768px){
  .photo--template--author--meta {
  position: absolute;
  }
  }


  .photo-credential {
  min-height: 750px;

  }





  .photo--template--button {
  border-color: <?php echo esc_html($secondarycoloropacity); ?>;
  color: <?php echo esc_html($secondarycolorfifty); ?>;
  }

<?php else : ?>
<?php endif; ?>
  <?php if ($productgridsystem=='two'): ?>
  .edd_downloads_list.edd_download_columns_3 {
  column-count: 3;
  display: block;
  column-gap: 30px;
  }

  @media (min-width: 768px) {
  #edd_download_pagination {
  margin: 60px 0;
  width: 100%;
  text-align: center;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  }
  }

<?php endif; ?>

  <?php if ( $pagebreadposition=='left'): ?>
  h2.page_title_single, .page_breadcrumb .breadcrumb, .page_breadcrumb {
  text-align: left;
  }

  .page_breadcrumb .breadcrumb {
  padding-left: 0;
  }

<?php elseif ( $pagebreadposition=='right'): ?>
  h2.page_title_single, .page_breadcrumb .breadcrumb, .page_breadcrumb {
  text-align: right;
  }

  .page_breadcrumb .breadcrumb {
  padding-right: 0;
  }

<?php endif; ?>


  <?php if ($pagetemplate=='gradient'): ?>
  .page_breadcrumb.mayosis-global-breadcrumb-style,.common-page-breadcrumb.page_breadcrumb {
  background: linear-gradient(<?php echo  esc_html($pageanglegradient); ?>deg, <?php echo esc_html($pagegradientdefault['color1']); ?>, <?php echo esc_html($pagegradientdefault['color2']); ?>);
  }

<?php elseif ($pagetemplate=='image'): ?>

  .page_breadcrumb.mayosis-global-breadcrumb-style,.common-page-breadcrumb.page_breadcrumb {
  background: url(<?php echo  esc_html($pagemainbg); ?>) no-repeat;
  background-size: cover;
  }

<?php elseif ($pagetemplate=='color'): ?>
  .page_breadcrumb.mayosis-global-breadcrumb-style ,.common-page-breadcrumb.page_breadcrumb{
  background: <?php echo  esc_html($pagebgdefault); ?>;
  }

<?php elseif ($pagetemplate=='custom'): ?>

  .page_breadcrumb.mayosis-global-breadcrumb-style,.common-page-breadcrumb.page_breadcrumb {
  <?php echo get_theme_mod( 'page_custom_css' ); ?>
  }

<?php endif;?>


  <?php if ( $pageoverlayimage): ?>
  .page_breadcrumb {
  position: relative;
  z-index: 5;
  }

  .page_breadcrumb:after {
  background: url(<?php echo esc_html($pageoverlayimage); ?>) 100% 100% no-repeat;
  content: "";
  background-size: cover;
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  width: 100%;
  height: 100%;
  z-index: -1;
  display: inline-block;
  }

<?php endif; ?>

  #edd_user_history td,
  table#edd_purchase_receipt_products td {
  border-color: <?php echo esc_html($globalborderopacity); ?> !important;
  }

  .vendor--search--box .search-btn::after {
  color: <?php echo esc_html($headermainsearchopacity); ?> !important;
  }

  <?php if($header_menu_arrow=='hide'){ ?>
  header ul > li.menu-item-has-children > a:after {
  display: none;
  }

<?php } ?>

  <?php if ( $buttontype=='gradient'){?>
  #commentform input[type=submit], .slider_dm_v .carousel-indicators .active, #edd-purchase-button, .edd-submit, input.edd-submit[type="submit"], .dm_register_button, button.fes-cmt-submit-form, .mini_cart .cart_item.edd_checkout a, .photo-image-zoom, a.edd-wl-button.edd-wl-save.edd-wl-action, .wishlist-with-bg .edd-wl-button.edd-wl-action, .edd-wl-create input[type=submit], .edd-wl-item-purchase .edd-add-to-cart-from-wish-list, .carousel-indicators li, #wp-calendar caption, .edd_discount_link, #edd-login-account-wrap a, #edd-new-account-wrap a, .edd-submit.button.blue, .single-cart-button a.btn, .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js, #sidebar-wrapper a#menu-close, .mini_cart .main_widget_checout, #basic-user-avatar-form input[type="submit"], .styleone.btn, .single-product-buttons .multiple_button_v, .button_accent {
  background-image: linear-gradient(90deg, <?php echo esc_html($buttongradienta); ?> 0%, <?php echo esc_html($buttongradientb); ?> 100%) !important;
  border: none;
  padding: 17px 40px;
  }

  .edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js:hover,
  .back-to-top:hover, .single-cart-button a:hover.btn, #edd_profile_editor_submit:hover, #edd_profile_editor_submit, #basic-user-avatar-form input[type="submit"]:hover, .single-news-letter .nl__item--submit:hover, .edd-submit.button.blue:hover, #commentform input[type=submit]:hover, #sidebar-wrapper a#menu-close:hover {
  background-image: linear-gradient(90deg, <?php echo esc_html($buttongradienta); ?> 0%, <?php echo esc_html($buttongradientb); ?> 100%) !important;
  }

<?php } ?>

  <?php if ( $buttonghosttype=='gradient'){?>
  .ghost_button, #edd_user_history th, table#edd_checkout_cart tbody, #edd_checkout_cart input.edd-item-quantity, .rel-info-value p, .button_text,
  .button_ghost.button_text:hover, #fes-save-as-draft, .social-button-bottom {
  border-image: linear-gradient(to right, <?php echo esc_html($ghostgradienta); ?> 0%, <?php echo esc_html($ghostgradientb); ?> 100%);
  border-image-slice: 1;
  }

  .ghost_button:hover, .tag_widget_single ul li a:hover, .mayosis-title-audio .mejs-button > button, .button_text, .button_ghost.button_text:hover {
  background-image: linear-gradient(to right, <?php echo esc_html($ghostgradienta); ?> 0%, <?php echo esc_html($ghostgradientb); ?> 100%);
  }

<?php } ?>

  <?php if ($anchorstyle=="soft"): ?>
  p a, .fes-widget--metabox a {
  background: linear-gradient(to bottom, <?php echo esc_html($primarycoloropacity);?> 0%, <?php echo esc_html($primarycoloropacity);?> 100%);
  background-position: 0% 90%;
  background-repeat: repeat-x;
  background-size: 4px 4px;
  text-decoration: none;
  position: relative;
  transition: top ease 0.5s;
  }

  p a:hover, .fes-widget--metabox a:hover {
  top: -2px;
  background-position: 0% 100%;
  }

<?php elseif ($anchorstyle=="color"): ?>

  p a, .fes-widget--metabox a {
  background: linear-gradient(to bottom, <?php echo esc_html($primarycolor);?> 0%, <?php echo esc_html($primarycolor);?> 100%);
  background-position: 0% 100%;
  background-repeat: repeat-x;
  background-size: 4px 4px;
  text-decoration: none;
  position: relative;
  transition: all 0.3s cubic-bezier(0.2, 0, 0, .8);
  }

  p a:hover, .fes-widget--metabox a:hover {
  background-size: 4px 90%;
  color: <?php echo esc_html($primarytextcolor); ?>;
  }

<?php elseif ($anchorstyle=="water"): ?>
  p a, .fes-widget--metabox a {
  border-bottom: 1px solid<?php echo esc_html($primarycolor);?>;
  text-decoration: none;
  }

  p a:hover, .fes-widget--metabox a:hover {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg id='mayosiswave-link' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:ev='http://www.w3.org/2001/xml-events' viewBox='0 0 20 4'%3E%3Cstyle type='text/css'%3E.mayosiswave{animation:shift .3s linear infinite;}@keyframes shift {from {transform:translateX(0);}to {transform:translateX(-20px);}}%3C/style%3E%3Cpath fill='none' stroke='%23453886' stroke-width='2' class='mayosiswave' d='M0,3.5 c 5,0,5,-3,10,-3 s 5,3,10,3 c 5,0,5,-3,10,-3 s 5,3,10,3'/%3E%3C/svg%3E");
  background-position: bottom;
  background-repeat: repeat-x;
  background-size: 20%;
  border-bottom: 0;
  text-decoration: none;
  }

<?php elseif ($anchorstyle=="ocean"): ?>

  p a, .fes-widget--metabox a {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg id='mayosiswave-link' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:ev='http://www.w3.org/2001/xml-events' viewBox='0 0 20 4'%3E%3Cstyle type='text/css'%3E.mayosiswave{animation:shift .3s linear infinite;}@keyframes shift {from {transform:translateX(0);}to {transform:translateX(-20px);}}%3C/style%3E%3Cpath fill='none' stroke='%23453886' stroke-width='2' class='mayosiswave' d='M0,3.5 c 5,0,5,-3,10,-3 s 5,3,10,3 c 5,0,5,-3,10,-3 s 5,3,10,3'/%3E%3C/svg%3E");
  background-position: bottom;
  background-repeat: repeat-x;
  background-size: 20%;
  border-bottom: 0;
  text-decoration: none;
  }

  p a:hover, .fes-widget--metabox a:hover {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg id='mayosiswave-link' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:ev='http://www.w3.org/2001/xml-events' viewBox='0 0 20 4'%3E%3Cstyle type='text/css'%3E%3C/style%3E%3Cpath fill='none' stroke='%23453886' stroke-width='2' class='mayosiswave' d='M0,3.5 c 5,0,5,-3,10,-3 s 5,3,10,3 c 5,0,5,-3,10,-3 s 5,3,10,3'/%3E%3C/svg%3E");
  background-position: bottom;
  background-repeat: repeat-x;
  background-size: 20%;
  border-bottom: 0;
  text-decoration: none;
  }

<?php endif; ?>
  <?php if ($remove_elementor_default=="one"): ?>
  .elementor-section.elementor-section-boxed > .elementor-container {
  max-width: 1170px;
  }

<?php endif; ?>
  @media (min-width: 1400px) {
  <?php if ($remove_elementor_default=="one"): ?>
  .elementor-section.elementor-section-boxed > .elementor-container,
  .e-con>.e-con-inner{
  max-width: <?php echo esc_html($containerwidthbig);?>;
  }

<?php endif; ?>

  .container {

  max-width: <?php echo esc_html($containerwidthbig);?>;
  }

  footer.main-footer .container {

  max-width: <?php echo esc_html($footerwidthcontainer);?>;

  }
  }
  
  
  @media  (min-width: 1900px){
  
  
   <?php if ($remove_elementor_default=="one"): ?>
  .elementor-section.elementor-section-boxed > .elementor-container,
  .e-con>.e-con-inner{
  max-width: <?php echo esc_html($containerwidthexbig);?>;
  }

<?php endif; ?>
  .container {

  max-width: <?php echo esc_html($containerwidthexbig);?>;
  }
  
  
  }

  <?php if ($photogap=="enable"){ ?>
  @media (min-width: 1200px) {
  .photo--section--image {
  padding-right: 30px;
  }

  .photo--credential--box {
  background: #fff;
  border-radius: 3px;
  }

  .photo-video-box-shadow img {
  border-radius: 3px;
  }
  }
  .photo--section--image-content{
  background:#fff !important;
  }

<?php } ?>
  <?php if ($photobgremove=="disable"){ ?>
  .photo--section--image,
  .photo--section--image-content{
  background: transparent !important;
  }

<?php }?>

  <?php if ($photobgshadow=="enable"){ ?>


  .photo-template-author {
  -webkit-box-shadow: 0px 4px 32px 0px rgba(15, 20, 30, 0.08);
  -moz-box-shadow: 0px 4px 32px 0px rgba(15, 20, 30, 0.08);
  box-shadow: 0px 4px 32px 0px rgba(15, 20, 30, 0.08);
  overflow:hidden;
  }
<?php } elseif ($photobgshadow=="seprate"){ ?>
  .photo-video-box-shadow, .photo--credential--box {
  box-shadow:0 .5rem 1rem rgba(40, 40, 55, 0.25);
  }
  .media-style-subcs-style-a{
  margin-left:calc(var(--bs-gutter-x) * -.5);
  }
<?php } ?>

  <?php if ($photobothequal=="enable"){ ?>
  .photo-template-author .row {
  display: flex;
  flex-wrap: wrap;
  }

<?php } ?>
  <?php if ($thumbvideocontrl=="minimal"){ ?>
  .mayosis-video-url {
  height: 100%;
  }

  .video-inner-box-promo .mejs-controls {
  opacity: 0 !important;
  transition: all 0.5s ease;
  display: none !important;
  visibility: hidden !important;
  }

<?php } ?>


  <?php if ($tag_bg_type== 'gradient'){ ?>
  .tag_breadcrumb_color {
  background: linear-gradient(-135deg,<?php echo esc_html($tag_gradient['color1']); ?> ,<?php echo esc_html($tag_gradient['color2']); ?> );
  }

<?php } elseif ($tag_bg_type=='custom'){ ?>
  .tag_breadcrumb_color {
  <?php echo get_theme_mod( 'tag_custom_css' ); ?>
  }

<?php } ?>
  .mayosis-gradient-bar{
  background: linear-gradient(-135deg,<?php echo esc_html($stickybargradient['color1']); ?> ,<?php echo esc_html($stickybargradient['color2']); ?> );
  }
  .mayosis-custom-bar {
  <?php echo get_theme_mod( 'notification_custom_css' ); ?>
  }

  .mayosis-sticky-cart-gradient#mayosis-sticky-cart-bar{
  background: linear-gradient(-135deg,<?php echo esc_html($stickycartgradient['color1']); ?> ,<?php echo esc_html($stickycartgradient['color2']); ?> );
  }
  .mayosis-sticky-cart-custom#mayosis-sticky-cart-bar {
  <?php echo get_theme_mod( 'stk_cart_custom_css' ); ?>
  }



  <?php if ($audiotemplate=='gradient'): ?>
  .maysosis-audio_hero {
  background: linear-gradient(<?php echo  esc_html($audioanglegradient); ?>deg, <?php echo esc_html($audiogradientdefault['color1']); ?>, <?php echo esc_html($audiogradientdefault['color2']); ?>) !important;
  }

<?php elseif ($audiotemplate=='image'): ?>

  .maysosis-audio_hero {
  background: url(<?php echo  esc_html($audiomainbg); ?>) no-repeat !important;
  background-size: cover !important;
  }

<?php elseif ($audiotemplate=='featured'): ?>
  .maysosis-audio_hero::before {
  background: <?php echo  esc_html($audioovarlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }

<?php elseif ($audiotemplate=='color'): ?>

  .maysosis-audio_hero {
  background: <?php echo  esc_html($audiobgdefault); ?> !important;
  }

<?php elseif ($audiotemplate=='custom'): ?>
  .maysosis-audio_hero {
  <?php echo get_theme_mod( 'audio_custom_css' ); ?>
  }

<?php endif; ?>

  <?php if ($audioblurbg): ?>
  .maysosis-audio_hero .featuredimagebg {
  filter: blur(<?php echo  esc_html($audioblurbg); ?>);
  transform: scale(1.1);
  }

<?php endif; ?>

  <?php if ($audiobgparallax=="yes"): ?>
  .maysosis-audio_hero .featuredimagebg {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

<?php endif; ?>

  <?php if ($msvshebl=="enable"): ?>
  header#main-header{
  box-shadow: <?php echo esc_html($msvhhoriz);?>px <?php echo esc_html($msvhvert);?>px <?php echo esc_html($msvhblur);?>px <?php echo esc_html($msvhsped);?>px <?php echo esc_html($msvhcolor);?>;
  }
<?php endif; ?>

  @media (min-width:768px){
  header.sticky,.header-master .to-flex-row,.main-header
  .maxcollapse,.maxcollapse-icon, .maxcollapse-submit{
  height:<?php echo esc_html($mheaderheight);?>;
  }
  .header-master .to-flex-row {
  padding-top: <?php echo  esc_html($mainheaderpadding['padding-top']); ?>;
  padding-right: <?php echo  esc_html($mainheaderpadding['padding-right']); ?>;
  padding-bottom: <?php echo  esc_html($mainheaderpadding['padding-bottom']); ?>;
  padding-left: <?php echo  esc_html($mainheaderpadding['padding-left']); ?>;
  }
  .footer-widget.mx-one{
  width:<?php echo esc_html($column_one_width); ?>%;
  }
  .footer-widget.mx-two{
  width:<?php echo esc_html($column_two_width); ?>%;
  }
  .footer-widget.mx-three{
  width:<?php echo esc_html($column_three_width); ?>%;
  }
  .footer-widget.mx-four{
  width:<?php echo esc_html($column_four_width); ?>%;
  }
  .footer-widget.mx-five{
  width:<?php echo esc_html($column_five_width); ?>%;
  }
  .footer-widget.mx-six{
  width:<?php echo esc_html($column_six_width); ?>%;
  }
  }

 body.sp-night-mode-on .product-archive-breadcrumb,
 body.sp-night-mode-on .pr_breadcrumb_dark_def{
  background: <?php echo  esc_html($productarchivebgdark); ?> !important;
  }

 body.sp-night-mode-on .default-product-template.product-main-header {
  background: <?php echo  esc_html($productbgdark); ?> !important;
  }
  
  body.sp-night-mode-on body,
  body.sp-night-mode-on .user--dasboard--box,
  body.sp-night-mode-on .user-dashboard-page .dasboard-tab{
  background-color: <?php echo esc_html($darkbg);?> !important;
  color:<?php echo esc_html($darktxt);?> !important;
  }

 body.sp-night-mode-on body, 
 body.sp-night-mode-on h1, 
 body.sp-night-mode-on h2, 
 body.sp-night-mode-on h3, 
 body.sp-night-mode-on h4,
 body.sp-night-mode-on h5,
 body.sp-night-mode-on h6,
 body.sp-night-mode-on a, 
 body.sp-night-mode-on p,
 body.sp-night-mode-on span,
 body.sp-night-mode-on label,
 body.sp-night-mode-on .mayosis-play--button-video:focus,
 body.sp-night-mode-on .mayosis-play--button-video,
 body.sp-night-mode-on .mayosel-select,
 body.sp-night-mode-on .title--button--box .btn.title--box--btn.transparent,
 body.sp-night-mode-on #fes-vendor-store-link,
 body.sp-night-mode-on .msv-mobile-stiky-bar ul li button{
 
  color:<?php echo esc_html($darktxt);?>;
  
  }


  body.sp-night-mode-on header,
  body.sp-night-mode-on .header-master,
  body.sp-night-mode-on #mobileheader,
  body.sp-night-mode-on #mayosis-sidebar,
  body.sp-night-mode-on #mayosis-sidebar .sidebar-fixed,
  body.sp-night-mode-on #mayosis-sidebar .mayosis-sidebar-header,
  body.sp-night-mode-on #mayosis-sidebar .social-icon-sidebar-header,
  body.sp-night-mode-on .extended-dasboard-tab,
  body.sp-night-mode-on .vendor-dasboard-template-main .fes_dashboard_menu{
  background: <?php echo esc_html($darkheader);?> !important;
  color: <?php echo esc_html($darkheadertxt);?> !important;
  }
   body.sp-night-mode-on .extended-dasboard-tab,
   body.sp-night-mode-on .vendor-dasboard-template-main .fes_dashboard_menu{
      box-shadow: 0px 1px 1px 0px rgb(0 0 0 / 14%), 0px 2px 1px -1px rgb(0 0 0 / 12%), 0px 1px 3px 0px rgb(0 0 0 / 20%);
      }


  body.sp-night-mode-on header .nav-style-megamenu>li.nav-item .nav-link,
  body.sp-night-mode-on header a,
  body.sp-night-mode-on header i,
  body.sp-night-mode-on #mayosis-sidebar .social-icon-sidebar-header a,
  body.sp-night-mode-on #mayosis-sidebar #mayosis-sidemenu ul ul li a,
  body.sp-night-mode-on .mayosel-select,
  body.sp-night-mode-on #edd_profile_editor_form label,
  body.sp-night-mode-on a.mobile-cart-button{
  color: <?php echo esc_html($darkheadertxt);?> !important;
  }

    body.sp-night-mode-on .burger span, 
    body.sp-night-mode-on .burger span::before, 
    body.sp-night-mode-on .burger span::after,
    body.sp-night-mode-on .burger.clicked span:before,
    body.sp-night-mode-on .burger.clicked span:after{
     background: <?php echo esc_html($darkheadertxt);?> !important;
    }
  body.sp-night-mode-on .has_mayosis_dark_bg,
  body.sp-night-mode-on .bottom-post-footer-widget,
  body.sp-night-mode-on .nav-style-megamenu>li.nav-item .dropdown-menu h5.xoopic-mg-col-title:after,
  body.sp-night-mode-on .has_mayosis_elementor_inner_bg.has_mayosis_dark_bg .elementor-widget-wrap.elementor-element-populated,
  body.sp-night-mode-on .fes-form .fes-variations-list-multiple .fes-single-variation,
  body.sp-night-mode-on .product--flex--fes:nth-of-type(even){
  background: <?php echo esc_html($darkpbgcolor);?> !important;
  color:<?php echo esc_html($darkptxtcolor);?> !important;
  }

  body.sp-night-mode-on .has_mayosis_dark_bg a,
  body.sp-night-mode-on .has_mayosis_dark_bg p,
  body.sp-night-mode-on .has_mayosis_dark_bg h1,
  body.sp-night-mode-on .has_mayosis_dark_bg h2,
  body.sp-night-mode-on .has_mayosis_dark_bg h3,
  body.sp-night-mode-on .has_mayosis_dark_bg h4,
  body.sp-night-mode-on .has_mayosis_dark_bg h5,
  body.sp-night-mode-on .has_mayosis_dark_bg h6,
  body.sp-night-mode-on .has_mayosis_dark_bg span,
  body.sp-night-mode-on .has_mayosis_dark_bg small,
  body.sp-night-mode-on .has_mayosis_dark_bg div,
  body.sp-night-mode-on .has_mayosis_dark_bg td,
  body.sp-night-mode-on .has_mayosis_dark_bg th,
  body.sp-night-mode-on .has_mayosis_dark_bg legend,
  body.sp-night-mode-on .has_mayosis_dark_bg label,
  body.sp-night-mode-on .comments-area,
  body.sp-night-mode-on .comments-area a,
  body.sp-night-mode-on .comments-area h3,
  body.sp-night-mode-on .edd-login-remember span,
  body.sp-night-mode-on .edd-lost-password a,
  body.sp-night-mode-on .vendor-dasboard-template-main .fes-form.fes-submission-form-div,
  body.sp-night-mode-on .vendor-dasboard-template-main .fes-form.fes-submission-form-div label,
  body.sp-night-mode-on .vendor-dasboard-template-main .fes-form.fes-submission-form-div legend,
  body.sp-night-mode-on .vendor-dasboard-template-main .fes-form.fes-submission-form-div span,
  body.sp-night-mode-on .select2-container--default .select2-selection--multiple .select2-selection__choice{
  color:<?php echo esc_html($darkptxtcolor);?> !important;
  }

  body.sp-night-mode-on .has_mayosis_dark_bg .button-fill-color,
  body.sp-night-mode-on .has_mayosis_dark_bg button,
  body.sp-night-mode-on .select2-container--default .select2-selection--multiple .select2-selection__choice{
  background: <?php echo esc_html($darkpbgcolor);?> !important;
  border-color: <?php echo esc_html($darkpbgcolor);?> !important;
  }


  body.sp-night-mode-on .has_mayosis_dark_alt_bg,
  body.sp-night-mode-on .page_breadcrumb.mayosis-global-breadcrumb-style,
  body.sp-night-mode-on  .common-page-breadcrumb.page_breadcrumb,
  body.sp-night-mode-on .has_mayosis_elementor_inner_bg.has_mayosis_dark_alt_bg .elementor-widget-wrap.elementor-element-populated,
  body.sp-night-mode-on .has_mayosis_dark_bg .elementor-widget-mayosis-counter .elementor-widget-container,
  body.sp-night-mode-on .grid-testimonal-promo .testimonial_details{
  background: <?php echo esc_html($darkalbgcolor);?> !important;
  color: <?php echo esc_html($darkaltxtcolor); ?> !important;
  }
  body.sp-night-mode-on .grid-testimonal-promo .arrow-down{
  border-top-color: <?php echo esc_html($darkalbgcolor);?> !important;
  }
  

  body.sp-night-mode-on .has_mayosis_dark_alt_bg a,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg p,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h1,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h2,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h3,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h4,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h5,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg h6,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg span,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg div{
  color:<?php echo esc_html($darkaltxtcolor); ?> !important;
  }

  body.sp-night-mode-on .has_mayosis_dark_alt_bg .button-fill-color,
  body.sp-night-mode-on .has_mayosis_dark_alt_bg button{
  background: <?php echo esc_html($darkalbgcolor);?> !important;
  border-color: <?php echo esc_html($darkalbgcolor);?> !important;
  }
  body.sp-night-mode-on .product--flex--fes:nth-of-type(odd),
  body.sp-night-mode-on .product--flex--fes:nth-of-type(even),
   body.sp-night-mode-on .button-fill-color,
   body.sp-night-mode-on .title--box--btn{
   border-color: <?php echo esc_html($darkalbgcolor);?> !important;
  }
  body.sp-night-mode-on .theme--sidebar--widget,
  body.sp-night-mode-on .subscribe-box-photo,
  body.sp-night-mode-on .sidebar-theme.theme--sidebar--widget,
  body.sp-night-mode-on .theme--sidebar--widget .sidebar-theme,
  body.sp-night-mode-on #grid-cat-edd a.cat--grid--stl-2,
  body.sp-night-mode-on .fes--author--block-style-2,
  body.sp-night-mode-on .products-tab-list li button,
  body.sp-night-mode-on .blog-box-stl2,
  body.sp-night-mode-on .main-post-promo.main-blog-promo,
  body.sp-night-mode-on .single_author_box,
  body.sp-night-mode-on .archive_bredcrumb_header,
  body.sp-night-mode-on .mayosis-wave-catgeory-box-msv #awp-wrapper .awp-player-thumb-wrapper,
  body.sp-night-mode-on .mayosis-wave-catgeory-box-msv #awp-wrapper .awp-player-holder,
  body.sp-night-mode-on #edd_profile_billing_address_label,
  body.sp-night-mode-on #edd_profile_name_label, #edd_profile_password_label,
  body.sp-night-mode-on #fes-comments-table tr.heading_tr,
  body.sp-night-mode-on .mayosis-v-box,
  body.sp-night-mode-on .vendor-dasboard-template-main #fes-comments-table,
  body.sp-night-mode-on #fes-comments-table tr,
  body.sp-night-mode-on nav.fes-vendor-menu ul li.active,
  body.sp-night-mode-on #msbmovaccordion .accordion-item,
  body.sp-night-mode-on .msv-mobile-stiky-bar ul,
  body.sp-night-mode-on #mayosis-sidemenu > ul > li.active > a,
  body.sp-night-mode-on .select2-dropdown,
  body.sp-night-mode-on .product--flex--fes:nth-of-type(odd),
  body.sp-night-mode-on .button-fill-color,
  body.sp-night-mode-on .title--box--btn,
  body.sp-night-mode-on .product-main-header .social-button a i{
  background: <?php echo esc_html($darkalbgcolor);?> !important;
  color: <?php echo esc_html($darkaltxtcolor); ?> !important;
  }
    
   body.sp-night-mode-on .cat-carousel-ms-ls-v #carousel-category-msv-elmentor #grid-cat-edd a.cat--grid--stl-2 svg path{
   stroke: <?php echo esc_html($darkaltxtcolor); ?>;
   }
  body.sp-night-mode-on #grid-cat-edd a.cat--grid--stl-2:hover,
  body.sp-night-mode-on .select2-container--default .select2-results__option[aria-selected=true],
  body.sp-night-mode-on nav.fes-vendor-menu ul li:hover{
   background: <?php echo esc_html($darksecbgcolor);?> !important;
  color: <?php echo esc_html($darksectxtcolor); ?> !important;
  }

  body.sp-night-mode-on .xoopic-m-menu .nav-style-megamenu>li.nav-item .dropdown-menu .submenu-box{
  background: <?php echo esc_html($darkalbgcolor);?> !important;
  color: <?php echo esc_html($darkaltxtcolor); ?> !important;
  }

  body.sp-night-mode-on .nav-style-megamenu>li.nav-item .dropdown-menu .xoopic-mg-col-title,
  body.sp-night-mode-on #mayosis-sidebar #mayosis-sidemenu > ul > li > a,
  body.sp-night-mode-on .theme--sidebar--widget span,
  body.sp-night-mode-on .theme--sidebar--widget p,
  body.sp-night-mode-on .theme--sidebar--widget .rel-info-tag,
  body.sp-night-mode-on .main-post-promo h1.single-post-title,
  body.sp-night-mode-on .main-post-promo .single--post--content a,
  body.sp-night-mode-on .main-post-promo .single-user-info ul li.datearchive, 
  body.sp-night-mode-on .main-post-promo .single-post-breadcrumbs .breadcrumb a,
  body.sp-night-mode-on .main-post-promo .single-user-info ul li a,
  body.sp-night-mode-on .main-post-promo.main-blog-promo h1,
  body.sp-night-mode-on .main-post-promo .breadcrumb a,
  body.sp-night-mode-on .main-post-promo .breadcrumb span,
  body.sp-night-mode-on .main-post-promo .blog--layout--contents a,
  body.sp-night-mode-on .main-post-promo .datearchive,
  body.sp-night-mode-on .main-post-promo .blog--layout--contents,
  body.sp-night-mode-on .single--post--header--content .toolspan,
  body.sp-night-mode-on .mayosis-v-box h4,
  body.sp-night-mode-on #fes-comments-table tr td,
  body.sp-night-mode-on nav.fes-vendor-menu ul li.active a,
  body.sp-night-mode-on #msbmovaccordion .accordion-button,
  body.sp-night-mode-on #msbmovaccordion .accordion-button:not(.collapsed){
  color: <?php echo esc_html($darkaltxtcolor); ?> !important;
  }

 

  body.sp-night-mode-on .has_mayosis_dark_sec_bg a,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg p,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h1,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h2,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h3,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h4,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h5,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg h6,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg span,
  body.sp-night-mode-on .has_mayosis_dark_sec_bg div,
  body.sp-night-mode-on .msv_fixed_cart_sidebar .cart-close{
  color:<?php echo esc_html($darksectxtcolor); ?> !important;
  }
  
body.sp-night-mode-on .has_mayosis_dark_sec_bg,
  body.sp-night-mode-on .widget-title,
  body.sp-night-mode-on .post-tabs .nav-pills > li.active > a,
  body.sp-night-mode-on .post-tabs .nav-pills > li.active > a:focus,
  body.sp-night-mode-on .post-tabs .nav-pills > li.active > a:hover,
  body.sp-night-mode-on .sidebar-search #icon-addon,
  body.sp-night-mode-on .theme--sidebar--widget .widget-title,
  body.sp-night-mode-on .widget_block .wp-block-group__inner-container h2,
  body.sp-night-mode-on blockquote,
  body.sp-night-mode-on .has_mayosis_elementor_inner_bg.has_mayosis_dark_sec_bg .elementor-widget-wrap.elementor-element-populated,
  body.sp-night-mode-on .products-tab-list li button:hover,
  body.sp-night-mode-on .products-tab-list li button.active,
  body.sp-night-mode-on .back-to-top,
  body.sp-night-mode-on .mayosis-wave-catgeory-box-msv #awp-wrapper .awp-playlist-thumb-style:before,
  body.sp-night-mode-on .mayosis-wave-catgeory-box-msv #awp-wrapper .awp-contr-btn i,
  body.sp-night-mode-on .bottom-post-footer-widget,
  body.sp-night-mode-on .post-view-style,
  body.sp-night-mode-on .post-promo-box,
  body.sp-night-mode-on .author_meta_single,
  body.sp-night-mode-on .single_author_post,
  body.sp-night-mode-on .sidebar-product-widget,
  body.sp-night-mode-on .single-blog-widget,
  body.sp-night-mode-on artist-items,
  body.sp-night-mode-on blockquote,
  body.sp-night-mode-on table,
  body.sp-night-mode-on pre,
  body.sp-night-mode-on .fes-fields textarea,
  body.sp-night-mode-on .jssortside,
  body.sp-night-mode-on #mayosis_side,
  body.sp-night-mode-on .photo--price--block a.edd-wl-action.edd-wl-button, 
  body.sp-night-mode-on .photo--price--block .photo_edd_el_button,
  body.sp-night-mode-on .mayosis-account-information,
  body.sp-night-mode-on .swiper-pagination.swiper-pagination-fraction,
  body.sp-night-mode-on .swiper-slide-zoom,
  body.sp-night-mode-on .salad-d-a-main,
  body.sp-night-mode-on .mayosis-woo-related-products,
  body.sp-night-mode-on .woo-login-condensed-div,
  body.sp-night-mode-on .mayosis-dokan-header .single--author--content,
  body.sp-night-mode-on .single--author--content,
  body.sp-night-mode-on #marketking_vendor_tab_reviews .review,
  body.sp-night-mode-on .cart-collaterals .cart_totals,
  body.sp-night-mode-on .woocommerce-mini-cart__buttons.buttons .button.wc-forward,
  body.sp-night-mode-on .post-promo-box.grid_dm .overlay_content_center a{
  
  background:<?php echo esc_html($darksecbgcolor);?> !important;
  color:<?php echo esc_html($darksectxtcolor);?> !important;

  }
    body.sp-night-mode-on #mayosis-sidebar #mayosis-sidemenu > ul > li > a:hover,
  body.sp-night-mode-on #mayosis-sidebar #mayosis-sidemenu ul li.active>a,
   body.sp-night-mode-on #mayosis-sidebar #mayosis-sidemenu ul li.active>a span{
   color:<?php echo esc_html($darksecbgcolor);?> !important;
   background:transparent !important;
  }
   body.sp-night-mode-on .back-to-top{
   border-color:<?php echo esc_html($darksecbgcolor);?> !important;
   }

  body.sp-night-mode-on .footer-sidebar .widget-title{
  background:transparent !important;
  }
  
  body.sp-night-mode-on .fes-vendor-dashboard-wrap div.fes-form .fes-el .fes-fields textarea,
  body.sp-night-mode-on .fes-vendor-dashboard-wrap div.fes-form .fes-el .fes-fields input[type=text],
  body.sp-night-mode-on #fes-vendor-dashboard .acf-repeater .acf-row-handle.remove,
  body.sp-night-mode-on #fes-vendor-dashboard .acf-repeater .acf-row-handle.order,
  body.sp-night-mode-on .acf-field input[type="text"],
  body.sp-night-mode-on .acf-field input[type="password"],
  body.sp-night-mode-on .acf-field input[type="date"],
  body.sp-night-mode-on .acf-field input[type="datetime"],
  body.sp-night-mode-on .acf-field input[type="datetime-local"],
  body.sp-night-mode-on .acf-field input[type="email"],
  body.sp-night-mode-on .acf-field input[type="month"],
  body.sp-night-mode-on .acf-field input[type="number"],
  body.sp-night-mode-on .acf-field input[type="search"],
  body.sp-night-mode-on .acf-field input[type="tel"],
  body.sp-night-mode-on .acf-field input[type="time"],
  body.sp-night-mode-on .acf-field input[type="url"],
  body.sp-night-mode-on .acf-field input[type="week"],
  body.sp-night-mode-on .acf-field textarea,
  body.sp-night-mode-on .acf-field select,
  body.sp-night-mode-on input[type="text"],
  body.sp-night-mode-on input[type="email"],
  body.sp-night-mode-on input[type="password"],
  body.sp-night-mode-on .solid-input input,
  body.sp-night-mode-on textarea,
  body.sp-night-mode-on #edd_profile_editor_form .mayosel-select,
  body.sp-night-mode-on #edd_checkout_form_wrap .mayosel-select,
  body.sp-night-mode-on p.comment-form-comment textarea,
  body.sp-night-mode-on #edd_login_form .edd-input,
  body.sp-night-mode-on #edd_register_form .edd-input,
  body.sp-night-mode-on #edd_checkout_form_wrap input.edd-input,
  body.sp-night-mode-on #edd_checkout_form_wrap textarea.edd-input,
  body.sp-night-mode-on #edd_checkout_form_wrap select.edd-select,
  body.sp-night-mode-on #edd_profile_editor_form input:not([type="submit"]),
  body.sp-night-mode-on #edd_profile_editor_form select,
  body.sp-night-mode-on #contact textarea,
  body.sp-night-mode-on .wpcf7-form-control-wrap textarea,
  body.sp-night-mode-on fes-pagination a.page-numbers,
  body.sp-night-mode-on .fes-pagination span.page-numbers,
  body.sp-night-mode-on .fes-fields input[type=text],
  body.sp-night-mode-on .fes-fields input[type=email],
  body.sp-night-mode-on .fes-fields input[type=password],
  body.sp-night-mode-on .fes-fields textarea,
  body.sp-night-mode-on .fes-fields input[type=url],
  body.sp-night-mode-on .fes-vendor-comment-respond-form textarea,
  body.sp-night-mode-on .fes-fields select,
  body.sp-night-mode-on textarea#edd-reviews-reply,
  body.sp-night-mode-on .vendor--search--box input[type="text"],
  body.sp-night-mode-on .download_category .select2-container--default .select2-selection--single,
  body.sp-night-mode-on .download_category .select2-container,
  body.sp-night-mode-on .fes-fields .mayosel-select,
  body.sp-night-mode-on #edd_checkout_form_wrap .mayosel-select .option:hover,
  body.sp-night-mode-on #edd_checkout_form_wrap .mayosel-select .option.focus,
  body.sp-night-mode-on #edd_profile_editor_form .mayosel-select .option:hover,
  body.sp-night-mode-on #edd_profile_editor_form .mayosel-select .option.focus,
  body.sp-night-mode-on #edd_profile_editor_form .mayosel-select,
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields input[type=text],
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields input[type=password],
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields input[type=email],
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields input[type=url],
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields input[type=number],
  body.sp-night-mode-on div.fes-form .fes-el .fes-fields textarea,
  body.sp-night-mode-on extarea#edd-reviews-review,
  body.sp-night-mode-on .select2-container--default .select2-selection--multiple,
  body.sp-night-mode-on .acf-gallery .acf-gallery-main,
  body.sp-night-mode-on .acf-gallery .acf-gallery-toolbar{
  background-color: <?php echo esc_html($darkinputbgcolor); ?> !important;
  border-color: <?php echo esc_html($darkinputbordercolor); ?> !important;
  color: <?php echo esc_html($darkinputtxtcolor); ?> !important;
  }
  
  body.sp-night-mode-on .select2Buttons li a,
  body.sp-night-mode-on #fes-save-as-draft,
  body.sp-night-mode-on .tag_widget_single ul li a,
  body.sp-night-mode-on .fes--widget--author--style1 .ghost--buttons-fx a, 
  body.sp-night-mode-on .fes--widget--author--style1 .solid--buttons-fx a{
  border-color: <?php echo esc_html($darkinputbordercolor); ?> !important;
  color: <?php echo esc_html($darkinputtxtcolor); ?> !important;
  }
  
  body.sp-night-mode-on input[type="text"]::placeholder,
body.sp-night-mode-on input[type="password"]::placeholder,
body.sp-night-mode-on input[type="date"]::placeholder,
body.sp-night-mode-on input[type="datetime"]::placeholder,
body.sp-night-mode-on input[type="datetime-local"]::placeholder,
body.sp-night-mode-on input[type="email"]::placeholder,
body.sp-night-mode-on input[type="month"]::placeholder,
body.sp-night-mode-on input[type="number"]::placeholder,
body.sp-night-mode-on input[type="search"]::placeholder,
body.sp-night-mode-on input[type="tel"]::placeholder,
body.sp-night-mode-on input[type="time"]::placeholder,
body.sp-night-mode-on input[type="url"]::placeholder,
body.sp-night-mode-on input[type="week"]::placeholder,
body.sp-night-mode-on textarea::placeholder,
body.sp-night-mode-on .sidebar-theme ul li a,
body.sp-night-mode-on .fes-widget--metabox a{
 color: <?php echo esc_html($darkinputtxtcolor); ?> !important;
}


  body.sp-night-mode-on footer.main-footer{
  background: <?php echo esc_html($darkfooter); ?> !important;
  color: <?php echo esc_html($darkfootertxt); ?> !important;
  }

  body.sp-night-mode-on footer.main-footer a,
  body.sp-night-mode-on footer.main-footer p,
  body.sp-night-mode-on footer.main-footer h1,
  body.sp-night-mode-on footer.main-footer h2,
  body.sp-night-mode-on footer.main-footer h3,
  body.sp-night-mode-on footer.main-footerh4,
  body.sp-night-mode-on footer.main-footer h5,
  body.sp-night-mode-on footer.main-footer h6,
  body.sp-night-mode-on footer.main-footer span,
  body.sp-night-mode-on footer.main-footer div{
  color:<?php echo esc_html($darkfootertxt); ?> !important;
  }
  
  
  
  
  
  
    .mayosis-woo-single-style-one {
  padding-top: <?php echo esc_html($woodefproductpadding['padding-top']);?>;
  padding-bottom: <?php echo esc_html($woodefproductpadding['padding-bottom']);?>;
  padding-right: <?php echo esc_html($woodefproductpadding['padding-right']);?>;
  padding-left: <?php echo esc_html($woodefproductpadding['padding-left']);?>;
  }
  
  <?php if ($wooproducttemplate=='gradient'): ?>
  .mayosis-woo-single-style-one {
  background: linear-gradient(<?php echo  esc_html($wooproductanglegradient); ?>deg, <?php echo esc_html($wooproductgradientdefault['color1']); ?>, <?php echo esc_html($wooproductgradientdefault['color2']); ?>) !important;
  }

<?php elseif ($wooproducttemplate=='image'): ?>

  .mayosis-woo-single-style-one {
  background: url(<?php echo  esc_html($wooproductmainbg); ?>) no-repeat !important;
  background-size: cover !important;
  }

<?php elseif ($wooproducttemplate=='featured'): ?>
  .mayosis-woo-single-style-one:before {
  background: <?php echo  esc_html($wooproductovarlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }

<?php elseif ($wooproducttemplate=='color'): ?>

  .mayosis-woo-single-style-one {
  background: <?php echo  esc_html($woosdefcolor); ?> !important;
  }

<?php elseif ($wooproducttemplate=='custom'): ?>
  .mayosis-woo-single-style-one {
  <?php echo get_theme_mod( 'woo_product_custom_css' ); ?>
  }

<?php endif; ?>

  <?php if ($wooproductblurbg): ?>
  .mayosis-woo-single-style-one .featuredimagebg {
  filter: blur(<?php echo  esc_html($wooproductblurbg); ?>);
  transform: scale(1.1);
  }

<?php endif; ?>

  <?php if ($wooproductbgparallax=="yes"): ?>
  .mayosis-woo-single-style-one .featuredimagebg {
  transform: translateX(1px) scale(1.1);
  background-attachment: fixed !important;
  }

<?php endif; ?>
    <?php if ($wooproductmainoverlay): ?>
  .mayosis-woo-single-style-one::after {
  background: url(<?php echo  esc_html($wooproductmainoverlay); ?>) 100% 100% no-repeat;
  }
  
   .mayosis-woo-single-style-one::after{
    content: "";
    background-size: contain !important;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    height: 100%;
    z-index: 5;
    display: inline-block !important;
}

<?php endif; ?>
  
    .mayosis-woo-single-style-one,
  .mayosis-woo-single-style-one .mayosis-woo-single-hero,
  .mayosis-woo-single-style-one .mayosis-woo-single-hero h1,
  .mayosis-woo-single-style-one .mayosis-woo-single-hero span a,
  .mayosis-woo-single-style-one .mayosis-woo-single-hero span,
 .mayosis-woo-single-style-one .mayosis-woo-single-hero a, .mayosis-woo-single-style-one .mayosis-woo-single-hero .social-button span,
 .mayosis-woo-single-style-one .product_title,
 .mayosis-woo-single-style-one .woocommerce-breadcrumb, .mayosis-woo-single-style-one .woocommerce-breadcrumb a, .mayosis-woo-single-style-one .woocommerce-breadcrumb span,
 .woo-prime-product-template,
 .woo-prime-product-template h1,
 .woo-prime-product-template span,
 .woo-prime-product-template a{
  color: <?php echo  esc_html($woodefproducttxt); ?>
  }
  
  
    <?php if ($wooarchivebgtype=='gradient'): ?>
  .woo-archive-breadcrumb-gradient {
  background: linear-gradient(-135deg, <?php echo esc_html($wooarchivegradientdefault['color1']); ?>, <?php echo esc_html($wooarchivegradientdefault['color2']); ?>) !important;
  }


<?php elseif ($wooarchivebgtype=='featured'): ?>

  .woo-archive-breadcrumb-featured::after {
  background: <?php echo  esc_html($wooarchiveovarlaymain); ?> !important;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
  z-index: 5;
  position: absolute;
  display: inline-block !important;
  }
<?php if ($wooarchivebgparallax=="yes"): ?>
  .woo-archive-breadcrumb-featured {
  background-attachment: fixed !important;
  }
  
 
<?php endif; ?>

<?php elseif ($wooarchivebgtype=='custom'): ?>
  .woo-archive-breadcrumb-custom {
  <?php echo get_theme_mod( 'woo_archive_custom_css' ); ?>
  }

<?php endif; ?>


<?php if ($csd_bg_style_df == 'stl1'){?>
body {
position:relative;
}
body:after,
body:before {
    width: 230px;
    height: 230px;
    border-radius: 100%;
    position: fixed;

}
body:after {
    content: '';
    top: 44.8%;
    right: 27%;
    background-color: <?php echo esc_html($csd_bg_style_clr1);?>;
    -webkit-filter: blur(150px);
    -o-filter: blur(150px);
    filter: blur(150px)
}

body:before {
    content: '';
        top: 10.5%;
    left: 17.9%;
    background-color: <?php echo esc_html($csd_bg_style_clr2);?>;
    -webkit-filter: blur(160px);
    -o-filter: blur(160px);
    filter: blur(160px)
}
<?php } ?>


<?php if ($body_custom_css){?>
body{
<?php echo $body_custom_css; ?>
}
<?php } ?>

  
  <?php

  $output = ob_get_clean();

  if ( ! $output ) {
    return;
  }

  $css  = '<style id="mayosis-custom-css" type="text/css">';
  $css .= $output;
  $css .= '</style>';

  echo mayosis_compress_css_lines( $css );
}

add_action('wp_head', 'mayosis_dynamic_css');
?>