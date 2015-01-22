<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;
			?>
			<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
		<div class="row">
		  <div class="col-md-4 clearfix col-md-offset-4">
				<?php echo get_previous_posts_link( __('', 'material') . '&nbsp;'); ?>
				<?php echo get_next_posts_link( '&nbsp;' . __('', 'material')); ?>
					
				<div class="clear"></div>
			
			</div>
			
		</div> <!-- /post-nav archive-nav -->
						
	<?php endif; 

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
