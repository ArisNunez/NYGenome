<?php get_header(); ?>

<?php
/*
Template Name: People List (U5)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<?php get_template_part('modules/module-banner'); ?>
	
<?php if(get_field('president')):
$presidents = get_field('president');
foreach($presidents as $post):
	setup_postdata($post); 
	$permalink = get_permalink();
	$title = get_the_title();
	$image = get_field('image');
	$position = get_field('position');
	$suffixes = get_field('academic_suffix') ? ', '.get_field('academic_suffix') : '';
	$attach = get_field('image_alignment');
?>	
<a href="<?php echo $permalink; ?>" class="block-link feature president">
	<div class="image attach-<?php echo $attach; ?>">
		<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" onload="imgLoaded(this, true)"/>
	</div>
	<div class="content wysiwyg">
		<h4 class="name"><?php echo $title; echo $suffixes?></h4>
		<p><?php echo $position; ?></p>
		
		<?php the_excerpt(); ?>
		<footer>
			<div class="read-more">Learn More</div>
		</footer>
	</div>
</a>

<?php endforeach;
wp_reset_postdata();
endif; ?>

<?php
if(get_field('repeater_people_groups')) :
while( has_sub_field('repeater_people_groups')) :?>

<div class="people-grid people">
	<h3><?php the_sub_field('people_group_heading'); ?></h3>
	
	<?php $people = get_sub_field('relationship_people');
	if( $people ):
 	foreach( $people as $post):
	setup_postdata($post); 
	$position = get_field('position');
	$suffixes = get_field('academic_suffix') ? ', '.get_field('academic_suffix') : '';
	?>
		<a href="<?php the_permalink(); ?>" class="person">
			<div class="image">
				<?php if(get_field('image')): ?>
				<img src="<?php the_field('image'); ?>" alt="<?php the_title(); ?>" onload="imgLoaded(this, true)"/>
				<?php endif; ?>
			</div>
			<div class="content wysiwyg">
				<h4 class="name"><?php the_title(); echo $suffixes;?></h4>
				<p>
					<?php echo truncate($position, 70); 
					if($position && get_field('institution')){ echo '<br/>';}; ?>
					<span class="institution"><?php the_field('institution'); ?></span>
				</p>
			</div>
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