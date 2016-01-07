<?php
/**
* The front page template
*
*/
$enable_home_page = of_get_option('enable_home_page');

if ( 'posts' == get_option( 'show_on_front' ) ) {

    include( get_home_template() );

} else {
	if(  $enable_home_page == "1" ){
	get_header("onepage");
	get_template_part( 'featured-content' );
	get_footer("onepage");
	}
	else{
     get_template_part( 'content','home');
	
		}
		
	
   }
