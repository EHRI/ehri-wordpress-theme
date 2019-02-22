<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">

		<a class="skip-link sr-only sr-only-focusable"
		   href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

		<nav class="navbar navbar-expand-md">
			<div class="container">
				<?php the_custom_logo(); ?>

				<?php if ( is_front_page() && is_home() ) : ?>

					<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
					                                 title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					                                 itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

				<?php else : ?>

					<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					   itemprop="url"><?php bloginfo( 'name' ); ?></a>

				<?php endif; ?>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
				        aria-controls="navbarNavDropdown" aria-expanded="false"
				        aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
					<span class="navbar-toggler-icon"></span>
				</button>

				<!-- The WordPress Menu goes here -->
				<div class="collapse navbar-collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle"  id="navbarCatDropdown" data-toggle="dropdown"  href="#">Articles</a>
							<div class="dropdown-menu" id="categories-dropdown" aria-labelledby="navbarCatDropdown">
								<?php foreach (get_categories() as $cat): ?>
									<a class="dropdown-item" href="<?php echo get_category_link($cat); ?>"><?php echo $cat->name; ?></a>
								<?php endforeach; ?>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/map">Map</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="/about/contribute">Contribute</a>
						</li>
						<li class="nav-item">

						</li>
					</ul>
					<form action="/" class="form-inline my-3">
						<div class="input-group">
							<input class="form-control py-2 border-right-0 border"
							       type="search" name="s" placeholder="Search" id="example-search-input"
							       value="<?php echo get_query_var('s'); ?>" />
							<span class="input-group-append">
							  <button class="btn btn-outline-secondary border-left-0 border" type="button">
									<i class="fa fa-search"></i>
							  </button>
							</span>
						</div>
					</form>
<!--				--><?php //wp_nav_menu(
//					array(
//						'theme_location' => 'primary',
//						'container_class' => 'collapse navbar-collapse',
//						'container_id' => 'navbarNavDropdown',
//						'menu_class' => 'navbar-nav ml-auto',
//						'fallback_cb' => '',
//						'menu_id' => 'main-menu',
//						'depth' => 2,
//						'walker' => new Understrap_WP_Bootstrap_Navwalker(),
//					)
//				); ?>
			</div><!-- .container -->

		</nav><!-- .site-navigation -->

	</div><!-- #wrapper-navbar end -->
