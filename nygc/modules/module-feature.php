<?php 

if($feature_post_type == 'case-studies' || $feature_post_type == 'experiences'){
	$heading = 'Collaborator Experience';
	$type = get_field('case_study_type',$feature_id) ? ': '.get_field('case_study_type',$feature_id) : '';
	$quote = get_field('quote',$feature_id);
	$author = get_the_title($feature_id);
	$institution = get_field('institution',$feature_id);
	$link = site_url().'/genomics/collaborator-experiences';
	$link_text = 'See more collaborator experiences';	
}elseif($feature_post_type == 'supporters'){
	$heading = 'Supporter Spotlight';
	$quote = get_field('quote',$feature_id);
	$author = get_the_title($feature_id);
	$institution = get_field('position',$feature_id);
	$link = get_permalink($feature_id);
	$link_text = 'Learn more';	
};

$zone = get_zone($feature_id);
$image = get_field('image',$feature_id);
$image_align = get_field('image_alignment',$feature_id);
$sidebar = is_page_template('page.php') ? 'sidebar-' : '';



if(is_page_template('experiences.php')):?>

<div class="<?php echo $sidebar; ?>feature no-link <?php echo $zone; ?>">
	<?php if($even && !is_page_template('page.php')): ?>
	<div class="image attach-<?php echo $image_align; ?>">
		<img src="<?php echo $image; ?>" alt="<?php echo $heading; echo ' '.$author?>" onload="imgLoaded(this, true)"/>
	</div>
	<?php endif; ?>
	<div class="content">
		<h5><?php echo $heading;  echo $type; ?></h5>
		<blockquote>
			<span><?php echo $quote; ?></span>
			
			<div class="name"><?php echo $author; ?></div>
			<p><?php echo $institution; ?></p>
		</blockquote>
	</div>
	<?php if(!$even): ?>
	<div class="image attach-<?php echo $image_align; ?>">
		<img src="<?php echo $image; ?>" alt="<?php echo $heading; echo ' '.$author?>" onload="imgLoaded(this, true)"/>
	</div>
	<?php endif; ?>
</div>

<?php else: ?>

<a href="<?php echo $link; ?>" class="block-link <?php echo $sidebar; ?>feature <?php echo $zone; ?>">
	<?php if($even && !is_page_template('page.php')): ?>
	<div class="image attach-<?php echo $image_align; ?>">
		<img src="<?php echo $image; ?>" alt="<?php echo $heading; echo ' '.$author?>" onload="imgLoaded(this, true)"/>
	</div>
	<?php endif; ?>
	<div class="content">
		<h5><?php echo $heading; ?></h5>
		<blockquote>
			<span><?php echo $quote; ?></span>
			
			<div class="name"><?php echo $author; ?></div>
			<p><?php echo $institution; ?></p>
		</blockquote>
		<footer>
			<div class="read-more"><?php echo $link_text; ?></div>
		</footer>
	</div>
	<?php if(!$even): ?>
	<div class="image attach-<?php echo $image_align; ?>">
		<img src="<?php echo $image; ?>" alt="<?php echo $heading; echo ' '.$author?>" onload="imgLoaded(this, true)"/>
	</div>
	<?php endif; ?>
</a>

<?php endif; ?>