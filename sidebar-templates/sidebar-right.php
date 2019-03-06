<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}

?>

<div class="col-md-3 widget-area" id="right-sidebar" role="complementary">

	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</div><!-- #right-sidebar -->
