<?php 

/*
	=========================================
	STATIC FILES SETUP
	=========================================
*/

//function to embed custom css & js (test_theme.css in css folder & test_theme.js in js folder)
//always use unique names for functions!!
function test_theme_script_enqueue() { 
	// css
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.4', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/test_theme.css', array(), '1.0.0', 'all' );
	// js
	wp_enqueue_script('jquery');
	wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.7', true);
	wp_enqueue_script('customscript', get_template_directory_uri() . '/js/test_theme.js', array(), '1.0.0', true );
}

//embed custom css & js
add_action('wp_enqueue_scripts', 'test_theme_script_enqueue');


/*
	=========================================
	THEME MENU FUNCTIONS
	=========================================
*/

// function to setup theme menus
function test_theme_setup() {

	//add 'menus' item to 'appearance' options 
	add_theme_support('menus');

	//register nav 
	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');
}
// call functions to setup theme menu
add_action( 'init', 'test_theme_setup');


/*
	=========================================
	THEME SUPPORT FUNCTIONS
	=========================================
*/

// add background image to customisation menu
add_theme_support('custom-background');

// add custom header to appearance menu
add_theme_support( 'custom-header' );

// add post thumbnail image
add_theme_support( 'post-thumbnails' );

// add custom post formats menu
add_theme_support( 'post-formats', array('aside','image','video'));
//use HTML5 in search form
add_theme_support( 'html5', array('search-form') );

/*
	=========================================
	SIDEBAR FUNCTION
	=========================================
*/

function test_theme_widget_setup() {

	register_sidebar( 
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar-1',
			'class' => 'custom', //class name given prefix 'sidebar-' eg 'sidebar-custom'
			'description' => 'Standard sidebar',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after-title' => '</h1>', 
		)
	);

}

add_action('widgets_init','test_theme_widget_setup');

/*
	=========================================
	INCLUDE WALKER FILE
	=========================================
*/

require get_template_directory() . '/inc/walker.php';

/*
	=========================================
	HEAD FUNCTION 
	=========================================
*/

// remove wordpress version from head data (prevent hacks)
function theme_remove_version() {
	return '';
}

add_filter('the_generator', 'theme_remove_version');

/*
	=========================================
	CUSTOM POST TYPE 
	=========================================
*/

function theme_custom_post_type(){

	$labels = array(
		'name' => 'Portfolio',
		'singular_name' => 'Project',
		'add_new' => 'Add Project',
		'all_items' => 'All Projects',
		'add_new_item' => 'Add Project',
		'edit_item' => 'Edit Project',
		'new_item' => 'New Project',
		'view_item' => 'View Project',
		'search_item' => 'Search Portfolio',
		'not_found' => 'No Projects Found',
		'not_found_in_trash' => 'No Projects Found in Trash',
		'parent_item_colon' => 'Parent Project'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false, //ie tags
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail',
			'revisions',
			// 'comments' etc
		),
		// 'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false,
	);
	register_post_type('portfolio', $args);

}

add_action('init', 'theme_custom_post_type');


// custom taxonomies for the above

function theme_custom_taxonomies() {
	
	//add new taxonomy, hierarchical
	$labels = array(
		'name' => 'Fields', //always plural!
		'singular_name' => 'Field',
		'search_items' => 'Search Fields',
		'all_items' => 'All Fields',
		'parent_item' => 'Parent Field',
		'parent_item_colon' => 'Parent Field:',
		'edit_item' => 'Edit Field',
		'update_item' => 'Update Field',
		'add_new_item' => 'Add New Field',
		'new_item_name' => 'New Field Name',
		'menu_name' => 'Fields'
	);

	$args = array(
		'hierarchical' => true, //ie categories
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true, //ability to create custom queries
		'rewrite' => array('slug' => 'field'), //rewrite slug (name of taxonomy, lower case - DON'T USE TYPE!)
	);

	//register 'field' taxonomy to 'portfolio' custom post type
	register_taxonomy('field' , array('portfolio'), $args);


	//add new taxonomy, NOT hierarchical

	register_taxonomy( 'software', 'portfolio', array(
		'label' => 'Software',
		'rewrite' => array('slug' => 'software'),
		'hierarchical' => false, 
	) );
}

add_action( 'init', 'theme_custom_taxonomies');

/*
	=========================================
	CUSTOM TERM FUNCTION (used in single-portfolio.php)
	=========================================
*/

function theme_get_terms($postID, $term) {

	$terms_list = wp_get_post_terms($postID, $term);
	$output ='';

	$i = 0; 
	foreach ($terms_list as $term) {$i++;
		if($i > 1) {$output .= ', ';}
	 	$output .= '<a href="' . get_term_link($term) . '">'. $term->name .'</a>';
	} 

	return $output;
}