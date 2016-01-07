<footer id="ot-footer-container" class="footer-onepage">
<?php
  $display_footer_widget_area = of_get_option('display_footer_widget_area',0);
  if( $display_footer_widget_area == '1' ){
?>
<div class="footer-widgets">
<div class="container">
				<div class="row">
                
                	<div class="footerwidgets col-md-3">
                	<?php dynamic_sidebar('footer-1');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                 <?php dynamic_sidebar('footer-2');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                    <?php dynamic_sidebar('footer-3');?>
                    </div>
                    
                    <div class="footerwidgets col-md-3">
                    	<?php dynamic_sidebar('footer-4');?>
                    </div>
                
                </div></div>
</div>
<?php }?>
		<div class="ot-center copyright">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="ot-block-last">
							<ul class="ot-social">
							 <?php 
				
				for($i=0;$i<9; $i++){
					$social_icon  = of_get_option('social_icon_'.$i);
					$social_link  = of_get_option('social_link_'.$i);
					$social_title = of_get_option('social_title_'.$i);
					if($social_link !=""){
					echo '<li><a href="'.esc_url($social_link).'" target="_blank" data-toggle="tooltip" title="'.esc_attr($social_title).'"><i class="'.$social_icon.'"></i></a></li>';
					}
					}
					?>
		
							</ul>
							<p>&copy; <?php echo date("Y");?>, <?php printf(__('Copyright <a href="%s">Quilombola Recreation</a>. Developed by <a href="%s">Quilombola Engineering</a>.','onetake'),esc_url('http://quilombolarecreation.com/'),esc_url('http://www.quilombolaengineering.com/'));?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </footer>
	<?php wp_footer();?>
	</body>
</html>
