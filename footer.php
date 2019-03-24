<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>

<div class="wrapper" id="wrapper-footer-full">

	<div class="container" id="footer-full-content" tabindex="-1">

		<div class="footer-full-sections">

			<div class="footer-full-section-social">

				<?php if ($mailinglist_url = get_theme_mod('ehri_mailinglist_url', false)): ?>

				<div class="newsletter">

					<h3>Don't miss new articles</h3>

					<a href="<?php echo $mailinglist_url; ?>" class="btn btn-primary btn-lg" target="_blank" id="subscribe-to-newsletter">
						Subscribe to our mailing list
					</a>

				</div>

				<?php endif; ?>

				<div class="social-links">
					<a href="https://facebook.com/EHRIproject">
						<i class="fa fa-facebook"></i>
						Facebook
					</a>
					<a href="https://twitter.com/EHRIproject">
						<i class="fa fa-twitter"></i>
						Twitter
					</a>
					<a href="/feed/">
						<i class="fa fa-rss"></i>
						RSS
					</a>
				</div>

				<p id="copyright">
					<span class="text-muted text-capitalize">© 2015-2019 EHRI Consortium </span>
					&nbsp;
					&nbsp;
					<a class="text-muted" href="https://ehri-project.eu/content/privacy-statement">Privacy
						policy</a>
				</p>

			</div>

			<div class="footer-full-section-menu">

				<div class="footer-full-menus">

					<div class="footer-full-menu">
						<?php foreach ( wp_get_nav_menu_items( 'footer1' ) as $item ): ?>
							<p class="<?php if ( $item->object_id === get_the_ID() ) echo "active"; ?>">
								<a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
							</p>
						<?php endforeach; ?>
					</div>

					<div class="footer-full-menu">

						<p>
							<a href="<?php echo esc_url( home_url( '/all-articles/' ) ); ?>">
								Categories
							</a>
						</p>
						<ul class="footer-categories">
							<?php foreach ( get_categories() as $category ): ?>
								<li>
									<a href="<?php echo get_category_link( $category ); ?>">
										<?php echo $category->name; ?>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>

					</div>

					<div class="footer-full-menu">
						<?php foreach ( wp_get_nav_menu_items( 'footer2' ) as $item ): ?>
							<p class="<?php if ( $item->object_id === get_the_ID() ) echo "active"; ?>">
								<a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
							</p>
						<?php endforeach; ?>
					</div>

				</div>

			</div>

		</div>

	</div>

</div><!-- #wrapper-footer-full -->



</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

