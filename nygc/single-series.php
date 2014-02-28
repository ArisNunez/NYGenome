<?php get_header(); ?>

<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<section class="banner wysiwyg">
	<h2><?php the_title(); ?></h2>
	
	<?php the_content(); ?>
	
</section>
	
<?php 

$today = date('Ymd');

$args=array(
	'meta_key' => 'event_date',
	'orderby' => 'meta_value',
	'order' => 'asc',
	'posts_per_page' => 100,
	'post_type' => 'events',
	'meta_query' => array(
		'relation' => 'AND',
		array(
			'key' => 'event_end_date',
			'value' => $today,
			'compare' => '>='
		),
		array(
			'key' => 'event_series',
			'value' => '"'.get_the_ID().'"',
			'compare' => 'LIKE'
		)
	)
);

query_posts($args); 

if(have_posts()): ?>
	
<section class="events-list no-filter">

<?php

while(have_posts()):
	the_post(); 
	$series = get_field('event_series');
	$series_title;
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
	
<?php endif; ?>

<?php endwhile; ?>
<?php endif; ?>

<a href="<?php echo site_url(); ?>/education-events" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Offerings</span>
</a>


<?php get_footer(); ?>