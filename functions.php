<?php 

//function to embed custom css & js (test_theme.css in css folder & test_theme.js in js folder)
//always use unique names for functions!!
function test_theme_script_enqueue() { 
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/test_theme.css', array(), '1.0.0', 'all' );
	wp_enqueue_script('customscript', get_template_directory_uri() . '/js/test_theme.js', array(), '1.0.0', true );
}

//embed custom css & js
add_action('wp_enqueue_scripts', 'test_theme_script_enqueue');


// function to setup theme
function test_theme_setup() {

	//add 'menus' item to 'appearance' options 
	add_theme_support('menus');

	//register nav 
	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Footer Navigation');
}

add_action( 'init', 'test_theme_setup');

?>