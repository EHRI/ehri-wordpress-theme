<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();


?>

<div class="wrapper" id="single-wrapper">

	<div class="container" id="content" tabindex="-1">

		<div class="row">

			<div class="col-md-9 content-area" id="primary">

				<main class="site-main" id="main">

					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'single' ); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;
						?>

						<?php if ( function_exists( 'get_crp_posts_id' ) ): ?>
							<?php $id = get_the_ID(); ?>
							<?php if ($related = get_crp_posts_id( array( 'postid' => $id, 'limit' => 3))): ?>
							<div class="related-posts">
								<h3>Related articles</h3>
								<div class="row">
									<?php foreach ($related as $id): ?>
										<?php global $post; ?>
										<?php $post = get_post($id->ID);?>
										<?php setup_postdata($post);?>
										<div class="col-lg-4">
											<div class="related-post">
												<img alt="<?php echo get_the_title() ?>" class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>"/>
												<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
												<div class="related-post-meta">
													<?php ehri_posted_on(); ?>
												</div>
												<?php echo get_the_excerpt();?>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
							<?php endif; ?>
							</div>
							<?php setup_postdata($id);?>
						<?php endif;?>

					<?php endwhile; // end of the loop. ?>

				</main><!-- #main -->

			</div>

			<!-- Do the right sidebar -->
			<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>

		</div><!-- .row -->

	</div><!-- #content -->

</div><!-- #single-wrapper -->

<?php get_footer(); ?>
