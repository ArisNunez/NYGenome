<?php get_header(); ?>

<?php
/*
Template Name: Details List (U3)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

<?php if(get_field('repeater_details')) : 
$counter = 0;
?>
<section class="services split">
<?php while( has_sub_field('repeater_details')) :
	if($counter % 2 == 0 && $counter != 0) : ?>
	</section>
	<section class="services split">
	<?php endif; ?>
	<div class="detail">
		<div class="image">
			<img src="<?php the_sub_field('detail_image')?>" alt="<?php the_sub_field('detail_heading'); ?>" onload="imgLoaded(this, true)"/>
		</div>
		<div class="content">
			<h4><?php the_sub_field('detail_heading'); ?></h4>
			<div class="wysiwyg">
				<?php the_sub_field('detail_description'); ?>
			</div>
		</div>
	</div>
	
<?php $counter++; 
endwhile; ?>
</section>
<?php endif; ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>