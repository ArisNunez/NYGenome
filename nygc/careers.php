<?php get_header(); ?>

<?php
/*
Template Name: Careers Landing (U4)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<div class="banner wysiwyg">
	<h2><?php the_title(); ?></h2>
	<?php the_content(); ?>
</div>

<?php 
$category = $post->post_name; 
$name = get_the_title();
?>






<?php

$openings = get_field('current_openings');
if($openings): ?>
<nav class="events-filters jobs" id="EventFilters">
	<span>Filter openings by: </span>
	<ul>
		<li class="filter" data-filter="all">All</li>
		<?php 
		$departments = get_terms('departments' ,'');
		foreach ($departments as $department){
			echo '<li class="filter" data-filter="'.$department->slug.'">'.$department->name.'</li>';
		}
		?>
	</ul>
</nav>
<section class="events-list jobs filtering" id="EventsList">
<div class="no-results" id="NoResults">
	<h3>No Openings Found</h3>
</div>
<?php 
	foreach($openings as $post):
		setup_postdata($post);
		include(locate_template('modules/module-post.php'));
	endforeach;
	wp_reset_postdata(); ?>
</section>	
<?php endif; ?>


<?php endwhile; endif; ?>

<?php get_footer(); ?>