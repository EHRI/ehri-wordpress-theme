<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'understrap_posted_on' ) ) {
	function understrap_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s"> (%4$s) </time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = apply_filters(
			'understrap_posted_on', sprintf(
				'<span class="posted-on">%1$s <a href="%2$s" rel="bookmark">%3$s</a></span>',
				esc_html_x( 'Posted on', 'post date', 'understrap' ),
				esc_url( get_permalink() ),
				apply_filters( 'understrap_posted_on_time', $time_string )
			)
		);
		$byline = apply_filters(
			'understrap_posted_by', sprintf(
				'<span class="byline"> %1$s<span class="author vcard"><a class="url fn n" href="%2$s"> %3$s</a></span></span>',
				$posted_on ? esc_html_x( 'by', 'post author', 'understrap' ) : esc_html_x( 'Posted by', 'post author', 'understrap' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
		echo $posted_on . $byline; // WPCS: XSS OK.
	}
}


/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
if ( ! function_exists( 'understrap_entry_footer' ) ) {
	function understrap_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'understrap' ) );
			if ( $categories_list && understrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'understrap' ) );
			if ( $tags_list ) {
				/* translators: %s: Tags of current post */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
		if ( ! is_single() && ! post_password_required() && (comments_open() || get_comments_number()) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'understrap' ), esc_html__( '1 Comment', 'understrap' ), esc_html__( '% Comments', 'understrap' ) );
			echo '</span>';
		}
		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'understrap' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
}


/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
if ( ! function_exists( 'understrap_categorized_blog' ) ) {
	function understrap_categorized_blog() {
		if ( false === ($all_the_cool_cats = get_transient( 'understrap_categories' )) ) {
			// Create an array of all the categories that are attached to posts.
			$all_the_cool_cats = get_categories( array(
				'fields' => 'ids',
				'hide_empty' => 1,
				// We only need to know if there is more than one category.
				'number' => 2,
			) );
			// Count the number of categories that are attached to the posts.
			$all_the_cool_cats = count( $all_the_cool_cats );
			set_transient( 'understrap_categories', $all_the_cool_cats );
		}
		if ( $all_the_cool_cats > 1 ) {
			// This blog has more than 1 category so components_categorized_blog should return true.
			return true;
		} else {
			// This blog has only 1 category so components_categorized_blog should return false.
			return false;
		}
	}
}


/**
 * Flush out the transients used in understrap_categorized_blog.
 */
add_action( 'edit_category', 'understrap_category_transient_flusher' );
add_action( 'save_post', 'understrap_category_transient_flusher' );

if ( ! function_exists( 'understrap_category_transient_flusher' ) ) {
	function understrap_category_transient_flusher() {
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		// Like, beat it. Dig?
		delete_transient( 'understrap_categories' );
	}
}

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'ehri_posted_on' ) ) {
	function ehri_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() )
		);
		$posted_on = apply_filters(
			'ehri_posted_on', sprintf(
				'<span class="posted-on"><a href="%1$s" rel="bookmark">%2$s</a></span>',
				esc_url( get_permalink() ),
				apply_filters( 'ehri_posted_on_time', $time_string )
			)
		);

		if ( function_exists( "get_coauthors" ) && function_exists( "coauthors_posts_links" ) ) {
			$coauthors = get_coauthors();
			$byline = apply_filters(
				'ehri_posted_by', sprintf(
					'<span class="byline">%1$s%2$s</span>',
					esc_html_x( _n( 'Author', 'Authors', sizeof( $coauthors ) ) . ': ', 'post author', 'understrap' ),
					coauthors_posts_links(
						'</span>, <span class="vcard">',
						'</span> and <span class="vcard">',
						'<span class="vcard">',
						'</span>',
						false
					)
				)
			);

		} else {
			$byline = apply_filters(
				'ehri_posted_by', sprintf(
					'<span class="byline"> %1$s<span class="vcard"><a class="author url fn" href="%2$s"> %3$s</a></span></span>',
					esc_html_x( 'Author: ', 'post author', 'understrap' ),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author() )
				)
			);
		}
		echo $byline . $posted_on; // WPCS: XSS OK.
	}
}


/**
 * Prints HTML with meta information for the categories and tags.
 */
if ( ! function_exists( 'ehri_entry_footer' ) ) {
	function ehri_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( '', 'understrap' ) );
			if ( $categories_list && understrap_categorized_blog() ) {
				/* translators: %s: Categories of current post */
				printf( '<span class="cat-links">' . esc_html__( 'Categories: %s', 'understrap' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
			/* translators: used between list items, there is a space after the comma */
//			$tags_list = get_the_tag_list( '', esc_html__( '', 'understrap' ) );
//			if ( $tags_list ) {
//				/* translators: %s: Tags of current post */
//				printf( '<span class="tags-links">' . esc_html__( 'Tags: %s', 'understrap' ) . '</span>', $tags_list ); // WPCS: XSS OK.
//			}
		}
	}
}


if ( ! function_exists( "ehri_current_archive_author" ) ) {
	function ehri_get_current_archive_author() {
		return get_query_var( 'author_name' )
			? get_user_by( 'slug', get_query_var( 'author_name' ) )
			: get_userdata( get_query_var( 'author' ) );
	}
}

if ( ! function_exists( "ehri_has_gravitar" ) ) {
	function ehri_has_gravitar( $user ) {
		// Craft a potential url and test its headers
		$hash = md5( strtolower( trim( $user->user_email ) ) );
		$uri = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers( $uri );
		return preg_match( "|200|", $headers[0] );
	}
}

/**
 * Experimental Polylang-based language switch widget.
 *
 */
if ( ! function_exists( "ehri_post_translations" ) ) {
	function ehri_post_translations( $post_id ) {
		if ( ! function_exists( "pll_get_post_translations" )
			|| ! function_exists( "pll_get_post_language" )
		) {
			return;
		}
		$current_lang = pll_get_post_language( $post_id );
		$translations = pll_get_post_translations( $post_id );
		unset( $translations[ $current_lang ] );

		if ( ! $translations ) {
			return;
		}

		$links = "<ul>";
		foreach ( $translations as $code => $other_id ) {
			$links .= sprintf( '<li><a href="%s">%s</a></li>', get_permalink( $other_id ), Locale::getDisplayLanguage( $code, $current_lang ) );
		}
		$links .= "</ul>"

		?>
		<div class="entry-translations">
			<?php _e( sprintf( "Translations of this post exist in the following languages: %s", $links ) ); ?>
		</div>
		<?php
	}
}
