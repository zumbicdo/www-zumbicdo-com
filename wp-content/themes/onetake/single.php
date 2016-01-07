<?php
/**
* The sigle template file.
*
*/
   get_header(); 

?>
<div id="post-<?php the_ID(); ?>" <?php post_class("clear"); ?>>
<?php if (have_posts()) :?>
<?php	while ( have_posts() ) : the_post();
         $hide_post_meta = of_get_option('hide_post_meta','no');
?>
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
                                    
                                    <?php if( $hide_post_meta == 'no' ){?>
                                        <div class="entry-meta">
                                            <div class="entry-date"><i class="fa fa-clock-o"></i><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m'));?>"><?php echo get_the_date("M d, Y");?></a></div>
                                            <div class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></div> 
                                            <div class="entry-category"><i class="fa fa-file-o"></i><?php the_category(', '); ?></div>
                                            <div class="entry-comments"><i class="fa fa-comment"></i>
                                            <?php  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'No comment');?>
                                             </div>
                                           <?php edit_post_link( __('Edit','onetake'), '<div class="entry-edit"><i class="fa fa-pencil"></i>', '</div>', get_the_ID() ); ?> 
                                        </div>
                                        <?php }?>
                                        
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
<?php get_sidebar("postright");?>
</div>
</aside>
</div>

</div>
</div>
<?php endwhile;?>
<?php endif;?>
</div>
<?php get_footer(); ?>