<?php get_header(); ?>

<?php
/*
Template Name: Home
*/
?>

<!-- BEGIN HOME PAGE -->

<?php get_template_part('modules/module-homecarousel'); ?>

<?php $is_link = get_field('statement_is_link') ? true : false;
if($is_link){ echo '<a href="'.get_field('statement_link_destination').'"'; } else { echo '<div'; };?> class="block-link statement zone-about-us">
	<div class="content">
		<h3><?php the_field('statement')?></h3>
		<?php if($is_link){ ?>
		<div class="read-more">Read Our Mission</div>
		<?php };?>
	</div>
<?php if($is_link){ echo '</a>'; } else { echo '</div>';};?>

<section class="split">
	<?php while (has_sub_field('repeater_cta')) : 
	$has_bg = get_sub_field('background_image') ? true : false;
	$link_object = get_sub_field('link_destination');
	$link_href = get_permalink($link_object->ID);
	$zone = get_zone($link_object->ID);
	?>
	<a href="<?php echo $link_href; ?>" class="block-link cta <?php echo $zone; if($has_bg){ echo ' has-bg';}; ?>">
		<?php if($has_bg){ ?>
		<div class="image">
			<img src="<?php the_sub_field('background_image'); ?>" onload="imgLoaded(this, true)"/>
		</div>
		<div class="overlay"></div>
		<?php }; ?>
		<div class="content">
			<h3><?php the_sub_field('heading'); ?></h3>
			<p><?php the_sub_field('text'); ?></p>
			<div class="btn"><?php the_sub_field('button_title'); ?></div>
		</div>
	</a>
	<?php endwhile; ?>
</section>

<?php if(get_field('featured_case_study')):
	$features = get_field('featured_case_study');
	foreach($features as $feature):
		$feature_id = $feature->ID;
		$feature_post_type = $feature->post_type;
		$even = false;
		include(locate_template('modules/module-feature.php'));
	endforeach;
endif; ?>

<?php get_template_part('modules/module-quotes'); ?>



<?php
$today = date('Ymd');
$featuredEvents = get_field('featured_event','options');
if($featuredEvents): ?>
<section class="events-list zone-education-events">
<?php 
foreach($featuredEvents as $post):

	setup_postdata($post);
	$series = get_field('event_series');
	$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
	$date = $date_obj->format('Y-m-d');
	$name = 'Featured Event';
	$title = truncate(get_the_title(), 80);
	$slug = '';
	if(get_field('event_date') >= $today):
	include(locate_template('modules/module-event.php'));
	endif;
	
endforeach; wp_reset_postdata(); ?>
</section>
<?php endif; ?>

<?php $args = array(
		'category_name' => 'news',
		'posts_per_page' => 1,
		'post_type' => 'post'
	); 

	$news = new WP_Query($args); 
	
	$args = array(
		'category_name' => 'blog',
		'posts_per_page' => 1,
		'post_type' => 'post'
	); 

	$blog = new WP_Query($args);
	
	if($news->have_posts() && $blog->have_posts()): ?>
	
	<section class="news-summary split">
	
	<?php while ( $news->have_posts() ) : $news->the_post(); ?>
	<a href="<?php the_permalink();?>" class="zone-news news">
		<h5>Latest NYGC News</h5>
		<h3><?php the_title(); ?></h3>
		<p><?php the_time('F d, Y'); ?></p>
		<div class="read-more">Learn More</div>
	</a>
	<?php endwhile; wp_reset_postdata(); 
	while ( $blog->have_posts() ) : $blog->the_post();?>
	<a href="<?php the_permalink();?>" class="zone-news blog">
		<div class="image">
		
		</div>
		<div class="content">
			<h5>From Our Blog</h5>
			<h3><?php the_title(); ?></h3>
			<p><?php the_time('F d, Y'); ?></p>
			<div class="read-more">Learn More</div>
		</div>
	</a>
	<?php endwhile; wp_reset_postdata(); ?>
	</section>

<?php endif; ?>

<?php get_template_part('modules/module-members'); ?>
	
	
<!-- END HOME PAGE -->

<?php get_footer(); ?>