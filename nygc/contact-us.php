<?php get_header(); ?>

<?php
/*
Template Name: Contact Us (U1)
*/
?>

<?php if (have_posts()): ?>
<?php while (have_posts()) : the_post(); ?>
	
<!-- BEGIN PAGE CONTENT -->

	<section class="page">
		<h2 class="seo"><?php the_title(); ?></h2>
		<div class="content wysiwyg">
			<h2><?php the_title(); ?></h2>
			<?php the_content(); ?>
			
			<form class="form" id="ContactForm" data-action="<?php the_permalink(); ?>">
				
				<div class="mask"></div>
				
				<div class="light loader">
					<i></i>
				</div>
				
				<label class="info instruction"><em><span>*</span> Required field</em></label>
				
				<fieldset class="just">
					<div class="field half">
						<label>First Name <span>*</span></label>
						<input type="text" name="input_12.3"/>
					</div>
					<div class="field half">
						<label>Last Name <span>*</span></label>
						<input type="text" name="input_12.6"/>
					</div>
					<div class="field">
						<label>Institution</label>
						<input type="text" name="input_2"/>
					</div>
					<div class="field half">
						<label>Email Address <span>*</span></label>
						<input type="text" name="input_3"/>
					</div>
					<div class="field half">
						<label>Contact Number <span>*</span></label>
						<input type="text" name="input_4"/>
					</div>
				</fieldset>
				
				<fieldset id="Reasons">
					<label>Reason(s) for Contact</label>
					<?php if(get_field('reasons_for_contacting')):
					$counter = 0;
					while(has_sub_field('reasons_for_contacting')): 
					$counter++;
					if($counter % 10 === 0){
						$counter++;	
					};
					$reason = get_sub_field('reason');
					$id = '';
					if($reason == 'Sequencing'){
						$id = 'id="CheckSequencing"';
					} elseif($reason == 'Other'){
						$id = 'id="CheckOther"';
					};
					
					$email = '';
					if(get_field('enable_copy_to')){
						$email = get_sub_field('associated_email');
					};
					?>
					<div class="checkbox">
						<input name="input_5.<?php echo $counter; ?>" value="<?php echo $reason; ?>" type="checkbox" data-copyto="<?php echo $email ?>" <?php echo $id;?>>
						<label><?php echo $reason;?></label>
					</div>
					<?php endwhile; 
					endif; ?>
				</fieldset>
				
				<div class="field hidden" id="OtherReason">
					<label>If Other, please specify:</label>
					<input type="text" name="input_9"/>
				</div>
				
				<fieldset class="just hidden" id="SequencingOptions">
					<?php if(get_field('types_of_sequencing')): ?>
					<div class="field half">
						<label>Type of Sequencing</label>
						<select class="dropdown" name="input_6">
							<option class="label">Select type</option>
							<?php while(has_sub_field('types_of_sequencing')): ?>
							<option value="<?php the_sub_field('sequencing_type')?>"><?php the_sub_field('sequencing_type')?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<?php endif; ?>
					<?php if(get_field('number_of_samples')): ?>
					<div class="field half">
						<label>Number of Samples</label>
						<select class="dropdown" name="input_7">
							<option class="label">Select number</option>
							<?php while(has_sub_field('number_of_samples')): ?>
							<option value="<?php the_sub_field('number')?>"><?php the_sub_field('number')?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<?php endif; ?>
				</fieldset>
				
				<div class="field">
					<label>Tell Us More <span>*</span></label>
					<p>If you are contacting us about a project, please note that our Sequencing Managers will ask to set up a phone with you for more details.</p>
					<textarea name="input_8"></textarea>
				</div>
				
				<div class="btn" id="Submit">Send Message</div>
				
				<input type="hidden" name="input_11" id="SendCopyTo">
				<input type="hidden" name="is_submit_1" value="1">
				<input type="hidden" name="gform_submit" value="1">
				<input type="hidden" name="gform_unique_id" value="">
				<input type="hidden" name="state_1" value="WyJhOjA6e30iLCJkNzE0NTNhYThmNWI0YTEzNjhlMmMyZmIxOWZjZTBlMyJd">
				<input type="hidden" name="gform_target_page_number_1" id="gform_target_page_number_1" value="0">
				<input type="hidden" name="gform_source_page_number_1" id="gform_source_page_number_1" value="1">
				<input type="hidden" name="gform_field_values" value="">
				
			</form>
			
			<div id="ThankYou" style="display: none;">
				<?php the_field('thank_you_message');?>
			</div>
			
			<hr class="last"/>
		</div>
		
<!-- END PAGE CONTENT -->

<?php get_sidebar(); ?>

	</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>