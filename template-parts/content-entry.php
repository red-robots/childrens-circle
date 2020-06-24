<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post">
		<h2 class="posttitle"><?php the_title();?></h2>
		<div class="copy">
			<?php the_excerpt();?>
		</div><!--.copy-->
		<a class="button" href="<?php the_permalink();?>">Read More</a>
	</div><!--.post-->
</article>