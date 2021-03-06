<!DOCTYPE html>
<html <?php language_attributes( ); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset'); ?>">
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title> <!-- title is theme name | blog post title -->
	<meta name="description" content="<?php bloginfo('description'); ?>"> <!-- desciption is tagline -->
	<?php wp_head(); ?>
</head>

<?php 
	
	// applies 'awesome-class' & 'my-class' if front page (front page set in setings!)
	if( is_front_page() ):
		$awesome_classes = array('awesome-class', 'my-class');
	else:
		$awesome_classes = array('no-awesome-class');
	endif;
?>

<body <?php body_class($awesome_classes); ?> >

	<!-- NAVBAR -->
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<nav class="navbar navbar-default navbar-fixed-top">
			  		<div class="container-fluid">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    	<div class="navbar-header">
				      		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        		<span class="sr-only">Toggle navigation</span>
				        		<span class="icon-bar"></span>
				        		<span class="icon-bar"></span>
				        		<span class="icon-bar"></span>
				      		</button>
				      		<a class="navbar-brand" href="<?php echo home_url(); ?>">Test Theme</a>
				    	</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
							<?php 
							// menu items - set in dashboard
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => 'nav navbar-nav navbar-right',
								// add walker dropdown menu
								'walker' => new Walker_Nav_Primary()
								)
							);

							?>
						</div>
				  	</div><!-- /.container-fluid -->
				</nav>
			</div>

			<div class="col-xs-12">
				<div class="search-form-container">
					<div class="container">
						<?php get_search_form(); ?>
					</div>
				</div>
			</div>
		</div>

	<!-- header image code (added, if wanted, from the appearance menu-->
	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" /> 





<!-- </body> &</html> closed by footer -->