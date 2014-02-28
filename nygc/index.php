<?php get_header(); ?>

<?php
/*
Template Name: News/Blog Landing (U4)
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

<?php endwhile; endif; ?>




<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'category_name' => $category,
	'posts_per_page' => 10,
	'paged' => $paged,
	'post_type' => 'post'
);

$myquery = new WP_Query($args); 

if($myquery->have_posts()): ?>
<div class="seo"><?php
echo paginate_links( array(
    'current' => max( 1, get_query_var('paged') ),
    'total' => $myquery->max_num_pages
) );

?></div>
<section class="events-list filtering" id="EventsList">
<?php
	while($myquery->have_posts()):
		
		$myquery->the_post();
		
		include(locate_template('modules/module-post.php'));
		
	endwhile; 
	wp_reset_postdata(); ?>
	
</section>

<div class="load-more" id="LoadMore" data-cat="<?php echo $category; ?>" data-posttype="post">
	<span>See Older <?php the_title(); ?> Posts</span>
</div>
	
<?php endif; ?>




<?php get_footer(); ?>