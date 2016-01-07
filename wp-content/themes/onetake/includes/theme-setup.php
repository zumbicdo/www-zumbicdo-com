<?php

function onetake_setup(){
	global $content_width;
	$lang = get_template_directory(). '/languages';
	load_theme_textdomain('onetake', $lang);
	add_theme_support( 'post-thumbnails' ); 
	$args = array();
	$header_args = array( 
	    'default-image'          => '',
		'default-repeat' => 'no-repeat',
        'default-text-color'     => 'ea9502',
		'url'                    => '',
        'width'                  => 1920,
        'height'                 => 89,
        'flex-height'            => true
     );
	add_theme_support( 'custom-background', $args );
	add_theme_support( 'custom-header', $header_args );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('nav_menus');
	add_theme_support( "title-tag" );
	register_nav_menus(
					   array(
						'primary' => __( 'Primary Menu', 'onetake' ) ,
					   'onepage' => __( 'One Page Menu', 'onetake' ),
					   'top_bar' => __( 'Top Bar Menu', 'onetake' )	
					   )
					   );
	add_editor_style("editor-style.css");
	if ( !isset( $content_width ) ) $content_width = 1170;
}

add_action( 'after_setup_theme', 'onetake_setup' );


 function onetake_custom_scripts(){
	 global $is_IE;
	 $theme_info = wp_get_theme();
	 $enable_query_loader  = of_get_option('enable_query_loader',1);
	wp_enqueue_style('onetake-Oswald',  esc_url('//fonts.googleapis.com/css?family=Oswald:300,400,700'), false, '', false);
	wp_enqueue_style('onetake-Syncopate',  esc_url('//fonts.googleapis.com/css?family=Syncopate'), false, '', false);
	wp_enqueue_style('onetake-bootstrap',  get_template_directory_uri() .'/css/bootstrap.css', false, '4.0.3', false);
	wp_enqueue_style('onetake-font-awesome',  get_template_directory_uri() .'/css/font-awesome.min.css', false, '4.1.0', false);
	wp_enqueue_style('onetake-PT-Sans',  esc_url('//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic'), false, '', false);
	wp_enqueue_style( 'onetake-main', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );

 
	wp_enqueue_script( 'onetake-bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array( 'jquery' ), '3.0.3', false );
	wp_enqueue_script( 'onetake-respond', get_template_directory_uri().'/js/respond.min.js', array( 'jquery' ), '1.4.2', false );
	wp_enqueue_script( 'onetake-nav', get_template_directory_uri().'/js/jquery.nav.js', array( 'jquery' ), '3.0.0', false );
	wp_enqueue_script( 'onetake-modernizr', get_template_directory_uri().'/js/modernizr.custom.js', array( 'jquery' ), '2.8.2', false );
	
	if( $enable_query_loader == '1')
	wp_enqueue_script( 'onetake-queryloader2', get_template_directory_uri().'/js/queryloader2.js', array( 'jquery' ), '', false );
	
	wp_enqueue_script( 'onetake-main', get_template_directory_uri().'/js/common.js', array( 'jquery' ), $theme_info->get( 'Version' ), true );
	

	if( $is_IE ) {
	wp_enqueue_script( 'onetake-html5', get_template_directory_uri().'/js/html5.js', array( 'jquery' ), '', false );
	}
	
		

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){wp_enqueue_script( 'comment-reply' );}
	
    $onetake_custom_css = "";
    $header_image       = get_header_image();
	if (isset($header_image) && ! empty( $header_image )) {
	$onetake_custom_css .= "header#ot-head-container{background:url(".esc_url($header_image). ");}\n";
	}
    if ( 'blank' != get_header_textcolor() && '' != get_header_textcolor() ){
     $header_textcolor    =  ' color:#' . get_header_textcolor() . ';';
	 $onetake_custom_css .=  'header#ot-head-container .name-box .site-name,header#ot-head-container .name-box .site-tagline {'.esc_attr($header_textcolor).'}';
		}
		
	$top_bar_background   = onetake_get_background( of_get_option('top_bar_background','') );
	if($top_bar_background){
	$onetake_custom_css  .=  '.top-bar{'.esc_attr($top_bar_background).'}';
		}
	$top_bar_color       = of_get_option('top_bar_color','#666666');
	if( $top_bar_color )
	$onetake_custom_css  .=  '.top-bar ul li a,.top-bar{color:'.esc_attr($top_bar_color).';}';
	
	$header_opacity       =  of_get_option("header_opacity");
	
	$fixed_header         =  of_get_option("fixed_header");
	if( $fixed_header == "no" ){
	$onetake_custom_css  .= "header#ot-head-container{position:static ;}\n";
	}
	$header_opacity = $header_opacity?$header_opacity:1;
	
	$header_background   = onetake_get_background( of_get_option('header_background',''),$header_opacity );
	if($header_background){
	
	$onetake_custom_css  .=  'header#ot-head-container{'.esc_attr($header_background).'}';
		}
	
	//
	$nav_menu_color       = of_get_option('nav_menu_color','#555555');
	if( $nav_menu_color )
	$onetake_custom_css  .=  '.site-nav > ul  li a{color:'.esc_attr($nav_menu_color).' !important;}';
	
	$link_color           = of_get_option('link_color');
	if( $link_color ){
	$onetake_custom_css  .=  'a:link, a:visited, a:focus,a,.page-numbers.current{color:'.esc_attr($link_color).';}';
	$onetake_custom_css  .=  '.list-pagition a, .list-pagition span{border: 1px solid '.esc_attr($link_color).';}';
	}
	
	$link_mouseover_color = of_get_option('link_mouseover_color');
	if( $link_mouseover_color ){
	$onetake_custom_css  .=  'a:hover,#onetake-footer-container .onetake-block-last ul.onetake-social li a:hover,.site-nav > ul > li.current-post-ancestor > a, .site-nav > ul > li.current-menu-parent > a, .site-nav > ul > li.current-menu-item > a, .site-nav > ul > li.current_page_item > a, .site-nav > ul > li.current > a, .site-nav > ul > li.active > a, .site-nav > ul > li:hover > a{color:'.esc_attr($link_mouseover_color).';}';
	$onetake_custom_css  .=  'div.social-icons a:hover{background-color:'.esc_attr($link_color).'}';
	$onetake_custom_css  .=  '::selection {background:'.esc_attr($link_mouseover_color).';}';
	$onetake_custom_css  .=  '.list-pagition a:hover{background-color:'.esc_attr($link_mouseover_color).';}';
	}
	
	$social_icon_color   = of_get_option('social_icon_color');
	if( $social_icon_color )
	$onetake_custom_css  .=  '#ot-footer-container .ot-block-last ul.ot-social li a{color:'.esc_attr($social_icon_color).';}';
	
	$social_icon_background_color   = of_get_option('social_icon_background_color');
	if( $social_icon_background_color )
	$onetake_custom_css  .=  '#ot-footer-container .ot-block-last ul.ot-social li a{background-color:'.esc_attr($social_icon_background_color).';}';
	
	$blog_title_color    = of_get_option('blog_title_color');
	if( $blog_title_color )
	$onetake_custom_css  .=  'h1.entry-title{color:'.esc_attr($blog_title_color).';}';
	
	$site_title_color    = of_get_option('site_title_color');
	if( $site_title_color )
	$onetake_custom_css  .=  '.site-name{color:'.esc_attr($site_title_color).';}';
	
	$home_footer_background        = onetake_get_background( of_get_option('home_footer_background','') );
	$single_footer_background      = onetake_get_background( of_get_option('single_footer_background','') );
	$footer_widget_area_background = onetake_get_background( of_get_option('footer_widget_area_background',''));
	
	if( $footer_widget_area_background )
	$onetake_custom_css  .=  'footer .footer-widgets{'.$footer_widget_area_background.'}';
	
	if( $home_footer_background )
	$onetake_custom_css  .=  'footer#ot-footer-container.footer-onepage .copyright{'.$home_footer_background.'}';
	
	if($single_footer_background){
	$onetake_custom_css  .=  'footer#ot-footer-container .copyright{'.$single_footer_background.'}';
	$onetake_custom_css  .=  '#ot-footer-container .ot-block-last{border-top:none;}';
	}
	//
	
	// Typography
	$menu_typography       = of_get_option("menu_typography",'');
	if( $menu_typography )
	$onetake_custom_css     .= onetake_options_typography_font_styles($menu_typography ,'.site-nav > ul > li > a,.site-nav > ul > li > a > span');
	
	$menu_active_color    = of_get_option('menu_active_color');
	if( $menu_active_color )
	
	$onetake_custom_css     .='
		  .site-nav li > ul > li:hover > a {
		  color: '.$menu_active_color.';
	  }
	  .site-nav > ul > li.current-post-ancestor > a,
	  .site-nav > ul > li.current-menu-parent > a,
	  .site-nav > ul > li.current-menu-item > a,
	  .site-nav > ul > li.current_page_item > a,
	  .site-nav > ul > li.active > a,
	  .site-nav > ul > li.current > a,
	  .site-nav > ul > li:hover > a {
		  color: '.$menu_active_color.';
	  }';
	
	
	$section_content_typography       = of_get_option("section_content_typography",'');
	if( $section_content_typography )
	$onetake_custom_css     .= onetake_options_typography_font_styles($section_content_typography ,'section.section,section.section p');
	
	$blog_title_typography       = of_get_option("blog_title_typography",'');
	if( $blog_title_typography )
	$onetake_custom_css     .= onetake_options_typography_font_styles($blog_title_typography ,'.entry-title');
	
	$page_content_typography       = of_get_option("page_content_typography",'');
	if( $page_content_typography )
	$onetake_custom_css     .= onetake_options_typography_font_styles($page_content_typography ,'.entry-content,.entry-content p,.entry-summary p');
	
	$sidebar_title_typography       = of_get_option("sidebar_title_typography",'');
	if( $page_content_typography )
	$onetake_custom_css     .= onetake_options_typography_font_styles($sidebar_title_typography ,'.widget-title');
	
	
	
	$custom_css           =  of_get_option("custom_css","");
	if( $custom_css != "" )
	$onetake_custom_css  .=  wp_filter_nohtml_kses($custom_css);
	$onetake_custom_css   = esc_html($onetake_custom_css);
	
	$onetake_custom_css   = str_replace('&gt;','>',$onetake_custom_css);
	
	wp_add_inline_style( 'onetake-main', $onetake_custom_css );
	
	wp_localize_script( 'onetake-main', 'onetake_params',  array(
			'ajaxurl'  => admin_url('admin-ajax.php'),
			'themeurl' => get_template_directory_uri(),
			'fixed_header' => $fixed_header,
			'query_loader' => $enable_query_loader,
		)  );
	
	}

  function onetake_admin_scripts(){
	 $theme_info = wp_get_theme();
	wp_enqueue_style('onetake-admin',  get_template_directory_uri() .'/css/admin.css', false, $theme_info->get( 'Version' ), false);
	wp_enqueue_script( 'onetake-admin', get_template_directory_uri().'/js/admin.js', array( 'jquery' ), $theme_info->get( 'Version' ), true );
  }
   if (!is_admin()) {
  add_action( 'wp_enqueue_scripts', 'onetake_custom_scripts' );
  }
  else{
   add_action( 'admin_enqueue_scripts', 'onetake_admin_scripts' );
	  }

