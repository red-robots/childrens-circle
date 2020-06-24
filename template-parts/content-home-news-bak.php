<?php
$args = array(
	'posts_per_page'   => 3,
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish'
);
$placeholder = get_bloginfo("template_url") . "/images/square.png";
$blogs = new WP_Query($args);
if ( $blogs->have_posts() ) {  ?>
<div id="newsItems" class="news-entries cf entries-wrapper">
	<?php while ( $blogs->have_posts() ) : $blogs->the_post();
		$postId = get_the_ID();
		$thumbId = get_post_thumbnail_id($postId);
		$image = wp_get_attachment_image_src($thumbId,'medium_large');
		$style = ($image) ? ' style="background-image:url('.$image[0].')"':'';
		$content = get_the_content();
		if($content) {
			$content = strip_shortcodes($content);
			$content = strip_tags($content);
			$content = shortenText($content, 90, " ", "...");
		}
		$postdate = get_the_date('m/d/Y');
		$pagelink = get_the_permalink();
	?>
	<article id="entry-<?php the_ID() ?>" class="post-item">
		<div class="inner cf">
			<div class="postdate"><span><?php echo $postdate ?></span></div>
			<div class="thumb <?php echo ($image) ? 'hasimage':'noimage'; ?>"<?php echo $style ?>>
				<a href="<?php echo $pagelink ?>"><img src="<?php echo $placeholder ?>" alt="" aria-hidden="true" /></a>
			</div>
			<div class="text">
				<h2 class="ptitle"><a href="<?php echo $pagelink ?>"><?php echo get_the_title(); ?></a></h2>
				<div class="excerpt"><?php echo $content; ?></div>
			</div>
		</div>
	</article>
	<?php endwhile; wp_reset_postdata(); ?>
</div>
<div class="buttondiv">
	<a href="#" class="seemore"><span>See More</span></a>
</div>
<?php } ?>