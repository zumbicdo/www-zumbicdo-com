<?php
/**
* The sigle template file.
*
*/
   get_header(); 

?>
<div id="post-404-not-found" <?php post_class("clear"); ?>>

<div id="main" class="clearfix container">
<div class="row">
<div class="breadcrumb-box">
 <?php onetake_breadcrumb_trail(array("before"=>"","show_browse"=>false));?>
        </div>
<div class="col-md-9">
<section class="blog-main text-center" role="main">
                            <article class="post-entry text-left">
                                <div class="entry-main no-img">
                                    <div class="entry-content">
                                       <?php 
									$page_404_content = of_get_option('page_404_content');
									echo esc_html($page_404_content) ;
									?>
                                    
                                    </div>
                                </div>
                            </article>
                        </section>
</div>
<div class="col-md-3">
<aside class="sidebar">
<div class="widget-area">
 <?php get_sidebar( '404' ); ?>
</div>
</aside>
</div>

</div>
</div>
</div>
<?php get_footer(); ?>