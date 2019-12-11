<?php if( is_front_page() ) { ?>

	<?php if( $slides = get_field('banner') ) { 
		$count = count($slides);
		$slidesId = ($count>1) ? 'slideshow':'static';
		?>
		<div id="<?php echo $slidesId ?>" class="slider swiper-container">
    		<div class="swiper-wrapper">
    			<?php foreach ($slides as $s) { 
    				$imageSrc = $s['url']; ?>
    				<?php if ($imageSrc) { ?>
    				<div class="swiper-slide" style="background-image:url('<?php echo $imageSrc ?>');">
    					<div class="slideCaption"></div>
    				</div>
    				<?php } ?>
    			<?php } ?>
    		</div>
			
			<?php if ($count>1) { ?>
			    <div class="swiper-pagination"></div>
			    <div class="swiper-button-next"></div>
			    <div class="swiper-button-prev"></div>
			<?php } ?>

    	</div>
	<?php } ?>

<?php } else { ?>
	
	<?php 
		$banner_image = get_field("banner_image");
		$sections = get_field("sections");
	?>

	<?php if ($banner_image) { ?>
	<div id="subpagehero" class="banner-wrapper cf">
		<div class="banner cf"><img src="<?php echo $banner_image['url'] ?>" alt="<?php echo $banner_image['title'] ?>" /></div>
	</div>	
	<?php } ?>

	<?php if ($sections) { ?>
	<div id="pagenav" class="sections-titles cf">
		<div id="currentNav" class="wrapper"><span id="currentPgNav"></span> <span id="pndropdown"><i class="fas fa-chevron-down arrowdown"></i></span></div>
		<div class="pagenavlinks wrapper cf">
		<?php $i=1; foreach ($sections as $s) { 
			$title = $s['title']; ?>
			<a href="#tprow<?php echo $i?>" class="pglink"><span><?php echo $title; ?></span></a>
		<?php $i++; } ?>
		</div>
	</div>	
	<?php } ?>

<?php } ?>