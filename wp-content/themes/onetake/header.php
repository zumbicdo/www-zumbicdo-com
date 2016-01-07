<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php wp_head();?>
</head>
<body <?php body_class(); ?>>
	  <?php
	     global $top_bar_text_position,$top_bar_text;
		$display_top_bar       = of_get_option('display_top_bar','no');
		$top_bar_text_position = of_get_option('top_bar_text_position','1');
		$top_bar_text          = of_get_option('top_bar_text','');
		if( $display_top_bar == 'yes' ):
		get_template_part('template','topbar');
		endif;
		?>
	<header id="ot-head-container" class="header header-primary">
		<div class="container">
				<div class="row-fluid row">
					<div class="col-md-12">
                      <div class="logo-container text-left">
                      
              
					 <?php if ( of_get_option('logo')!="") { ?>
        <a href="<?php echo esc_url(home_url('/')); ?>">
        <img src="<?php echo esc_url(of_get_option('logo')); ?>" class="site-logo" alt="<?php bloginfo('name'); ?>" />
        </a>
        <?php } else{?>
					<div class="name-box">
						<a href="<?php echo esc_url(home_url('/')); ?>"><h1 class="site-name"><?php bloginfo('name'); ?></h1></a>
                        <?php if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){?>
						<span class="site-tagline"><?php echo  get_bloginfo( 'description' );?></span>
                        <?php }?>
					</div>
                 <?php }?>
                    </div>
              <button class="site-nav-toggle">
					<span class="sr-only"><?php __('Toggle navigation','onetake');?></span>
					<i class="fa fa-bars fa-2x"></i>
				</button>
                
				<nav class="site-nav" role="navigation">
					<?php 
					 wp_nav_menu(array('theme_location'=>'primary','depth'=>0,'fallback_cb' =>false,'container'=>'','container_class'=>'onepage-nav','menu_id'=>'onepage-nav','menu_class'=>'ot-navbar','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
					?>
				</nav>
               				                  
					</div>
			</div>
		</div>
	</header>