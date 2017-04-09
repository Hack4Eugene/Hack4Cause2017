<?php

/**
 * Class Name: wp_bootstrap_navwalker
 * GitHub URI: https://github.com/twittem/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 3 navigation style in a custom theme using the WordPress built in menu manager.
 * Version: 2.0.4
 * Author: Edward McIntyre - @twittem
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of page. Used for padding.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		global $megamenu, $megachildren;
		$indent = str_repeat( "\t", $depth );
		if ($megamenu == 'megamenu' ) {
			switch ($megachildren) {
				case 1:
					$columns = 'mega-menu-one';
					break;
				case 2:
					$columns = 'mega-menu-two';
					break;
				case 3:
					$columns = 'mega-menu-three';
					break;
				case 4:
					$columns = 'mega-menu-four';
					break;
				case 5:
					$columns = 'mega-menu-five';
					break;
				case 6:
					$columns = 'mega-menu-six';
					break;
				case 7:
					$columns = 'mega-menu-seven';
					break;
				case 8:
					$columns = 'mega-menu-eight';
					break;
			}
			$output .= "\n$indent<ul role=\"menu\" class=\"mega-menu-inner in-mega $columns\">\n";
		}
		else $output .= "\n$indent<ul role=\"menu\" class=\"drop-menu\">\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $megamenu, $megachildren, $wpdb, $menutype;

		$description = '';
		$icon_html = '';
		$megamenu = $item->megamenu;
		if ($megamenu == 'megamenu') {
			if ($args->has_children) {
				$megachildren = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value = %d", '_menu_item_menu_item_parent', $item->ID));
			}
		}
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		if ($item->description !== '' && ($menutype === 'menu-overlay' || $menutype === 'menu-overlay-center')) $description = '<span class="menu-item-description">' . $item->description . '</span>';

		/**
		 * Get the icon
		 */
		if ( ! empty( $item->icon )) $icon_html = '<i class="menu-icon ' . esc_attr( $item->icon ) . '"></i>';

		/**
		 * Dividers, Headers or Disabled
		 * =============================
		 * Determine whether the item is a Divider, Header, Disabled or regular
		 * menu item. To prevent errors we use the strcasecmp() function to so a
		 * comparison that is not case sensitive. The strcasecmp() function returns
		 * a 0 if the strings are equal.
		 */
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#"><span>' . esc_attr( $item->title ) . '</span></a>';
		} else if ( strcasecmp($item->megamenu, 'megamenu' ) == 0 && $depth === 0 ) {
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			$class_names = $class_names ? ' ' . esc_attr( $class_names ) : '';
			$output .= $indent . '<li class="mega-menu'.$class_names.'"><a href="'.(! empty( $item->url ) ? $item->url : '#').'">'  . $icon_html . esc_attr( $item->title ) . '<i class="fa fa-angle-down fa-dropdown"></i>' . $description . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			if ($item->button) $classes[] = 'menu-btn-container';

			if ( $args->has_children )
				$classes[] = 'dropdown';

			if ( in_array( 'current-menu-item', $classes )) {
				$parse_link = parse_url($item->url);
				if (!isset($parse_link['fragment'])) $classes[] = 'active';
			}

			if ($item->button) $classes[] = 'btn';
			else {
				if ($depth === 0)	$classes[] = 'menu-item-link';
			}
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );

			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . (!$item->button ? $class_names : ' class="menu-item-button"') .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : (! empty( $item->title )	? $item->title	: '');
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '#';
				$atts['data-toggle']	= 'dropdown';
				$atts['class']			= 'dropdown-toggle';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			 * Glyphicons
			 * ===========
			 * Since the the menu item is NOT a Divider or Header we check the see
			 * if there is a value in the attr_title property. If the attr_title
			 * property is NOT null we apply it as the class name for the glyphicon.
			 */
			if (!isset($item->logo) && !$item->logo) {
				if ( ! empty( $item->icon ) && ! $item->button )
					$item_output .= '<a'. $attributes .'>' . $icon_html;
				else {
					$item_output .= ( $args->has_children) ? '<a'. $attributes .' data-type="title">' : '<a'. $attributes .'>';
				}

				if ($item->button) {
					$item_output .= '<div class="menu-btn-table"><div class="menu-btn-cell"><div'.$class_names.'><span>' . $args->link_before . ( ! empty( $item->icon ) ? '<i class="menu-icon ' . esc_attr( $item->icon ) . '"></i>' : '') . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</span></div></div></div>'.$description.'</a>';
				} else {
					$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
					$item_output .= ( $args->has_children) ? '<i class="fa fa-angle-down fa-dropdown"></i>' . $description . '</a>' : '<i class="fa fa-angle-right fa-dropdown"></i>' . $description . '</a>';
				}
			} else {
				$item_output .= $item->title;
			}

			$item_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	 * Traverse elements to create list from elements.
	 *
	 * Display one element if the element doesn't have any children otherwise,
	 * display the element and its children. Will only traverse up to the max
	 * depth and no ignore elements under that depth.
	 *
	 * This method shouldn't be called directly, use the walk() method instead.
	 *
	 * @see Walker::start_el()
	 * @since 2.5.0
	 *
	 * @param object $element Data object
	 * @param array $children_elements List of elements to continue traversing.
	 * @param int $max_depth Max depth to traverse.
	 * @param int $depth Depth of current element.
	 * @param array $args
	 * @param string $output Passed by reference. Used to append additional content.
	 * @return null Null on failure with no changes to parameters.
	 */
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 *
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			return $fb_output;
		}
	}
}

/**
* Navigation Menu widget class extended
*
* @since 3.0.0
*/
class Uncode_Nav_Menu_Widget extends WP_Nav_Menu_Widget {

	function widget($args, $instance) {

		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . $instance['title'] . $args['after_title'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'menu_class' => isset($args['menu_class']) ? $args['menu_class'] : 'menu' ) );

		echo $args['after_widget'];
	}

}

add_action("widgets_init", "uncode_custom_menu_widget");

function uncode_custom_menu_widget() {
	unregister_widget("WP_Nav_Menu_Widget");
	register_widget("Uncode_Nav_Menu_Widget");
}