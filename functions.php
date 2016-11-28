<?php
/**
 * WCBarcelona16 Demo functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WCBarcelona16_Demo
 */

if ( ! function_exists( 'wcbcn_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wcbcn_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'wcbcn' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wcbcn', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'wcbcn-featured-image', 640, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu_1' => esc_html__( 'Top', 'wcbcn' ),
		) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wcbcn_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'wcbcn_setup' );



/**
 * Enqueue scripts and styles.
 */
function wcbcn_scripts() {
	wp_enqueue_style( 'wcbcn-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wcbcn-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons');

	wp_enqueue_script( 'wcbcn-dependencies', get_template_directory_uri() . '/assets/js/dependencies.js', array(), '20161009', false );

wp_enqueue_script( 'wcbcn-script', get_template_directory_uri() . '/assets/js/script.js', array(), '20161009', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wcbcn_scripts' );


/**
* Register custom post type: Serie.
*/
function cpt_series() {

$labels = array(
'name'                  => _x( 'Series', 'Post Type General Name', 'wcbcn' ),
'singular_name'         => _x( 'Serie', 'Post Type Singular Name', 'wcbcn' ),
'menu_name'             => __( 'Series', 'wcbcn' ),
'name_admin_bar'        => __( 'Serie', 'wcbcn' ),
'archives'              => __( 'Serieteca', 'wcbcn' ),
'parent_item_colon'     => __( 'Serie padre:', 'wcbcn' ),
'all_items'             => __( 'Todas las series', 'wcbcn' ),
'add_new_item'          => __( 'Añadir nueva serie', 'wcbcn' ),
'add_new'               => __( 'Añadir nueva', 'wcbcn' ),
'new_item'              => __( 'Nueva serie', 'wcbcn' ),
'edit_item'             => __( 'Editar serie', 'wcbcn' ),
'update_item'           => __( 'Actualizar serie', 'wcbcn' ),
'view_item'             => __( 'Ver serie', 'wcbcn' ),
'search_items'          => __( 'Buscar serie', 'wcbcn' ),
'not_found'             => __( 'No se han encontrado series', 'wcbcn' ),
'not_found_in_trash'    => __( 'No se han encontrado series en la papelera', 'wcbcn' ),
'featured_image'        => __( 'Imagen destacada', 'wcbcn' ),
'set_featured_image'    => __( 'Establecer imagen destacada', 'wcbcn' ),
'remove_featured_image' => __( 'Quitar imagen destacada', 'wcbcn' ),
'use_featured_image'    => __( 'Usar como imagen destacada', 'wcbcn' ),
'insert_into_item'      => __( 'Insertar en serie', 'wcbcn' ),
'uploaded_to_this_item' => __( 'Subido a esta serie', 'wcbcn' ),
'items_list'            => __( 'Lista de series', 'wcbcn' ),
'items_list_navigation' => __( 'Navegación en lista de series', 'wcbcn' ),
'filter_items_list'     => __( 'Filtrar lista de series', 'wcbcn' ),
);
$args = array(
'label'                 => __( 'Serie', 'wcbcn' ),
'description'           => __( 'Post personalizado: Serie de TV.', 'wcbcn' ),
'labels'                => $labels,
'supports'              => array( 'title', 'editor', 'author', 'thumbnail' ),
'taxonomies'            => array( 'category', 'post_tag' ),
'hierarchical'          => false,
'public'                => true,
'show_ui'               => true,
'show_in_menu'          => true,
'menu_position'         => 5,
'show_in_admin_bar'     => true,
'show_in_nav_menus'     => true,
'menu_icon'				=> 'dashicons-format-video',
'can_export'            => true,
'has_archive'           => true,
'exclude_from_search'   => false,
'publicly_queryable'    => true,
'capability_type'       => 'page',
'show_in_rest'			=> true,
'rest_base'				=> 'series'
);
register_post_type( 'series', $args );

}
add_action( 'init', 'cpt_series', 0 );

function my_rewrite_flush() {
	cpt_series();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );