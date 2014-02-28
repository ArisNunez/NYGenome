<?php get_header(); ?>

<?php
/*
Template Name: Members List (U5)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

<?php
if(get_field('repeater_member_groups')) :
while( has_sub_field('repeater_member_groups')) :?>

<div class="people-grid members">
	<h3><?php the_sub_field('member_group_heading'); ?></h3>
	
	<?php $members = get_sub_field('relationship_members');
	if($members):
 	foreach($members as $post):
	setup_postdata($post); ?>
		<a href="http://<?php the_field('member_institution_link'); ?>" target="_blank" class="person" title="<?php the_title(); ?>">
			<div class="image">
				<img src="<?php the_field('member_institution_logo'); ?>" alt="<?php the_title(); ?>" onload="imgLoaded(this, true)"/>
			</div>
			<div class="overlay"></div>
		</a>
	<?php endforeach;
	wp_reset_postdata();
	endif; ?>
	
</div>
<?php endwhile; 
endif; ?>

<?php endwhile; 
endif; ?>

<?php get_footer(); ?>