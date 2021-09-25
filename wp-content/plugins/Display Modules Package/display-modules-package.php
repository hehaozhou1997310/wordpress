<?php
/**
 * Plugin Name: Display Modules Package
 * Description: Display a listing of modules in the package.
 * Version: 1.0.0
 * Author: Ali Dahidan & Haozhou He
 */

add_shortcode( 'display-modules', 'display_modules_shortcode' );

function display_modules_shortcode( $atts ) {

	$output = apply_filters( 'pre_display_modules_shortcode_output', false, $atts );
	if ( false !== $output ) {
		return $output;
	}

	// Original attributes, for filters.
	$original_atts = $atts;

	// Pull in shortcode attributes and set defaults.
	$atts = shortcode_atts(
		array(
			'author'                => '',
			'category'              => '',
			'category_display'      => '',
			'category_id'           => false,
			'category_label'        => 'Posted in: ',
			'content_class'         => 'content',
			'date_format'           => '(n/j/Y)',
			'date'                  => '',
			'date_column'           => 'post_date',
			'date_compare'          => '=',
			'display_posts_off'     => false,
			'excerpt_length'        => false,
			'excerpt_more'          => false,
			'excerpt_more_link'     => false,
			'exclude'               => false,
			'exclude_current'       => false,
			'id'                    => false,
			'image_size'            => false,
			'include_author'        => false,
			'include_content'       => false,
			'include_date'          => false,
			'include_date_modified' => false,
			'include_excerpt'       => false,
			'include_excerpt_dash'  => true,
			'include_link'          => true,
			'include_title'         => true,
			'no_posts_message'      => '',
			'order'                 => 'DESC',
			'orderby'               => 'date',
			'post_status'           => 'publish',
			'post_type'             => 'post',
			'posts_per_page'        => '10',
			's'                     => false,
			'tag'                   => '',
			
			'time'                  => '',
			'title'                 => '',
			'wrapper'               => 'ul',
			'wrapper_class'         => 'display-posts-listing',
			'wrapper_id'            => false,
		),
		$atts,
		'display-events'
	);

	// End early if shortcode should be turned off.
	if ( $atts['display_posts_off'] ) {
		return;
	}

	$author                = sanitize_text_field( $atts['author'] );
	$category              = sanitize_text_field( $atts['category'] );
	$category_display      = 'true' === $atts['category_display'] ? 'category' : sanitize_text_field( $atts['category_display'] );
	$category_id           = (int) $atts['category_id'];
	$category_label        = sanitize_text_field( $atts['category_label'] );
	$content_class         = array_map( 'sanitize_html_class', explode( ' ', $atts['content_class'] ) );
	$date_format           = sanitize_text_field( $atts['date_format'] );
	$date                  = sanitize_text_field( $atts['date'] );
	$date_compare          = sanitize_text_field( $atts['date_compare'] );
	$excerpt_length        = (int) $atts['excerpt_length'];
	$excerpt_more          = sanitize_text_field( $atts['excerpt_more'] );
	$excerpt_more_link     = filter_var( $atts['excerpt_more_link'], FILTER_VALIDATE_BOOLEAN );
	$exclude               = $atts['exclude']; // Sanitized later as an array of integers.
	$exclude_current       = filter_var( $atts['exclude_current'], FILTER_VALIDATE_BOOLEAN );
	$id                    = $atts['id']; // Sanitized later as an array of integers.
	$image_size            = sanitize_key( $atts['image_size'] );
	$include_title         = filter_var( $atts['include_title'], FILTER_VALIDATE_BOOLEAN );
	$include_author        = filter_var( $atts['include_author'], FILTER_VALIDATE_BOOLEAN );
	$include_content       = filter_var( $atts['include_content'], FILTER_VALIDATE_BOOLEAN );
	$include_date          = filter_var( $atts['include_date'], FILTER_VALIDATE_BOOLEAN );
	$include_date_modified = filter_var( $atts['include_date_modified'], FILTER_VALIDATE_BOOLEAN );
	$include_excerpt       = filter_var( $atts['include_excerpt'], FILTER_VALIDATE_BOOLEAN );
	$include_excerpt_dash  = filter_var( $atts['include_excerpt_dash'], FILTER_VALIDATE_BOOLEAN );
	$include_link          = filter_var( $atts['include_link'], FILTER_VALIDATE_BOOLEAN );
	$no_posts_message      = sanitize_text_field( $atts['no_posts_message'] );
	$order                 = sanitize_key( $atts['order'] );
	$orderby               = sanitize_key( $atts['orderby'] );
	$post_status           = $atts['post_status']; // Validated later as one of a few values.
	$post_type             = sanitize_text_field( $atts['post_type'] );
	$posts_per_page        = (int) $atts['posts_per_page'];
	$s                     = sanitize_text_field( $atts['s'] );
	$tag                   = sanitize_text_field( $atts['tag'] );
	$shortcode_title       = sanitize_text_field( $atts['title'] );
	$wrapper               = sanitize_text_field( $atts['wrapper'] );
	$wrapper_class         = array_map( 'sanitize_html_class', explode( ' ', $atts['wrapper_class'] ) );

	if ( ! empty( $wrapper_class ) ) {
		$wrapper_class = ' class="' . implode( ' ', $wrapper_class ) . '"';
	}
	$wrapper_id = sanitize_html_class( $atts['wrapper_id'] );
	if ( ! empty( $wrapper_id ) ) {
		$wrapper_id = ' id="' . $wrapper_id . '"';
	}

	// Set up initial query for post.
	$args = array(
		'perm' => 'readable',
	);

	// Add args if they aren't empty.
	if ( ! empty( $category_id ) ) {
		$args['cat'] = $category_id;
	}
	if ( ! empty( $category ) ) {
		$args['category_name'] = $category;
	}
	if ( ! empty( $order ) ) {
		$args['order'] = $order;
	}
	if ( ! empty( $orderby ) ) {
		$args['orderby'] = $orderby;
	}
	if ( ! empty( $post_type ) ) {
		$args['post_type'] = be_dps_explode( $post_type );
	}
	if ( ! empty( $posts_per_page ) ) {
		$args['posts_per_page'] = $posts_per_page;
	}
	if ( ! empty( $s ) ) {
		$args['s'] = $s;
	}
	if ( ! empty( $tag ) ) {
		$args['tag'] = $tag;
	}

	// Date query.
	if ( ! empty( $date ) || ! empty( $time ) || ! empty( $date_query_after ) || ! empty( $date_query_before ) ) {
		$initial_date_query = array();
		$date_query_top_lvl = array();

		$valid_date_columns = array(
			'post_date',
			'post_date_gmt',
			'post_modified',
			'post_modified_gmt',
			'comment_date',
			'comment_date_gmt',
		);

		$valid_compare_ops = array( '=', '!=', '>', '>=', '<', '<=', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN' );

		
		// 'compare' argument.
		if ( ! empty( $date_compare ) && in_array( $date_compare, $valid_compare_ops, true ) ) {
			$date_query_top_lvl['compare'] = $date_compare;
		}

		// Bring in the initial date query.
		if ( ! empty( $initial_date_query ) ) {
			$date_query_top_lvl[] = $initial_date_query;
		}

		// Date queries.
		$args['date_query'] = $date_query_top_lvl;
	} 

	// If Post IDs.
	if ( $id ) {
		$posts_in         = array_map( 'intval', be_dps_explode( $id ) );
		$args['post__in'] = $posts_in;
	}

	// If Exclude.
	$post__not_in = array();
	if ( ! empty( $exclude ) ) {
		$post__not_in = array_map( 'intval', be_dps_explode( $exclude ) );
	}
	if ( is_singular() && $exclude_current ) {
		$post__not_in[] = get_the_ID();
	}
	if ( ! empty( $post__not_in ) ) {
		$args['post__not_in'] = $post__not_in; 
	}

	// Post Status.
	$post_status = be_dps_explode( $post_status );
	$validated   = array();
	$available   = array( 'publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash', 'any' );
	foreach ( $post_status as $unvalidated ) {
		if ( in_array( $unvalidated, $available, true ) ) {
			$validated[] = $unvalidated;
		}
	}
	if ( ! empty( $validated ) ) {
		$args['post_status'] = $validated;
	}

	// Set up html elements used to wrap the posts. Default is ul/li, but can also be ol/li and div/div.
	$wrapper_options = array( 'ul', 'ol', 'div' );
	if ( ! in_array( $wrapper, $wrapper_options, true ) ) {
		$wrapper = 'ul';
	}
	$inner_wrapper = 'div' === $wrapper ? 'div' : 'li';

	// Filter the arguments passed to WP_Query.
	global $dps_listing;
	$dps_listing = new WP_Query( apply_filters( 'display_events_package_args', $args, $original_atts ) );

	if ( ! $dps_listing->have_posts() ) {
		return apply_filters( 'display_events_package_no_results', wpautop( $no_posts_message ) );
	}

	$inner = '';
	while ( $dps_listing->have_posts() ) :
		$dps_listing->the_post();
		global $post;

		$image   = '';
		$date    = '';
		$author  = '';
		$excerpt = '';
		$content = '';

		if ( $include_title && $include_link ) {
			/** This filter is documented in wp-includes/link-template.php */
			$title = '<a class="title" href="' . apply_filters( 'the_permalink', get_permalink() ) . '">' . get_the_title() . '</a>';

		} elseif ( $include_title ) {
			$title = '<span class="title">' . get_the_title() . '</span>';

		} else {
			$title = '';
		}

		if ( $image_size && has_post_thumbnail() && $include_link ) {
			$image = '<a class="image" href="' . get_permalink() . '">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</a> ';

		} elseif ( $image_size && has_post_thumbnail() ) {
			$image = '<span class="image">' . get_the_post_thumbnail( get_the_ID(), $image_size ) . '</span> ';

		}

		if ( $include_date ) {
			$date = 'relative' === $date_format ? be_dps_relative_date( get_the_date( 'U' ) ) : get_the_date( $date_format );
		} elseif ( $include_date_modified ) {
			$date = 'relative' === $date_format ? be_dps_relative_date( get_the_modified_time( 'U' ) ) : get_the_modified_date( $date_format );
		}
		if ( ! empty( $date ) ) {
			$date = ' <span class="date">' . $date . '</span>';
		}

		if ( $include_author ) {
			//	
			$author = apply_filters( 'display_posts_shortcode_author', ' <span class="author">by ' . get_the_author() . '</span>', $original_atts );
		}

		if ( $include_excerpt ) {

			// Custom build excerpt based on shortcode parameters.
			if ( $excerpt_length || $excerpt_more || $excerpt_more_link ) {

				$length = $excerpt_length ? $excerpt_length : apply_filters( 'excerpt_length', 55 );
				$more   = $excerpt_more ? $excerpt_more : apply_filters( 'excerpt_more', '' );
				$more   = $excerpt_more_link ? ' <a class="excerpt-more" href="' . get_permalink() . '">' . $more . '</a>' : ' <span class="excerpt-more">' . $more . '</span>';

				if ( has_excerpt() && apply_filters( 'display_posts_shortcode_full_manual_excerpt', false ) ) {
					$excerpt = $post->post_excerpt . $more;
				} elseif ( has_excerpt() ) {
					$excerpt = wp_trim_words( strip_shortcodes( $post->post_excerpt ), $length ) . $more;
				} else {
					$excerpt = wp_trim_words( strip_shortcodes( $post->post_content ), $length ) . $more;
				}

				// Use default, can customize with WP filters.
			} else {
				$excerpt = get_the_excerpt();
			}

			$excerpt = ' <span class="excerpt">' . $excerpt . '</span>';
			if ( $include_excerpt_dash ) {
				$excerpt = ' <span class="excerpt-dash">-</span>' . $excerpt;
			}
		}

		if ( $include_content ) {
			add_filter( 'shortcode_atts_display-posts', 'be_display_posts_off', 10, 3 );
			/** This filter is documented in wp-includes/post-template.php */
			$content = '<div class="' . implode( ' ', $content_class ) . '">' . apply_filters( 'the_content', get_the_content() ) . '</div>';
			remove_filter( 'shortcode_atts_display-posts', 'be_display_posts_off', 10, 3 );
		}

		// Display categories the post is in.
		$category_display_text = '';

		if ( $category_display && is_object_in_taxonomy( get_post_type(), $category_display ) ) {
			$terms       = get_the_terms( get_the_ID(), $category_display );
			$term_output = array();

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$term_output[] = '<a href="' . get_term_link( $term, $category_display ) . '">' . $term->name . '</a>';
				}
				$category_display_text = ' <span class="category-display"><span class="category-display-label">' . $category_label . '</span> ' . implode( ', ', $term_output ) . '</span>';
			}

			//  Filter the list of categories attached to the current post.
			$category_display_text = apply_filters( 'display_posts_shortcode_category_display', $category_display_text, $terms, $category_display, $original_atts );

		}

		$class = array( 'listing-item' );

		// Filter the post classes for the inner wrapper element of the current post.
		$class  = array_map( 'sanitize_html_class', apply_filters( 'display_posts_shortcode_post_class', $class, $post, $dps_listing, $original_atts ) );
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $author . $category_display_text . $excerpt . $content . '</' . $inner_wrapper . '>';

		// Filter the HTML markup for output via the shortcode.
		$inner .= apply_filters( 'display_posts_shortcode_output', $output, $original_atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text );

	endwhile;
	wp_reset_postdata();

	// Filter the shortcode output's opening outer wrapper element.	
	$open = apply_filters( 'display_posts_shortcode_wrapper_open', '<' . $wrapper . $wrapper_class . $wrapper_id . '>', $original_atts, $dps_listing );

	// Filter the shortcode output's closing outer wrapper element.
	$close = apply_filters( 'display_posts_shortcode_wrapper_close', '</' . $wrapper . '>', $original_atts, $dps_listing );

	$return = '';

	if ( $shortcode_title ) {

		/**		 * Filter the shortcode output title tag element.		 */
		$title_tag = apply_filters( 'display_posts_shortcode_title_tag', 'h2', $original_atts );

		$return .= '<' . $title_tag . ' class="display-posts-title">' . $shortcode_title . '</' . $title_tag . '>' . "\n";
	}

	$return .= $open . $inner . $close;

	return $return;
}

//* Explode list using "," and ", ".
function be_dps_explode( $string = '' ) {
	$string = str_replace( ', ', ',', $string );
	return explode( ',', $string );
}
