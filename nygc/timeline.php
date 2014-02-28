<?php get_header(); ?>

<?php
/*
Template Name: Timeline (U7)
*/
?>
<section class="page">
	<div class="content wysiwyg detached-intro">
		<h2><?php the_title(); ?></h2>
		<h3><?php the_field('intro_text'); ?></h3>
	</div>
</section>

<section class="timeline" id="Timeline">
	
	<?php if(get_field('timeline')):?>
		
		<?php $current_year = null; ?>
		<?php $index = 0; ?>
		
		<?php while(has_sub_field('timeline')): ?>
			
			<?php $new_year = get_sub_field('year'); ?>
			
			<?php if($new_year !== $current_year): ?>
			<?php $current_year = $new_year; ?>
			<?php if(!$index): ?>
			<div class="year track-down">
			<?php else: ?>
			<div class="year track-down track-up">	
			<?php endif; ?>
				<span><?php echo $current_year;?></span>
			</div>
			<?php endif; ?>
			
			<article class="entry track-down track-up">
				<div class="marker"></div>
				<div class="entry-wrapper">
					<?php if(get_sub_field('entry_type')): ?>
					<h5><?php the_sub_field('entry_type'); ?></h5>
					<?php endif; ?>
					<?php $month = get_sub_field('month'); ?>
					<?php $day = get_sub_field('day'); ?>
					<h3><strong><?php echo $month; if($day){echo ' '.$day;}; echo ' '.$current_year; ?></strong><br/>
					<?php the_sub_field('entry_title'); ?></h3>
					
					<?php $media = get_sub_field('add_media');?>
					
					<?php if($media == 'Image'): ?>
					<div class="image">
						<img src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('entry_title'); ?>" onload="imgLoaded(this, true)"/>
					</div>	
					<?php elseif($media == 'Video'): ?>
					<div class="video loading">
						<div class="wrapper">
							<div class="player">
								<video id="VideoJS<?php echo $index; ?>" class="video-js" preload="auto" width="101%" height="100%" onloadedmetadata="videoLoaded(this)">
									<?php while(has_sub_field('video_files')):?>
									<source src="<?php the_sub_field('mp4_file'); ?>" type='video/mp4'/>
									<source src="<?php the_sub_field('webm_file'); ?>" type='video/webm'/>
									<source src="<?php the_sub_field('ogv_file'); ?>" type='video/ogg'/>
									<?php endwhile;?>
								</video>
								<div class="overlay"></div>
								<div class="controls">
									<div class="play-pause"></div>
									<div class="scrubber">
										<div class="total">
											<div class="buffered"></div>
											<div class="current"></div>
										</div>
										<div class="time"><span class="elapsed">0:00</span> / <span class="dur">0:00</span></div>
									</div>
									<div class="volume">
										<div class="bar"></div>
										<div class="bar"></div>
										<div class="bar"></div>
										<div class="bar"></div>
										<div class="bar"></div>
										<div class="bar"></div>
										<div class="sensor"></div>
									</div>
									<div class="full-screen"></div>
								</div>
							</div>
						</div>
					</div>	
					<?php endif; ?>
					
					<div class="content wysiwyg">
						<?php the_sub_field('content'); ?>
					</div>
					<?php $link = get_sub_field('link_title'); ?>
					<?php if($link): ?>
					<footer class="wysiwyg">
						<p><a href="<?php the_sub_field('link_destination'); ?>" class="read-more"><?php echo $link; ?></a></p>
					</footer>
					<?php endif; ?>
				</div>
			</article>
			
			<?php $index++; ?>
		<?php endwhile;?>
		
	<?php endif; ?>

	<div class="spacer track-down">
	</div>
	
</section>

<?php get_footer(); ?>
