<?php
/**
 * The category template file.
 *
 * @since onetake 1.0.0
 */

get_header(); ?>
<div class="breadcrumb-box">
             <div class="container">
            <?php onetake_breadcrumb_trail(array("before"=>"","show_browse"=>false));?>
            </div>
        </div>
<div class="blog-list">
			<div class="container">
				<div class="row">
					<div class="col-md-9">
						<section class="blog-main text-center" role="main">
							
                            <?php if (have_posts()) :?>
                            <div class="blog-list-wrap">
                    <?php while ( have_posts() ) : the_post(); 
					
					    get_template_part("content","article");
					?>
                   <?php endwhile;?>
                   </div>
                   <?php endif;?>
                            		<div class="list-pagition text-center">
							<?php onetake_native_pagenavi("echo",$wp_query);?>
							</div>
						</section>
					</div>
                    <div class="col-md-3">
						<aside class="blog-side left text-left">
							<div class="widget-area">
						<?php get_sidebar( 'category' ); ?>
							</div>
						</aside>
					</div>
				</div>
			</div>	
		</div>
<?php get_footer(); ?>