<?php get_header(); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); 

if(get_post_type() == 'post'){
$categories = get_the_category();
$category = array_shift(array_values($categories));
$name = $category->name;
$slug = $category->slug == 'blog' ? 'news/blog' : 'news';
$time = get_the_time('F d, Y');

?>	
<script>
	var blogPost = {
		name: '<?php echo $name; ?>',
	};
</script>
<?php } elseif(get_post_type() == 'jobs'){ 

$name = 'Careers';
$slug = 'careers';
$time = 'Posted: '.get_the_time('F d, Y');

		
}; ?>
	
<a href="<?php echo site_url(); ?>/<?php echo $slug; ?>" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to <?php echo $name; ?></span>
</a>	

<!-- BEGIN PAGE CONTENT -->

	<section class="page single-event" id="SinglePost">
		<div class="content wysiwyg">
			
			<h2><?php the_title();?></h2>
			
			<span class="info"><?php echo $time; ?></span></p>
			
			<?php 
			$has_video = false;
			if(get_field('video_files')){
			while(has_sub_field('video_files')){
				$has_video = get_sub_field('mp4_file') ? true : false;
			}};
			if($has_video):?>
				<?php get_template_part('modules/module-video'); ?>
			<?php elseif(get_field('image')): ?>
			<div class="image">
				<img alt="<?php the_title(); ?>" src="<?php the_field('image'); ?>" onload="imgLoaded(this,true)"/>
			</div>
			<?php endif; ?>
			
			<?php the_content(); ?>
			
			<?php if(get_field('author_bio')):?>
			<hr/>
			
			<h4>About <?php the_field('author_name'); ?></h4>
			
			<p><?php the_field('author_bio'); ?></p>
			<?php endif;?>
		
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<a href="<?php echo site_url(); ?>/<?php echo $slug; ?>" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to <?php echo $name; ?></span>
</a>

<?php get_footer(); ?>