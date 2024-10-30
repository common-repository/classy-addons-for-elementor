<?php
/**
 *  Menu Walker
 */

namespace ClassyEa\Helper\Classyea_Module\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Menu_Walker.
 */
class Classyea_Nav_Menu_Walker extends \Walker_Nav_Menu {

	
	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$args   = (object) $args;

		$class_names = '';
		$value       = '';
		$rel_xfn     = '';
		$rel_blank   = '';

		$classes = empty( $item->classes ) ? [] : (array) $item->classes;
		$submenu = $args->has_children ? ' has-submenu-custom' : '';

		if ( 0 === $depth ) {
			array_push( $classes, 'parent' );
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = ' class="' . esc_attr( $class_names ) . $submenu . '"';
		$value       = apply_filters( 'nav_menu_li_values', $value );

		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && false === strpos( $item->xfn, 'noopener' ) ) {
			$rel_xfn = ' noopener';
		}
		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && empty( $item->xfn ) ) {
			$rel_blank = 'rel="noopener"';
		}

		$atts  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$atts .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$atts .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . $rel_xfn . '"' : '' . $rel_blank;
		$atts .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$atts = apply_filters( 'classyea_nav_menu_attrs', $atts );

		$item_output = $args->before;
		$item_output .= '<a' . $atts;
		if ( 0 === $depth ) {
			$item_output .= ' class = "classyea-menu-item"';
		} else {
			$item_output .= in_array( 'current-menu-item', $item->classes ) ? ' class = "classyea-submenu-custom submenu-active"' : ' class = "classyea-submenu-custom"';
		}

		$item_output .= '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if ( $args->has_children ) {
			$item_output .= "<span class='classyea-menu-toggle sub-arrow classyea-menu-child-";
			$item_output .= $depth;
			$item_output .= "'><i></i>";
		}
		$item_output .= '</a>';

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * function element display here
	 *
	 */
	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

