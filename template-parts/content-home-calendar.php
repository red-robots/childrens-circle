<?php
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$posttype = 'events';
$perpage = 4;
$args = array(
	'posts_per_page'   => -1,
	'post_type'        => $posttype,
	'post_status'      => 'publish'
);
$orderbyArr = array('orderby'=>'date','order'=>'DESC');
$orderbyJson = json_encode($orderbyArr);
$entries = next_entries_result($posttype, $paged, $perpage, $orderbyArr);
$items = get_posts($args);
$total = ($items) ? count($items): 0;
if ( $items ) {  ?>
<div class="calendarItems posts-column cf entries-wrapper">
	<?php echo $entries; ?>
</div>
<div class="buttondiv hasSpinner">
	<a href="#" data-currentpage="1" data-perpage="<?php echo $perpage ?>" data-count="<?php echo $total ?>" data-type="<?php echo $posttype ?>" data-orderby='<?php echo $orderbyJson ?>' data-container=".newsItems" class="seemore imorebtn"><span>See More</span></a>
	<div class="spinner"><div class="loader"></div></div>
</div>
<?php } ?>