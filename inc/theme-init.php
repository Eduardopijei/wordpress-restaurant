<?php

global $am_option;

if (!is_admin()){
	add_action( 'wp_enqueue_scripts', 'am_add_javascript' );
	add_action('wp_print_styles', 'am_add_css');
}

load_theme_textdomain( $am_option['textdomain'], get_template_directory() . '/languages' );

add_filter('body_class','am_browser_body_class');
add_filter('excerpt_more', 'am_excerpt_more');
add_action('widgets_init', 'am_the_widgets_init' );
add_action('widgets_init', 'am_unregister_default_wp_widgets', 1);
add_filter('the_title','am_has_title');
add_filter('the_content', 'am_texturize_shortcode_before' );
add_action( 'login_headerurl', 'am_login_logo_url' );
add_filter( 'comment_form_fields', 'am_move_comment_field_to_bottom' );
add_filter('upload_mimes', 'am_mime_types');
add_action('admin_head', 'am_svg_thumb_display');

// create demo user which can not install plugins and themes
add_action('init', 'am_demo_role');

//acf plugin
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false,
        'position' => 59
	));
	
	/*acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Socials Settings',
		'menu_title'	=> 'Socials',
		'parent_slug'	=> 'theme-general-settings',
	));*/
	
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'mainmenu' => __( 'Main Navigation', 'am' ),
	'footermenu' => __( 'Footer Navigation', 'am' ),
) );

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// This theme uses post thumbnails
add_theme_support( 'post-thumbnails' );

add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 */
add_theme_support('title-tag');

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Allow Shortcodes in Sidebar Widgets
add_filter('widget_text', 'do_shortcode');

//remove_filter( 'the_content', 'wpautop' );
//add_filter( 'the_content', 'wpautop' , 99);
//add_filter( 'the_content', 'shortcode_unautop',100 );

// Image Sizes
add_image_size( 'two-images-big', 630, 984, true );
add_image_size( 'two-images-big-2x', 1260, 1968, true );

add_image_size( 'two-images-small', 440, 620, true );
add_image_size( 'two-images-small-2x', 880, 1240, true );

add_image_size( 'culinary-slider', 442, 663, true );
add_image_size( 'culinary-slider-2x', 884, 1326, true );

add_image_size( 'single-culinary', 584, 729, true );
add_image_size( 'single-culinary-2x', 1168, 1458, true );

add_image_size( 'offer-module', 570, 700, true );
add_image_size( 'offer-module-2x', 1140, 1400, true );

add_image_size( 'post-module', 570, 425, true );
add_image_size( 'post-module-2x', 570, 850, true );

add_image_size( 'slide-image', 1210, 665, true );
add_image_size( 'slide-image-2x', 2420, 1330, true );

add_image_size( 'boston-module', 500, 600, true );
add_image_size( 'boston-module-2x', 1000, 1200, true );

//show_admin_bar(false);
//define( 'WPCF7_AUTOP', false );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function am_content_width() {
    $GLOBALS['content_width'] = apply_filters('wfc_content_width', 960);
}

add_action('after_setup_theme', 'am_content_width', 0);
?>