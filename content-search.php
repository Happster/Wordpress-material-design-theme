<article id="post-<?php the_ID(); ?>" class="well page active">
	<?php if ( has_post_thumbnail() ) : ?>	
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
			
				<?php the_post_thumbnail('post-image'); ?>
			
			</a>
			
			<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>
														
				<p class="caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>
				
			<?php endif; ?>
			
	<?php endif; ?>

	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->


</article><!-- #post-## -->
