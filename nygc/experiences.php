<?php get_header(); ?>

<?php
/*
Template Name: Collaborator Experiences (U8)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

	
	<?php if(get_field('collaborator_experiences')):
		$features = get_field('collaborator_experiences');
		$count = 0;
		foreach($features as $feature):
			$feature_id = $feature->ID;
			$feature_post_type = $feature->post_type;
			$even = $count % 2 == 0 ? true : false;
			$count++;
			include(locate_template('modules/module-feature.php'));
		endforeach;
	endif; ?>


<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>