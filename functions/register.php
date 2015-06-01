<?php
/* 
====================
	FUNCTIONS - REGISTER
====================
*/

// Register Sidebars
if ( ! function_exists( 'custom_widgets' ) ) {
	function custom_widgets() {
		// Sidebar Right
		register_sidebar( array(
			'name' 			=> 'Sidebar Right',
			'id' 			=> 'sidebar-right',
			'description' 	=> '',
			'class'			=> '',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h5>',
			'after_title' 	=> '</h5>'
		) );
		// Sidebar Left
		register_sidebar( array(
			'name' 			=> 'Sidebar Left',
			'id' 			=> 'sidebar-left',
			'description' 	=> '',
			'class'			=> '',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h5>',
			'after_title' 	=> '</h5>'
		) );
		// Sidebar Blog
		register_sidebar( array(
			'name' 			=> 'Sidebar Blog',
			'id' 			=> 'sidebar-blog',
			'description' 	=> '',
			'class'			=> '',
			'before_widget' => '<div class="sidebar-widget">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<h5>',
			'after_title' 	=> '</h5>'
		) );
	}
	add_action( 'widgets_init', 'custom_widgets' );
}

// Register wp_nav_menu()
register_nav_menus( 
	array( // http://codex.wordpress.org/Function_Reference/register_nav_menus
	    'main_nav' 		=> 'Main Navigation',
	    'secondary_nav' => 'Secondary Navigation'
	)
);

// Navigation Walker
class Custom_Navigation_Walker extends Walker_Nav_Menu {
    // Specify the item type to allow different walkers
    var $nav_bar = ''; 
    function __construct( $nav_args = '' ) {
        $defaults = array(
            'item_type' 	=> 'li',
            'in_top_bar' 	=> false
        );
        $this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
    }  
    function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';
        $class_names 	= $value = '';
        $classes   		= empty( $item->classes ) ? array() : (array)$item->classes;
        $classes[] 		= 'menu-item-' . $item->ID;      
        // Check for flyout
        if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {
            if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {
                $classes[] = 'has-drop';
            } elseif ( $this->nav_bar['in_top_bar'] == true ) {
                $classes[] = 'has-dropdown';
            }
        }
        // Add class names to the li.divider from parent menu item
        $class_names_divider = join( ' ', $item->classes );
        $class_names         = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
        $class_names         = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';     
        if ( $depth > 0 ) {
            $output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        } else {
            $output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider' . $class_names_divider . '"></li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
        }
        $attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
        $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
        $attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
        $item_output = $args->before;
        $item_output .= '<a ' . $attributes . '>';
        $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
        $item_output .= '</a>';
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
            $indent = str_repeat( "\t", 1 );
            $output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"navdrop\">\n";
        } else {
            $indent = str_repeat( "\t", $depth );
            $output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
        }
    }
}


if ( ! function_exists( 'required_side_nav' ) ) { // Displays a simple subnav with child pages of the current
    function required_side_nav( $nav_args = '' ) {
        global $post;
        $defaults = array(
            'show_home' => false,
            'depth' 	=> 1,
            'before' 	=> '<ul class="side-nav">',
            'after' 	=> '</ul>',
            'item_type' => 'li'
        );
        $nav_args = apply_filters( 'req_side_nav_args', wp_parse_args( $nav_args, $defaults ) );
        $args = array(
            'title_li' 		=> '',
            'depth' 		=> $nav_args['depth'],
            'sort_column' 	=> 'menu_order',
            'echo' 			=> 0
        );
        // Make sure it only shows 1 level
        if ( $nav_args['item_type'] != 'li' ) {
            $args['depth'] = 0;
        }
        if ( $post->post_parent ) {
            // So we have a post parent
            $args['child_of'] = $post->post_parent;
        } else {
            // So we don't have a post parent, so you are!
            $args['child_of'] = $post->ID;
        }
        // Filter the $args if you want to do something different!
        $children = wp_list_pages( $args );
        // Point as back home or not?
        if ( $nav_args['show_home'] == true ) {
            $nav_args['before'] .= '<li><a href="' . get_home_url() . '">' . __( '&larr; Home', 'requiredfoundation' ) . '</a></li><li class="divider"></li>';
        }
        // Do we have children?
        if ( $children ) {
            $output = $nav_args['before'] . $children . $nav_args['after'];
            // Replace the output if we are on a definition list
            if ( $nav_args['item_type'] != 'li' ) {
                $pattern_start = '/<li/';
                $pattern_end   = '/<\/li>/';
                $replace_start = '<dd';
                $replace_end   = '</dd>';
                $output = preg_replace( $pattern_start, $replace_start, $output );
                $output = preg_replace( $pattern_end, $replace_end, $output );
            }
            echo $output;
        }
    }
}