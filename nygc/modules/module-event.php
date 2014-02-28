<a href="<?php the_permalink();?>" class="blocklink mix event <?php echo $slug; echo ' '.$featured; echo "m".$date_obj->format('m'); echo " wk".$date_obj->format('W');?>">
	<div class="image align-<?php the_field('image_alignment'); ?>">
		<?php if(get_field('image')): ?>
		<img src="<?php the_field('image'); ?>" alt="<?php echo $title; ?>" onload="imgLoaded(this, true)"/>
		<?php endif; ?>
		<div class="date">
			<span><?php echo $date_obj->format('D. M'); ?></span>
			<span class="lrg"><?php echo $date_obj->format('d'); ?></span>
		</div>
	</div>
	<div class="content">
		<?php if($name):?>
		<h5 class="<?php echo $featured;?>"><?php echo $name; ?></h5>
		<?php endif;
		if($series):
		foreach($series as $aseries):?>	
			<h5 class="series"><?php echo get_the_title($aseries->ID); ?></h5>
		<?php 
		endforeach;
		endif; ?>

		<h3><?php echo $title; ?></h3>

		<div class="event-meta">
			<p><?php the_field('event_location'); ?></p>
			<time datetime="<?php echo $date_obj->format('Y-m-d'); ?>"><?php 
			if(get_field('event_is_multiday') == 'true'):
				$end_date_obj = DateTime::createFromFormat('Ymd', get_field('event_end_date'));
				if($date_obj->format('F') == $end_date_obj->format('F')):
					echo $date_obj->format('F j').' - '.$end_date_obj->format('j, Y');
				else:
					echo $date_obj->format('F j').' - '.$end_date_obj->format('F j, Y');
				endif;
			else:	
				the_field('event_time'); 
			endif;
			?></time>
			<div class="read-more">Learn more</div>
		</div>
	</div>
</a>