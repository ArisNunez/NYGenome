<?php 
$is_job = false;
if(get_post_type() == 'post'){
	$time = get_the_time('F j, Y');
} else if(get_post_type() == 'jobs'){
	$is_job = true;
	$cats = get_the_terms($post->ID, 'departments');
	$name = '';
	if($cats){
		$category = '';
		$name = '';
		foreach ( $cats as $cat ) {
			$category .= $cat->slug." ";
			$name .= $cat->name;
		};
	};
	$time = '';//'Posted: '.get_the_time('F j, Y');
};?>

<a href="<?php the_permalink();?>" class="block-link mix event <?php echo $category; ?>">
	<?php if(!$is_job): ?>
	<div class="image align-<?php the_field('image_alignment'); ?>">
		<?php if(get_field('image')): ?>
		<img src="<?php the_field('image'); ?>" alt="<?php the_title();?>" onload="imgLoaded(this, true)"/>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	<div class="content">
		<h5><?php echo $name; ?></h5>

		<h3><?php echo truncate(get_the_title(), 100); ?></h3>

		<div class="event-meta">
			<?php if(get_field('author_name')):
			echo '<p>'.get_field('author_name').'</p>';
			endif; ?>
			<time datetime="<?php echo get_the_time('Y-m-d');?>"><?php echo $time; ?></time>
			<div class="read-more">Learn more</div>
		</div>
	</div>
</a>