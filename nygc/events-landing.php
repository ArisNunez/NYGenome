<?php get_header(); ?>

<?php
/*
Template Name: Events Landing (U4)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

<section class="overview">
	<div class="sub-pages">
	<?php if(get_field('sub_pages')): 
	$sub_pages = get_field('sub_pages');
	$counter = 0;
	foreach($sub_pages as $sub_page):
		if($counter == 4) :
		break;
		endif;

		$id = $sub_page->ID;
		$title = get_the_title($id);
		$permalink = get_permalink($id);
		$page_summary = get_field('page_summary',$id); ?>
		
		
	
		<a href="<?php echo $permalink; ?>" class="block-link wysiwyg has-image">
			<div class="image">
				<img src="<?php the_field('image',$id);?>" alt="<?php echo $title; ?>" onload="imgLoaded(this, true)"/>
			</div>
			<div class="content">
				<h4><?php echo $title; ?></h4>
				<p><?php echo $page_summary; ?></p>
				<div class="read-more">Learn More</div>
			</div>
		</a>
		
	<?php $counter++; 
	endforeach; 
	endif; ?>
	
<?php endwhile; 
endif; ?>
	</div>
</section>



<?php

$today = date('Ymd');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args=array(
	'meta_key' => 'event_date',
	'orderby' => 'meta_value',
	'order' => 'asc',
	'paged' => $paged,
	'posts_per_page' => 10, 
	'post_type' => 'events',
	'meta_query' => array(
		array(
			'key' => 'event_end_date',
			'value' => $today,
			'compare' => '>=',
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
	<div class="showing-from" id="ShowingFrom"><p>Showing events on and after <span id="StartDate"></span>:</p></div>
	<span>Filter events by </span>
	<ul>
		<li class="filter" data-filter="all">All</li>
		<?php if(get_field('sub_pages')): 
		$sub_pages = get_field('sub_pages');
		foreach ($sub_pages as $sub_page){

			echo '<li class="filter" data-filter="featured-event '.$sub_page->post_name.'">'.$sub_page->post_title.'</li>';
		}
			echo '<li class="filter" data-filter="featured-event m' . date('m') . '">This Month</li>';
			echo '<li class="filter" data-filter="featured-event wk' . date('W') . '">This Week</li>';
		endif; ?>
	</ul>
	<div class="pick-a-date">
		<span id="PickADate">Pick a date </span>
		<div class="menu" id="DatePicker">
		</div>
	</div>
</nav>

<section class="events-list filtering" id="EventsList">
	<div class="no-results" id="NoResults">
		<h3>No Events Found</h3>
	</div>
<?php	$featured_id = null;

	$featuredEvents = get_field('featured_event','options');
	if($featuredEvents): ?>
	
	<?php 
	foreach($featuredEvents as $post):

		setup_postdata($post);
		$featured_id = $post->ID;
		$featured = 'featured-event';
		$series = get_field('event_series');
		$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
		$date = $date_obj->format('Y-m-d');
		$name = 'Featured Event';
		$slug = '';
		$title = truncate(get_the_title(), 80);

		if(get_field('event_date') >= $today || get_field('event_end_date') >= $today):
		include(locate_template('modules/module-event.php'));
		endif;

	endforeach; wp_reset_postdata(); endif;
	
	$featured = ''; 

while($myquery->have_posts()):
	$myquery->the_post(); 
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

<div class="load-more" id="LoadMore">
	<span>See More Events</span>
</div>

<?php else: ?>

<section class="events-list filtering fail" id="EventsList">
	<div class="no-results" id="NoResults">
		<h3>No Events Found</h3>
	</div>
</section>

<div class="load-more" id="LoadMore">
	<span>See More Events</span>
</div>
	
<?php endif; ?>




<?php get_footer(); ?>