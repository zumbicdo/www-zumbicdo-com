<?php
/**
* The featured template file.
*
*/
?>

<div id="ot-main-container">
				<div class="ot-main-content ot-sections-container">
<?php  
        global $allowedposttags;
		
		$allowedposttags['input']  = array ( 'class' => 1, 'id'=> 1, 'style' => 1, 'type' => 1, 'value' => 1 ,'placeholder'=> 1,'size'=> 1,'tabindex'=> 1,'aria-required'=> 1);
		$allowedposttags['iframe'] = array(
		'align' => true,
		'width' => true,
		'height' => true,
		'frameborder' => true,
		'name' => true,
		'src' => true,
		'id' => true,
		'class' => true,
		'style' => true,
		'scrolling' => true,
		'marginwidth' => true,
		'marginheight' => true,
		
		);
 
		$sectionNum               = absint(of_get_option('section_num', 0));
		$video_id                 = esc_attr(of_get_option('youtube_background_video',''));
		$video_controls           = absint(of_get_option('video_controls',1));
		$video_background_section = absint(of_get_option('video_background_section',1));
		$section_1_content        = esc_attr(of_get_option('section_1_content','content'));
		$default_volum            = absint(of_get_option('default_volum',10));
		$youtube_seekto           = absint(of_get_option('youtube_seekto',3));
		$youtube_video_loop       = absint(of_get_option('youtube_video_loop',1));

		
		if(  $sectionNum > 0 ) { 
	for( $i=0; $i<$sectionNum; $i++ ){ 
			
	 if( $section_1_content == 'slider' && $i == 0 ){
		 
		echo onetake_get_slider(); 
		 
		 }else{
			$title_style  = "";
			$title        =  esc_attr( of_get_option('section_title_'.$i, ''));
            $class        =  esc_attr( of_get_option('section_css_class_'.$i, ''));
            $content	  =  of_get_option('section_content_'.$i, '');
			
			$anchor       =  esc_attr( of_get_option('section_anchor_'.($i+1), '')) ;
			if( $anchor == "" ) 
			$anchor       =  sanitize_title( esc_attr( of_get_option('section_title_'.($i+1), '')) );
			if( $anchor == "" ) 
			$anchor = "section-".($i+1);
			
			$section_id  = uniqid("section-id-");
			
			$title_color    = esc_attr(of_get_option('section_title_color_'.$i, '') );
			$title_border   = esc_attr(of_get_option('section_title_border_color_'.$i, ''));
			$content_color  = esc_attr(of_get_option('section_content_color_'.$i, ''));
			if( $title_color  != "" ) $title_style .= 'color:'.$title_color.';';
			if( $title_border != "" ) $title_style .= 'border-color:'.$title_border.';';
			
			
			$section_background       = of_get_option( 'section_background_'.$i );
			$background               = onetake_get_background( $section_background );
			$section_background_size  = of_get_option( 'background_size_'.$i, 'no' );

			if( $section_background_size == 'yes'){
				 $background .= '-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;background-size:100% 100%;';
				}
			if( $content_color  != "" ) $background .= 'color:'.$content_color.';';
			
			// video background
			
		  $video_enable   = 0;
          $detect         = new Mobile_Detect;
		  if( $video_id  != "" && $video_background_section == ($i+1) && !$detect->isMobile() && !$detect->isTablet() ){
			$video_enable      = 1;  
			$background_video  = array("videoId"=>$video_id, "start"=>$youtube_seekto ,'repeat'=> ($youtube_video_loop==1)?true:false,'defaultVolum'=>$default_volum ,"container" =>"section.section-".$anchor,"playerid"=>$anchor);
			$background        = "";
			$class            .= " section-video-background";
			wp_localize_script( 'onetake-main', 'onetakeBgvideo',$background_video );
			
			}
							
	//
		?>
         <?php if( $content_color ){?>
        <style>
        section#<?php echo $section_id ; ?>,section#<?php echo $section_id ; ?> p{
			color:<?php echo esc_attr($content_color);?>
			}
        </style>
        <?php }?>
        <section  id="<?php echo $section_id ; ?>" class="section section-<?php echo $anchor?> <?php echo $class ; ?>" style=" <?php echo $background; ?>">
         <?php if( $i == 0 ){
			 $anchorFirst      = ( of_get_option('section_anchor_0', true) != '' ) ? of_get_option('section_anchor_0', true) : sanitize_title( esc_html( of_get_option('section_title_0', true) ) );
			 ?>
        <div id="<?php echo $anchorFirst ; ?>" class="scrolling-anchor"></div>
        <?php }?>
						<div class="container"> 
                        <?php if(  trim($title) != "" ) { ?>
                        <div class="section-title" style=" <?php echo $title_style ;?>"><?php echo $title ;?></div>
                        <?php }?>
                        <div class="section-content">
							<?php 
							
							$content = do_shortcode( wp_kses( $content , $allowedposttags ) ) ;
							if(function_exists('Form_maker_fornt_end_main'))
							{
							$content = Form_maker_fornt_end_main($content);
							}
							
							echo $content ;
							?>						
						</div>
                        
                        	 <?php if( $anchor ){?>
        
        
                        </div>
						<?php 
	  if( $video_enable == 1 && $video_controls == 1 ){
	  echo '<p id="video-controls">
		  <a class="tubular-play" href="#"><i class="fa fa-play"></i></a>
		  <a class="tubular-pause" href="#"><i class="fa fa-pause"></i></a>
		  <a class="tubular-volume-up" href="#"><i class="fa fa-volume-up"></i></a>
		  <a class="tubular-volume-down" href="#"><i class="fa fa-volume-down"></i></a> 
	  </p>';
	 }
	 ?><div id="<?php echo $anchor ; ?>" class="scrolling-anchor scrolling-anchor-bottom"></div>
        <?php }?>	
				
					</section>
        
        <?php
			}
		  }
		}
		?>
        
				</div>
			</div>