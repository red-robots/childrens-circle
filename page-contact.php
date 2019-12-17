<?php
/**
 * Template Name: Contact
 */

get_header(); ?>

<div id="primary" class="content-area cf">
	<main id="main" data-id="<?php the_ID(); ?>" class="site-main wrapper contactpage cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php 
				$contact_form = get_field("contact_form"); 
				$google_map = get_field("google_map"); 
				$main_text = '';
				ob_start();
				echo the_content();
				$main_text = ob_get_contents();
				ob_end_clean();
				$email_obfuscate = ($main_text) ? email_obfuscator($main_text) : '';
			?>

			<header class="entry-header text-center cf">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<div class="col-left">
					<?php if ( get_the_content() ) { ?>
						<?php echo $email_obfuscate; ?>
					<?php } ?>
					<?php if ($contact_form) { ?>
					<div class="contact-form-wrap">
						<?php echo $contact_form ?>
					</div>	
					<?php } ?>
				</div>
				
				<?php if ($google_map) { ?>
				<div class="col-right">
					<?php echo $google_map ?>
				</div>
				<?php } ?>
			</div>
			

			<?php $sections = get_field("sections"); ?>
			<?php if ($sections) { ?>
				<?php $i=1; foreach ($sections as $s) { 
					$title = $s['title'];
					$copy = $s['copy'];
					$image = $s['section_image'];
					$menu_title = $s['menu_title'];
					$rowclass = ( ($title || $copy) &&  $image ) ? 'half':'full';
					$slug = ($title) ? sanitize_title($title) : '';
				?>
				<div id="tprow<?php echo $i?>" class="row-content <?php echo $rowclass ?>">
					<?php if ($title || $copy) { ?>
					<div class="sectioncol text">
						<?php if ($title) { ?>
						<h2 class="title"><?php echo $title; ?></h2>	
						<?php } ?>
						<?php if ($copy) { ?>
						<div class="copy"><?php echo $copy; ?></div>	
						<?php } ?>
					</div>	
					<?php } ?>

					<?php if($image) { ?>
					<div class="sectioncol image">
						<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" />
					</div>	
					<?php } ?>
				</div>	
				<?php $i++; } ?>
			<?php } ?>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
