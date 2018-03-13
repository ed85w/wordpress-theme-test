<?php get_header(); ?>

	<div id="primary" class="container">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">

				<head class="page-header">
					<h1 class="page-title">Sorry, page not found</h1>
				</head>

				<div class="page-content">

					<h2>It looks like nothing was found at this location. Try one of the links below</h2>

					<!-- get searchform.php -->
					<?php get_search_form(); ?>

					<!-- get recent posts widget -->
					<?php the_widget('WP_Widget_Recent_Posts'); ?>

					<div class="widget widget_categories">
						<h3>Check the most used categories</h3>

						<ul>
							<?php
								// list by 
								wp_list_categories(array(
									'orderby' => 'count',
									'order' => 'DESC',
									'show_count' => 1, //true
									'title_li' => '', //no title for list
									'number' => 5,
								));
							?>
						</ul>
					</div>

					<!-- get archive widget (with dropdown box)-->
					<?php the_widget('WP_Widget_Archives', 'dropdown=1'); ?>
					
				</div>



			</section>

		</main>
	</div>

<?php get_footer(); ?>