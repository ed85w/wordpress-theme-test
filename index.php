<?php get_header(); ?>

<div class="row">
	<div class="col-xs-12 col-sm-8">

		<?php 

		if( have_posts() ):

			while ( have_posts() ): the_post(); ?>

				<!-- looks for content- file name e.g content-image.php -->
				<?php get_template_part('content', get_post_format()); ?>

			<?php endwhile;

		endif;
		
		?>
	</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div><!--  close row -->
<?php get_footer(); ?>