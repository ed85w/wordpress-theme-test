<?php
	
/* Collection of Walker classes */
	/*
		
		wp_nav_menu()
		
		<div class="menu-container">
			<ul> // start_lvl()
				<li><a><span> // start_el()
				
					</a></span>
					
					<ul>
					</li> // end_el()
					
				<li><a>Link</a></li>
				<li><a>Link</a></li>
				<li><a>Link</a></li>
				
			</ul> // end_lvl()
		</div>
		
	*/
	
class Walker_Nav_Primary extends Walker_Nav_menu {
	
	//applies bootstrap class .dropdown-menu to ul
	function start_lvl( &$output, $depth = 0, $args = array() ){ //ul
		// indent code dependant on DOM level
		$indent = str_repeat("\t",$depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		//merge the string below with the ul class
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ){ //li a span
		
		// if $depth is defined then str-repeat else empty
		$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
		
		$li_attributes = '';
		$class_names = $value = '';
		
		// if $classes array is empty return empty array (not undefined) else return the array with item classes
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		//check if item has children and add .dropdown class if so
		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';

		//check if item is .current (active, bootstrap class) or .current_item_ancestor (WP class) and return active class if so
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		//add .menu-item-ID to the element
		$classes[] = 'menu-item-' . $item->ID;

		// if li is subelement of subelement & has children elements add .dropdown-submenu class
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}
		
		//join classes in classes array 
		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );

		// make class_names readable to WP
		$class_names = ' class="' . esc_attr($class_names) . '"';
		
		// extract current item's id
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);

		// check id is not empty and return id name if so
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		
		// merge/produce $output with custom values from above
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		// if item attribute title is not empty then return title, else '' (a tags)
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		// if item attribute target is not empty then return target (a tags)
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		//as above for rel
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		//as above for href
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';

		//add bootstrap .dropdown-toggle class if item has children 
		$attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		

		$item_output = $args->before;
		
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ( $depth == 0 && $args->walker->has_children ) ? ' <b class="caret"></b></a>' : '</a>';

		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
	}
	
/*	
	function end_el(){ // closing li a span
		
	}
	
	function end_lvl(){ // closing ul
		
	}
*/
	
}