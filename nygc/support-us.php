<?php get_header(); ?>

<?php
/*
Template Name: Support Us Overview (U6)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>

<?php $sub_pages = get_field('sub_pages');

if($sub_pages): 
$count = count($sub_pages);	
?>
<section class="support-us">
<?php foreach($sub_pages as $post):
	setup_postdata($post); ?>
	<a href="<?php the_permalink(); ?>" class="block-link detail">
		<div class="image">
			<img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>" onload="imgLoaded(this, true)"/>
		</div>
		<div class="content wysiwyg">
			<h4><?php the_title(); ?></h4>
			<div class="wysiwyg">
				<p><?php the_field('page_summary'); ?></p>
				
				<div class="read-more">Learn More</div>
			</div>
		</div>
	</a>
<?php endforeach; wp_reset_postdata();
	if($count == 5): 
		if(get_field('fall_back_cta')):
		while(has_sub_field('fall_back_cta')):
		$link_object = get_sub_field('link_destination');
		$link_href = get_permalink($link_object->ID);
		$zone = get_zone($link_object->ID);
		?>
		<a href="<?php echo $link_href; ?>" class="cta detail <?php echo $zone; ?>">
			<div class="content wysiwyg">
				<h4><?php the_sub_field('heading')?></h4>
				<div class="wysiwyg">
					<p><?php the_sub_field('text'); ?></p>
				
					<div class="btn"><?php the_sub_field('button_title'); ?></div>
				</div>
			</div>
		</a>
		<?php endwhile; endif; ?>
	<?php endif;?>
</section>
<?php endif; ?>

<?php if(get_field('featured_supporter')):
	$features = get_field('featured_supporter');
	foreach($features as $feature):
		$feature_id = $feature->ID;
		$feature_post_type = $feature->post_type;
		include(locate_template('modules/module-feature.php'));
	endforeach;
endif; ?>

<?php if(get_field("supporters")): ?>
	<div class="supporters">
		<h5>Our Supporters</h5>
		<div class="content wysiwyg">
			<ul>
				<?php while(has_sub_field("supporters")): ?>
					<li><a target="_blank" href="<?php the_sub_field('supporter_link'); ?>"><?php the_sub_field('supporter_name'); ?></a></li>
					<li></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
<?php endif; ?>


<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>