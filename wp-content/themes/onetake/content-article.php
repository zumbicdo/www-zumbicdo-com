<article class="entry-box text-left">
                            <?php 
							global $onetake_sidebar;
							$featured_image = "no-img";
							$hide_post_meta = of_get_option('hide_post_meta','no');
							if ( has_post_thumbnail() && $onetake_sidebar != "both") {
							$featured_image = "";
								?>
 
								<div class="entry-aside">
									<a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail("blog");?>
                                    </a>
								</div>
                                <?php }?>

								<div class="entry-main <?php echo $featured_image ;?>">
									<div class="entry-header">
                                    <a href="<?php the_permalink();?>"><h1 class="entry-title"><?php the_title();?></h1></a>
                                    <?php if( $hide_post_meta == 'no' ){?>
										<div class="entry-meta">
											<div class="entry-date"><i class="fa fa-clock-o"></i><a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m'));?>"><?php echo get_the_date("M d, Y");?></a></div>
											<div class="entry-author"><i class="fa fa-user"></i><?php echo get_the_author_link();?></div> 
											<div class="entry-category"><i class="fa fa-file-o"></i><?php the_category(', '); ?></div>
                                            <div class="entry-tags"><i class="fa fa-tags"></i><?php the_tags(); ?></div>
											<div class="entry-comments"><i class="fa fa-comment"></i><?php  comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'No comment');?></div>
											<?php edit_post_link( __('Edit','onetake'), '<div class="entry-edit"><i class="fa fa-pencil"></i>', '</div>', get_the_ID() ); ?> 
										</div>
                                        <?php }?>
										
									</div>
									<div class="entry-summary"><?php the_excerpt();?></div>
									<div class="entry-footer">
										<a href="<?php the_permalink();?>"><div class="entry-more"><?php _e("Read More","onetake");?>&gt;&gt;</div></a>
									</div>
								</div>
                                <div class="clear"></div>
							</article>