<?php

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		  <div class="well page active">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			get_template_part( 'content', get_post_format() );

			$tags = get_tags();
			$html = '<div class="post_tags padding">';
			foreach ( $tags as $tag ) {
				$tag_link = get_tag_link( $tag->term_id );
						
				$html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='label label-primary'>";
				$html .= "{$tag->name}</a>";
			}
			$html .= '</div>';
			echo $html;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
			
		<?php 
		// End the loop.
		endwhile;
		?>
		 <div class="row">
				  <div class="col-md-4 clearfix col-md-offset-4">
				  <?php
						$prev_post = get_previous_post();
						$next_post = get_next_post();
					?>
					
					<?php								
					if (!empty( $prev_post )): ?>
					
						<a class="btn btn-info btn-fab btn-raised mdi-hardware-keyboard-arrow-left" title="<?php _e('Previous post:', 'hoffman'); echo ' ' . get_the_title($prev_post); ?>" href="<?php echo get_permalink( $prev_post->ID ); ?>">
						</a>
					<?php endif; 
					if (!empty( $next_post )): ?>
						
						<a class="btn btn-info btn-fab btn-raised mdi-hardware-keyboard-arrow-right" title="<?php _e('Next post:', 'material'); echo ' ' . get_the_title($next_post); ?>" href="<?php echo get_permalink( $next_post->ID ); ?>">
						</a>
				
					<?php endif; ?>
						
						<div class="clear"></div>
					
					</div>
			
		    </div> <!-- /post-nav archive-nav -->
       </div>
       <?php 
        

     ?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
