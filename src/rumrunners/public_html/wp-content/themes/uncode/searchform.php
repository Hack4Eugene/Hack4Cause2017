<?php
	global $use_live_search;
?>
<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
	<div class="search-container-inner">
		<input type="search" class="search-field form-fluid<?php echo ($use_live_search) ? ' form-xl' : ' no-livesearch'; ?>" placeholder="<?php echo esc_html__('Search…','uncode'); ?>" value="" name="s" title="<?php echo esc_html__('Search for:','uncode'); ?>">
	  <i class="fa fa-search3"></i>
	</div>
</form>
