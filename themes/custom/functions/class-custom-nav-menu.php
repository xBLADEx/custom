<?php
/**
 * Class Custom Nav Menu
 *
 * @package Custom
 */

/**
 * Class Custom Nav Menu
 */
class Custom_Nav_Menu extends Walker_Nav_Menu {
	public $nav_bar = '';

	public function __construct( $nav_args = '' ) {
		$defaults = [
			'item_type'  => 'li',
			'in_top_bar' => false,
		];

		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent    = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$slug      = sanitize_title( $item->title );
		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$classes   = preg_replace( '/(current([-_]page[-_])(item|parent|ancestor))/', '', $classes );
		$classes   = preg_replace( '/^((menu|page)[-_\w+]+)+/', '', $classes );
		$classes[] = 'navigation__item navigation__item--' . $slug;
		$classes   = array_unique( $classes );

		if ( $args->has_children && 'li' === $this->nav_bar['item_type'] ) {
			if ( 0 === $depth && false === $this->nav_bar['in_top_bar'] ) {
				$classes[] = 'navigation__sub-menu-parent';
			}
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			$output .= $indent . '<li ' . $class_names . '>';
		} else {
			$output .= $indent . '<' . $this->nav_bar['item_type'] . ' ' . $class_names . '>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$item_output  = $args->before;
		$item_output .= '<a ' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= $item->description ? '<span class="navigation__description">' . $item->description . '</span>' : '';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= '</' . $this->nav_bar['item_type'] . ">\n";
		}
	}

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 0 === $depth && 'li' === $this->nav_bar['item_type'] ) {
			$output .= '<ul class="navigation__sub-menu">';
		} else {
			$output .= '<ul class="level-' . $depth . '">';
		}
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= '</ul>';
	}
}
