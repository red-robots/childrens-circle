<aside class="archives-recent">
	<div class="recent">
		<header><h2>Recent</h2></header>
		<?php $args = array(
			'post_type'=>'post',
			'posts_per_page'=>10,
			'orderby'=>'date',
			'order'=>'ASC',
		);
		$query = new WP_Query($args);
		if($query->have_posts()):?>
			<ul class="list">
				<?php while($query->have_posts()):$query->the_post();?>
					<li><a href="<?php the_permalink();?>"><?php the_title();?></a></li>
				<?php endwhile;?>
			</ul><!--.list-->
		<?php wp_reset_postdata();
		endif;?>
	</div><!--.archives-->
	<div class="archives">
		<header><h2>Archives</h2></header>
		<ul class="list">
			<?php wp_get_archives(array('type'=>'monthly')); ?>
		</ul>
	</div><!--.archives-->
</aside><!--.wrapper.quicklinks-->