// prevent $ from conflicting w other frameworks 
// $.noConflict();

jQuery(document).ready(function($){

	// open and close search on click of search in nav bar
	$(document).on('click', '.open-search a', function(e){
		e.preventDefault();
		$('.search-form-container').slideToggle(300);
	});

});