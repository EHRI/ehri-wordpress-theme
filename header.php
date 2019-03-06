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
	<link href="https://fonts.googleapis.com/css?family=Barlow+Semi+Condensed:600" rel="stylesheet">

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
						<img class="img-fluid"
						     src="<?php echo get_theme_file_uri( "img/ehri-wp-theme-logo-trans-xs.png" ); ?>"
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
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbar-cat-dropdown" data-toggle="dropdown"
								   href="#">Articles</a>
								<div class="dropdown-menu" id="categories-dropdown" aria-labelledby="navbar-cat-dropdown">
									<div class="dropdown-menu-tab"></div>
									<?php the_widget('WP_Widget_Categories');?>

									<a class="all-articles" href="?post_type=post">
										List all articles
									</a>
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
						</ul>
						<form action="/" class="form-inline my-3" id="navbar-nav-search">
							<div class="input-group" id="search-controls">
								<input class="form-control py-2 border-right-0"
								       type="search" name="s" placeholder="Search" id="example-search-input"
								       value="<?php echo get_query_var( 's' ); ?>"/>
								<span class="input-group-append">
							  <button class="btn btn-outline-secondary border-left-0" type="button">
									<i class="fa fa-search fa-inverse"></i>
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

			<?php if ( is_front_page() && is_home() ) : ?>
				<?php get_template_part( 'global-templates/hero' ); ?>
			<?php endif; ?>

		</div>
	</div><!-- #wrapper-navbar end -->
