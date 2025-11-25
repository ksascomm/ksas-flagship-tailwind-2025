<?php
/**
 * Custom sidebar walker and parent class names.
 *
 * @package Flagship_Tailwind
 */

// Add hook.
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );

/**
 * Filter_hook function to react on sub_menu flag.
 */
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
	if ( isset( $args->sub_menu ) ) {
		$root_id = 0;

		// find the current menu item.
		foreach ( $sorted_menu_items as $menu_item ) {
			if ( $menu_item->current ) {
				// set the root id based on whether the current menu item has a parent or not.
				$root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
				break;
			}
		}

		// find the top level parent.
		if ( ! isset( $args->direct_parent ) ) {
			$prev_root_id = $root_id;
			while ( $prev_root_id != 0 ) {
				foreach ( $sorted_menu_items as $menu_item ) {
					if ( $menu_item->ID == $prev_root_id ) {
						$prev_root_id = $menu_item->menu_item_parent;
						// don't set the root_id to 0 if we've reached the top of the menu.
						if ( $prev_root_id != 0 ) {
							$root_id = $menu_item->menu_item_parent;
						}
						break;
					}
				}
			}
		}

		$menu_item_parents = array();
		foreach ( $sorted_menu_items as $key => $item ) {
			// init menu_item_parents.
			if ( $item->ID == $root_id ) {
				$menu_item_parents[] = $item->ID;
			}

			if ( in_array( $item->menu_item_parent, $menu_item_parents ) ) {
				// part of sub-tree: keep!
				$menu_item_parents[] = $item->ID;
			} elseif ( ! ( isset( $args->show_parent ) && in_array( $item->ID, $menu_item_parents ) ) ) {
				// not part of sub-tree: away with it!
				unset( $sorted_menu_items[ $key ] );
			}
		}

		return $sorted_menu_items;
	} else {
		return $sorted_menu_items;
	}// End if().
}

/**
 * Add classname to parent nav item
 *
 */
function add_classname_to_parent_nav_link( $atts, $item ) {

	// Add class only on parent.
	if ( $item->menu_item_parent == 0 ) {
			$atts['class'] = 'top-level';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_classname_to_parent_nav_link', 10, 2 );

/**
 * WP_nav_menu separate submenu output.
 *
 * Optional $args contents:
 *
 * string theme_location - The menu that is desired.  Accepts (matching in order) id, slug, name. Defaults to blank.
 * string xpath - Optional. xPath syntax.
 * string before - Optional. Text before the menu tree.
 * string after - Optional. Text after the menu tree.
 * bool echo - Optional, default is TRUE. Whether to echo the menu or return it.
 *
 * @param array $args Arguments
 * @return String If $echo value is set to FALSE.
 *
 * @link https://www.isitwp.com/wp_nav_menu-separate-submenu-output/
 */
function internal_page_submenu( $args = array() ) {
	$defaults = array(
		'theme_location' => 'menu-1',
		'xpath'          => "./li[contains(@class,'current-menu-item') or contains(@class,'current-menu-ancestor')]/ul",
		'before'         => '',
		'after'          => '',
		'echo'           => true,
	);
	$args     = wp_parse_args( $args, $defaults );
	$args     = (object) $args;

	$output = array();

	$menu_tree     = wp_nav_menu(
		array(
			'theme_location' => $args->theme_location,
			'container'      => '',
			'echo'           => false,
		)
	);
	$menu_tree_XML = new SimpleXMLElement( $menu_tree );
	$path          = $menu_tree_XML->xpath( $args->xpath );

	$output[] = $args->before;

	if ( ! empty( $path ) ) {
		$output[] = $path[0]->asXML();
	}

	$output[] = $args->after;

	if ( $args->echo ) {
		echo implode( '', $output );
	} else {
		return implode( '', $output );
	}

}

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus() {

	$locations = array(
		'expanded' => __( 'Desktop Expanded Menu', 'twentytwenty' ),
		'mobile'   => __( 'Mobile Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );
