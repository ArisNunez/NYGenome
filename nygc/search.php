<?php get_header(); ?>

	
<!-- BEGIN PAGE CONTENT -->

	<section class="page">
		<div class="content wysiwyg">
			
			
			<?php
						
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			$args = array(
				's' => get_query_var('s'),
				'posts_per_page' => 10,
				'paged' => $paged,
			);

			$search = new WP_Query($args);
			
			?>
			
			<h2>Search Results</h2>
			
			<?php
			$startpost=1;
			$startpost=10*($paged - 1)+1;
			$endpost = (10*$paged < $search->found_posts ? 10*$paged : $search->found_posts);
			?>
			
			<?php if($endpost > 0): ?>
			<p><?php ?>Showing results <?php echo $startpost; ?> - <?php echo $endpost; ?> of <?php echo $wp_query->found_posts; ?> for &ldquo;<?php the_search_query(); ?>&rdquo;</p>
			<?php endif; ?>
			
			<?php if($search->have_posts()): ?>
			<p>	<?php
				if($endpost > 0):
				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max(1 , $paged ),
					'total' => $wp_query->max_num_pages
				) );
				
				endif;
				?></p>
			
			<?php while ($search->have_posts()) : $search->the_post(); 
				$post_type = get_post_type();
				$post_type = $post_type == 'post' ? 'News &amp; Blog' : $post_type;
				$post_type = $post_type == 'series' ? 'Event Series' : $post_type;
				$id = get_the_ID();
				$zone = get_zone($id);
			?>
				<hr/>
				
				<div class="<?php echo $zone; ?>">
					
					<?php if($post_type != 'page'):?>
					<h5><?php echo $post_type; ?></h5>
					<?php endif; ?>
				
					<h4><?php search_title_highlight(); ?></h4>
					
					<p><a class="read-more <?php echo $zone; ?>" href="<?php the_permalink(); ?>"><?php the_permalink(); ?></a></p>
					
					<?php search_excerpt_highlight(); ?>
				
					<p><a class="read-more <?php echo $zone; ?>" href="<?php the_permalink(); ?>">Read more</a></p>
				
				</div>
				
				
			<?php endwhile; ?>
			<hr/><p>	<?php
				if($endpost > 0):
				$big = 999999999; // need an unlikely integer

				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' => '?paged=%#%',
					'current' => max(1 , $paged ),
					'total' => $wp_query->max_num_pages
				) );
				
				endif;
				?></p>
			
			<?php endif; wp_reset_query(); ?>
			
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>



<?php get_footer(); ?>