<?php get_header(); ?>

<?php
/*
Template Name: Past Events (U4-B)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

<?php endwhile; ?>
<?php endif; ?>
	
<?php 

$today = date('Ymd');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args=array(
	'meta_key' => 'event_date',
	'orderby' => 'meta_value',
	'order' => 'desc',
	'paged' => $paged, 
	'posts_per_page' => 10, 
	'post_type' => 'events',
	'meta_query' => array(
		array(
			'key' => 'event_end_date',
			'value' => $today,
			'compare' => '<'
		)
	)
);

$myquery = new WP_Query($args); 

if($myquery->have_posts()): ?>

<div class="seo"><?php
echo paginate_links( array(
    'current' => max( 1, get_query_var('paged') ),
    'total' => $myquery->max_num_pages
) );

?></div>

<nav class="events-filters" id="EventFilters">
	<span>Filter events by: </span>
	<ul>
		<li class="filter" data-filter="all">All</li>
		<?php 
		$industries = get_terms('event-types' ,'');
		foreach ($industries as $industry){
			echo '<li class="filter" data-filter="'.$industry->slug.'">'.$industry->name.'</li>';
		}
		?>
	</ul>
</nav>

<section class="events-list filtering" id="EventsList">
	<div class="no-results" id="NoResults">
		<h3>No Past Events Found</h3>
	</div>
<?php

while($myquery->have_posts()):
	$myquery->the_post(); 
	print_r(get_field('event_end_date'));
	if($post->ID != $featured_id):
		$series = get_field('event_series');
		$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
		$date = $date_obj->format('Y-m-d');
		$categories = get_the_terms($post->ID, 'event-types');
		$category = array_shift(array_values($categories));
		$name = $category->name;
		$slug = $category->slug;
		$title = truncate(get_the_title(), 80);
		include(locate_template('modules/module-event.php'));
	endif;
	
endwhile; wp_reset_postdata();?>

</section>

<div class="load-more past" id="LoadMore">
	<span>See Older Events</span>
</div>

<?php else: ?>

<section class="events-list filtering fail" id="EventsList">
	<div class="no-results" id="NoResults">
		<h3>No Past Events Found</h3>
	</div>
</section>

<div class="load-more past" id="LoadMore">
	<span>See Oler Events</span>
</div>
	
<?php endif; ?>

<?php get_footer(); ?>