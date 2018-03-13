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