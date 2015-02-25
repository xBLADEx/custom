<?php
/* 
====================
	FUNCTIONS
====================

====================
	LEGEND
====================
THEME SUPPORT
ENQUEUE SCRIPTS
HEADER CLEAN UP
PAGINATION
SIDEBARS
POST EXCERPT
COMMENTS TEMPLATE
STICKY POST
TITLE TAG
WALKER NAVIGATION
CUSTOM QUICKTAGS
LOGIN LOGO
BLANK SEARCH RESULTS FIX
SHORTCODES
*/
// Initiate Foundation
if ( ! function_exists( 'foundation_setup' ) ) {
	function foundation_setup() {
		// Support for Featured Images
		add_theme_support( 'post-thumbnails' ); 
		// Automatic Feed Links & Post Formats
		add_theme_support( 'automatic-feed-links' );
		// Enable support for Post Formats. See http://codex.wordpress.org/Post_Formats
		// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status' ) );
	}
	add_action( 'after_setup_theme', 'foundation_setup' );
}
// Enqueue Scripts and Styles for Front-End
if ( ! function_exists( 'foundation_assets' ) ) {
	function foundation_assets() { 
		if ( ! is_admin() ) { 
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
			// wp_enqueue_style( $handle, $src, $deps, $ver, $media );
			// wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Open+Sans:300,400', array(), '1.0' );
			wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '3.0.1' );
			wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.css', array(), '5.5.1' );
			// wp_enqueue_style( 'jquery-ui-css', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css', array(), '1.11.2' );
			wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.0' );
			wp_enqueue_style( 'custom', get_stylesheet_uri(), array(), '5.5.1' );
			// http://codex.wordpress.org/Function_Reference/wp_enqueue_script
			// wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
			wp_deregister_script( 'jquery' );
			wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/vendor/jquery.js', array(), '2.1.1', true );
			// wp_enqueue_script( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js', array(), '1.11.2', true );
			wp_enqueue_script( 'foundation', get_template_directory_uri() . '/js/foundation.min.js', array(), '5.5.1', true );
			wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.8.3', true );
			wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array(), '1.3.6', true );
			wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array(), '1.0', true);
		}
	}
	add_action( 'wp_enqueue_scripts', 'foundation_assets' );
}
// Header Clean up
remove_action( 'wp_head', 'wp_generator' ); // This removes the WordPress version
remove_action( 'wp_head', 'rsd_link' ); // This removes Windows Live Writer (WLW)
remove_action( 'wp_head', 'wlwmanifest_link' ); // This removes Windows Live Writer (WLW)
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Removes rel='prev' and rel='next'
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // Remove shortlink
function remove_cssjs_ver( $src ) { // Remove version number after Scripts and Styles
    if ( strpos( $src, '?ver=' ) ) {
        $src = remove_query_arg( 'ver', $src );
    }
    return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );
function remove_recent_comments_style() { // Remove recent comments style tag
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}
add_action( 'widgets_init', 'remove_recent_comments_style' );
// Create pagination
if ( ! function_exists( 'blade_pagination' ) ) {
	function blade_pagination() {
		global $custom_query;
		$big = 999999999;
		$pagArg = array( // http://codex.wordpress.org/Function_Reference/paginate_links
			'base'         			=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'       			=> '?page=%#%',
			'total'        			=> $custom_query->max_num_pages,
			'current'      			=> max( 1, get_query_var('paged') ),
			'show_all'     			=> False,
			'end_size'     			=> 1,
			'mid_size'     			=> 2,
			'prev_next'    			=> True,
			'prev_text'    			=> '&laquo; Previous',
			'next_text'    			=> 'Next &raquo;',
			'type'         			=> 'list',
			'add_args'     			=> False,
			'add_fragment' 			=> '',
			'before_page_number' 	=> '',
			'after_page_number' 	=> ''
		);
		echo paginate_links( $pagArg ); 
	}
}
// Register Sidebars
if ( ! function_exists( 'foundation_widgets' ) ) {
	function foundation_widgets() {
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
	add_action( 'widgets_init', 'foundation_widgets' );
}
// Custom Post Excerpt
if ( ! function_exists( 'foundation_excerpt' ) ) {
	function foundation_excerpt( $text ) {
        global $post;
        if ( '' == $text ) {
            $text = get_the_content( '' );
            $text = apply_filters( 'the_content', $text );
            $text = str_replace( '\]\]\>', ']]&gt;', $text );
            $text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
            $text = strip_tags( $text, '<p>' );
            $excerpt_length = 80;
            $words = explode( ' ', $text, $excerpt_length + 1 );
            if ( count( $words ) > $excerpt_length ) {
                array_pop( $words );
                array_push( $words, '... <br><br><a href="' . get_permalink( $post->ID ) . '" class="button">Read More</a>' );
                $text = implode( ' ', $words );
            }
        }
        return $text;
	}
	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'foundation_excerpt' );
}
// Comments Template
if ( ! function_exists( 'foundation_comment' ) ) {
	function foundation_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) {
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<p>Pingback: <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'foundation' ), '<span>', '</span>' ); ?></p>
		<?php
			break;
			default :
			global $post;
		?>
		<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header>
					<?php
						echo "<span class='comment-gravatar'>";
						echo get_avatar( $comment, 44 );
						echo "</span>";
						printf( '%2$s %1$s',
							get_comment_author_link(),
							( $comment->user_id === $post->post_author ) ? '<span>Posted by: </span>' : ''
						);
						printf( '<br><a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							sprintf( __( '%1$s at %2$s', 'foundation' ), get_comment_date(), get_comment_time() )
						);
					?>
				</header>
				<?php if ( '0' == $comment->comment_approved ) { ?>
					<p>Your comment is awaiting moderation.</p>
				<?php } ?>
				<section>
					<?php comment_text(); ?>
				</section>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply', 'after' => ' &darr; <br><br>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div>
			</article>
		<?php
			break;
		}
	}
}
// Remove Class from Sticky Post
if ( ! function_exists( 'foundation_remove_sticky' ) ) {
	function foundation_remove_sticky( $classes ) {
	  $classes = array_diff( $classes, array( 'sticky' ) );
	  return $classes;
	}
	add_filter( 'post_class', 'foundation_remove_sticky' );
}
// Custom Title Tag
function foundation_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) { return $title; }
	// Add the site name.
	$title .= " " . get_bloginfo( 'name' );
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'foundation' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'foundation_title', 10, 2 );
// Register wp_nav_menu()
register_nav_menus( array( // http://codex.wordpress.org/Function_Reference/register_nav_menus
    'main_nav' 		=> 'Main Navigation',
    'secondaryNav' 	=> 'Secondary Navigation'
));
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
        $classes   		= empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] 		= 'menu-item-' . $item->ID;      
        // Check for flyout
        $flyout_toggle = '';
        if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {
            if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {
                $classes[]     = 'has-drop';
                //$flyout_toggle = '<a href="#" class="drop-toggle"><span></span></a>';
            } elseif ( $this->nav_bar['in_top_bar'] == true ) {
                $classes[]     = 'has-dropdown';
                //$flyout_toggle = '';
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
        //$item_output .= $flyout_toggle; // Add possible flyout toggle
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
// Yes you can overwrite the whole function
if( ! function_exists( 'required_side_nav' ) ) { // Displays a simple subnav with child pages of the current
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
        // Make sure the dl only shows 1 level
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
// End Navigation Walker
// Filter certain buttons from showing in the wordpress html editor for pages/posts
function custom_remove_quicktags( $qtInit ) {
	// Whatever is in the below string displays in the editor. !Important! No spaces after the comma.
	$qtInit['buttons'] = 'link';
	return $qtInit;
}
add_filter( 'quicktags_settings', 'custom_remove_quicktags' );
// Add custom buttons to the wordpress html editor for pages/posts
function custom_add_quicktags() { ?>
	<script>
		if ( typeof( QTags ) == 'function' ) {
			QTags.addButton( 'eg_div6', 'div 6', '<div class="medium-6 columns">\n', '\n</div>', 'd', 'Div 6', 1 );
			QTags.addButton( 'eg_div', 'div', '<div class="">\n', '\n</div>', 'd', 'Division', 1 );
			QTags.addButton( 'eg_h2', 'H2', '<h2>', '</h2>', '2', 'Heading 2', 1 );
			QTags.addButton( 'eg_h3', 'H3', '<h3>', '</h3>', '3', 'Heading 3', 1 );
			QTags.addButton( 'eg_h4', 'H4', '<h4>', '</h4>', '4', 'Heading 4', 1 );
			QTags.addButton( 'eg_paragraph', 'p', '<p>', '</p>', 'p', 'Paragraph', 1 );
	        QTags.addButton( 'eg_span', 'span', '<span>', '</span>', 'span', 'Span', 1 );
	        QTags.addButton( 'eg_bold', 'bold', '<span class="bold">', '</span>', 'bold', 'Bold', 1 );
	        QTags.addButton( 'eg_italic', 'italic', '<span class="italic">', '</span>', 'italic', 'Italic', 1 );
			QTags.addButton( 'eg_break', 'br', '<br>', '', 'b', 'Line Break', 20 );
			QTags.addButton( 'eg_hrule', 'hr', '<hr>\n', '', 'h', 'Horizontal Rule', 20 );
			QTags.addButton( 'eg_ordered', 'ol', '<ol>\n', '\n</ol>', 'o', 'Ordered List', 20 );
			QTags.addButton( 'eg_unordered', 'ul', '<ul>\n', '\n</ul>', 'u', 'Unordered List', 20 );
			QTags.addButton( 'eg_listitem', 'li', '<li>', '</li>', 'l', 'List Item', 20 );
		}
	</script>
<?php
}
add_action( 'admin_print_footer_scripts', 'custom_add_quicktags' );
// Custom Login Logo
function my_login_logo() { // http://codex.wordpress.org/Customizing_the_Login_Form ?>
    <style>
        body.login div#login h1 a {
            background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/logo-login.jpg');
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );
// Fix blank search results
function blankSearch( $query ) {
    // If 's' request variable is set but empty
    if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) && $query->is_main_query() ) {
        $query->is_search = true;
        $query->is_home = false;
    }
    return $query;
}
add_filter( 'pre_get_posts', 'blankSearch' );
// SHORTCODES 
add_shortcode( 'name', 'function_name' ); // [name]
function function_name() {
	ob_start();
	?>
	
	<?php 
	return ob_get_clean();
}
?>