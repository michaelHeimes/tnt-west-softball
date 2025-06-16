<?php
/**
 * Trailhead functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package trailhead
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trailhead_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Trailhead, use a find and replace
		* to change 'trailhead' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'trailhead', get_template_directory() . '/languages' );

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
	
	// Default thumbnail size
	set_post_thumbnail_size(150, 150, true);

	// This theme uses wp_nav_menu() in one location.
	// register_nav_menus(
	// 	array(
	// 		'menu-1' => esc_html__( 'Primary', 'trailhead' ),
	// 	)
	// );

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'trailhead_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
			'header-text' => array( 'site-title', 'site-description' ),
		)
	);
}
add_action( 'after_setup_theme', 'trailhead_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function trailhead_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trailhead_content_width', 640 );
}
add_action( 'after_setup_theme', 'trailhead_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function trailhead_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'trailhead' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'trailhead' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(array(
		'id' => 'offcanvas',
		'name' => __('Offcanvas', 'trailhead'),
		'description' => __('The offcanvas sidebar.', 'trailhead'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));
	
}
add_action( 'widgets_init', 'trailhead_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function trailhead_scripts() {
	wp_enqueue_style( 'trailhead-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'trailhead-style', 'rtl', 'replace' );
	
	wp_enqueue_style( 'trailhead-style-min', get_template_directory_uri() . '/assets/styles/style.min.css', array(), _S_VERSION );
	
	wp_enqueue_script( 'app-js', get_template_directory_uri() . '/assets/scripts/app.min.js', array('jquery'), _S_VERSION, true );
	
	//wp_enqueue_script( 'trailhead-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trailhead_scripts' );


/**
 * Enqueue Google Fonts.
 */
wp_enqueue_style(
	 'pmi-google-fonts',
	 'https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Work+Sans:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap',
	 array(),
	 null
 );
 
 function google_font_loader_tag_filter( $html, $handle ) {
	 if ( $handle === 'pmi-google-fonts' ) {
		 $rel_preconnect = "rel='stylesheet preconnect'";
		 return str_replace(
			 "rel='stylesheet'",
			 $rel_preconnect,
			 $html
		 );
	 }
	 return $html;
 }
 add_filter( 'style_loader_tag', 'google_font_loader_tag_filter', 10, 2 );


// Disable Tabelpress Stylesheet
add_filter( 'tablepress_use_default_css', '__return_false' );



// for cpt-player admin, add team column and order by team then last-name
$team_related_cpts = ['cpt-player', 'cpt-staff'];

// 1. Add a "Team" column to each relevant CPT admin screen
foreach ($team_related_cpts as $post_type) {
	add_filter("manage_{$post_type}_posts_columns", function($columns) {
		$columns['acf_team'] = 'Team';
		return $columns;
	});
}

// 2. Display the related team post title in the custom column
add_action('manage_posts_custom_column', function($column, $post_id) {
	if ($column === 'acf_team') {
		$team_post = get_field('team', $post_id);
		if ($team_post && is_object($team_post)) {
			echo esc_html(get_the_title($team_post->ID));
		}
	}
}, 10, 2);

// 3. Make the column appear sortable
foreach ($team_related_cpts as $post_type) {
	add_filter("manage_edit-{$post_type}_sortable_columns", function($columns) {
		$columns['acf_team'] = 'acf_team';
		return $columns;
	});
}

// 4. Sort by team title and then by last-name
add_action('pre_get_posts', function($query) use ($team_related_cpts) {
	if (
		is_admin() &&
		$query->is_main_query() &&
		in_array($query->get('post_type'), $team_related_cpts, true) &&
		$query->get('orderby') === 'acf_team'
	) {
		global $wpdb;

		// Remove default meta_key so we can customize the SQL
		$query->set('meta_key', '');
		$query->set('orderby', ''); // we'll override it with custom SQL

		add_filter('posts_clauses', function($clauses) use ($wpdb) {
			$clauses['join'] .= "
				LEFT JOIN {$wpdb->postmeta} AS team_meta
					ON {$wpdb->posts}.ID = team_meta.post_id
					AND team_meta.meta_key = 'team'
				LEFT JOIN {$wpdb->posts} AS team_post
					ON team_meta.meta_value = team_post.ID
				LEFT JOIN {$wpdb->postmeta} AS last_name_meta
					ON {$wpdb->posts}.ID = last_name_meta.post_id
					AND last_name_meta.meta_key = 'last-name'
			";
			$clauses['orderby'] = "
				team_post.post_title ASC,
				last_name_meta.meta_value ASC
			";
			return $clauses;
		});
	}
});

// for cpt-staff admin, add team column and order by team then last-name
// 1. Add a "Team" column to the admin screen
// add_filter('manage_cpt-staff_posts_columns', function($columns) {
// 	$columns['acf_team'] = 'Team';
// 	return $columns;
// });
// 
// // 2. Display the related team post title in the custom column
// add_action('manage_cpt-staff_posts_custom_column', function($column, $post_id) {
// 	if ($column === 'acf_team') {
// 		$team_post = get_field('team', $post_id);
// 		if ($team_post && is_object($team_post)) {
// 			echo esc_html(get_the_title($team_post->ID));
// 		}
// 	}
// }, 10, 2);
// 
// // 3. Make the column appear sortable (though sorting is custom below)
// add_filter('manage_edit-cpt-staff_sortable_columns', function($columns) {
// 	$columns['acf_team'] = 'acf_team';
// 	return $columns;
// });
// 
// // 4. Sort by team title (from relationship field), then by last-name
// add_action('pre_get_posts', function($query) {
// 	if (
// 		is_admin() &&
// 		$query->is_main_query() &&
// 		$query->get('post_type') === 'cpt-staff'
// 	) {
// 		global $wpdb;
// 
// 		// Join to get the team post ID (meta_key = 'team')
// 		$query->set('meta_key', 'team');
// 		$query->set('orderby', [
// 			'team_title_clause'     => 'ASC',
// 			'last_name_clause'      => 'ASC',
// 		]);
// 
// 		// Extend the query with JOINs and ORDER BY
// 		add_filter('posts_clauses', function($clauses) use ($wpdb) {
// 			$clauses['join'] .= "
// 				LEFT JOIN {$wpdb->postmeta} AS team_meta
// 					ON {$wpdb->posts}.ID = team_meta.post_id
// 					AND team_meta.meta_key = 'team'
// 				LEFT JOIN {$wpdb->posts} AS team_post
// 					ON team_meta.meta_value = team_post.ID
// 				LEFT JOIN {$wpdb->postmeta} AS last_name_meta
// 					ON {$wpdb->posts}.ID = last_name_meta.post_id
// 					AND last_name_meta.meta_key = 'last-name'
// 			";
// 			$clauses['orderby'] = "
// 				team_post.post_title ASC,
// 				last_name_meta.meta_value ASC
// 			";
// 			return $clauses;
// 		});
// 	}
// });




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



// Additional Custom Functions

// WP Head and other cleanup functions
require_once(get_template_directory().'/inc/cleanup.php'); 

// Register custom menus and menu walkers
require_once(get_template_directory().'/inc/menu.php'); 

// Makes WordPress comments suck less
require_once(get_template_directory().'/inc/comments.php'); 

// Replace 'older/newer' post links with numbered navigation
require_once(get_template_directory().'/inc/page-navi.php'); 

// Adds site styles to the WordPress editor
require_once(get_template_directory().'/inc/editor-styles.php'); 

// ACF Options
require_once(get_template_directory().'/inc/acf-json.php');

// ACF json
require_once(get_template_directory().'/inc/acf-options.php');

// ACF Block
//require_once(get_template_directory().'/inc/acf-blocks.php');

// Disable Gutenberg
require_once(get_template_directory().'/inc/disable-gutenberg.php'); 

// Add Page Slug to Body Class
// require_once(get_template_directory().'/inc/page-slug-body-class.php');

// Remove Emoji Support
// require_once(get_template_directory().'/inc/disable-emoji.php'); 

// Related post function - no need to rely on plugins
// require_once(get_template_directory().'/inc/related-posts.php'); 

// Use this as a template for custom post types
// require_once(get_template_directory().'/inc/custom-post-type.php');

// Customize the WordPress login menu
// require_once(get_template_directory().'/inc/login.php'); 

// Customize the WordPress admin
// require_once(get_template_directory().'/inc/admin.php'); 

// Sitemap Removal
// require_once(get_template_directory().'/inc/sitemap-removal.php');

// Slugify
// require_once(get_template_directory().'/inc/slugify.php');

// Image Sizes
require_once(get_template_directory().'/inc/image-sizes.php');