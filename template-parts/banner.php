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

<?php } ?>