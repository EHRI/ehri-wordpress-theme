<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

?>

<div class="wrapper" id="author-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<div class="content-area" id="primary">

				<main class="site-main" id="main">

					<header class="page-header author-header">

						<?php
						if ( isset( $_GET['author_name'] ) ) {
							$curauth = get_user_by( 'slug', $author_name );
						} else {
							$curauth = get_userdata( intval( $author ) );
						}
						?>

						<h1><?php echo esc_html__( 'About:', 'understrap' ) . ' ' . esc_html( $curauth->nickname ); ?></h1>

						<?php if ( ! empty( $curauth->ID ) ) : ?>
							<?php echo get_avatar( $curauth->ID ); ?>
						<?php endif; ?>

						<?php if ( ! empty( $curauth->user_url ) || ! empty( $curauth->user_description ) ) : ?>
							<dl>
								<?php if ( ! empty( $curauth->user_url ) ) : ?>
									<dt><?php esc_html_e( 'Website', 'understrap' ); ?></dt>
									<dd>
										<a href="<?php echo esc_url( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
									</dd>
								<?php endif; ?>

								<?php if ( ! empty( $curauth->user_description ) ) : ?>
									<dt><?php esc_html_e( 'Profile', 'understrap' ); ?></dt>
									<dd><?php esc_html_e( $curauth->user_description ); ?></dd>
								<?php endif; ?>
							</dl>
						<?php endif; ?>

						<h2><?php echo esc_html( 'Posts by', 'understrap' ) . ' ' . esc_html( $curauth->nickname ); ?>
							:</h2>

					</header><!-- .page-header -->

					<div class="post-list">

						<?php while (have_posts()) : the_post(); ?>

							<?php get_template_part( 'loop-templates/content', get_post_format() ); ?>

						<?php
						endwhile;
						wp_reset_postdata();
						?>

					</div>

				</main><!-- #main -->

				<!-- The pagination component -->
				<?php ehri_pagination(); ?>

			</div>

			<!-- Do the right sidebar -->
			<?php get_template_part( 'sidebar' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

</div><!-- #author-wrapper -->

<?php get_footer(); ?>
