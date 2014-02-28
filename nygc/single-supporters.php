<?php get_header(); ?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>

<script>
	var peopleGroup = {
		name: '<?php echo $name; ?>',
		slug: '<?php echo $slug; ?>'
	};
</script>

<a href="<?php echo site_url();?>/support-us" class="back-to">
	<span>&laquo;&nbsp;&nbsp;Back to Support Us</span>
</a>

<!-- BEGIN PAGE CONTENT -->

	<section class="page single-person" id="SinglePerson">
		<div class="content wysiwyg">
			
			<h5>NYGC Supporter</h5>
			
			<h2><?php the_title(); ?></h2>

			<div class="image single-col">
				<img alt="<?php the_title();?>" src="<?php the_field('image');?>" onload="imgLoaded(this,true)">
			</div>
			
			
			<?php if(get_field('quote')):
				echo '<blockquote><p>'.get_field('quote').'</p></blockquote>';
			endif;?>
			
			<?php the_content(); ?>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>