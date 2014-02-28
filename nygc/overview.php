<?php get_header(); ?>

<?php
/*
Template Name: Overview (U2)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>


<section class="overview">
	<?php if(get_field('link_intro') == 1):?>
	<a href="<?php the_field('intro_link_destination');?>" class="intro">
	<?php else: ?>
	<div class="intro">
	<?php endif; ?>
		<div class="content wysiwyg">
			<h2><?php the_field('intro_heading');?></h2>
			<h3><?php the_field('intro_text');?></h3>
			
			
			<?php if(get_field('link_intro') == 1):?>
			<div class="read-more lrg"><?php the_field('intro_link_title'); ?></div>
			<?php endif; ?>
		</div>
		<div class="image">
			<a class="link_box_top" href="/genomics/sequencing/"></a>
			<a class="link_box_right" href="/genomics/bioinformatics-analysis/"></a>
			<a class="link_box_bottom" href="/genomics/high-performance-computing/"></a>
			<a class="link_box_left" href="/genomics/experimental-design/"></a>
			<!--<svg width="96" height="96">
			  <image xlink:href="<?php //the_field('intro_image'); ?>" src="<?php //the_field('jpg_intro_image'); ?>" width="96" height="96" onload="imgLoaded(this, true)"/>
			</svg>-->
			<?php if(!islteIE9()):?>
			<img src="<?php the_field('intro_image'); ?>" alt="<?php the_field('intro_heading');?>" onload="imgLoaded(this, true)"/>
			<?php else: ?>
			<img src="<?php the_field('jpg_intro_image'); ?>" alt="<?php the_field('intro_heading');?>" onload="imgLoaded(this, true)"/>	
			<?php endif;?>
		</div>
	<?php if(get_field('link_intro') == 1):?>
	</a>
	<?php else: ?>
	</div>
	<?php endif; ?>
	<div class="sub-pages">
	<?php if(get_field('sub_pages')): 
	$sub_pages = get_field('sub_pages');
	$counter = 0;
	foreach($sub_pages as $sub_page):
		if($counter == 4) :
		break;
		endif;

		$id = $sub_page->ID;
		$title = get_the_title($id);
		$permalink = get_permalink($id);
		$page_summary = get_field('page_summary',$id); ?>
		
		
	
		<a href="<?php echo $permalink; ?>" class="block-link content wysiwyg">
			<div class="content">
				<h4><?php echo $title; ?></h4>
				<p><?php echo $page_summary; ?></p>
				<div class="read-more">Learn More</div>
			</div>
		</a>
		
	<?php $counter++; 
	endforeach; ?>
	</div>
	
	<?php if(count($sub_pages) == 5) :
		$id = $sub_pages[4]->ID;
		$title = get_the_title($id);
		$permalink = get_permalink($id);
		$page_summary = get_field('page_summary',$id);	
	?>
	<a href="<?php echo $permalink; ?>" class="block-link hero-sub-page">
		<div class="image">
			<img src="<?php the_field('hero_sub_page_image');?>" alt="<?php echo $permalink; ?>" onload="imgLoaded(this, true)"/>
		</div>
		<div class="content wysiwyg">
			<h4><?php echo $title; ?></h4>
			<p><?php echo $page_summary; ?></p>
			<div class="read-more">Learn More</div>
		</div>
	</a>
	<?php endif;
	endif;?>
</section>
	
	<?php if(get_field('featured_case_studies')):
		$features = get_field('featured_case_studies');
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