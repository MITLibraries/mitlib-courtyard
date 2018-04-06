<?php
/**
 * This needs to describe the functions-strap php file.
 *
 * @package mitlib-courtyard
 */

/**
 * Bootstrap menu class injection
 *
 * @param array  $sorted_menu_items Undocumented.
 * @param object $args Undocumented.
 */
function bootstrap_menu_objects( $sorted_menu_items, $args ) {
	if ( 'primary' == $args->theme_location  ) {
		$current = array( 'current-menu-ancestor', 'current-menu-item' );
		$registry = array();
		foreach ( $sorted_menu_items as $i => $item ) {
			$is_current = array_intersect( (array) $item->classes, $current );
			if ( ! empty( $is_current ) ) {
				$item->classes[] = 'active';
			}
			$registry[ $item->ID ] = $i;
			if ( $item->menu_item_parent ) {
				$parent_index = $registry[ $item->menu_item_parent ];
				if ( ! in_array( 'dropdown', $sorted_menu_items[ $parent_index ]->classes ) ) {
					$sorted_menu_items[ $parent_index ]->classes[] = 'dropdown';
				}
			}
		}
		// Was print_r($sorted_menu_items);print_r($args);exit;.
	}
	return $sorted_menu_items;
}
add_filter( 'wp_nav_menu_objects', 'bootstrap_menu_objects', 10, 2 );

/**
 * Custom Bootstrap Walker
 */
class Bootstrap_Nav_Menu extends Walker_Nav_Menu {
	/**
	 * Start level
	 *
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 * @param array  $args Undocumented.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	/**
	 * Start element
	 *
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param object $args Undocumented.
	 * @param int    $id Undocumented.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		if ( is_array( $args ) ) {
			$args = json_decode( json_encode( $args ) ); // Convert to object.
		}
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$dropdown = in_array( 'dropdown', $classes );
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		if ( $depth > 0 ) {
			$class_names = str_replace( 'dropdown', 'dropdown-submenu', $class_names );
		}

		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr( $item->url ) .'"' : '';
		$attributes .= $dropdown ? ' class="dropdown-toggle" data-toggle="dropdown" data-target="#"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if ( $dropdown && 0 == $depth ) {
			$item_output .= ' <b class="caret"></b>';
		}
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

/**
 * Custom Page Menu
 */
class Bootstrap_Page_Menu extends Walker_Page {

	/**
	 * Start level
	 *
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth Depth of page. Used for padding.
	 * @param array  $args Unknown.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\">\n";
	}

	/**
	 * Start element
	 *
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Page data object.
	 * @param int    $depth Depth of page. Used for padding.
	 * @param array  $args Not sure what this is used for.
	 * @param int    $current_page Page ID.
	 */
	public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
		if ( $depth ) {
			$indent = str_repeat( "\t", $depth );
		} else {
			$indent = '';
		}

		$css_class = array( 'page_item', 'page-item-' . $page->ID );

		$has_childen = (bool) isset( $args['pages_with_children'][ $page->ID ] );
		if ( $has_childen ) {
			$css_class[] = 'page_item_has_children';
		}

		if ( ! empty( $current_page ) ) {
			$_current_page = get_post( $current_page );
			if ( $_current_page && in_array( $page->ID, $_current_page->ancestors ) ) {
				$css_class[] = 'active current_page_ancestor';
			}
			if ( $page->ID == $current_page ) {
				$css_class[] = 'active current_page_item';
			} elseif ( $_current_page && $page->ID == $_current_page->post_parent ) {
				$css_class[] = 'active current_page_parent';
			}
		} elseif ( get_option( 'page_for_posts' ) == $page->ID ) {
			$css_class[] = 'active current_page_parent';
		}
		if ( $has_childen && $depth > 0 ) {
			$css_class[] = 'dropdown-submenu';
		}

		$css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		if ( '' === $page->post_title ) {
			$page->post_title = sprintf( __( '#%d (no title)' ), $page->ID );
		}

		$args['link_before'] = empty( $args['link_before'] ) ? '' : $args['link_before'];
		$args['link_after'] = empty( $args['link_after'] ) ? '' : $args['link_after'];
		if ( $has_childen && 0 == $depth ) {
			$args['link_after'] .= ' <b class="caret"></b>';
		}

		$output .= $indent . sprintf(
				'<li class="%s"><a href="%s"%s>%s%s%s</a>',
				$css_classes,
				get_permalink( $page->ID ),
				$has_childen ? ' class="dropdown-toggle" data-toggle="dropdown" data-target="#"' : '',
				$args['link_before'],
				get_the_title( $page->ID ), // Unused: apply_filters( 'the_title', get_field('menu', $page->ID), $page->ID ), .
				$args['link_after']
			);

		if ( ! empty( $args['show_date'] ) ) {
			if ( 'modified' == $args['show_date'] ) {
				$time = $page->post_modified;
			} else {
				$time = $page->post_date;
			}

			$date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
			$output .= ' ' . mysql2date( $date_format, $time );
		}
	}
}

/**
 * Bootstrap styled Caption shortcode.
 * Hat tip: http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 */
add_filter( 'img_caption_shortcode', 'bootstrap_img_caption_shortcode', 10, 3 );

/**
 * Image caption shortcode
 *
 * @param string $output Undocumented.
 * @param string $attr Undocumented.
 * @param string $content Undocumented.
 */
function bootstrap_img_caption_shortcode( $output, $attr, $content ) {

	/* We're not worried abut captions in feeds, so just return the output here. */
	if ( is_feed() ) {
		return '';
	}

	extract(shortcode_atts(array(
				'id'	=> '',
				'align'	=> 'alignnone',
				'width'	=> '',
				'caption' => '',
			), $attr));

	if ( 1 > (int) $width || empty( $caption ) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . esc_attr( $id ) . '" ';
	}

	return '<div ' . $id . 'class="thumbnail ' . esc_attr( $align ) . '">'
		. do_shortcode( $content ) . '<div class="caption">' . $caption . '</div></div>';
}

/**
 * Bootstrap styled Comment form.
 */
add_filter( 'comment_form_defaults', 'bootstrap_comment_form_defaults', 10, 1 );

/**
 * Bootrap comment form default
 *
 * @param object $defaults Not sure how to document this.
 */
function bootstrap_comment_form_defaults( $defaults ) {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$defaults['fields'] = array(
		'author' => '<div class="form-group comment-form-author">' .
				'<label for="author" class="col-sm-3 control-label">' . __( 'Name', 'courtyard' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<div class="col-sm-9">' .
					'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '"  class="form-control"' . $aria_req . ' />' .
				'</div>' .
			'</div>',
		'email'  => '<div class="form-group comment-form-email">' .
				'<label for="email" class="col-sm-3 control-label">' . __( 'Email', 'courtyard' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
				'<div class="col-sm-9">' .
					'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '"  class="form-control"' . $aria_req . ' />' .
				'</div>' .
			'</div>',
		'url'    => '<div class="form-group comment-form-url">' .
			'<label for="url" class="col-sm-3 control-label"">' . __( 'Website', 'courtyard' ) . '</label>' .
				'<div class="col-sm-9">' .
					'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  class="form-control" />' .
				'</div>' .
			'</div>',
	);
	$defaults['comment_field'] = '<div class="form-group comment-form-comment">' .
		'<label for="comment" class="col-sm-3 control-label">' . _x( 'Comment', 'noun', 'courtyard' ) . '</label>' .
			'<div class="col-sm-9">' .
				'<textarea id="comment" name="comment" aria-required="true" class="form-control" rows="8"></textarea>' .
				'<span class="help-block form-allowed-tags">' . sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</span>' .
		   '</div>' .
		'</div>';

	$defaults['comment_notes_after'] = '<div class="form-group comment-form-submit">';

	return $defaults;
}
add_action( 'comment_form', 'bootstrap_comment_form', 10, 1 );

/**
 * Bootstrap comment form
 *
 * @param int $post_id unused.
 */
function bootstrap_comment_form( $post_id ) {
	// Closing tag for 'comment_notes_after'.
	echo '</div><!-- .form-group .comment-form-submit -->';
}


/**
 * Bootstrap search form class
 *
 * @param array $bt Not sure what $bt is...
 */
function bootstrap_searchform_class( $bt = array() ) {
	$caller = basename( $bt[1]['file'], '.php' );
	switch ( $caller ) {
		case 'header':
			return 'navbar-form navbar-right';
		default:
			return 'form-inline';
	}
}

add_filter( 'embed_oembed_html', 'bootstrap_oembed_html', 10, 4 );

/**
 * Bootstrap oembed
 *
 * @param string $html markup being included in oembed.
 * @param string $url unused.
 * @param string $attr unused.
 * @param int    $post_id unused.
 */
function bootstrap_oembed_html( $html, $url, $attr, $post_id ) {
	return '<div class="embed-responsive embed-responsive-16by9">' . $html . '</div>';
}
