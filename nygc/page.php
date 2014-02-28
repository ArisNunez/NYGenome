<?php get_header(); ?>

<?php
/*
Template Name: Generic (U1)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
	
<!-- BEGIN PAGE CONTENT -->

	<section class="page">
		<div class="content wysiwyg">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>