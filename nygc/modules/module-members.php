<section class="members-carousel" id="MembersCarousel">
	<h5>Our Members</h5>
	<div class="container">
		<div class="scrollwrapper">
			<?php
			$members = get_field('members');
			foreach($members as $member):
				$id = $member->ID;
				$name = get_the_title($id);
				$logo = get_field('member_institution_logo',$id);
				$link = get_field('member_institution_link',$id);
			?>
			<a href="http://<?php echo $link; ?>" target="_blank" class="slide image">
				<img src="<?php echo $logo; ?>" alt="<?php echo $name; ?>" onload="imgLoaded(this)"/>
			</a>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="pager prev" data-target="prev"></div>
	<div class="pager next" data-target="next"></div>
</section>