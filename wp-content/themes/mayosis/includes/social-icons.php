  <?php
            $facebookurl= get_theme_mod('facebook_url','https://facebook.com/'); 
            $twitterurl= get_theme_mod('twitter_url','https://twitter.com/'); 
            $instagramurl= get_theme_mod('instagram_url','https://instagram.com/');
            $pinteresturl= get_theme_mod('pinterest_url','https://pinterest.com/'); 
            $youtubeurl= get_theme_mod('youtube_url','https://youtube.com/');
            $linkedinurl= get_theme_mod('linkedin_url','https://linkedin.com/');
            $githuburl= get_theme_mod('github_url','https://github.io/'); 
            $slackurl= get_theme_mod('slack_url','https://slack.com/');
            $envatourl= get_theme_mod('envato_url','https://envato.com/');
            $behanceurl= get_theme_mod('behance_url','https://behance.com/');
            $dribbbleurl= get_theme_mod('dribbble_url','https://dribbble.com/');
            $vimeourl= get_theme_mod('vimeo_url','https://vimeo.com/'); 
            $spotifyurl= get_theme_mod('spotify_url','https://spotify.com/');
            ?>
            
             <?php if($facebookurl){ ?>
							<a href="<?php echo esc_url($facebookurl); ?>" class="facebook" target="_blank"><i class="zil zi-facebook"></i></a>
							<?php } ?>
							
							 <?php if($twitterurl){ ?>
							<a href="<?php echo esc_url($twitterurl); ?>" class="twitter" target="_blank"><i class="zil zi-twitter"></i></a>
							<?php } ?>
							
							
							<?php if($pinteresturl){ ?>
							<a href="<?php echo esc_url($pinteresturl); ?>" class="pinterest" target="_blank"><i class="zil zi-pinterest"></i></a>
							<?php } ?>
							
							<?php if($instagramurl){ ?>
							<a href="<?php echo esc_url($instagramurl); ?>" class="instagram" target="_blank"><i class="zil zi-instagram"></i></a>
							<?php } ?>
							
							<?php if($behanceurl){ ?>
							<a href="<?php echo esc_url($behanceurl); ?>" class="behance" target="_blank"><i class="zil zi-behance"></i></a>
			            	<?php } ?>
			            	
			            	<?php if($youtubeurl){ ?>
				            <a href="<?php echo esc_url($youtubeurl); ?>" class="youtube" target="_blank"><i class="zil zi-youtube"></i></a>
				            <?php } ?>
				            
				            <?php if($linkedinurl){ ?>
				            <a href="<?php echo esc_url($linkedinurl); ?>" class="linkedin" target="_blank"><i class="zil zi-linked-in"></i></a>
				            <?php } ?>
				            
				            <?php if($githuburl){ ?>
				            <a href="<?php echo esc_url($githuburl); ?>" class="github" target="_blank"><i class="zil zi-github"></i></a>
				            <?php } ?>
				            
				            <?php if($slackurl){ ?>
				            <a href="<?php echo esc_url($slackurl); ?>" class="slack" target="_blank"><i class="zil zi-slack"></i></a>
				            <?php } ?>
				            
				             <?php if($envatourl){ ?>
				            <a href="<?php echo esc_url($envatourl); ?>" class="envato" target="_blank"><i class="zil zi-envato"></i></a>
				            <?php } ?>
				            
				             <?php if($dribbbleurl){ ?>
				            <a href="<?php echo esc_url($dribbbleurl); ?>" class="dribbble" target="_blank"><i class="zil zi-dribbble"></i></a>
				            <?php } ?>
				            
				             <?php if($vimeourl){ ?>
				            <a href="<?php echo esc_url($vimeourl); ?>" class="vimeo" target="_blank"><i class="zil zi-vimeo"></i></a>
				            <?php } ?>
				            
				             <?php if($spotifyurl){ ?>
				            <a href="<?php echo esc_url($spotifyurl); ?>" class="spotify" target="_blank"><i class="zil zi-spotify"></i></a>
				            <?php } ?>