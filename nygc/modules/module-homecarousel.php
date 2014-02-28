<section id="HomeCarousel" class="carousel">
	<div class="loader">
		<i></i>
	</div>
	<ul class="scrollwrapper">
		<?php if(get_field('repeater_carousel')): 
		while(has_sub_field('repeater_carousel')):
			$title = get_sub_field('slide_title');
			$link_title = get_sub_field('slide_link_title');
			$link_obj = get_sub_field('slide_link_destination');
			$link_id = $link_obj->ID;
			$link_href = get_permalink($link_id);
			$position = get_sub_field('slide_text_position');
			if(get_sub_field('slide_image')){$image = get_sub_field('slide_image');}
		?>
		<li class="slide" data-slide='{
		    "title": "<?php echo $title; ?>",
		    "linkTitle": "<?php echo $link_title; ?>",
		    "href": "<?php echo $link_href; ?>",
		    "position": "<?php echo $position; ?>",
			"zone": "<?php echo get_zone($link_id); ?>"
		}'>
		<?php if(get_sub_field('video_option')): ?>
		<video class="slider_video" width="100%" id="video_<?php echo $link_id; ?>" controls="true">
		  <source src="<?php the_sub_field('video_mp4'); ?>" type="video/mp4">
		  <source src="<?php the_sub_field('video_ogv'); ?>" type="video/ogg">
		  <source src="<?php the_sub_field('video_webm'); ?>" type="video/webm">
		  Your browser does not support HTML5 video.
		</video>
		<img style="display:none;" src="<?php bloginfo('template_url'); ?>/im/logo.svg" alt="<?php echo $title; ?>" onload="imgLoaded(this, true, true)">		
		<?php else: ?>
			<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>" onload="imgLoaded(this, true, true)">
		<?php endif; ?>
		</li>
		<?php 
		endwhile; 
		endif; ?>
	</ul>
	<div class="overlay">
		<div class="pager next" data-target="prev"></div>
		<div class="blank">
			<a href="#" class="block-link caption">
				<div class="content">
					<h2></h2>
					<div class="read-more"></div>
				</div>
			</a>
			<ul class="pager-list"></ul>
		</div>
		<div class="pager prev" data-target="next"></div>
	</div>
	
	<!-- <ul class="overlays">
		<li class="pager next" data-target="prev"></li>
		<li class="blank">
			<a href="#" class="block-link caption">
				<div class="content">
					<h2></h2>
					<div class="read-more"></div>
				</div>
			</a>
			<ul class="pager-list"></ul>
		</li>
		<li class="pager prev" data-target="next"></li>
	</ul> -->
	<div class="mobile image">
		<?php if(get_field('repeater_carousel')): 
		while(has_sub_field('repeater_carousel')): ?>
		<img src="<?php if(get_sub_field('slide_image')){the_sub_field('slide_image');} ?>" alt="<?php the_sub_field('slide_title'); ?>" onload="imgLoaded(this, false, true)">
		<?php break;
		endwhile; 
		endif; ?>
	</div>
</section>