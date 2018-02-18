<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test Theme</title>
	<?php wp_head(); ?>
</head>

<?php 
	
	// applies 'awesome-class' & 'my-class' if front page (front page set in seetings!)
	if( is_front_page() ):
		$awesome_classes = array('awesome-class', 'my-class');
	else:
		$awesome_classes = array('no-awesome-class');
	endif;
?>

<body <?php body_class($awesome_classes); ?> >

	<!-- header menu (header menu is named primary-->
	<?php wp_nav_menu(array('theme_location' => 'primary')); ?>





<!-- </body> &</html> closed by footer -->