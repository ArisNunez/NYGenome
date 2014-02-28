<div class="image video loading" id="Video">
	<div class="wrapper">
		<div class="player">
			<video id="VideoJS" class="video-js" preload="auto" width="100%" height="100%" onloadedmetadata="videoLoaded(this)">
				<?php while(has_sub_field('video_files')):?>
				<source src="<?php the_sub_field('mp4_file'); ?>" type='video/mp4'/>
				<source src="<?php the_sub_field('webm_file'); ?>" type='video/webm'/>
				<source src="<?php the_sub_field('ogv_file'); ?>" type='video/ogg'/>
				<?php endwhile;?>
			</video>
			<?php if(get_field('use_image') == 1): ?>
			<div class="image">
				<img src="<?php the_field('image'); ?>" onload="imgLoaded(this,true)" alt="<?php the_field('video_title'); ?>"/>
			</div>
			<?php elseif(get_field('video_poster_image')): ?>
			<div class="image">
				<img src="<?php the_field('video_poster_image'); ?>" onload="imgLoaded(this,true)" alt="<?php the_field('video_title'); ?>"/>
			</div>
			<?php endif; ?>
			<div class="overlay"></div>
			<?php if(get_field('video_title')): ?>
			<div class="video-title">
				<h4><?php the_field('video_title'); ?></h4>
			</div>
			<?php endif; ?>
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