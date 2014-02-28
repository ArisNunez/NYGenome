<!DOCTYPE html>
<html lang="en">
	<head>
		<?php 
		if(get_post_type() == 'page'):
			$description = get_field('page_summary') ? get_field('page_summary') : get_field('global_seo_description','options');
		else:
			$description = get_the_excerpt() ? get_the_excerpt() : get_field('global_seo_description','options');
		endif;?>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=320, initial-scale=1, user-scalable=1"/>
		<!--[if lt IE 9]>
			<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<![endif]-->
		
		<meta name="description" content="<?php echo $description; ?>"/>
		<meta property="og:description" content="<?php echo $description; ?>"/> 
		<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?>"/>
		<meta property="og:image" content="<?php the_field('open_graph_image','options');?>"/>
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
<?php if(get_post_type() == 'post'): ?>
		<meta property="og:type" content="article"/>
		<?php else: ?>
		<meta property="og:type" content="website"/>
		<?php endif; ?>
		
		<!--

		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     `"MMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM        `MMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM         'MMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     `"MMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM        `MMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM         'MMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMM     MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM
		MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMM

		Built by Barrel NY
	
		http://www.barrelny.com

		-->
		
		<link type="text/plain" rel="author" href="<?php bloginfo('template_url'); ?>/humans.txt" />

		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
			<script src="<?php bloginfo('template_url'); ?>/js/selectivizr-min.js"></script>
		<![endif]-->
		
		<?php global $theme_version; ?>
		
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_url'); ?>/im/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/style.min.css?ver=<?php echo $theme_version; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/nygc-colors/zone-colors.css?ver=<?php echo $theme_version; ?>"/>
		<link rel="alternate" type="application/rss+xml" title="New York Genome Center News Feed" href="<?php bloginfo('url');?>/feed/" />

		<?php wp_head(); ?>
		
		<script type="text/javascript" src="//use.typekit.net/fxb2rxi.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

		<title><?php wp_title( '|', true, 'right' ); bloginfo( 'name' ); ?></title>	
	</head>
	
<!-- BEGIN HEADER -->
	
	<?php
	if(!is_404() && !is_search()):
		$page_id = preg_replace('/[^A-Za-z]/', '', get_the_title()); 
		$post_type = $post->post_type;
		if($post_type == 'page'){
			$parent = $post->post_parent ? $post->post_parent : $post->ID;
			$parent_title = get_the_title($parent);
			if(
				(strpos($parent_title,'Contact Us') !== false) || 
				(strpos($parent_title,'Terms') !== false) ||
				(strpos($parent_title,'Privacy') !== false)
			){
				$zone_class = 'zone-default';
			} else {
				$zone_class = 'zone-'.strtolower(preg_replace('/\s+/', "-", trim(preg_replace('/[^A-Za-z]/', " ", $parent_title)))); 
			};
		} elseif($post_type == 'people') {
			$parent_title = 'People';
			$zone_class = 'zone-people';
		} elseif($post_type == 'series' || $post_type == 'events'){
			$parent_title = 'Education & Events';
			$zone_class = 'zone-education-events';
		} elseif($post_type == 'post'){
			$parent_title = 'News';
			$zone_class = 'zone-news';
		} elseif($post_type == 'jobs'){
			$parent_title = 'Careers';
			$zone_class = 'zone-careers';
		} elseif($post_type == 'supporters'){
			$parent_title = 'Support Us';
			$zone_class = 'zone-support-us';
		};
	else:
		$parent_title = '';
		$zone_class = 'zone-default';
	endif;
	?>
	
	<body id="<?php echo $page_id; ?>" class="<?php echo $zone_class; ?>">
		<nav class="mobile-nav mobile" id="MobileNav">
			<?php
				$args = array('theme_location' => 'primary', 'container' => false, 'link_before' => '<span>', 'link_after' => '</span>');
		        wp_nav_menu($args);
			?>
		</nav>
		<header class="mobile-header mobile just">
			<div class="btn hamburger" id="FixedHamburger"></div>
			<!--<div class="btn search" id="FixedSearch"></div>-->
		</header>
		<div>
			<header class="header just">
				<nav>
					<a href="<?php echo home_url(); ?>"><h1 class="logo">New York Genome Center</h1></a>
					<?php
						$args = array('theme_location' => 'primary', 'container' => false, 'link_before' => '<span>', 'link_after' => '</span>', 'depth' => 1);
				        wp_nav_menu($args);
					?>
					<?php if(is_front_page()):?>
					<div class="mobile">
						<a href="<?php echo home_url();?>/contact-us" class="btn zone-default">Contact Us</a>
						<a href="<?php echo home_url();?>/genomics" class="btn zone-genomics">Work With Us</a>
					</div>
					<?php endif;?>
				</nav>
				<aside>
					<?php if(get_field('researcher_login','options')): ?>

<!--
					<a href="http://<?php the_field('researcher_login','options');?>" target="_blank"><span>Leadership Portal</span></a>
-->

<?php
if ( is_user_logged_in() ) {
?>

<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Logout"><span>Logout</span></a>

<?php
} else {
?>

<a href="http://www.nygenome.org/wp-login.php?loginFacebook=1&redirect=/leadership-portal"><span>Leadership Portal</span></a>

<?php
}
?>


					<?php endif; ?>
					<div class="btn-wrap">
						<div class="btn search">
							<div class="trigger" id="SearchButton"></div>
							<form id="SearchForm" onsubmit="return site.analytics.events.search(this)">
								<input type="search" name="s" autocomplete="off"/>
							</form>
						</div>
						<a href="<?php echo home_url();?>/genomics" class="btn zone-genomics">Work With Us</a>
						<a href="<?php echo home_url();?>/careers" class="btn zone-careers">Careers</a>
						<a href="<?php echo home_url();?>/support-us" class="btn zone-support-us">Support Us</a>
					</div>
				</aside>
			</header>
			
			<?php if(!is_front_page() && wp_get_nav_menu_object($parent_title)) : ?>
			<section class="sub-nav max-left" id="SubNav">
				<?php
					$args = array('menu' =>  $parent_title, 'container' => false, 'link_before' => '<span>', 'link_after' => '</span>', 'depth' => 1);
				   	wp_nav_menu($args);
				?>
			</section>
			<?php endif; ?>
	
<!-- END HEADER -->	

		
		
		
