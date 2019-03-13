<?php
/**
 * Sidebar setup for footer full.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<div class="wrapper" id="wrapper-footer-full">

		<div class="container" id="footer-full-content" tabindex="-1">

			<div class="footer-full-sections">

				<div class="footer-full-section-social">

					<h3>Don't miss new articles</h3>

					<form action="/">

						<div class="form-group">

							<div class="input-group">

								<input class="form-control col-md-8" type="email" placeholder="your e-mail"/>

								<div class="input-group-append">

									<button type="submit" class="btn btn btn-primary">Subscribe</button>

								</div>

							</div>

						</div>

					</form>
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
						<a class="text-muted" href="https://ehri-project.eu/content/privacy-statement">Privacy policy</a>
					</p>

				</div>

				<div class="footer-full-section-menu">

					<div class="footer-full-menus">

						<div class="footer-full-menu">
							<p>
								<a href="/">Home</a>
							</p>
							<p>
								<a href="/about/">About</a>
							</p>

							<p>
								<a href="/about/contribute/">Contribute</a>
							</p>

							<p>
								<a href="/timeline/">Timeline</a>
							</p>
						</div>

						<div class="footer-full-menu">

							<p>
								<a href="/categories/">Categories</a>
							</p>
							<p>
								<ul class="footer-categories">
								<?php foreach (get_categories() as $category): ?>
									<li>
										<a href="<?php echo get_category_link($category);?>">
											<?php echo $category->name;?>
										</a>
									</li>
								<?php endforeach; ?>
								</ul>
							</p>

						</div>

						<div class="footer-full-menu">
							<p>
								<a href="/sitemap/">Sitemap</a>
							</p>

						</div>

					</div>

				</div>

			</div>

		</div>

	</div><!-- #wrapper-footer-full -->

<?php endif; ?>
