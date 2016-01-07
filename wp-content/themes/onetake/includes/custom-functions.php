<?php
/*
*  page navigation
*
*/
function onetake_native_pagenavi($echo,$wp_query){
    if(!$wp_query){global $wp_query;}
    global $wp_rewrite;      
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    $pagination = array(
    'base' => @add_query_arg('paged','%#%'),
    'format' => '',
    'total' => $wp_query->max_num_pages,
    'current' => $current,
    'prev_text' => '&laquo; ',
    'next_text' => ' &raquo;'
    );
 
    if( $wp_rewrite->using_permalinks() )
        $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg('s',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
 
    if( !empty($wp_query->query_vars['s']) )
        $pagination['add_args'] = array('s'=>get_query_var('s'));
    if($echo == "echo"){
    echo '<div class="page_navi">'.paginate_links($pagination).'</div>'; 
	}else
	{
	
	return '<div class="page_navi">'.paginate_links($pagination).'</div>';
	}
}

/*
*  Custom comments list
*
*/
   
   function onetake_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ;?>">
     <div id="comment-<?php comment_ID(); ?>">
	 
	 <div class="comment-avatar"><?php echo get_avatar($comment,'52','' ); ?></div>
			<div class="comment-info">
			<div class="reply-quote">
             <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
			</div>
      <div class="comment-author vcard">
        
			<span class="fnfn"><?php printf(__('%s </cite><span class="says">says:</span>','onetake'), get_comment_author_link()) ;?></span>
								<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">
<?php printf(__('%1$s at %2$s','onetake'), get_comment_date(), get_comment_time()) ;?></a>
<?php edit_comment_link(__('(Edit)','onetake'),'  ','') ;?></span>
				<span class="comment-meta">
					<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ;?>">-#<?php echo $depth?></a>				</span>

      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.','onetake') ;?></em>
         <br />
      <?php endif; ?>

     

      <?php comment_text() ;?>
</div>
   <div class="clear"></div>
     </div>
<?php
        }
		
	/*
*  wp_title filter
*
*/	
if ( ! function_exists( '_wp_render_title_tag' ) ) {	
 function onetake_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( ' Page %s ', 'onetake' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'onetake_wp_title', 10, 2 );
}

if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function onetake_slug_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'onetake_slug_render_title' );
}

/*
*  title filter
*
*/

function onetake_the_title( $title ) {
if ( $title == '' ) {
  return  __( 'Untitled', 'onetake' );
  } else {
  return $title;
  }
}
add_filter( 'the_title', 'onetake_the_title' );



// onetake slider

 function onetake_get_slider(){
	 
	global $allowedposttags;
	$controller   = '';
	$slideContent = '';
	
	$slide_time       = absint(of_get_option("slide_time","5000"));
	$slide_height     = esc_attr(of_get_option("slide_height",""));
	$slide_height     = $slide_height==""?"":"height:".$slide_height.";";
	
	$anchor_0       = esc_attr(of_get_option('section_anchor_0', ''))  ;
	$anchor_1       = esc_attr(of_get_option('section_anchor_1', ''))  ;
		  
	$return = '<section class="homepage-slider"><div id="'.$anchor_0.'" class="scrolling-anchor"></div><div id="carousel-onetake-generic" style="'.$slide_height.'" class="carousel slide" data-interval="'.$slide_time.'" data-ride="carousel">';
	 for($i=1;$i<=5;$i++){
	$active = '';
	// $title = onetake_options_array('onetake_slide_title_'.$i);
	 $text       = of_get_option('onetake_slide_text_'.$i);
	 $image      = of_get_option('onetake_slide_image_'.$i);
	 $link       = of_get_option('onetake_slide_link_'.$i);

	 if( $image != "" ){
	 if($i==1) $active     = 'active';

		 $controller   .= '<li data-target="#carousel-onetake-generic" data-slide-to="'.($i-1).'" class="'.$active.'"></li>';
		
		 $slideContent .= '<div class="item '.$active.'">';
		 if(trim($link) == ""){
			 
          $slideContent .= '<img src="'.esc_url($image).'" alt="" />';
		  
		 }else{
		  $slideContent .= '<a href="'.esc_url($link).'" target="_blank"><img src="'.esc_url($image).'" alt="" /></a>';
			 } 
			 
          $slideContent .= '<div class="carousel-caption">'.do_shortcode( wp_kses( $text , $allowedposttags ) ).'</div></div>';

	}
 }
	     $return .= '<ol class="carousel-indicators">'. $controller .'</ol>';
		 $return .= '<div class="carousel-inner">'. do_shortcode( wp_kses( $slideContent , $allowedposttags ) ) .'</div>';
		 
		 $return .= '<a class="left carousel-control" href="#carousel-onetake-generic" data-slide="prev">
						<span class="fa fa-angle-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-onetake-generic" data-slide="next">
						<span class="fa fa-angle-right"></span>
					</a>';
		$return .= '</div><div id="'.$anchor_1.'" class="scrolling-anchor"></div></section>';

        return $return;
   }


   /**
 * onetake admin sidebar
 */
 
add_action( 'optionsframework_sidebar','onetake_options_panel_sidebar' );

function onetake_options_panel_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
	    	<div class="postbox">
	    		<h3><?php _e( 'Quick Links', 'onetake' ); ?></h3>
      			<div class="inside"> 
		          <ul>
                  <li><a href="<?php echo esc_url( 'http://www.hoothemes.com/themes/onetake.html' ); ?>" target="_blank">Upgrade to Pro</a></li>
                  <li><a href="<?php echo esc_url( 'http://www.hoothemes.com/onetake-wordpress-theme-manual.html' ); ?>" target="_blank">Tutorials</a></li>
                  </ul>
      			</div>
	    	</div>
	  	</div>
	</div>
    <div class="clear"></div>
<?php
}


   /**
 * onetake favicon
 */

	function onetake_favicon()
	{
	    $url =  of_get_option('favicon');
	
		$icon_link = "";
		if($url)
		{
			$type = "image/x-icon";
			if(strpos($url,'.png' )) $type = "image/png";
			if(strpos($url,'.gif' )) $type = "image/gif";
		
			$icon_link = '<link rel="icon" href="'.esc_url($url).'" type="'.$type.'">';
		}
		
		echo $icon_link;
	}
	
	 add_action( 'wp_head', 'onetake_favicon' );
	 

// allow script & iframe tag within posts
function onetake_allow_post_tags( $allowedposttags ){
    $allowedposttags['script'] = array(
        'type' => true,
        'src' => true,
        'height' => true,
        'width' => true,
    );
    $allowedposttags['iframe'] = array(
        'src' => true,
        'width' => true,
        'height' => true,
        'class' => true,
        'frameborder' => true,
        'webkitAllowFullScreen' => true,
        'mozallowfullscreen' => true,
        'allowFullScreen' => true
    );
	$allowedposttags['video'] = array(
	     'src' => true,
		 'type' => true,
		 'poster' => true,
									  
       );
	

    return $allowedposttags;
}
add_filter('wp_kses_allowed_html','onetake_allow_post_tags', 1);



function onetake_options_typography_get_os_fonts() {

  // OS Font Defaults

  $os_faces = array(

      'Arial, sans-serif' => 'Arial',

      '"Avant Garde", sans-serif' => 'Avant Garde',

      'Cambria, Georgia, serif' => 'Cambria',

      'Copse, sans-serif' => 'Copse',

      'Garamond, "Hoefler Text", Times New Roman, Times, serif' => 'Garamond',

      'Georgia, serif' => 'Georgia',

      '"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',

      'Tahoma, Geneva, sans-serif' => 'Tahoma',
	  'PT Sans, sans-serif' => 'PT Sans',

  );

  return $os_faces;

}


function onetake_options_typography_font_styles($option, $selectors) {

      $output = $selectors . ' {';

      $output .= ' color:' . $option['color'] .'; ';

      $output .= 'font-family:' . $option['face'] . '; ';

      $output .= 'font-weight:' . $option['style'] . '; ';

      $output .= 'font-size:' . $option['size'] . '; ';

      $output .= '}';

      $output .= "\n";

      return $output;

}
