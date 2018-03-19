<?php get_header(); ?>



<div class="row">
	<div class="col-xs-12 col-sm-8">

		<div class="row text-center no-margin">
		
			<?php 

			if( have_posts() ): ?>

				<header>
					

				<?php
					// get the title of the archive being viewed
					the_archive_title('<h1 class="page-title">','</h1>');

					the_archive_description('<div class="taxonomy-description">','</div>')

				?>

				</header>


				<?php while ( have_posts() ): the_post(); ?>

					<!-- content-archive.php -->
					<?php get_template_part('content', 'archive') ?>

				<?php endwhile; ?>
			<div class="col-xs-12 text-center">
				<?php the_posts_navigation( ); ?>
				
			</div>

			<?php endif;
			
			?>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4">
		<?php get_sidebar(); ?>
	</div>

</div><!--  close row -->
<?php get_footer(); ?>