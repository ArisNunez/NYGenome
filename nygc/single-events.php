<?php get_header(); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); 

$categories = get_the_terms($post->ID, 'event-types');
$category = array_shift(array_values($categories));
$name = $category->name;
$slug = $category->slug;

?>	
	
<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>	
	
<?php 

$featured_id = null;
$event_id = $post->ID;

$featured_events = get_field('featured_event','options');
if($featured_events):
	foreach($featured_events as $featured_event):
		$featured_id = $featured_event->ID;
	endforeach;
endif; ?>
	
<!-- BEGIN PAGE CONTENT -->

	<section class="page single-event">
		<div class="content wysiwyg">
			
			<?php if ($event_id == $featured_id): ?>
				<h5 class="featured-event">Featured Event</h5>
			<?php endif;
			
			if($name): ?>
			<h5><?php echo $name; ?></h5>
			<?php endif; ?>
			
			<h2><?php the_title();?></h2>
			
			<?php $serieses = get_field('event_series');
				if($serieses):
					foreach($serieses as $series): 
					$title = get_the_title($series->ID);
					$permalink = get_permalink($series->ID);	
					?>	
					<p class="series-alert">This event is part of 
						<a href="<?php echo $permalink; ?>">
							<strong><?php echo $title; ?> &raquo;</strong>
						</a>
					</p>
					<?php endforeach;
				endif;
			?>
			
			
			<?php 
			$has_video = false;
			if(get_field('video_files')){
			while(has_sub_field('video_files')){
				$has_video = get_sub_field('ogv_file') ? true : false;
				$has_video = get_sub_field('mp4_file') ? true : false;
				$has_video = get_sub_field('webm_file') ? true : false;			
			}};
			if($has_video):?>
				<?php get_template_part('modules/module-video'); ?>
			<?php elseif(get_field('image')): ?>
			<div class="image">
				<img alt="<?php the_title(); ?>" src="<?php the_field('image'); ?>" onload="imgLoaded(this,true)"/>
			</div>
			<?php endif; ?>
			
			
			
			<div class="content-wrapper">
			
			<aside class="content-meta">
				<?php $date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
				$end_date_obj = DateTime::createFromFormat('Ymd', get_field('event_end_date'));
				?>
				
				<p><strong><?php echo $date_obj->format('F j, Y'); ?></strong>
				<?php if(get_field('event_is_multiday') == 'true'):
				echo '<strong> -<br/> '.$end_date_obj->format('F j, Y').'</strong>';
				endif;?><br/><span class="info"><?php the_field('event_time');?></span></p>
				
				<p class="info"><?php the_field('event_location');?><br/>
				<?php the_field('event_address');?></p>
				
				<?php if(get_field('ticketed_event')): ?>
				<?php the_field('ticket_information');?>
				<a href="http://<?php the_field('eventbrite_ticket_purchase_link'); ?>" target="_blank" class="btn">Register</a>
				
				<?php endif; ?>	
				
			</aside>
			
			<?php the_content(); ?>
			
			</div>
			
			<?php $serieses = get_field('event_series');
				if($serieses):
					foreach($serieses as $series): 
					$title = get_the_title($series->ID);
					$permalink = get_permalink($series->ID);	

					$today = date('Ymd');

					$args=array(
						'meta_key' => 'event_date',
						'orderby' => 'meta_value',
						'order' => 'asc',
						'posts_per_page' => 100,
						'post_type' => 'events',
						'post__not_in' => array($event_id),
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key' => 'event_date',
								'value' => $today,
								'compare' => '>='
							),
							array(
								'key' => 'event_series',
								'value' => '"'.$series->ID.'"',
								'compare' => 'LIKE'
							)
						)
					);

					query_posts($args); 

					if(have_posts()): ?>
							
					<hr/>
					<h4>More Upcoming Events in <?php echo $title; ?>:</h4>

					<ul>

					<?php
						while(have_posts()):
							the_post(); 
							$title = truncate(get_the_title(), 80);
							$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
							?>
							
							<li>
								<a href="<?php the_permalink(); ?>"><strong><?php echo $title; ?></strong></a><br/> 
								<?php echo $date_obj->format('F j, Y'); ?>
							</li>

						<?php endwhile; wp_reset_query(); ?>
						</ul>
					 <?php endif; ?>
					
					
					<?php endforeach;
				endif;
			?>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>

<?php get_footer(); ?>