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
	<link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto&amp;subset=latin-ext" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- FIXME: load this via the theme code? -->
	<script async src="https://static.addtoany.com/menu/page.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="site" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">
		<div id="wrapper-navbar-overlay">

			<a class="skip-link sr-only sr-only-focusable"
			   href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

			<nav class="navbar navbar-expand-lg navbar-dark bg-secondary" id="primary-nav">
				<div class="container">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img id="header-logo" class="img-fluid"
						     src="<?php echo get_theme_file_uri( "img/ehri-logo@2x.png" ); ?>"
						     alt=""/></a>

					<h1 class="navbar-brand mb-0 nav-item"><a class="nav-link" rel="home"
					                                          href="<?php echo esc_url( home_url( '/' ) ); ?>"
					                                          title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"
					                                          itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>

					<button class="navbar-toggler" type="button" data-toggle="collapse"
					        data-target="#navbar-nav-dropdown"
					        aria-controls="navbarNavDropdown" aria-expanded="false"
					        aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>

					<!-- The WordPress Menu goes here -->
					<div class="collapse navbar-collapse" id="navbar-nav-dropdown">
						<ul id="navbar-nav-pages" class="navbar-nav ml-auto">
							<?php $active_articles = is_archive() || is_single(); ?>
							<li class="nav-item dropdown <?php if ($active_articles) echo "active"; ?>">
								<a class="nav-link dropdown-toggle" id="navbar-cat-dropdown" data-toggle="dropdown"
								   href="#">Articles</a>
								<div class="dropdown-menu" id="categories-dropdown"
								     aria-labelledby="navbar-cat-dropdown">
									<div class="dropdown-menu-tab"></div>
									<?php the_widget( 'WP_Widget_Categories' ); ?>

									<a class="all-articles-menu"
									   href="<?php echo esc_url( home_url( '/all-articles/' ) ); ?>">
										<?php _e("List all articles"); ?>
									</a>
								</div>
							</li>

							<?php foreach ( wp_get_nav_menu_items( 'main' ) as $item ): ?>
								<li class="nav-item <?php if ( $item->object_id == get_the_ID() ) echo "active"; ?>">
									<a class="nav-link" href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
						<form action="/" class="form-inline" id="navbar-nav-search">
							<div class="input-group" id="search-controls">
								<input class="form-control border-right-0"
								       type="search" name="s" placeholder="Search" id="example-search-input"
								       value="<?php echo get_query_var( 's' ); ?>"/>
								<span class="input-group-append">
							  <button class="btn btn-outline-secondary border-left-0" type="submit">
<!--									<i class="material-icons">search</i>-->
									<i class="fa fa-search fa-inverse fa-lg"></i>
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

			<?php if ( is_front_page() ) : ?>
				<?php get_template_part( 'global-templates/hero' ); ?>
			<?php endif; ?>

		</div>
	</div><!-- #wrapper-navbar end -->

	<!-- Floating follow buttons -->
	<aside id="follow-buttons">

		<header><?php _e("Follow"); ?></header>

		<a class="follow-button" href="https://facebook.com/EHRIproject" title="Follow EHRI on Facebook">

			<i class="fa fa-facebook"></i>

		</a>

		<a class="follow-button" href="https://twitter.com/EHRIproject" title="Follow EHRI on Twitter">

			<i class="fa fa-twitter"></i>

		</a>

	</aside>

