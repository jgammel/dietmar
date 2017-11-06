<?php
/**
 * Dietmar Winkler functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Dietmar_Winkler
 */

if ( ! function_exists( 'drw_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function drw_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Dietmar Winkler, use a find and replace
		 * to change 'drw' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'drw', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'drw' ),
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
		add_theme_support( 'custom-background', apply_filters( 'drw_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'drw_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function drw_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'drw_content_width', 640 );
}
add_action( 'after_setup_theme', 'drw_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function drw_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'drw' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'drw' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'drw_widgets_init' );

/**
 * Set up custom taxonomies for categorizing portfolio content.
 */
 if ( ! function_exists( 'custom_taxonomy' ) ) {

// Register Custom Taxonomy
function custom_taxonomy_client() {

	$labels = array(
		'name'                       => _x( 'Client', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Client', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Client', 'text_domain' ),
		'all_items'                  => __( 'All Clients', 'text_domain' ),
		'parent_item'                => __( 'Parent Client', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Client:', 'text_domain' ),
		'new_item_name'              => __( 'New Client Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Client', 'text_domain' ),
		'edit_item'                  => __( 'Edit Client', 'text_domain' ),
		'update_item'                => __( 'Update Client', 'text_domain' ),
		'view_item'                  => __( 'View Client', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No Clients', 'text_domain' ),
		'items_list'                 => __( 'Clients list', 'text_domain' ),
		'items_list_navigation'      => __( 'Clients list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'client',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'client', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_taxonomy_client', 0 );
function custom_taxonomy_genre() {

	$labels = array(
		'name'                       => _x( 'Genre', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'Genre', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'Genre', 'text_domain' ),
		'all_items'                  => __( 'All Genres', 'text_domain' ),
		'parent_item'                => __( 'Parent Item', 'text_domain' ),
		'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
		'new_item_name'              => __( 'New Genre Name', 'text_domain' ),
		'add_new_item'               => __( 'Add New Genre', 'text_domain' ),
		'edit_item'                  => __( 'Edit Genre', 'text_domain' ),
		'update_item'                => __( 'Update Genre', 'text_domain' ),
		'view_item'                  => __( 'View Genre', 'text_domain' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
		'popular_items'              => __( 'Popular Items', 'text_domain' ),
		'search_items'               => __( 'Search Items', 'text_domain' ),
		'not_found'                  => __( 'Not Found', 'text_domain' ),
		'no_terms'                   => __( 'No items', 'text_domain' ),
		'items_list'                 => __( 'Items list', 'text_domain' ),
		'items_list_navigation'      => __( 'Items list navigation', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                       => 'genre',
		'with_front'                 => true,
		'hierarchical'               => false,
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
		'rewrite'                    => $rewrite,
	);
	register_taxonomy( 'genre', array( 'portfolio' ), $args );

}
add_action( 'init', 'custom_taxonomy_genre', 0 );
}
//Register Custom Metaboxes

/* 1) Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'drw_box_year_setup' );
add_action( 'load-post-new.php', 'drw_box_year_setup' );

/* 2) Meta box setup function. */
function drw_box_year_setup() {
	add_action( 'add_meta_boxes', 'drw_add_custom_box' );
	add_action( 'save_post', 'drw_save_postdata', 10, 2 );
}

/* 3) Create one or more meta boxes to be displayed on the post editor screen. */
function drw_add_custom_box()
{
    add_meta_box(
        'drw_box_year',			// Unique ID
        'Year',  				// Box title
        'drw_box_year_html',  	// Content callback, must be of type callable
        'portfolio',            // Post type
        'normal', 				//Context
        'high' 					//Priority
    );
}
add_action('add_meta_boxes', 'drw_add_custom_box');

/* 4) Display the post meta box. */
function drw_box_year_html($post)
{
     wp_nonce_field( basename( __FILE__ ), 'drw_box_year_nonce' ); ?>
     
    <label for="drw_box_year">Year work was completed:</label>
    <br/>
    <input type="text" name="drw_box_year" id="drw_box_year" value="<?php echo esc_attr( get_post_meta( $post->ID, 'drw_box_year', true ) ); ?>" size="30"></input>
    <?php
}

function drw_save_postdata($post_id, $post)
{
/* Verify the nonce before proceeding. */
  if ( !isset( $_POST['drw_box_year_nonce'] ) || !wp_verify_nonce( $_POST['drw_box_year_nonce'], basename( __FILE__ ) ) )
    return $post_id;

  /* Get the post type object. */
  $post_type = get_post_type_object( $post->post_type );

  /* Check if the current user has permission to edit the post. */
  if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
    return $post_id;

  /* Get the posted data and sanitize it for use as an HTML class. */
  $new_meta_value = ( isset( $_POST['drw_box_year'] ) ? sanitize_html_class( $_POST['drw_box_year'] ) : '' );
  /* Get the meta key. */
  $meta_key = 'drw_box_year';

  /* Get the meta value of the custom field key. */
  $meta_value = get_post_meta( $post_id, $meta_key, true );

  /* If a new meta value was added and there was no previous value, add it. */
  if ( $new_meta_value && '' == $meta_value )
    add_post_meta( $post_id, $meta_key, $new_meta_value, true );

  /* If the new meta value does not match the old value, update it. */
  elseif ( $new_meta_value && $new_meta_value != $meta_value )
    update_post_meta( $post_id, $meta_key, $new_meta_value );

  /* If there is no new meta value but an old value exists, delete it. */
  elseif ( '' == $new_meta_value && $meta_value )
    delete_post_meta( $post_id, $meta_key, $meta_value );
}
/**
 * Set up portfolio custom post type.
 */
if ( ! function_exists('portfolio') ) {

// Register Custom Post Type
function portfolio() {

	$labels = array(
		'name'                  => _x( 'Portfolio Items', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Portfolio Item', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Portfolio', 'text_domain' ),
		'name_admin_bar'        => __( 'Portfolio', 'text_domain' ),
		'archives'              => __( 'Portfolio Archive', 'text_domain' ),
		'attributes'            => __( 'Portfolio Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
		'all_items'             => __( 'All Portfolio Items', 'text_domain' ),
		'add_new_item'          => __( 'Add New Portfolio Item', 'text_domain' ),
		'add_new'               => __( 'Add New Portfolio Item', 'text_domain' ),
		'new_item'              => __( 'New Portfolio Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Portfolio Item', 'text_domain' ),
		'update_item'           => __( 'Update Portfolio Item', 'text_domain' ),
		'view_item'             => __( 'View Portfolio Item', 'text_domain' ),
		'view_items'            => __( 'View Portfolio Items', 'text_domain' ),
		'search_items'          => __( 'Search Portfolio Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$rewrite = array(
		'slug'                  => 'portfolio',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Portfolio Item', 'text_domain' ),
		'description'           => __( 'Piece of content from Dietmar\'s portfolio', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		'taxonomies'            => array( 'client', 'post_tag', 'genre' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => false,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'page',
		'menu_icon'				=> 'dashicons-art',
	);
	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'portfolio', 0 );

}
/**
 * Enqueue scripts and styles.
 */
function drw_scripts() {
	wp_enqueue_style( 'drw-style', get_template_directory_uri() . '/sass/style.css' );
	
	wp_enqueue_style( 'drw-fonts', get_template_directory_uri() . '/fonts/MyFontsWebfontsKit.css' );

	wp_enqueue_script( 'drw-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'drw-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'drw_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

