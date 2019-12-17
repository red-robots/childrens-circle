<?php
/**
 * Template Name: Sitemap
 */

get_header(); ?>

<div id="primary" class="content-area cf">
	<main id="main" data-id="<?php the_ID(); ?>" class="site-main wrapper default cf" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<header class="entry-header text-center cf">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
			<div class="entry-content">
				<?php get_template_part('template-parts/content','sitemap'); ?>
			</div>

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
