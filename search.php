<?php

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );

			// End the loop.
			endwhile;
			?>
			<div class="row">
		  <div class="col-md-4 clearfix col-md-offset-4">
				<?php echo get_previous_posts_link( __('', 'material') . '&nbsp;'); ?>
				<?php echo get_next_posts_link( '&nbsp;' . __('', 'material')); ?>
					
				<div class="clear"></div>
			
			</div>
			
		</div> <!-- /post-nav archive-nav -->
		<?php 

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
