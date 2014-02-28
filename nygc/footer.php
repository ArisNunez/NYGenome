<!-- BEGIN FOOTER -->
		
		<footer class="footer">
			<div class="upper">
				
				<?php if (have_posts() && !is_404() && !is_search()):
				while (have_posts()) : the_post();
				
				if(get_field('footer_call_to_action')){
					the_field('footer_call_to_action');
				} else {
					the_field('footer_call_to_action','options');
				};
				
				endwhile; 
				else:
					the_field('footer_call_to_action','options');
				endif;?>
		
				<div class="just">
					<?php while(has_sub_field('repeater_footer_boxes','options')): ?>
					<div class="col wysiwyg">
						<h5><?php the_sub_field('heading'); ?></h5>
						<?php the_sub_field('text');
						if(get_sub_field('links')):
						while(has_sub_field('links','options')):?>
						<a class="read-more" href="<?php the_sub_field('link_destination'); ?>"><?php the_sub_field('link_title'); ?></a><br/>
						<?php endwhile; 
						endif; ?>
					</div>
					<?php endwhile;?>
				</div>
			</div>
			<div class="lower just">
				<p>&copy; 2013 New York Genome Center. All rights reserved.</p>
				<aside>
					<a href="<?php echo home_url();?>/support-us" class="btn zone-support-us">Support Us</a>
					<?php if(get_field('social_media_links','options')):
					$counter = 0;
					$name = 'LinkedIn';
					$class = 'li';
					while(has_sub_field('social_media_links','options')):
					if($counter == 1){
						$name = 'Twitter';
						$class = 'tw';
					} elseif($counter == 2){
						$name = 'Facebook';
						$class = 'fb';
					};
					$counter++;
					?>
					<a href="http://<?php the_sub_field('link');?>" target="_blank" class="btn social <?php echo $class; ?>"><?php echo $name;?></a>
					<?php endwhile; endif; ?>
				</aside>
			</div>
		</footer>
	</div>
	
	<script type="text/javascript">
	
	if(window.location.hostname.indexOf('www.nygenome.org') > -1){
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-26399939-1']);
		_gaq.push(['_trackPageview']);
		
		(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	};
	
	<?php if(is_search()): ?>
		_gaq.push(['_trackPageview', '/search/?s=<?php urlencode(the_search_query()); ?>']);
	<?php endif; ?>	
		
	</script>
	
	<?php wp_footer(); ?>
	
</body>
</html>
		
<!-- END FOOTER -->