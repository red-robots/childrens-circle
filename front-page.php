<?php get_header(); ?>
<div id="primary" class="content-area cf">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
			$text1 = get_field('main_text'); 
			$image1 = get_field('feat_image'); 
			$colClass = ($text1 && $image1) ? 'half':'full';
		?>
		
		<?php if ($text1 || $image1) { ?>
		<section class="section intro <?php echo $colClass ?>">
			<div class="wrapper flexwrap">
				<?php if ($text1) { ?>
				<div class="flexcol textcol">
					<div class="inside"><?php echo $text1 ?></div>
				</div>
				<?php } ?>
				<?php if ($image1) { ?>
				<div class="flexcol imagecol">
					<img src="<?php echo $image1['url'] ?>" alt="<?php echo $image1['title'] ?>" />
				</div>
				<?php } ?>
			</div>
		</section>	
		<?php } ?>
	<?php endwhile; ?>

	<?php /* THREE COLUMNS */ ?>
	<section class="section news-section">
		<div class="wrapper">
			<div class="flexwrap">
				<div class="flexcol col-news yellow">
					<div class="inside">
						<div class="icon">
							<?php include_once(get_template_directory().'/images/book.svg'); ?>
						</div>
						<div class="textwrap cf">
							<h2 class="hd">News</h2>
						</div>
					</div>
				</div>

				<div class="flexcol col-calendar purple">
					<div class="inside">
						<div class="icon">
							<?php include_once(get_template_directory().'/images/calendar.svg'); ?>
						</div>
						<div class="textwrap cf">
							<h2 class="hd">Calendar</h2>
						</div>
					</div>
				</div>

				<div class="flexcol col-facebook blue">
					<div class="inside">
						<div class="icon">
							<?php include_once(get_template_directory().'/images/facebook.svg'); ?>
						</div>
						<div class="textwrap cf">
							<h2 class="hd">Facebook Posts</h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</div><!-- #primary -->
<?php
get_footer();
