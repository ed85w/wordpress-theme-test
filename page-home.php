<?php get_header(); ?>

<div class="row">

		<?php
			//get latest post from 3 different categories
			$args_cat = array(
				'include' => '4, 7, 8'
			);

			$categories = get_categories( $args_cat );

			foreach ($categories as $category): {
				$args = array(
					'type' => 'post',
					'posts_per_page' => 1, 
					'category__in' => $category->term_id,
				);
				$LastBlog = new WP_Query($args);

				if( $LastBlog->have_posts() ):

					while ( $LastBlog->have_posts() ): $LastBlog->the_post(); ?>

						<div class="col-xs-12 col-sm-4">

							<!-- looks for content- file name e.g content-image.php -->
							<?php get_template_part('content', 'featured'); ?>

						</div>

					<?php endwhile;

				endif;

				//reset the post query (use after custom WP_Query)
				wp_reset_postdata();
				}
			endforeach;

			

		?>

</div>

<div class="row">


	<div class="col-xs-12 col-sm-8">

		<?php 

			if( have_posts() ):

				while ( have_posts() ): the_post(); ?>

					<!-- looks for content- file name e.g content-image.php -->
					<?php get_template_part('content', get_post_format()); ?>

				<?php endwhile;

			endif;

		
			//CUSTOM QUERY, SELECT THE NEXT 2 POSTS, NOT INCLUDING THE FIRST
/*			
			$args = array(
				'type' => 'post',
				'posts_per_page' => 2,
				'offset' => 1,
			);

			$LastBlog = new WP_Query($args);

			if( $LastBlog->have_posts() ):

				while ( $LastBlog->have_posts() ): $LastBlog->the_post(); ?>

					<!-- looks for content- file name e.g content-image.php -->
					<?php get_template_part('content', get_post_format()); ?>

				<?php endwhile;

			endif;

			//reset the post query (use after custom WP_Query)
			wp_reset_postdata();
*/
		?>

		<!-- <hr> -->

		<?php

		//CUSTOM QUERY, SELECT ONLY NEWS 
		//'posts_per_page=-1' = infinite, not as set 
		//get category num from url in edit category in dashboard
		
/*		
		$LastBlog = new WP_Query('type=post&posts_per_page=-1&category_name=news');

			if( $LastBlog->have_posts() ):

				while ( $LastBlog->have_posts() ): $LastBlog->the_post(); ?>

					<!-- looks for content- file name e.g content-image.php -->
					<?php get_template_part('content', get_post_format()); ?>

				<?php endwhile;

			endif;

			//reset the post query (use after custom WP_Query)
			wp_reset_postdata();
*/
		?>


	</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div><!--  close row -->
<?php get_footer(); ?>