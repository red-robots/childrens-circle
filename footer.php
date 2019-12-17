	</div><!-- #content -->
	
	<?php  
	$footer_logo = get_field("footer_logo","option");
	$footer_text = get_field("footer_text","option");
	$street = get_field("street","option");
	$city = get_field("city","option");
	$phone = get_field("phone","option");
	$email = get_field("email","option");
	if($phone) {
		$phone = '<a href="tel:'.format_phone_number($phone).'">'.$phone.'</a>';
	}
	if($email) {
		$email = '<a href="mailto:'.antispambot($email,1).'">'.antispambot($email).'</a>';
	}
	$contactArrs = array($street,$city,$phone,$email);
	$contactInfos = ( array_filter($contactArrs) ) ? array_filter($contactArrs) : false;
	?>
	<footer id="colophon" class="site-footer cf" role="contentinfo">
		<div class="wrapper">
			<div class="flexwrap">
				<div class="footcol left">
				<?php if ($footer_logo) { ?>
					<img class="footlogo" src="<?php echo $footer_logo['url'] ?>" alt="<?php echo $footer_logo['title'] ?>" />
				<?php } ?>
				</div>

				<div class="footcol right">
				<?php if ($footer_text) { ?>
					<div class="foottext t1"><?php echo $footer_text ?></div>
				<?php } ?>
				<?php if ($contactInfos) { ?>
					<div class="foottext t2"><?php //echo implode(" &#124; ", $contactInfos); ?>
						<?php $j=1; foreach ($contactInfos as $e) { 
							$foo = preg_replace('/\s+/', ' ', $e); ?>
							<span class="<?php echo ($j==1) ? 'first info':'info' ?>"><?php echo $foo; ?></span>
						<?php $j++; } ?>
					</div>
				<?php } ?>
				</div>
			</div>
		</div><!-- wrapper -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<div id="loader"><div class="loader"><span class="loadtxt">Loading...</span></div></div>
<a href="#" class="scrollup"><span><i class="fa fa-chevron-up"></i></span></a></a>
<?php wp_footer(); ?>

</body>
</html>
