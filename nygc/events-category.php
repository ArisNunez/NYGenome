<?php get_header(); ?>

<?php
/*
Template Name: Events Category Overview (U4-C)
*/
?>

<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<section class="banner wysiwyg">
	<h2><?php the_title(); ?></h2>
	
	<?php the_content(); ?>
	
	<?php $series = get_field('event_series');
	
	if($series): ?>
	<hr/>
	
	<h3><?php the_title(); ?> Event Series</h3>
	
	<ul>
		<?php foreach($series as $post): 
			setup_postdata();
			echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
		endforeach; 
		wp_reset_postdata();?> 
	<ul>
	
	<?php endif; ?>
	
</section>
	
<?php 

$today = date('Ymd');

$args=array(
	'meta_key' => 'event_date',
	'orderby' => 'meta_value',
	'event-types' => $post->post_name,
	'order' => 'asc',
	'paged' => 1, 
	'posts_per_page' => 10, 
	'post_type' => 'events',
	'meta_query' => array(
		array(
			'key' => 'event_end_date',
			'value' => $today,
			'compare' => '>'
		)
	)
);

query_posts($args); 

if(have_posts()): ?>
	
<section class="events-list filtering" id="EventsList" data-category="<?php echo $post->post_name; ?>">

<?php

while(have_posts()):
	the_post(); 
	$series = get_field('event_series');
	$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
	$date = $date_obj->format('Y-m-d');
	$categories = get_the_terms($post->ID, 'event-types');
	$category = array_shift(array_values($categories));
	$name = $category->name;
	$slug = $category->slug;
	$title = truncate(get_the_title(), 80);
	include(locate_template('modules/module-event.php'));

endwhile; wp_reset_query();?>

</section>

<div class="load-more" id="LoadMore">
	<span>See More Upcoming in <?php the_title(); ?></span>
</div>

<?php else: ?>

</section>
	
<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>


<?php get_footer(); ?>