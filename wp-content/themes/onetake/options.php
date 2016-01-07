<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
    
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {


	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	$home_footer_background_defaults = array(
		'color' => '#ff8500',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );
    $footer_widget_area_background = array(
		'color' => '#313f52',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';

	$options = array();

   /**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */
	 
	 $options[] = array(
		'name' => __('General Options', 'onetake'),
		'type' => 'heading');
	 
	 $options[] = array(
			'name' => __('Enable Query Loader', 'onetake'),
			'desc' => __('Enable page query loader progress bar.', 'onetake'),
			'id' => 'enable_query_loader',
			'std' => '',
			'type' => 'checkbox');

	$options[] = array(
		'name' => __('Upload Logo', 'onetake'),
		'id' => 'logo',
		'std' => '',
		'type' => 'upload');
		
	$options[] = array(
		'name' => __('Favicon', 'onetake'),
		'desc' => sprintf(__('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="%s" target="_blank">Favicon</a>', 'onetake'),esc_url("http://en.wikipedia.org/wiki/Favicon")),
		'id' => 'favicon',
		'type' => 'upload');
	
	$options[] = array('name' => __('Link Color', 'onetake'),'id' => 'link_color','std'=>'#4ca702' ,'type'=> 'color');	
	$options[] = array('name' => __('Link Mouseover Color', 'onetake'),'std'=>'#94c03d','id' => 'link_mouseover_color' ,'type'=> 'color');	
	$options[] = array('name' => __('Site Title Color', 'onetake'),'id' => 'site_title_color','std'=>'#4ca702' ,'type'=> 'color');	
	
	$options[] = array(
		'name' => __('404 Page Content', 'onetake'),
		'id' => 'page_404_content',
		'std' => '<div class="text-center">
                                    <img class="img-404" src="'.$imagepath .'404.png" alt="404 not found" />
                                    <br/> <br/>
                                    <a href="'.esc_url(home_url("/")).'"><i class="fa fa-home"></i> Please, return to homepage!</a>
                                    </div>',
		'type' => 'editor');
		
	$options[] = array(
		'name' => __('Custom CSS', 'onetake'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'onetake'),
		'id' => 'custom_css',
		'std' => 'body{margin:0px;}',
		'type' => 'textarea');


	 $options[] = array(
		'name' => __('Home Page', 'onetake'),
		'type' => 'heading');
	 
	  $options[] = array(
		'name' => __('Enable Featured Homepage', 'onetake'),
		'desc' => sprintf(__('Active featured homepage Layout.  The standardized way of creating Static Front Pages: <a href="%s" target="_blank">Creating a Static Front Page</a>', 'onetake'),esc_url('http://codex.wordpress.org/Creating_a_Static_Front_Page')),
		'id' => 'enable_home_page',
		'std' => '1',
		'type' => 'checkbox');
	  
	 $options[] = array(
		'name' => __('Number of Sections', 'onetake'),
		'desc' => __('Select number of sections', 'onetake'),
		'id' => 'section_num',
		'type' => 'select',
		'class' => 'mini',
		'std' => '5',
		'options' => array_combine(range(1,10), range(1,10)) );
		
	 $section_num = of_get_option( 'section_num', 5 );
	 
	 $options[] = array(	'desc' =>'<div class="options-section"><h3 class="groupTitle">'.__('Video Background Options', 'onetake').'</h3>',	'class' => 'toggle_option_group group_close','type' => 'info');
	 $options[] = array('name' => __('Section Background Video', 'onetake'),'std' => '1TFC-nttP3U','desc' => __('YouTube Video ID', 'onetake'),'id' => 'youtube_background_video','type' => 'text');
		
	$options[] = array('name' => __('Display Buttons', 'onetake'), 'desc' => __('Display video control buttons.', 'onetake'),'id' => 'video_controls', 'std' => '1','class' => 'mini', 'options' => array('1'=>'yes','0'=>'no'),'type' => 'select');
	
	$options[] = array('name' => __('Video Loop', 'onetake'), 'desc' => __('Play video loop.', 'onetake'),'id' => 'youtube_video_loop', 'std' => '1','class' => 'mini', 'options' => array('1'=>'yes','0'=>'no'),'type' => 'select');
	
	$options[] = array('name' => __('Default Volum', 'onetake'),'desc' => '','id' => 'default_volum','type' => 'select',	'class' => 'mini',	'std' => '10','options' => array_combine(range(0,100,10), range(0,100,10)) );
	
	$options[] = array('name' => __('Seeks To', 'onetake'),'std' => '3','desc' => __('Seeks to a specified time in the video ( number of seconds ).', 'onetake'),'id' => 'youtube_seekto','type' => 'text');
		
		$video_background_section = array("0"=>__('No video background', 'onetake'));
		if( is_numeric( $section_num ) ){
		for($i=1; $i <= $section_num; $i++){
			$video_background_section[$i] = "Secion ".$i;
			}
		}
	$options[]  = array('name' => __('Video Background Section', 'onetake'),'std' => '1','id' => 'video_background_section',
		'type'  => 'select','options'=>$video_background_section);
	 $options[] = array('desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
	 $options[] = array('name' => __('Section 1 Content', 'onetake'),'std' => 'content','class' => 'mini','id' => 'section_1_content','type' => 'select','options'=>array("content"=>__('Content', 'onetake'),"slider"=>__('Slider', 'onetake')));
		
		
     $section_title              = array("","INTRODUCTION","SERVICES","PROJECTS","CONTACT");
	 $section_title_color        = array("","#00bceb","#4dad00","#305999","#ff8400");
	 $section_title_border_color = array("","#009dc4","#459a00","#305999","#ff6c00");
	 $section_content_color      = array("#ffffff","#595959","#ffffff","#595959","#ffffff");
	 $section_anchor             = array("section-home","section-introduction","section-services","section-projects","section-contact");
	 $section_css_class          = array("","","","section-projects","section-contact");
	 $section_background_size    = array("yes","no","no","yes","no");
	 
	 $section_background = array(
	     array(
		'color' => '',
		'image' => $imagepath.'youtube-video-screenshot.jpg',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg-section-two.png',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg-section-three.png',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '',
		'image' => $imagepath.'bg-section-projects.png',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' ),
		 array(
		'color' => '#ff8500',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top left',
		'attachment'=>'scroll' )
		 );
	 
	 $section_content   = array(
               '<div class="brand">
		    <span class="bike fa fa-bicycle fa-3">&nbsp;</span>
		    		<h1>MY LAST LOCATION</h1>
		    			<br/>
		    <h2>Impressive . Original . Awesome</h2>

<ul class="social-icons">
            	<li><a href="#"><i class="fa fa-2 fa-facebook">&nbsp;</i></a></li>
                <li><a href="#"><i class="fa fa-2 fa-skype">&nbsp;</i></a></li>
                <li><a href="#"><i class="fa fa-2 fa-twitter">&nbsp;</i></a></li>
                <li><a href="#"><i class="fa fa-2 fa-linkedin">&nbsp;</i></a></li>
                <li><a href="#"><i class="fa fa-2 fa-google-plus">&nbsp;</i></a></li>
                <li><a href="#"><i class="fa fa-2 fa-rss">&nbsp;</i></a></li>
            </ul>
<a class="btn" href="#section-introduction">Get Started</a>
	    		</div>', 
			   
               '<p class="ot-onetake"><span>Onetake</span> is a responsive single-page theme that enables you to build your WordPress website <span>quickly and effectively</span>.</p>
							<p class="ot-professional">Onetake is a one page HTML5 & CSS3 responsive business theme that displays all the essential features of your website on the home page. It have a very interesting and useful concept by showing you concise information on a single page.</p>							
							<div class="img-radius">
							    <div class="img-left"><i class="fa fa-cloud">&nbsp;</i></div>
								 <div class="img-right"><i i class="fa fa-comment-o">&nbsp;</i></div>
							</div>
							<p class="ot-professional">Onetake is a professional and outstanding responsive business One Page WordPress Theme, which is based on Bootstrap 3 & Font Awesome 4, you can create a single-page-style front page for your WordPress site with autogenerated content and JavaScript scroll navigation or personal blog.</p>',
							
	
				'<div class="col-sm-4 ">
<div class="service-box">
<i class="fa fa-pie-chart">&nbsp;</i>
<h3>FEATURE ONE</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
<a href="#">Read More&gt;&gt;</a>

</div></div>

<div class="col-sm-4 ">
<div class="service-box">
<i class="fa fa-line-chart">&nbsp;</i>
<h3>FEATURE TWO</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
<a href="#">Read More&gt;&gt;</a>

</div></div>

<div class="col-sm-4 ">
<div class="service-box">
<i class="fa fa-comments-o">&nbsp;</i>
<h3>FEATURE THREE</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscingelit. Integer sed magna vel velit dignissim luctus eu n urna. Dapibus ege-stas turpis. Praesent faucibus nisl sit amet nulla sollicitudin.</p>
<a href="#">Read More&gt;&gt;</a>

</div></div>',
							
							'<div class="col-md-6">
	<p class="ot-images"><img class="rsImg" src="'.$imagepath.'onetake.png" alt="Onetake" />&nbsp;</p>
</div>
<div class="col-md-6">
		<div class="ot-content">
		<h4 class="ot-title">JustLook</h4>
		<p class="ot-title">Business WordPress Theme</p>
		<p>Join HooThemes and Start a Magical Web Design Journey.</p>
			<ul>
				<li><i class="fa fa-check">&nbsp;</i>Impressive Design</li>
				<li><i class="fa fa-check">&nbsp;</i>Responsive Layout</li>
				<li><i class="fa fa-check">&nbsp;</i>Cross-Browser Compatibility</li>
				<li><i class="fa fa-check">&nbsp;</i>Continuous  Support</li>
			</ul>
<a href="'.esc_url("http://www.domain.com").'" target="_blank">
<i class="fa fa-arrow-circle-o-right">&nbsp;</i>&nbsp;www.domain.com</a>
 </div>
</div>',
							'<p class="ot-under">This theme recommends the plugin "contact form 7"</p>
<p class="ot-under">We are currently available for projects, please feel free to call or contact us</p>

<div style="width:60%; margin:auto;">
<div class="col-md-6 fa-2">  
<i class="fa fa-at">&nbsp;</i><a href="mailto:admin@domain.com">admin@domain.com</a>
</div>
<div class="col-md-6 fa-2"> 
   <i class="fa fa-phone">&nbsp;</i>(+01) 0123 456 789
</div>'
								
 );
	     
	 
	 		for($i=0; $i < $section_num; $i++){
		
		if(!isset($section_title[$i])){$section_title[$i] = "";}
		if(!isset($section_menu[$i])){$section_menu[$i] = "";}
		if(!isset($section_background[$i])){$section_background[$i] = array('color' => '',
		'image' => '',
		'repeat' => '',
		'position' => '',
		'attachment'=>'');}
		if(!isset($section_css_class[$i])){$section_css_class[$i] = "";}
		if(!isset($section_content[$i])){$section_content[$i] = "";}
		if(!isset($section_title_color[$i])){$section_title_color[$i] = "";}
		if(!isset($section_title_border_color[$i])){$section_title_border_color[$i] = "";}
		
		if(!isset($section_content_color[$i])){$section_content_color[$i] = "";}
		if(!isset($section_anchor[$i])){$section_anchor[$i] = "";}
		if(!isset($section_background[$i])){$section_background[$i] = "";}
		if(!isset($section_background_size[$i])){$section_background_size[$i] = "";}
		
		
		
		$options[] = array(	'desc' => '<div class="options-section"><h3 class="groupTitle">Section '.($i+1).'</h3>', 'class' => 'toggle_option_group home-section group_close','type' => 'info');
		
		$options[] = array(
		'name' => '',
		'desc' => '<div style="overflow:hidden; background-color:#eee;"><a data-section="'.$i.'" class="delete-section button-primary" style="float:right;" title="'.__('Delete', 'onetake').'">'.__('Delete this section', 'onetake').'</a></div>',
		'id' => 'delete_section_'.$i,
		'std' => '',
		'type' => 'info',
		'class'=>'section-item section-delete-button');
		
		$options[] = array('name' => __('Section Title', 'onetake'),'id' => 'section_title_'.$i.'','type' => 'text','std'=>$section_title[$i]);
		$options[] = array('name' => __('Title Color', 'onetake'),'id' => 'section_title_color_'.$i.'','type' => 'color','std'=>$section_title_color[$i]);
		$options[] = array('name' => __('Title Border Color', 'onetake'),'id' => 'section_title_border_color_'.$i.'','type' => 'color','std'=>$section_title_border_color[$i]);
		$options[] = array('name' => __('Content Color', 'onetake'),'id' => 'section_content_color_'.$i.'','type' => 'color','std'=>$section_content_color[$i]);
		$options[] = array('name' => __('Section ID', 'onetake'),'id' => 'section_anchor_'.$i.'','type' => 'text','std'=>$section_anchor[$i],'desc'=>__('Add anchor tag to jump to specific section on one page without having any space or symbol. This section id will be related with the menu link, it should be call on wp appearance menu by using # after site url. It is usually all lowercase and contains only letters, numbers, and hyphens.', 'onetake'));
		$options[] = array('name' =>  __('Section Background', 'onetake'),'id' => 'section_background_'.$i.'','std' => $section_background[$i],'type' => 'background' );
		$options[] = array('name' => __('100% Width Background Image', 'onetake'),'std' => $section_background_size[$i],'id' => 'background_size_'.$i.'',
		'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
		$options[] = array('name' => __('Full Width', 'onetake'),'std' => 'no','id' => 'full_width_'.$i.'',	'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
	   $options[] = array('name' => __('Section Css Class', 'onetake'),'id' => 'section_css_class_'.$i.'','type' => 'text','std'=>$section_css_class[$i]);
	   $options[] = array('name' => __('Section Content', 'onetake'),'id' => 'section_content_'.$i,'std' => $section_content[$i],'type' => 'editor');
	   $options[] = array('desc' => __('</div>', 'onetake'),'class' => 'toggle_title','type' => 'info');
	
		}
	
	 $social_icons = array('fa fa-facebook'=>'facebook',
						  'fa fa-flickr'=>'flickr',
						  'fa fa-google-plus'=>'google plus',
						  'fa fa-linkedin'=>'linkedin',
						  'fa fa-pinterest'=>'pinterest',
						  'fa fa-twitter'=>'twitter',
						  'fa fa-tumblr'=>'tumblr',
						  'fa fa-digg'=>'digg',
						  'fa fa-rss'=>'rss',
						 
						  );
						  
						  
	    // HEADER
	    $options[] = array('name' => __('Header', 'onetake'),'type' => 'heading');
		$options[] = array('name' => __('Display Top Bar', 'onetake'),'desc' =>'',	'id' => 'display_top_bar',	'type' => 'select',	'class' => 'mini',	'std' => 'no','options' => array('yes'=>'yes','no'=>'no') );
		
		$options[] = array('name' => __('Display Top Bar', 'onetake'),'desc' =>__('Menu: Appearance > Menus > Top Bar Menu', 'onetake'),	'id' => 'top_bar_text_position', 'type' => 'select',	'class' => '',	'std' => '1','options' => array('1'=>__('Text left & Menu right', 'onetake'),'2'=> __('Menu left & Text right', 'onetake') ));
		
		$options[] = array(
		'name' => __('Top Bar Text', 'onetake'),
		'desc' =>'',
		'id' => 'top_bar_text',
		'std' => '',
		'type' => 'textarea');
		$options[] = array('name' =>  __('Top Bar Background', 'onetake'),'id' => 'top_bar_background','std' => $background_defaults,'type' => 'background' );
		
		$options[] = array('name' => __('Top Bar Text Color', 'onetake'),'id' => 'top_bar_color','std'=>'#666666' ,'type'=> 'color');
		
		
		//$options[] = array('name' => __('Nav Menu Color', 'onetake'),'id' => 'nav_menu_color' ,'type'=> 'color');	
		
		$options[] = array('name' =>  __('Header Background', 'onetake'),'id' => 'header_background','std' => $background_defaults,'type' => 'background' );
		
		$options[] = array('name' => __('Header Opacity', 'onetake'),'desc' =>'',	'id' => 'header_opacity',	'type' => 'select',	'class' => 'mini',	'std' => '1','options' => array_combine(range(0,1,0.1), range(0,1,0.1)) );	
		
		$options[] = array('name' => __('Fixed Header', 'onetake'),'desc' =>'',	'id' => 'fixed_header',	'type' => 'select',	'class' => 'mini',	'std' => '1','options' => array('yes'=>'yes','no'=>'no') );
				
	// FOOTER

	    $options[] = array('name' => __('Footer', 'onetake'),'type' => 'heading');
		  $options[] = array('name' =>  __('Footer Widget Area Background', 'onetake'),'id' => 'footer_widget_area_background','std' => $footer_widget_area_background,'type' => 'background' );
		  
		  $options[] = array('name' => __('Display Footer Widget Are', 'onetake'), 'desc' =>'','id' => 'display_footer_widget_area', 'std' => '0','class' => 'mini', 'options' => array('0'=>'no','1'=>'yes'),'type' => 'select');
		  
		$options[] = array('name' => __('Social Icon Color', 'onetake'),'std' => '#FFFFFF','id' => 'social_icon_color' ,'type'=> 'color');
		$options[] = array('name' => __('Social Icon Background Color', 'onetake'),'std' => '#ff6600','id' => 'social_icon_background_color' ,'type'=> 'color');
		
		$options[] = array('name' =>  __('Home Page Footer Background', 'onetake'),'id' => 'home_footer_background','std' =>$home_footer_background_defaults,'type' => 'background' );
		$options[] = array('name' =>  __('Single Page Footer Background', 'onetake'),'id' => 'single_footer_background','std' => $background_defaults,'type' => 'background' );
	
        for($i=0;$i<9;$i++){
			
	    $options[] = array("name" => sprintf(__('Social Icon #%s', 'onetake'),($i+1)),	"id" => "social_icon_".$i,"std" => "","class" => 'mini',"type" => "select",	"options" => $social_icons );
		$options[] = array('name' => sprintf(__('Social Title #%s', 'onetake'),($i+1)),'id' => 'social_title_'.$i,"class" => 'mini','type' => 'text');	
		$options[] = array('name' => sprintf(__('Social Link #%s', 'onetake'),($i+1)),'id' => 'social_link_'.$i,'type' => 'text');	
		}
		// Slider
		$options[] = array(	'name' => __('Homepage Slider', 'onetake'),	'type' => 'heading');
	
		//HOME PAGE SLIDER
		$options[] = array('name' => __('Slideshow', 'onetake'),'id' => 'group_title','type' => 'title');
		
		$options[] = array(	'desc' => __('<div class="options-section"><h3 class="groupTitle">'.__('Slide One','onetake').'</h3>', 'onetake'),	'class' => 'toggle_option_group group_close','type' => 'info');
		
		$options[] = array('name' => __('Image', 'onetake'),'id' => 'onetake_slide_image_1','type' => 'upload','std'=>$imagepath.'banner-1.jpg');
	
		$options[] = array('name' => __('Text', 'onetake'),'id' => 'onetake_slide_text_1','type' => 'editor','std'=>'<h1>The jQuery slider that just slides.</h1><p>No fancy effects or unnecessary markup.</p><a class="btn" href="#download">Download</a>');
		
		$options[] = array(	'desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
		
		$options[] = array(	'desc' => __('<div class="options-section"><h3 class="groupTitle">'.__('Slide Two','onetake').'</h3>', 'onetake'),	'class' => 'toggle_option_group group_close','type' => 'info');
		
		$options[] = array('name' => __('Image', 'onetake'),'id' => 'onetake_slide_image_2','type' => 'upload','std'=>$imagepath.'banner-2.jpg');
		
		$options[] = array('name' => __('Text', 'onetake'),'id' => 'onetake_slide_text_2','type' => 'editor','std'=>'<h1>Fluid, flexible, fantastically minimal.</h1><p>Use any HTML in your slides, extend with CSS. You have full control.</p><a class="btn" href="#download">Download</a>');
		
		$options[] = array(	'desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
		
		$options[] = array(	'desc' => __('<div class="options-section"><h3 class="groupTitle">'.__('Slide Three','onetake').'</h3>', 'onetake'),	'class' => 'toggle_option_group group_close','type' => 'info');
		$options[] = array('name' => __('Image', 'onetake'),'id' => 'onetake_slide_image_3','type' => 'upload','std'=>$imagepath.'banner-3.jpg');
		
		$options[] = array('name' => __('Text', 'onetake'),'id' => 'onetake_slide_text_3','type' => 'editor','std'=>'<h1>Open-source.</h1><p> Vestibulum auctor nisl vel lectus ullamcorper sed pellentesque dolor eleifend.</p><a class="btn" href="#">Contribute</a>');
		
    	$options[] = array(	'desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
		
		$options[] = array(	'desc' => __('<div class="options-section"><h3 class="groupTitle">'.__('Slide Four','onetake').'</h3>', 'onetake'),	'class' => 'toggle_option_group group_close','type' => 'info');
		$options[] = array('name' => __('Image', 'onetake'),'id' => 'onetake_slide_image_4','type' => 'upload','std'=>$imagepath.'banner-4.jpg');
		
		$options[] = array('name' => __('Text', 'onetake'),'id' => 'onetake_slide_text_4','type' => 'editor','std'=>'<h1>Uh, that\'s about it.</h1><p>I just wanted to show you another slide.</p><a class="btn" href="#download">Download</a>');
		
		$options[] = array(	'desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
		
		$options[] = array(	'desc' => __('<div class="options-section"><h3 class="groupTitle">'.__('Slide Five','onetake').'</h3>', 'onetake'),	'class' => 'toggle_option_group group_close','type' => 'info');
		$options[] = array('name' => __('Image', 'onetake'),'id' => 'onetake_slide_image_5','type' => 'upload');
	 
		$options[] = array('name' => __('Text', 'onetake'),'id' => 'onetake_slide_text_5','type' => 'editor');
	 
		$options[] = array(	'desc' => __('</div>', 'onetake'),	'class' => 'toggle_title','type' => 'info');
	
		
		$options[] = array(	'name' => __('Slide Time', 'onetake'),'id' => 'slide_time',	'std' => '5000','desc'=>__('Milliseconds between the end of the sliding effect and the start of the nex one.','onetake'),'type' => 'text');
			//END HOME PAGE SLIDER
			//Blog
		$options[] = array('name' => __('Blog', 'onetake'),'type' => 'heading');
		$options[] = array('name' => __('Hide Post Meta', 'onetake'),'std' => 'no','desc'=>__('Hide date, author, category...below blog title.','onetake'),'id' => 'hide_post_meta',
		'type' => 'select','class'=>'mini','options'=>array("no"=>"no","yes"=>"yes"));
		//$options[] = array('name' => __('Blog Title Color', 'onetake'),'id' => 'blog_title_color','std'=>'#4ca702' ,'type'=> 'color');	
		
		
		// Typography
	  $typography_mixed_fonts =  onetake_options_typography_get_os_fonts();
	  
	 $options[] = array('name' => __('Typography', 'onetake'),'type' => 'heading');
	 $options[] = array( 'name' => __('Menu Typography', 'onetake'),

			'desc' => __('Main menu typography.', 'onetake'),
			'id' => 'menu_typography',
			'std' => array( 'size' => '16px', 'face' => 'PT Sans, sans-serif', 'color' => '#595959'),
			'type' => 'typography',
			'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false )
			  );
	 $options[] = array('name' => __('Menu Active Color', 'onetake'),'id' => 'menu_active_color','type' => 'color','std'=>'#4ca702');
	 
	 $options[] = array( 'name' => __('Section Content Typography', 'onetake'),

			'desc' => __('Home page section content typography.', 'onetake'),
			'id' => 'section_content_typography',
			'std' => array( 'size' => '16px', 'face' => 'PT Sans, sans-serif', 'color' => '#595959'),
			'type' => 'typography',
			'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false )
			  );
	 
	 $options[] = array( 'name' => __('Blog Title Typography', 'onetake'),

			'desc' => __('Blog archive title typography.', 'onetake'),
			'id' => 'blog_title_typography',
			'std' => array( 'size' => '22px', 'face' => 'PT Sans, sans-serif', 'color' => '#595959'),
			'type' => 'typography',
			'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false )
			  );
	 
	  $options[] = array( 'name' => __('Page Content Typography', 'onetake'),

			'desc' => __('Page & post content typography.', 'onetake'),
			'id' => 'page_content_typography',
			'std' => array( 'size' => '16px', 'face' => 'PT Sans, sans-serif', 'color' => '#747474'),
			'type' => 'typography',
			'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false )
			  );
	  
	  $options[] = array( 'name' => __('Sidebar Title Typography', 'onetake'),

			'desc' => __('Sidebar widget title typography.', 'onetake'),
			'id' => 'sidebar_title_typography',
			'std' => array( 'size' => '22px', 'face' => 'PT Sans, sans-serif', 'color' => '#595959'),
			'type' => 'typography',
			'options' => array(
			'faces' => $typography_mixed_fonts,
			'styles' => false )
			  );
	  
		
	

	return $options;
}