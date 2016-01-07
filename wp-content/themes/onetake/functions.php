<?php

define('ONETAKE_OPTIONS_PREFIXED' ,'onetake_');
/*
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
require_once dirname( __FILE__ ) . '/admin/options-framework.php';
require_once get_template_directory() . '/options.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { 
}

/*
 * This is an example of filtering menu parameters
 */

/*
function prefix_options_menu_filter( $menu ) {
	$menu['mode'] = 'menu';
	$menu['page_title'] = __( 'Hello Options', 'onetake');
	$menu['menu_title'] = __( 'Hello Options', 'onetake');
	$menu['menu_slug'] = 'hello-options';
	return $menu;
}

add_filter( 'optionsframework_menu', 'prefix_options_menu_filter' );
*/



/**
 * Theme setup
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-setup.php' );

/**
 * Theme functions
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/custom-functions.php' );

/**
 * Theme widgets
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/theme-widgets.php' );

/**
 * Theme breadcrumb
 */
 
load_template( trailingslashit( get_template_directory() ) . 'includes/breadcrumb-trail.php' );

/**
 * Mobile Detect Library
 */
 
if( !class_exists("Mobile_Detect") ) 
load_template( trailingslashit( get_template_directory() ) . 'includes/Mobile_Detect.php' );

 	/*	
	*	get background 
	*	---------------------------------------------------------------------
	*/
function onetake_get_background($args,$opacity=1){
$background = "";
 if (is_array($args)) {
	if (isset($args['image']) && $args['image']!="") {
	$background .=  "background-image:url(".esc_url($args['image']). ");";
	$background .= "background-repeat: ".esc_attr($args['repeat']).";";
	$background .= "background-position: ".esc_attr($args['position']).";";
	$background .= "background-attachment: ".esc_attr($args['attachment']).";";
	}

	if(isset($args['color']) && $args['color'] !=""){
	$rgb = onetake_hex2rgb($args['color']);
	$background .= "background-color:rgba(".$rgb[0].",".$rgb[1].",".$rgb[2].",".esc_attr($opacity).");";
	}

	}
return $background;
}



/**
 * Convert Hex Code to RGB
 * @param  string $hex Color Hex Code
 * @return array       RGB values
 */
 
function onetake_hex2rgb( $hex ) {
		if ( strpos( $hex,'rgb' ) !== FALSE ) {

			$rgb_part = strstr( $hex, '(' );
			$rgb_part = trim($rgb_part, '(' );
			$rgb_part = rtrim($rgb_part, ')' );
			$rgb_part = explode( ',', $rgb_part );

			$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

		} elseif( $hex == 'transparent' ) {
			$rgb = array( '255', '255', '255', '0' );
		} else {

			$hex = str_replace( '#', '', $hex );

			if( strlen( $hex ) == 3 ) {
				$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
				$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
				$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
			} else {
				$r = hexdec( substr( $hex, 0, 2 ) );
				$g = hexdec( substr( $hex, 2, 2 ) );
				$b = hexdec( substr( $hex, 4, 2 ) );
			}
			$rgb = array( $r, $g, $b );
		}

		return $rgb; // returns an array with the rgb values
	}
