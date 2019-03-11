<?php
/**
 * Declaring widgets
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( "ehri_register_post_meta_widget" ) ) {
	function ehri_register_post_meta_widget() {
		register_widget( 'Ehri_Post_Metadata' );
	}
}

add_action( 'widgets_init', 'ehri_register_post_meta_widget' );

class Ehri_Post_Metadata extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Ehri_Post_Metadata',
			__( 'Post Metadata', ' ehri_widget_domain' ),
			array('description' => __( 'Displays post author and publication date', 'ehri_widget_domain' ),)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		echo __( 'Author' ) . ': ' . get_the_author_posts_link();
		echo '<br/>';
		echo __( 'Published' ) . ': ' . get_the_date();
		echo $args['after_widget'];
	}

	public function form( $instance ) {
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}


if ( ! function_exists( "ehri_register_comment_info_widget" ) ) {
	function ehri_register_comment_info_widget() {
		register_widget( 'Ehri_Post_Comment_Info' );
	}
}

add_action( 'widgets_init', 'ehri_register_comment_info_widget' );

class Ehri_Post_Comment_Info extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Ehri_Post_Comment_Info',
			__( 'Post Comment Info', ' ehri_widget_domain' ),
			array('description' => __( 'Displays comment count and a link to the reply section', 'ehri_widget_domain' ),)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$number = get_comments_number();
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		if ( $number > 0 ) {
			echo '<i class="fa fa-comment fa-lg"></i>';
			echo '<span id="post-comment-number">';
			printf( _nx(
				'%1$s Comment',
				'%1$s Comments',
				$number,
				'comments title'
			), number_format_i18n( $number ) );
			echo '</span>';
		}
		echo '<a class="btn btn-primary" href="#respond">Leave a reply</a>';
		echo $args['after_widget'];
	}

	public function form( $instance ) {
	}

	public function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
}


if ( ! function_exists( "ehri_register_post_categories_widget" ) ) {
	function ehri_register_post_categories_widget() {
		register_widget( 'Ehri_Post_Categories' );
	}
}

add_action( 'widgets_init', 'ehri_register_post_categories_widget' );

class Ehri_Post_Categories extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Ehri_Post_Categories',
			__( 'Post Categories', ' ehri_widget_domain' ),
			array('description' => __( 'Displays categories for the current post', 'ehri_widget_domain' ),)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ($cats = trim(get_the_category_list())) {
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
			echo $cats;
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Categories', 'ehri_widget_domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}


if ( ! function_exists( "ehri_register_post_tags_widget" ) ) {
	function ehri_register_post_tags_widget() {
		register_widget( 'Ehri_Post_Tags' );
	}
}

add_action( 'widgets_init', 'ehri_register_post_tags_widget' );

class Ehri_Post_Tags extends WP_Widget {

	function __construct() {
		parent::__construct(
			'Ehri_Post_Tags',
			__( 'Post Tags', ' ehri_widget_domain' ),
			array('description' => __( 'Displays tags for the current post', 'ehri_widget_domain' ),)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ($tags = trim(get_the_tag_list())) {
			if ( ! empty( $title ) )
				echo $args['before_title'] . $title . $args['after_title'];
			echo $tags;
		}
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) )
			$title = $instance[ 'title' ];
		else
			$title = __( 'Tags', 'ehri_widget_domain' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}
}


/**
 * Add filter to the parameters passed to a widget's display callback.
 * The filter is evaluated on both the front and the back end!
 *
 * @link https://developer.wordpress.org/reference/hooks/dynamic_sidebar_params/
 */
add_filter( 'dynamic_sidebar_params', 'understrap_widget_classes' );

if ( ! function_exists( 'understrap_widget_classes' ) ) {
	/**
	 * Count number of visible widgets in a sidebar and add classes to widgets accordingly,
	 * so widgets can be displayed one, two, three or four per row.
	 *
	 * @global array $sidebars_widgets
	 *
	 * @param array $params {
	 * @type array $args {
	 *         An array of widget display arguments.
	 *
	 * @type string $name Name of the sidebar the widget is assigned to.
	 * @type string $id ID of the sidebar the widget is assigned to.
	 * @type string $description The sidebar description.
	 * @type string $class CSS class applied to the sidebar container.
	 * @type string $before_widget HTML markup to prepend to each widget in the sidebar.
	 * @type string $after_widget HTML markup to append to each widget in the sidebar.
	 * @type string $before_title HTML markup to prepend to the widget title when displayed.
	 * @type string $after_title HTML markup to append to the widget title when displayed.
	 * @type string $widget_id ID of the widget.
	 * @type string $widget_name Name of the widget.
	 *     }
	 * @type array $widget_args {
	 *         An array of multi-widget arguments.
	 *
	 * @type int $number Number increment used for multiples of the same widget.
	 *     }
	 * }
	 * @return array $params
	 */
	function understrap_widget_classes( $params ) {

		global $sidebars_widgets;

		/*
		 * When the corresponding filter is evaluated on the front end
		 * this takes into account that there might have been made other changes.
		 */
		$sidebars_widgets_count = apply_filters( 'sidebars_widgets', $sidebars_widgets );

		// Only apply changes if sidebar ID is set and the widget's classes depend on the number of widgets in the sidebar.
		if ( isset( $params[0]['id'] ) && strpos( $params[0]['before_widget'], 'dynamic-classes' ) ) {
			$sidebar_id = $params[0]['id'];
			$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );

			$widget_classes = 'widget-count-' . $widget_count;
			if ( 0 === $widget_count % 4 || $widget_count > 6 ) {
				// Four widgets per row if there are exactly four or more than six.
				$widget_classes .= ' col-md-3';
			} elseif ( 6 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-2';
			} elseif ( $widget_count >= 3 ) {
				// Three widgets per row if there's three or more widgets.
				$widget_classes .= ' col-md-4';
			} elseif ( 2 === $widget_count ) {
				// If two widgets are published.
				$widget_classes .= ' col-md-6';
			} elseif ( 1 === $widget_count ) {
				// If just on widget is active.
				$widget_classes .= ' col-md-12';
			}

			// Replace the placeholder class 'dynamic-classes' with the classes stored in $widget_classes.
			$params[0]['before_widget'] = str_replace( 'dynamic-classes', $widget_classes, $params[0]['before_widget'] );
		}

		return $params;

	}
} // endif function_exists( 'understrap_widget_classes' ).

add_action( 'widgets_init', 'understrap_widgets_init' );

if ( ! function_exists( 'understrap_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function understrap_widgets_init() {
		register_sidebar(
			array(
				'name' => __( 'Right Sidebar', 'understrap' ),
				'id' => 'right-sidebar',
				'description' => __( 'Right sidebar widget area', 'understrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name' => __( 'Left Sidebar', 'understrap' ),
				'id' => 'left-sidebar',
				'description' => __( 'Left sidebar widget area', 'understrap' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name' => __( 'Hero Slider', 'understrap' ),
				'id' => 'hero',
				'description' => __( 'Hero slider area. Place two or more widgets here and they will slide!', 'understrap' ),
				'before_widget' => '<div class="carousel-item">',
				'after_widget' => '</div>',
				'before_title' => '',
				'after_title' => '',
			)
		);

		register_sidebar(
			array(
				'name' => __( 'Hero Canvas', 'understrap' ),
				'id' => 'herocanvas',
				'description' => __( 'Full size canvas hero area for Bootstrap and other custom HTML markup', 'understrap' ),
				'before_widget' => '',
				'after_widget' => '',
				'before_title' => '',
				'after_title' => '',
			)
		);

		register_sidebar(
			array(
				'name' => __( 'Top Full', 'understrap' ),
				'id' => 'statichero',
				'description' => __( 'Full top widget with dynamic grid', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
				'after_widget' => '</div><!-- .static-hero-widget -->',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);

		register_sidebar(
			array(
				'name' => __( 'Footer Full', 'understrap' ),
				'id' => 'footerfull',
				'description' => __( 'Full sized footer widget with dynamic grid', 'understrap' ),
				'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes">',
				'after_widget' => '</div><!-- .footer-widget -->',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)
		);

	}
} // endif function_exists( 'understrap_widgets_init' ).


