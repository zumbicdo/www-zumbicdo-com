<?php
/**
* The page template file.
*
*/
   get_header(); 

?>
<div id="page-<?php the_ID(); ?>" <?php post_class("clear"); ?>>
<?php if (have_posts()) :?>
<?php	while ( have_posts() ) : the_post();?>
<div id="main" class="clearfix container">
<div class="row">
<div class="breadcrumb-box">
 <?php onetake_breadcrumb_trail(array("before"=>"","show_browse"=>false));?>
        </div>
<div class="col-md-9">
<section class="blog-main text-center" role="main">
                            <article class="post-entry text-left">
                                <div class="entry-main no-img">
                                    <div class="entry-header">
                                    <h1 class="entry-title"><?php the_title();?></h1>
                                    </div>
                                    <div class="entry-content">
                                       <?php the_content();?>	
                                       <?php  wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'onetake' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );?>
                                    </div>
                                </div>
                            </article>
                            <div class="comments-area text-left">
                             <?php
									echo '<div class="comment-wrapper">';
									comments_template(); 
									echo '</div>';
                                  ?>    
                            </div>
                        </section>
</div>
<div class="col-md-3">
<aside class="sidebar">
<div class="widget-area">
<?php get_sidebar("pageright");?>
</div>
</aside>
</div>

</div>
</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_footer(); ?>