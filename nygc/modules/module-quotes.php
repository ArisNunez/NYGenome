<section class="quotes" id="Quotes">
	<h5>From the NYGC Community</h5>
	<?php while (has_sub_field('repeater_quotes')) :  ?>
	<blockquote class="slide">
		<div class="content">
			<span><?php the_sub_field('quote_text'); ?></span>
			<footer>
				<div class="name"><?php the_sub_field('quote_attribution_line_1'); ?></div>
				<p><?php the_sub_field('quote_attribution_line_2'); ?></p>
			</footer>
		</div>
	</blockquote>
	<?php endwhile; ?>
	<ul class="pager-list"></ul>
</section>