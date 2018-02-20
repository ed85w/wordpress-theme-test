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

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<nav class="navbar navbar-default">
			  		<div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    	<div class="navbar-header">
				      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        		<span class="sr-only">Toggle navigation</span>
				        		<span class="icon-bar"></span>
				        		<span class="icon-bar"></span>
				        		<span class="icon-bar"></span>
				      		</button>
				      		<a class="navbar-brand" href="#">Test Theme</a>
				    	</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<?php 
							// menu items - set in dashboard
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => 'nav navbar-nav navbar-right'
								)
							);

							?>
						</div>
				  	</div><!-- /.container-fluid -->
				</nav>
			</div>
		</div>

	<!-- header image code -->
	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />





<!-- </body> &</html> closed by footer -->