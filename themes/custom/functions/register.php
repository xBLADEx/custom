<?php
//--------------------------------------------------------------
// Register
//--------------------------------------------------------------

//--------------------------------------------------------------
// Sidebars
//--------------------------------------------------------------
if ( ! function_exists( 'custom_widgets' ) ) {
	function custom_widgets() {
		// Sidebar Right
		register_sidebar(
            array(
    			'name' 			=> 'Sidebar Right',
    			'id' 			=> 'sidebar-right',
    			'description' 	=> '',
    			'class'			=> 'sidebar-right',
    			'before_widget' => '<div class="sidebar-widget">',
    			'after_widget' 	=> '</div>',
    			'before_title' 	=> '<h5>',
    			'after_title' 	=> '</h5>'
    		)
        );
		// Sidebar Left
		register_sidebar(
            array(
    			'name' 			=> 'Sidebar Left',
    			'id' 			=> 'sidebar-left',
    			'description' 	=> '',
    			'class'			=> 'sidebar-left',
    			'before_widget' => '<div class="sidebar-widget">',
    			'after_widget' 	=> '</div>',
    			'before_title' 	=> '<h5>',
    			'after_title' 	=> '</h5>'
    		)
        );
		// Sidebar Blog
		register_sidebar(
            array(
    			'name' 			=> 'Sidebar Blog',
    			'id' 			=> 'sidebar-blog',
    			'description' 	=> '',
    			'class'			=> 'sidebar-blog',
    			'before_widget' => '<div class="sidebar-widget">',
    			'after_widget' 	=> '</div>',
    			'before_title' 	=> '<h5>',
    			'after_title' 	=> '</h5>'
    		)
        );
	}
	add_action( 'widgets_init', 'custom_widgets' );
}

//--------------------------------------------------------------
// Navigation
//--------------------------------------------------------------
register_nav_menus(
	array( // http://codex.wordpress.org/Function_Reference/register_nav_menus
	    'main_nav' 		=> 'Main Navigation',
	    'secondary_nav' => 'Secondary Navigation'
	)
);

//--------------------------------------------------------------
// Walker Nav Menu
//--------------------------------------------------------------
class Custom_Nav_Menu extends Walker_Nav_Menu {

    var $nav_bar = '';

    function __construct( $nav_args = '' ) {
        $defaults = array(
            'item_type'     => 'li',
            'in_top_bar'    => false,
            'menu_type'     => 'main-menu' //enable menu differenciation, used in preg_replace classes[] below
        );
        $this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $classes = empty( $item->classes ) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $slug = sanitize_title($item->title);
        //$classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', '', $classes);
        $classes = preg_replace('/(current([-_]page[-_])(item|parent|ancestor))/', '', $classes);
        $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);
        $menu_type = $this->nav_bar['menu_type'];
        //$classes[] = 'menu-item menu-item-' . $menu_type . ' menu-item-' . $slug;
        $classes[] = 'menu-item menu-item-' . $slug;
        $classes = array_unique($classes);

        // Check for flyout
        $flyout_toggle = '';
        if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {
            if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {
                $classes[] = 'has-flyout';
                // $flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';
            } else if ( $this->nav_bar['in_top_bar'] == true ) {
                $classes[] = 'has-dropdown';
                $flyout_toggle = '';
            }
        }

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

        if ( $depth > 0 ) {
            $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        } else {
            $output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider"></li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
        }

        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

        $item_output = $args->before;
        $item_output .= '<a '. $attributes .'>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= $item->description ? '<span class="desc">' . $item->description . '</span>' : '';
        $item_output .= '</a>';
        $item_output .= $flyout_toggle;
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

    function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( $depth > 0 ) {
            $output .= "</li>\n";
        } else {
            $output .= "</" . $this->nav_bar['item_type'] . ">\n";
        }
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
            $indent = str_repeat("\t", 1);
            $output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"flyout\">\n";
        } else {
            $indent = str_repeat("\t", $depth);
            $output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

}
