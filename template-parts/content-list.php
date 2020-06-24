<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ACStarter
 */
$per_page = (get_option( 'posts_per_page' )) ? get_option( 'posts_per_page' ) : 10;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("template-list"); ?>>
	<section class="col-1">
		
		<?php $read_more_text = get_field("read_more_text","option");
		$wp_query_holder = $wp_query;
		if(!is_archive()):
			$args = array(
				'post_type'=>'post',
				'paged'=>$paged,
				'posts_per_page'=>$per_page
			);
			$wp_query = new WP_Query($args);?>
		<?php endif;
		if(have_posts()):?>
			<div class="post-list">
				<?php while(have_posts()): the_post();?>
					<div class="post">
						<h2 class="posttitle"><?php the_title();?></h2>
						<div class="copy">
							<?php the_excerpt();?>
						</div><!--.copy-->
						<a class="button" href="<?php the_permalink();?>">Read More</a>
					</div><!--.post-->
				<?php endwhile;?>
			</div><!--.post-list-->
		<?php endif;?>
		<nav class="pagination">
			<?php pagi_posts_nav();?>
		</nav>
		<?php $wp_query = $wp_query_holder;?>
	</section><!--.col-2-->
	<?php get_template_part("template-parts/archives-recent");?>
</article><!-- #post-## -->
