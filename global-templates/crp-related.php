<?php if ( function_exists( 'get_crp_posts_id' ) ): ?>

	<?php $this_post = get_post(); ?>

	<?php if ( $related = get_crp_posts_id( array('postid' => $this_post->ID, 'limit' => 3) ) ): ?>

		<div class="related-posts" id="related-posts">

			<h3>Related articles</h3>

			<div class="related-post-items">

				<?php foreach ( $related as $id ): ?>

					<?php
						// Initialise global post data in the loop, restored afterwards...
						global $post; $post = get_post( $id->ID ); setup_postdata( $post ); ?>

					<div class="related-post-item">

						<article class="related-post">

							<img alt="<?php echo get_the_title() ?>" class="img-fluid" src="<?php echo get_the_post_thumbnail_url(); ?>"/>

							<h3><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>

							<div class="related-post-meta">

								<?php ehri_posted_on(); ?>

							</div>

							<?php echo get_the_excerpt(); ?>

						</article>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

	<?php endif; ?>

	<?php setup_postdata( $this_post ); ?>

<?php endif; ?>

