jQuery(document).ready(function($){
								
								
/*----------------------------------------------------*/
//  page loader
/*----------------------------------------------------*/  

	 if( typeof onetake_params.query_loader !== 'undefined' &&  onetake_params.query_loader == '1' ){
	 window.addEventListener('DOMContentLoaded', function() {
        new QueryLoader2(document.querySelector("body"), {
            barColor: "#efefef",
            backgroundColor: "#111",
            percentage: true,
            barHeight: 1,
            minimumTime: 200,
            fadeOutTime: 1000
        });
    });
	 }
	window.location.hash = "";
	// Parallax Scrolling
	jQuery('.ot-navbar').onePageNav({
		changeHash: false,
		filter: ".menu-item-type-custom a[href^='#']"
	});
	// responsive nav
	jQuery(".site-nav-toggle").click(function(){
				jQuery(".site-nav").toggle();
			});
	
	//tooltip
	jQuery('#ot-footer-container .ot-block-last ul.ot-social li a').tooltip();

// sticky menu
     jQuery('header.header').onepageSticky({'scrollSpeed' : 1000 });	
	 
	 //video background
								
if( typeof onetakeBgvideo !== 'undefined' && onetakeBgvideo != null ){
jQuery( onetakeBgvideo.container ).tubular( onetakeBgvideo );

  }
  
  jQuery(".ot-sections-container .section").each(function(){
	if(jQuery(this).find("#tubular-container").length > 0){
		
		jQuery(this).css({"height":(jQuery(window).height()-jQuery("header").height())+"px"});
		jQuery(this).find("#tubular-container,#tubular-player").css({"height":(jQuery(window).height()-jQuery("header").height())+"px"});

		}						
 });

// smooth scrolling  btn

  jQuery(".ot-main-content a[href^='#']").on('click', function(e){
				var selectorHeight = jQuery('.sticky-header').height(); 
				var scrollTop = jQuery(window).scrollTop(); 
				e.preventDefault();
		 		var id = jQuery(this).attr('href');
				if(jQuery("body.admin-bar").length){
					if(jQuery(window).width() < 765) {
							stickyTop = 46;
							
						} else {
							stickyTop = 32;
						}
				  }
				  else{
					  stickyTop = 0;
					  }
				selectorHeight = selectorHeight + stickyTop - 1;
		
				if(typeof jQuery(id).offset() !== 'undefined'){
					var offset = jQuery(id).offset().top ;
			             offset = offset - selectorHeight;	
				    var goTo   = offset - selectorHeight;
				jQuery("html, body").animate({ scrollTop: goTo }, 1000);
				}

			});	
  
  /* ------------------------------------------------------------------------ */
/* Preserving aspect ratio for embedded iframes														*/
/* ------------------------------------------------------------------------ */
$('.entry-content embed,.entry-content iframe').each(function(){
										
		var width  = $(this).attr('width');	
		var height = $(this).attr('height');
		if($.isNumeric(width) && $.isNumeric(height)){
			if(width > $(this).width()){
				var new_height = (height/width)*$(this).width();
				$(this).css({'height':new_height});
				}
			
			}				
    });

/*----------------------------------------------------*/
// section title center
/*----------------------------------------------------*/  
$("section .section-title").each(function(){
	var width     = $(this).width();
	var new_width = (width/2)+15;
	$(this).css({'margin-left':-new_width});				  
								  
   });


  
});


(function($){
	$.fn.onepageSticky = function( options ) {
		// adding a class to users div
		$(this).addClass('sticky-header')
		var settings = $.extend({
            'scrollSpeed '  : 500
            }, options);

		//return $(".sticky-header #onepage-nav li.menu-item-type-custom a[href^='#']").each( function() {
			
			if ( settings.scrollSpeed ) {

				var scrollSpeed = settings.scrollSpeed

			}
			
	stickyTop = 0;
	if(jQuery("body.admin-bar").length){
		if(jQuery(window).width() < 765) {
				stickyTop = 46;
				
			} else {
				stickyTop = 32;
			}
	  }
	  
		  
		  $('.sticky-header').css({'top':stickyTop});
		  

		var stickyMenu = function(){
				var scrollTop = $(window).scrollTop(); 
				if (scrollTop > stickyTop) { 
					  $('.sticky-header').css({ 'position': 'fixed' }).addClass('fxd');
					} else {
					  $('.sticky-header').css({ 'position': 'static'}).removeClass('fxd'); 
					}   
					//
					
			};
		if( onetake_params.fixed_header !== 'no'){
				
			stickyMenu();
			$(window).scroll(function() {
									  
				 stickyMenu();
			});
			}
			
					
		//});

	}

})(jQuery);



/* jQuery tubular plugin
|* by Sean McCambridge
|* http://www.seanmccambridge.com/tubular
|* version: 1.0
|* updated: October 1, 2012
|* since 2010
|* licensed under the MIT License
|* Enjoy.
|* 
|* Thanks,
|* Sean */

;(function ($, window) {

    // test for feature support and return if failure
    
    // defaults
    var defaults = {
        ratio: 16/9, // usually either 4/3 or 16/9 -- tweak as needed
        videoId: 'ZCAnLxRvNNc', // toy robot in space is a good default, no?
        mute: false,
        repeat: true,
        width: $(window).width(),
        wrapperZIndex: 99,
        playButtonClass: 'tubular-play',
        pauseButtonClass: 'tubular-pause',
        muteButtonClass: 'tubular-mute',
        volumeUpClass: 'tubular-volume-up',
        volumeDownClass: 'tubular-volume-down',
        increaseVolumeBy: 10,
        start: 0,
		container:"body",
		defaultVolum:10
    };
	 

    // methods

    var tubular = function(node, options) { // should be called on the wrapper div
        var options = $.extend({}, defaults, options),
            $body = $(options.container) // cache body node
            $node = $(node); // cache wrapper node

        // build container
        var tubularContainer = '<div id="tubular-container" style="overflow: hidden; position: absolute; z-index: -1; width: 100%; height: 100%"><div id="tubular-player" style="position: absolute"></div></div><div id="tubular-shield" style="width: 100%; height: 100%; z-index: 2; position: absolute; left: 0; top: 0;"></div>';

        // set up css prereq's, inject tubular container and set up wrapper defaults
       // $('html,body').css({'width': '100%', 'height': '100%'});
        $body.prepend(tubularContainer);
        $node.css({position: 'relative', 'z-index': options.wrapperZIndex});

        // set up iframe player, use global scope so YT api can talk
        window.player;
		
        window.onYouTubeIframeAPIReady = function() {
            player = new YT.Player('tubular-player', {
                width: options.width,
                height: Math.ceil(options.width / options.ratio),
                videoId: options.videoId,
                playerVars: {
                    controls: 0,
                    showinfo: 0,
                    modestbranding: 1,
                    wmode: 'transparent',
					rel:0
					
                },
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange,
					
                }
            });
	
        }

        window.onPlayerReady = function(e) {
            resize();
            if (options.mute) e.target.mute();
            e.target.seekTo(parseInt(options.start));
			e.target.setVolume(parseInt(options.defaultVolum));	
            e.target.playVideo();
			
        }

        window.onPlayerStateChange = function(state) {
			
            if (state.data === 0 && options.repeat) { // video ended and repeat option is set true
                player.seekTo(options.start); // restart
            }
        }

        // resize handler updates width, height and offset of player after resize/init
        var resize = function() {
            var width = $(window).width(),
                pWidth, // player width, to be defined
                height = $(window).height(),
                pHeight, // player height, tbd
                $tubularPlayer = $('#tubular-player');

            // when screen aspect ratio differs from video, video must center and underlay one dimension

            if (width / options.ratio < height) { // if new video height < window height (gap underneath)
                pWidth = Math.ceil(height * options.ratio); // get new player width
                $tubularPlayer.width(pWidth).height(height).css({left: (width - pWidth) / 2, top: 0}); // player width is greater, offset left; reset top
				$tubularPlayer.parents('section.section,#tubular-container').css({'height':height});
            } else { // new video width < window width (gap to right)
                pHeight = Math.ceil(width / options.ratio); // get new player height
                $tubularPlayer.width(width).height(pHeight).css({left: 0, top: (height - pHeight) / 2}); // player height is greater, offset top; reset left
				$tubularPlayer.parents('section.section,#tubular-container').css({'height':pHeight});
            }

        }

        // events
        $(window).on('resize.tubular', function() {
            resize();
        })

        $('body').on('click','.' + options.playButtonClass, function(e) { // play button
            e.preventDefault();
            player.playVideo();
        }).on('click', '.' + options.pauseButtonClass, function(e) { // pause button
            e.preventDefault();
            player.pauseVideo();
        }).on('click', '.' + options.muteButtonClass, function(e) { // mute button
            e.preventDefault();
            (player.isMuted()) ? player.unMute() : player.mute();
        }).on('click', '.' + options.volumeDownClass, function(e) { // volume down button
            e.preventDefault();
            var currentVolume = player.getVolume();
            if (currentVolume < options.increaseVolumeBy) currentVolume = options.increaseVolumeBy;
            player.setVolume(currentVolume - options.increaseVolumeBy);
        }).on('click', '.' + options.volumeUpClass, function(e) { // volume up button
            e.preventDefault();
            if (player.isMuted()) player.unMute(); // if mute is on, unmute
            var currentVolume = player.getVolume();
            if (currentVolume > 100 - options.increaseVolumeBy) currentVolume = 100 - options.increaseVolumeBy;
            player.setVolume(currentVolume + options.increaseVolumeBy);
        })
    }

    // load yt iframe js api

    var tag = document.createElement('script');
    tag.src = "//www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // create plugin

    $.fn.tubular = function (options) {
        return this.each(function () {
            if (!$.data(this, 'tubular_instantiated')) { // let's only run one
                $.data(this, 'tubular_instantiated', 
                tubular(this, options));
            }
        });
    }

})(jQuery, window);


/*========================================================================================
 * SmoothScroll v0.9.9
 * Licensed under the terms of the MIT license.
 * People involved
 * - Balazs Galambosi: maintainer (CHANGELOG.txt)
 * - Patrick Brunner (patrickb1991@gmail.com)
 * - Michael Herf: ssc_pulse Algorithm
 *========================================================================================*/
;(function($){

    // Scroll Variables (tweakable)
    var ssc_framerate = 150; // [Hz]
    var ssc_animtime  = 500; // [px]
    var ssc_stepsize  = 150; // [px]
    
    // ssc_pulse (less tweakable)
    // ratio of "tail" to "acceleration"
    var ssc_pulseAlgorithm = true;
    var ssc_pulseScale     = 6;
    var ssc_pulseNormalize = 1;
    
    // Keyboard Settings
    var ssc_keyboardsupport = true;
    var ssc_arrowscroll     = 50; // [px]
    
    // Other Variables
    var ssc_frame = false;
    var ssc_direction = { x: 0, y: 0 };
    var ssc_initdone  = false;
    var ssc_fixedback = true;
    var ssc_root = document.documentElement;
    var ssc_activeElement;
    
    var ssc_key = { left: 37, up: 38, right: 39, down: 40, spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36 };
    
    function ssc_init(){if(!document.body)return;var a=document.body;var b=document.documentElement;var c=window.innerHeight;var d=a.scrollHeight;ssc_root=(document.compatMode.indexOf('CSS')>=0)?b:a;ssc_activeElement=a;ssc_initdone=true;if(top!=self){ssc_frame=true}else if(d>c&&(a.offsetHeight<=c||b.offsetHeight<=c)){ssc_root.style.height="auto";if(ssc_root.offsetHeight<=c){var e=document.createElement("div");e.style.clear="both";a.appendChild(e)}}if(!ssc_fixedback){a.style.backgroundAttachment="scroll";b.style.backgroundAttachment="scroll"}if(ssc_keyboardsupport){ssc_addEvent("keydown",ssc_keydown)}}var ssc_que=[];var ssc_pending=false;function ssc_scrollArray(k,l,m,n){n||(n=1000);ssc_directionCheck(l,m);ssc_que.push({x:l,y:m,lastX:(l<0)?0.99:-0.99,lastY:(m<0)?0.99:-0.99,start:+new Date});if(ssc_pending){return};var o=function(){var a=+new Date;var b=0;var c=0;for(var i=0;i<ssc_que.length;i++){var d=ssc_que[i];var e=a-d.start;var f=(e>=ssc_animtime);var g=(f)?1:e/ssc_animtime;if(ssc_pulseAlgorithm){g=ssc_pulse(g)}var x=(d.x*g-d.lastX)>>0;var y=(d.y*g-d.lastY)>>0;b+=x;c+=y;d.lastX+=x;d.lastY+=y;if(f){ssc_que.splice(i,1);i--}}if(l){var h=k.scrollLeft;k.scrollLeft+=b;if(b&&k.scrollLeft===h){l=0}}if(m){var j=k.scrollTop;k.scrollTop+=c;if(c&&k.scrollTop===j){m=0}}if(!l&&!m){ssc_que=[]}if(ssc_que.length){setTimeout(o,n/ssc_framerate+1)}else{ssc_pending=false}};setTimeout(o,0);ssc_pending=true}function ssc_wheel(a){if(!ssc_initdone){}var b=a.target;var c=ssc_overflowingAncestor(b);if(!c||a.defaultPrevented||ssc_isNodeName(ssc_activeElement,"embed")||(ssc_isNodeName(b,"embed")&&/\.pdf/i.test(b.src))){return true}var d=a.wheelDeltaX||0;var e=a.wheelDeltaY||0;if(!d&&!e){e=a.wheelDelta||0}if(Math.abs(d)>1.2){d*=ssc_stepsize/120}if(Math.abs(e)>1.2){e*=ssc_stepsize/120}ssc_scrollArray(c,-d,-e);a.preventDefault()}function ssc_keydown(a){var b=a.target;var c=a.ctrlKey||a.altKey||a.metaKey;if(/input|textarea|embed/i.test(b.nodeName)||b.isContentEditable||a.defaultPrevented||c){return true}if(ssc_isNodeName(b,"button")&&a.keyCode===ssc_key.spacebar){return true}var d,x=0,y=0;var e=ssc_overflowingAncestor(ssc_activeElement);var f=e.clientHeight;if(e==document.body){f=window.innerHeight}switch(a.keyCode){case ssc_key.up:y=-ssc_arrowscroll;break;case ssc_key.down:y=ssc_arrowscroll;break;case ssc_key.spacebar:d=a.shiftKey?1:-1;y=-d*f*0.9;break;case ssc_key.pageup:y=-f*0.9;break;case ssc_key.pagedown:y=f*0.9;break;case ssc_key.home:y=-e.scrollTop;break;case ssc_key.end:var g=e.scrollHeight-e.scrollTop-f;y=(g>0)?g+10:0;break;case ssc_key.left:x=-ssc_arrowscroll;break;case ssc_key.right:x=ssc_arrowscroll;break;default:return true}ssc_scrollArray(e,x,y);a.preventDefault()}function ssc_mousedown(a){ssc_activeElement=a.target}var ssc_cache={};setInterval(function(){ssc_cache={}},10*1000);var ssc_uniqueID=(function(){var i=0;return function(a){return a.ssc_uniqueID||(a.ssc_uniqueID=i++)}})();function ssc_setCache(a,b){for(var i=a.length;i--;)ssc_cache[ssc_uniqueID(a[i])]=b;return b}function ssc_overflowingAncestor(a){var b=[];var c=ssc_root.scrollHeight;do{var d=ssc_cache[ssc_uniqueID(a)];if(d){return ssc_setCache(b,d)}b.push(a);if(c===a.scrollHeight){if(!ssc_frame||ssc_root.clientHeight+10<c){return ssc_setCache(b,document.body)}}else if(a.clientHeight+10<a.scrollHeight){overflow=getComputedStyle(a,"").getPropertyValue("overflow");if(overflow==="scroll"||overflow==="auto"){return ssc_setCache(b,a)}}}while(a=a.parentNode)}function ssc_addEvent(a,b,c){window.addEventListener(a,b,(c||false))}function ssc_removeEvent(a,b,c){window.removeEventListener(a,b,(c||false))}function ssc_isNodeName(a,b){return a.nodeName.toLowerCase()===b.toLowerCase()}function ssc_directionCheck(x,y){x=(x>0)?1:-1;y=(y>0)?1:-1;if(ssc_direction.x!==x||ssc_direction.y!==y){ssc_direction.x=x;ssc_direction.y=y;ssc_que=[]}}function ssc_pulse_(x){var a,start,expx;x=x*ssc_pulseScale;if(x<1){a=x-(1-Math.exp(-x))}else{start=Math.exp(-1);x-=1;expx=1-Math.exp(-x);a=start+(expx*(1-start))}return a*ssc_pulseNormalize}function ssc_pulse(x){if(x>=1)return 1;if(x<=0)return 0;if(ssc_pulseNormalize==1){ssc_pulseNormalize/=ssc_pulse_(1)}return ssc_pulse_(x)}$.browser.chrome=/chrome/.test(navigator.userAgent.toLowerCase());if($.browser.chrome){ssc_addEvent("mousedown",ssc_mousedown);ssc_addEvent("mousewheel",ssc_wheel);ssc_addEvent("load",ssc_init)}

})(jQuery);
