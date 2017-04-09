<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<hr />

<div class="detail-container">
	<span class="detail-label"><?php echo esc_html__('Share','uncode'); ?></span>
	<div class="share-button share-buttons share-inline only-icon"></div>
</div>