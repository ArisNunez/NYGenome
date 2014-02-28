<!-- BEGIN SIDEBAR -->

		<aside class="sidebar two-col">
		<?php if (!is_search()):
			if('people' == get_post_type() || 'supporters' == get_post_type()): 
				if(get_field('image')): ?>
				<div class="image person-image">
					<img src="<?php the_field('image');?>" alt="<?php the_title();?>" onload="imgLoaded(this)"/>
				</div>
			<?php endif;
			endif; ?>
		
			<?php if(get_field('repeater_widgets') || 'events' == get_post_type()): 
				while(has_sub_field('repeater_widgets') || ('events' == get_post_type() && has_sub_field('repeater_widgets','options'))):
					if(get_sub_field('feature')):
						$features = get_sub_field('feature');
						foreach($features as $feature):
							$feature_id = $feature->ID;
							$feature_post_type = $feature->post_type;
							include(locate_template('modules/module-feature.php'));
						endforeach;
					else:
						$has_bg = get_sub_field('background_image') ? true : false;
						$link_object = get_sub_field('link_destination');
						$link_href = get_permalink($link_object->ID);
						$zone = get_zone($link_object->ID);	
						include(locate_template('modules/module-cta.php'));
					endif;
				endwhile;
			endif; ?>
		
			<?php if('events' == get_post_type()):
				$date_obj = DateTime::createFromFormat('Ymd', get_field('event_date'));
				$day = $date_obj->format('d');
		 		$month = $date_obj->format('m');  
			    $year = $date_obj->format('Y');
				$length = 0;
		
				if(get_field('event_is_multiday')):
					$startdate = strtotime(get_field('event_date'));
					$enddate = strtotime(get_field('event_end_date'));
					$datediff = $enddate - $startdate;
					$length = floor($datediff/(60*60*24));
				endif;	
			
				echo build_calendar($day, $month,$year, $length);
			endif;
		endif?>
			
		</aside>
		
<!-- END SIDEBAR -->