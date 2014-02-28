<?php get_header(); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
<?php
$group = get_the_terms($post->ID, 'people-groups');
$group = array_shift(array_values($group));
$name = $group->name;
$slug = $group->slug;
$suffixes = get_field('academic_suffix') ? ', '.get_field('academic_suffix') : '';
?>

<script>
	var peopleGroup = {
		name: '<?php echo $name; ?>',
		slug: '<?php echo $slug; ?>'
	};
</script>

<a href="<?php echo site_url().'/people/'.$slug; ?>" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to <?php echo $name; ?></span>
</a>

<!-- BEGIN PAGE CONTENT -->

	<section class="page single-person" id="SinglePerson">
		<div class="content wysiwyg">
			
			<?php
			if(get_field('institution')):
				echo '<p class="info">'.get_field('institution').'</p>';
			endif;
			?>
			<h5><?php the_field('position'); ?></h5>
			
			<h2><?php the_title(); echo $suffixes; ?></h2>

			<div class="image single-col">
				<img alt="<?php the_title();?>" src="<?php the_field('image');?>" onload="imgLoaded(this,true)">
			</div>
			
			<?php the_content(); ?>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>