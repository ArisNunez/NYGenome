<?php get_header(); ?>

<?php
/*
Template Name: Support Us Sub-Page (U1)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
	
<a href="<?php echo site_url(); ?>/support-us" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Support Us</span>
</a>
	
<!-- BEGIN PAGE CONTENT -->

	<section class="page">
		<h2 class="seo"><?php the_title(); ?></h2>
		<div class="content wysiwyg">
			<h2><?php the_title(); ?></h2>
			
			<?php if(get_field('image')): ?>
			<div class="image single-col">
				<img alt="<?php the_title();?>" src="<?php the_field('image');?>" onload="imgLoaded(this,true)">
			</div>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>
	
<a href="<?php echo site_url(); ?>/support-us" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Support Us</span>
</a>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>