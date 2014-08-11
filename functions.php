<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Concise Theme' );
define( 'CHILD_THEME_URL', 'http://wpspeak.com/themes/concise/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'concise_custom_scripts' );
function concise_custom_scripts() {

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_script( 'concise-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );

}

//* Create blue, green, orange and red color style options
add_theme_support( 'genesis-style-selector', array(
	'concise-green'	=> __( 'Green', 'concise' ),
	'concise-blue'	=> __( 'Blue', 'concise' ),
) );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Register new featured image size
add_image_size( 'concise-img', 660, 250, TRUE ); 

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for 2-column footer widgets
add_theme_support( 'genesis-footer-widgets', 2 );

//* Remove the site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );

//* Unregister layouts
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Unregister sidebars
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );

add_filter( 'wp_nav_menu_objects', 'concise_filter_menu_class' );
/**
 * Filters the first and last nav menu objects in your menus
 * to add custom classes.
 *
 * @since 1.0.0
 *
 * @param object $objects An array of nav menu objects
 * @return object $objects Amended array of nav menu objects with new class
 */
function concise_filter_menu_class( $objects ) {
 
    // Add "last-menu-item" class to the last menu object
    $objects[count( $objects )]->classes[] = 'last-menu-item';
 
    // Return the menu objects
    return $objects;
 
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'concise_author_box_gravatar_size' );
function concise_author_box_gravatar_size( $size ) {

	return '100';

}

//* Add 'one-third' class to Entry Header so that Post Title appears left
add_filter( 'genesis_attr_entry-header', 'concise_genesis_attributes_entry_header' );
/**
 * Add attributes for entry header element.
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function concise_genesis_attributes_entry_header( $attributes ) {
 
	$attributes['class'] = 'entry-header one-third first';
	return $attributes;
 
}

//* Add 'two-thirds' class to Entry Content so that Excerpt appears right
add_filter( 'genesis_attr_entry-content', 'concise_genesis_attributes_entry_content' );
/**
 * Add attributes for entry content element.
 * @param array $attributes Existing attributes.
 * @return array Amended attributes.
 */
function concise_genesis_attributes_entry_content( $attributes ) {
 
	$attributes['class'] = 'entry-content two-thirds';
	return $attributes;
 
}

//* Customize the entry meta in the entry header (requires HTML5 theme support)
add_filter( 'genesis_post_info', 'concise_post_info_filter' );
function concise_post_info_filter($post_info) {
	$post_info = '[post_date before="<i>Published //</i> "] [post_author_posts_link before="Author // "] [post_comments before="Comments // "] [post_categories before="Categories // "] [post_tags before="Tags // "] [post_edit] ';
	return $post_info;
}

//* Remove the entry meta in the entry footer (requires HTML5 theme support)
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Remove HTML allowed tag in comment form
add_filter( 'comment_form_defaults', 'concise_comment_form_allowed_tags' );
function concise_comment_form_allowed_tags( $defaults ) {
 
	$defaults['comment_notes_after'] = '';
	return $defaults;
 
}

//* Change the footer text
add_filter('genesis_footer_creds_text', 'concise_footer_creds_filter');
function concise_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; ' . get_bloginfo('name') . ' &middot; [footer_childtheme_link before="Designed by "]';
	return $creds;
}

//* Add top widget section
add_action( 'genesis_after_header', 'concise_top_widget', 15 );
function concise_top_widget() {

	genesis_widget_area( 'top-widget', array(
		'before' => '<aside class="top-widget"> <div class="wrap">',
		'after'  => '</aside> </div>',
	) );
	
}

//** Register top widget in sidebar
genesis_register_sidebar( array(
    'id'       		 => 'top-widget',
    'name'			 => __( 'Top  Widget', 'concise' ),
    'description'    => __( 'This is the top widget section.', 'concise' ),
) );