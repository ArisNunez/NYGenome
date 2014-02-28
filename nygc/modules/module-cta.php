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