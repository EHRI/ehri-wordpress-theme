<?php
/**
 * Custom actions for this theme.
 */

add_action( 'wp_ajax_nopriv_blog_geo_posts', 'ehri_blog_geo_posts_handler' );
add_action( 'wp_ajax_blog_geo_posts', 'ehri_blog_geo_posts_handler' );

/**
 * Fetch the title, permalink and thumbnail info for posts which
 * are geo-tagged (with geo_latitude and geo_longitude metadata.)
 *
 * Limit of 200 most-recent posts can be overridden with the `limit`
 * parameter.
 */
if ( ! function_exists( "ehri_blog_geo_posts_handler" ) ) {
	function ehri_blog_geo_posts_handler() {

		$limit = $_GET["limit"] ? $_GET["limit"] : 200;

		$data = array();
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => $limit,
			'meta_query' => array(
				'relation' => 'AND',
				array('key' => 'geo_latitude'),
				array('key' => 'geo_longitude')
			)
		);

		$post_query = new WP_Query( $args );
		if ( $post_query->have_posts() ) {
			while ( $post_query->have_posts() ) {
				$post_query->the_post();
				$post_id = get_the_ID();

				$title = get_the_title( $post_id );
				$thumb = get_the_post_thumbnail_url( $post_id );
				$lat = get_post_meta( $post_id, 'geo_latitude', true );
				$lon = get_post_meta( $post_id, 'geo_longitude', true );
				$url = get_permalink( $post_id );

				$data[] = array(
					'geo' => [$lat, $lon],
					'title' => $title,
					'thumb' => $thumb ? $thumb : null,
					'url' => $url
				);
			}
		}
		$json = json_encode( $data );

		header( 'Content-Type: application/json; charset=utf-8', true );
		header( 'Content-Length: ' . strlen( $json ) );
		echo $json;
		wp_die();
	}
}
