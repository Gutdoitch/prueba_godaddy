<?php
$mainlogomain= get_theme_mod( 'main_logo', get_template_directory_uri().'/images/Mayosis_Color_Logo.svg' );
$stickylogomain= get_theme_mod( 'sticky_logo');
$mobilelogo= get_theme_mod( 'mobile-logo-image');
$logoproperty= get_theme_mod( 'logo_property','width');
$logowidth= get_theme_mod( 'logo-width','');
$logoheight= get_theme_mod( 'logo-height','');
$logopropertymob= get_theme_mod( 'logo_property_mobile','width');
$logowidthmob= get_theme_mod( 'logo-width-mobile','');
$logoheightmob= get_theme_mod( 'logo-height-mobile','');
$darklogo= get_theme_mod( 'dark_logo','disable' );
$darklogoimg= get_theme_mod( 'dark_logo_img' );
$customlogoUrl= get_theme_mod( 'logo-cs-link-m' );
if($customlogoUrl){
     $logourl= $customlogoUrl;
} else{
    $logourl= home_url( '/' );
}
?>

<?php if ($mainlogomain){ ?>

        <?php if ($stickylogomain): ?>
        <div class="site-logo sticky-enabled">
        <?php else : ?>
        <div class="site-logo">
        <?php endif; ?>

              <a href="<?php echo esc_url( $logourl ); ?>" class="logo_box">
                    <?php if($darklogo=="enable"){?>
                   <img src="<?php echo esc_url($mainlogomain);  ?>" class="img-responsive main-logo light-version-desktop-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logoproperty=="width"){ ?>style="width:<?php echo esc_html($logowidth); ?>;"<?php } ?>  <?php if ($logoproperty=="height"){ ?>style="height:<?php echo esc_html($logoheight); ?>;"<?php } ?>/>
                   <img src="<?php echo esc_url($darklogoimg);  ?>" class="img-responsive main-logo dark-version-desktop-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logoproperty=="width"){ ?>style="width:<?php echo esc_html($logowidth); ?>;"<?php } ?>  <?php if ($logoproperty=="height"){ ?>style="height:<?php echo esc_html($logoheight); ?>;"<?php } ?>/>
                        
                       
                        <?php } else { ?>
                         <img src="<?php echo esc_url($mainlogomain);  ?>" class="img-responsive main-logo d-none d-lg-block" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logoproperty=="width"){ ?>style="width:<?php echo esc_html($logowidth); ?>;"<?php } ?>  <?php if ($logoproperty=="height"){ ?>style="height:<?php echo esc_html($logoheight); ?>;"<?php } ?>/>
                        <?php } ?>
                  
                 
                  
                  <?php if($mobilelogo){ ?>
                     <?php if($darklogo=="enable"){?>
                   <img src="<?php echo esc_url($mobilelogo);  ?>" class="img-responsive main-logo light-version-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                   <img src="<?php echo esc_url($darklogoimg);  ?>" class="img-responsive main-logo dark-version-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                        
                       
                        <?php } else { ?>
                         <img src="<?php echo esc_url($mobilelogo);  ?>" class="img-responsive main-logo d-block d-lg-none" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                        <?php } ?>
                 
                  <?php } else  { ?>
                  
                  <?php if($darklogo=="enable"){?>
                   <img src="<?php echo esc_url($mainlogomain);  ?>" class="img-responsive main-logo light-version-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                   <img src="<?php echo esc_url($darklogoimg);  ?>" class="img-responsive main-logo dark-version-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                        
                       
                        <?php } else { ?>
                         <img src="<?php echo esc_url($mainlogomain);  ?>" class="img-responsive main-logo d-block d-lg-none" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>" <?php if ($logopropertymob=="width"){ ?>style="width:<?php echo esc_html($logowidthmob); ?>;"<?php } ?>  <?php if ($logopropertymob=="height"){ ?>style="height:<?php echo esc_html($logoheightmob); ?>;"<?php } ?>/>
                        <?php } ?>
                        
                 
                  <?php } ?>
						<?php if ($stickylogomain): ?>
						<img src="<?php echo esc_url($stickylogomain); ?>" class="img-responsive sticky-logo" alt="<?php esc_html( 'Logo', 'mayosis' ); ?>"  <?php if ($logoproperty=="width"){ ?>style="width:<?php echo esc_html($logowidth); ?>;"<?php } ?>  <?php if ($logoproperty=="height"){ ?>style="height:<?php echo esc_html($logoheight); ?>;"<?php } ?>/>
						 <?php endif; ?>
						 
						 </a>
						 
</div>
<?php } else { ?>
    <a href="<?php echo esc_url( $logourl ); ?>">
    <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" class="img-responsive main-logo" alt="<?php esc_html__( 'Logo', 'mayosis' ); ?>"/>
    </a>
<?php } ?>

