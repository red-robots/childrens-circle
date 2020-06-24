<?php
/**
 * Template Name: News
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<header class="entry-header cf">
				<h1 class="entry-title">
					<?php if(is_archive()):
						the_archive_title();
					else:
						the_title();
					endif;?>
				</h1>
			</header>


			<?php
			if ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'list' );

			endif; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
