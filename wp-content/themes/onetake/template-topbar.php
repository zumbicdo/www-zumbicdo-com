<?php
  global $top_bar_text_position,$top_bar_text;
?>
<div class="top-bar">
	       <div class="container">
           <div class="row">
           <div class="col-md-6 top-bar-left">
           <?php   
		          if( $top_bar_text_position == 2){
					 wp_nav_menu(array('theme_location'=>'top_bar','depth'=>1,'fallback_cb' =>false,'container'=>'','container_class'=>'top-bar-nav','menu_id'=>'top-bar-nav','menu_class'=>'onetake-navbar','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
				  }else{
					  
					echo do_shortcode($top_bar_text) ;   
					  }
					 
					?>
                    
           </div>
           <div class="col-md-6 top-bar-right">
           <?php   
		          if( $top_bar_text_position == 1){
					 wp_nav_menu(array('theme_location'=>'top_bar','depth'=>1,'fallback_cb' =>false,'container'=>'','container_class'=>'top-bar-nav','menu_id'=>'top-bar-nav','menu_class'=>'onetake-navbar','link_before' => '<span>', 'link_after' => '</span>','items_wrap'=> '<ul id="%1$s" class="%2$s">%3$s</ul>'));
				  }else{
					  
					echo do_shortcode($top_bar_text) ;  
					  }
					 
					?>
           </div>
           </div>
           </div>
        </div>