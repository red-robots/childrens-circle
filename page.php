<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header(); ?>

<div id="primary" class="content-area cf">
	<main id="main" class="site-main wrapper default cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="entry-header text-center cf">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<?php if ( get_the_content() ) { ?>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php } ?>
			

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
