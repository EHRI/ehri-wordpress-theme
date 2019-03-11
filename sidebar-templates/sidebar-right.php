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

	<?php if (is_single()): ?>

		<?php get_template_part( 'global-templates/share' ); ?>

	<?php endif; ?>

	<?php dynamic_sidebar( 'right-sidebar' ); ?>

	<?php if (is_search()): ?>
		<aside class="author-list widget widget-authors">
			<h4 class="widget-title">Authors</h4>
			<ul>
				<?php foreach (wp_list_authors() as $author): ?>
					<?php echo $author; ?>
				<?php endforeach; ?>
			</ul>
		</aside>
	<?php endif; ?>
</div><!-- #right-sidebar -->
